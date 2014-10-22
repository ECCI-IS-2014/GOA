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
		if ($this->request->is('post')) {
			$this->Wish->create();
			if ($this->Wish->save($this->request->data)) {
				$this->Session->setFlash(__('The wish has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The wish could not be saved. Please, try again.'));
			}
		}
		$users = $this->Wish->User->find('list');
		$products = $this->Wish->Product->find('list');
		$this->set(compact('users', 'products'));
       // $this->set('users', 'products'));
       // print_r($this->Product->find('all'));
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
