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
	public $uses = array('CreditCard','BankCard');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('card_brands', array('Visa'=>'Visa', 'Mastercard'=>'MasterCard', 'American Express'=>'American Express'));
		if ($this->request->is('post')) {
			$this->request->data['CreditCard']['user_id'] = $this->Session->read('Auth.User.id');
			$this->request->data['CreditCard']['expiration_date'] = 
				$this->request->data['CreditCard']['expiration_date']['year'].'-'.
				$this->request->data['CreditCard']['expiration_date']['month'].'-01';
				
			if ($this->BankCard->verify_information($this->request->data['CreditCard']['card_number'],$this->request->data['CreditCard']['card_name'],$this->request->data['CreditCard']['brand'],$this->request->data['CreditCard']['expiration_date'])) {
			//if (true) {
				$this->CreditCard->create();

				try {
					if ($this->CreditCard->save($this->request->data)) {
						$this->Session->setFlash(__('The credit card has been saved.'));
						return $this->redirect(array('controller'=>'users','action' => 'profile'));
					} else {
						$this->Session->setFlash(__('The credit card could not be saved. Please, try again.'));
					}
				} catch (Exception $e) {
					$this->Session->setFlash(__('The credit card could not be saved. This credit card has already been added.'));
				}
				
			} else {
				$this->Session->setFlash(__('The credit card could not be saved. The information is not valid.'));
			}
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
