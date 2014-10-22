<?php
App::uses('AppController', 'Controller');
/**
 * Wishes Controller
 *
 * @property Wish $Wish
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */


class WishesController extends AppController {

    //public $models = array('Product');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Wish->recursive = 0;
		$this->set('wishes', $this->Paginator->paginate());
       // print_r($this->Product->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Wish->exists($id)) {
			throw new NotFoundException(__('Invalid wish'));
		}
		$options = array('conditions' => array('Wish.' . $this->Wish->primaryKey => $id));
		$this->set('wish', $this->Wish->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $prod_id = $this->passedArgs['id'];
        $id=$this->Session->read('Auth.User.id');
        $data = array('user_id' => $id,'product_id'=>$prod_id);
        $this->Wish->save($data);
        $this->redirect(
            array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id)
        );

	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Wish->id = $id;
		if (!$this->Wish->exists()) {
			throw new NotFoundException(__('Invalid wish'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Wish->delete()) {
			$this->Session->setFlash(__('The wish has been deleted.'));
		} else {
			$this->Session->setFlash(__('The wish could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}


// hola
