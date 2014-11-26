<?php
App::uses('AppController', 'Controller');
/**
 * Addresses Controller
 *
 * @property Address $Address
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AddressesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if ($this->Session->read('Auth.User.id') != false) {
				$this->request->data['Address']['user_id'] = $this->Session->read('Auth.User.id');
			}
			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The shipping address has been saved.'));
				return $this->redirect(array('controller'=>'users','action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.'));
			}
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function addBilling() {
		if ($this->request->is('post')) {
			if ($this->Session->read('Auth.User.id') != false) {
				$this->request->data['Address']['user_id'] = $this->Session->read('Auth.User.id');
			}
			$this->request->data['Address']['is_billing'] = 1;
			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The billing address has been saved.'));
				return $this->redirect(array('controller'=>'users','action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Address->exists($id)) {
			throw new NotFoundException(__('Invalid address'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The address has been saved.'));
				return $this->redirect(array('controller'=>'users','action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Address.' . $this->Address->primaryKey => $id));
			$this->request->data = $this->Address->find('first', $options);
		}
		$users = $this->Address->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			throw new NotFoundException(__('Invalid address'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Address->delete()) {
			$this->Session->setFlash(__('The address has been deleted.'));
		} else {
			$this->Session->setFlash(__('The address could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
	}
}
