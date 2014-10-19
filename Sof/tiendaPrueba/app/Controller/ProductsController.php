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
	public $helpers = array('CatalogGenerator', 'Html');

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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
     * Cambia la categoria de todos los productos cuyo categoria sea $old_cate_id por la categoria $new_cate_id
     */
    public function replaceCategory ( $old_cate_id, $new_cate_id  ) {
		$total = $this->Product->find('count');
		for ($id = 1; $id <= $total; ++$id) {
			$this->Product->id = $id;
	        if (!$this->Product->exists()) {
	            throw new NotFoundException(__('Invalid product'));
	        } else {
	        	if ( $this->Product->field('category_id') == $old_cate_id ) {
					$this->Product->set('category_id', $new_cate_id );
					$this->Product->save();
				}
			}
		}
	}
	
	/*
     * Obtiene todos los productos de la base de datos, ordenados por el atributo $order_by en orden 'ASC' o 'DESC', 
     * segun el valor de $direction.
     */
	public function browseCatalog($order_by, $direction) {

		$order = array('Product.' . $order_by . ' ' . $direction);	//Example: 'Product.name DESC'

		if($order_by != 'null') {
			$this->set('products', $this->Product->find('all', array(
				'order'=>$order
			)));
		}
		else {
			$this->set( 'products', $this->Product->find('all') );	
		}

		//echo Router::url(array('controller'=>'Product','action'=>'browseCatalog')) + '/param1' + '/param2';

	}

	/*
     * Obtiene los productos de la base de datos que cumplan con la condición de atributo $attribute entre los valores 
     * $match_lesser_than y $match_greater_than (pueden ser el mismo para buscar por valor exacto), ordenados por el atributo 
     * $order_by en orden 'ASC' o 'DESC', segun el valor de $direction.
     */
	public function searchCatalog($attribute, $match_lesser_than, $match_greater_than, $order_by, $direction) {

		if($match_lesser_than == $match_greater_than) {
			$conditions = array('Product.' . $attribute => $match_lesser_than);
		}
		else {
			if($match_lesser_than == 'null') {
				$conditions = array('Product.' . $attribute . ' <=' => $match_greater_than);
			}
			else {
				if($match_greater_than == 'null') {
					$conditions = array('Product.' . $attribute . ' >=' => $match_lesser_than);
				}
				else {
					$conditions = array('Product.' . $attribute . ' >=' => $match_lesser_than, 'Product.' . $attribute . ' <=' => $match_greater_than);
				}
			}
		}

		if($order_by != 'null') {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$this->set('products', $this->Product->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		)));

	}

    public function productInside()
    {
        $product_id = $this->passedArgs['id'];

        $this->set( 'product', $this->Product->find('first',array('conditions'=>array('Product.id'=>$product_id)) ));
    }

}
