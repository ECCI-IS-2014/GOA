<?php
App::uses('AppController', 'Controller');
/**
 * ProductSales Controller
 *
 * @property ProductSale $ProductSale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductSalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $helpers = array('CatalogGenerator', 'StringFormatter', 'Html');
    public $uses = array('Product','Cart', 'Sale', 'CreditCard', 'ProductSale');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProductSale->recursive = 0;
		$this->set('productSales', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductSale->exists($id)) {
			throw new NotFoundException(__('Invalid product sale'));
		}
		$options = array('conditions' => array('ProductSale.' . $this->ProductSale->primaryKey => $id));
		$this->set('productSale', $this->ProductSale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function pay() {
        $cart = $this->Session->read('cart');
        for( $i = 1; $i < count($cart); $i++ ) {
            $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$cart[$i])));
            $this->ProductSale->query("INSERT INTO product_sales (sale_id,product_id,quantity, price,discount) VALUES(".$this->Session->read('sale_id').",".$product['Product']['id'].",".$product['Product']['quantity'].",".$product['Product']['price'].",".$product['Product']['discount'].");");
       }

        return $this->redirect(array('controller' => 'Sales', 'action' => 'buys'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductSale->exists($id)) {
			throw new NotFoundException(__('Invalid product sale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductSale->save($this->request->data)) {
				$this->Session->setFlash(__('The product sale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product sale could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSale.' . $this->ProductSale->primaryKey => $id));
			$this->request->data = $this->ProductSale->find('first', $options);
		}
		$sales = $this->ProductSale->Sale->find('list');
		$products = $this->ProductSale->Product->find('list');
		$this->set(compact('sales', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductSale->id = $id;
		if (!$this->ProductSale->exists()) {
			throw new NotFoundException(__('Invalid product sale'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductSale->delete()) {
			$this->Session->setFlash(__('The product sale has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product sale could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
