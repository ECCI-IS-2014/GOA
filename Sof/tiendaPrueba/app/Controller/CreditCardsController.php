<?php
App::uses('AppController', 'Controller');
/**
 * CreditCards Controller
 *
 * @property CreditCard $CreditCard
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CreditCardsController extends AppController {

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
		$this->set('card_brands', array('Visa'=>'Visa', 'MasterCard'=>'MasterCard', 'American Express'=>'American Express'));
		if ($this->request->is('post')) {
			$this->CreditCard->create();

			$this->request->data['CreditCard']['user_id'] = $this->Session->read('Auth.User.id');

			if ($this->CreditCard->save($this->request->data)) {
				$this->Session->setFlash(__('The credit card has been saved.'));
				return $this->redirect(array('controller'=>'users','action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The credit card could not be saved. Please, try again.'));
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
		$this->set('card_brands', array('Visa'=>'Visa', 'MasterCard'=>'MasterCard', 'American Express'=>'American Express'));
		if (!$this->CreditCard->exists($id)) {
			throw new NotFoundException(__('Invalid credit card'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CreditCard->save($this->request->data)) {
				$this->Session->setFlash(__('The credit card has been saved.'));
				return $this->redirect(array('controller'=>'users','action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The credit card could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CreditCard.' . $this->CreditCard->primaryKey => $id));
			$this->request->data = $this->CreditCard->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CreditCard->id = $id;
		if (!$this->CreditCard->exists()) {
			throw new NotFoundException(__('Invalid credit card'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CreditCard->delete()) {
			$this->Session->setFlash(__('The credit card has been deleted.'));
		} else {
			$this->Session->setFlash(__('The credit card could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
	}
}
