<?php
App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Product','Rating');
	public $helpers = array('CatalogGenerator', 'StringFormatter', 'Html');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if (!empty($this->request->data)) {
            $filename = null;
            if ( !empty($this->request->data['Product']['image']['tmp_name'])
                && is_uploaded_file($this->request->data['Product']['image']['tmp_name']) ) {
                $filename = time() . '-' . basename($this->request->data['Product']['image']['name']);
                move_uploaded_file(
                    $this->data['Product']['image']['tmp_name'],
                    WWW_ROOT . DS . 'img/product_icons' . DS . $filename
                );
            } else {
				// no se definio una imagen
				$filename = 'placeholder.png';
			}
            
			$this->request->data['Product']['image'] = $filename;

            unset($this->Product->Rating->validate['product_id']);
			if ( $this->Product->saveAssociated($this->request->data) ) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Product->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				unset($this->Product->Rating->validate['product_id']);
				if ( $this->Product->saveAssociated($this->request->data) ) {
					$this->Session->setFlash(__('The product has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
				}
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$categories = $this->Product->Category->find('list');
		$this->set(compact('categories'));
	}
	
	/*
     * Hace que el producto con id $id tenga el campo de enable_product en 0
     */
    public function disable($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        } else {
			$this->Product->set('enable_product', 0 );
			$this->Product->save();
			$this->Session->setFlash(__('The product has been disabled.'));
		}

        return $this->redirect(array('action' => 'index'));
    }
	
	/*
     * Hace que el producto con id $id tenga el campo de enable_product en 1
     */
	public function enable($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        } else {
			$this->Product->set('enable_product', 1 );
			$this->Product->save();
			$this->Session->setFlash(__('The product has been enabled.'));
		}
        return $this->redirect(array('action' => 'index'));
    }
	
	/*
     * Asigna un nuevo rating con el valor $newRating al producto con id $id
     */
	public function rateProduct( $id, $newRating  ) {
		$this->Product->id = $id;
        if ( $this->Product->exists() && $newRating > 0 && $newRating <= 5 ) {
            $prod = $this->Product->Rating->read( null, $id );
			switch ( $newRating ) {
				case 1:
					$rating = $prod['Rating']['rating1'] + 1;
					$this->Product->Rating->set('rating1', $rating );
					$this->Product->Rating->save();
					break;
				case 2:
					$rating = $prod['Rating']['rating2'] + 1;
					$this->Product->Rating->set('rating2', $rating );
					$this->Product->Rating->save();
					break;
				case 3:
					$rating = $prod['Rating']['rating3'] + 1;
					$this->Product->Rating->set('rating3', $rating );
					$this->Product->Rating->save();
					break;
				case 4:
					$rating = $prod['Rating']['rating4'] + 1;
					$this->Product->Rating->set('rating4', $rating );
					$this->Product->Rating->save();
					break;
				case 5:
					$rating = $prod['Rating']['rating5'] + 1;
					$this->Product->Rating->set('rating5', $rating );
					$this->Product->Rating->save();
					break;
			}
			$prod = $this->Product->Rating->read( null, $id );
			$numRates = $prod['Rating']['rating1'] + $prod['Rating']['rating2'] + $prod['Rating']['rating3']
					+ $prod['Rating']['rating4'] + $prod['Rating']['rating5'];
			$rating = $prod['Rating']['rating1'] + $prod['Rating']['rating2']*2 + $prod['Rating']['rating3']*3
					+ $prod['Rating']['rating4']*4 + $prod['Rating']['rating5']*5;
			$rating = $rating/$numRates;
			$this->Product->set('rating', $rating );
			$this->Product->save();
		}
		return $this->redirect(array('action' => 'index'));
		// cambiar el redirect luego!
	}

    public function productInside()
    {
        $product_id = $this->passedArgs['id'];

        $this->set( 'product', $this->Product->find('first',array('conditions'=>array('Product.id'=>$product_id)) ));
    }

}
