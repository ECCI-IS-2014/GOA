<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array('CatalogGenerator', 'StringFormatter', 'Html');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Product','Cart');
/**
 * index method
 *
 * @return void
 */

    public function index() {
        $this->Sale->recursive = 0;
        $this->set('sales', $this->Paginator->paginate());
    }


    public function checkout() {
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');
        $totalCartProducts = 0;

        $cart_Ids = array();

        for( $i = 0; $i < count($cart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i])));
            array_push($cart_Ids,$product);
            if ( $i > 0 ) {
                if ( $i > 0 && $product['Product']['enable_product'] == 0 ) {
                    // Revisa que el producto no haya sido deshabilitado
                    $numProducts[$i] = 0;
                    $this->Session->write('numProducts',$numProducts);
                } elseif( $product['Product']['quantity'] < $numProducts[$i] ) {
                    // Mantiene la cantidad de productos por comprar limitada por la quantity del producto
                    $numProducts[$i] = $product['Product']['quantity'];
                    $this->Session->write('numProducts',$numProducts);
                }
            }
            $totalCartProducts = $totalCartProducts + $numProducts[$i];
        }

        $this->Session->write('totalCartProducts',$totalCartProducts);

        $this->set('totalCartProducts',$totalCartProducts);
        $this->set('prodCarts',$cart_Ids);
        $this->set('numProducts',$numProducts);

    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sale->create();
			if ($this->Sale->save($this->request->data)) {
				$this->Session->setFlash(__('The sale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		}
		$users = $this->Sale->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 *
 */
    public function edit($id = null) {
    $cart = $this->Session->read('cart');
    $numProducts = $this->Session->read('numProducts');

    $pos = array_search($id,$cart);
    if ( $pos != false ) {
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            $numProducts[$pos] = $data['cantidad'];
        }
    }
    $this->Session->write('numProducts',$numProducts);

    return $this->redirect(array('controller' => 'carts', 'action' => 'index'));

}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

    public function delete() {
        $prod_id = $this->passedArgs['id'];
        $cart = $this->Session->read('cart');
        $numProducts = $this->Session->read('numProducts');

        $pos = array_search($prod_id,$cart);

        $first_cart = array_slice($cart, 0, $pos);
        $second_cart = array_slice($cart, $pos+1);
        $first_num = array_slice($numProducts, 0, $pos);
        $second_num = array_slice($numProducts, $pos+1);

        for($i = 0; $i<count($second_cart);$i++) {
            array_push($first_cart,$second_cart[$i]);
            array_push($first_num,$second_num[$i]);
        }

        $this->Session->write('cart',$first_cart);
        $this->Session->write('numProducts',$first_num);

        return $this->redirect(array('controller' => 'sales', 'action' => 'checkout'));
    }
}
