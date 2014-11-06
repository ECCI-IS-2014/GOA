<?php
App::uses('AppController', 'Controller');
/**
 * Cards Controller
 *
 * @property Card $Card
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BankCardsController extends AppController {

    public $uses = array('BankCard');
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
		$this->Card->recursive = 0;
		$this->set('cards', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Card->exists($id)) {
			throw new NotFoundException(__('Invalid card'));
		}
		$options = array('conditions' => array('Card.' . $this->Card->primaryKey => $id));
		$this->set('card', $this->Card->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Card->create();
			if ($this->Card->save($this->request->data)) {
				$this->Session->setFlash(__('The card has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The card could not be saved. Please, try again.'));
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
		if (!$this->Card->exists($id)) {
			throw new NotFoundException(__('Invalid card'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Card->save($this->request->data)) {
				$this->Session->setFlash(__('The card has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The card could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Card.' . $this->Card->primaryKey => $id));
			$this->request->data = $this->Card->find('first', $options);
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
		$this->Card->id = $id;
		if (!$this->Card->exists()) {
			throw new NotFoundException(__('Invalid card'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Card->delete()) {
			$this->Session->setFlash(__('The card has been deleted.'));
		} else {
			$this->Session->setFlash(__('The card could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    /**
     * Funcion para verificar el nombre del dueño de la tarjeta
     */

    public function verify_name($card_holder_EF)
    {
        $result = false;
        $card_holder_store=  $this->Session->read('card_holder');
        if($card_holder_EF===$card_holder_store)
        {
            $result = true;
        }
        return $result;
    }

    public function verify_expiration_date($exp_date_EF)
    {
        $valid = false;
        $exp_date =  $this->Session->read('exp_date');

        $todays_date = date("Y-m-d");
        $today = strtotime($todays_date);
        $expiration_date = strtotime($exp_date);
        $expira_date_EF = strtotime($exp_date_EF);
        if ($expiration_date > $today && $expira_date_EF == $expiration_date)
        {
            $valid = true;
        }

        return $valid;
    }

    public function balance_decrease()
    {
        $card_number_store = $this->Session->read('card_number');
        $bill = $this->Session->read('bill');
        $result = false;
        $conditions = array('BankCard.id'=>$card_number_store);
       if($this->BankCard->hasAny($conditions))
       {

            $card = $this->Product->find('first',array('conditions'=>array('BankCard.id'=>$card_number_store)) );
            $money_left = $card['BankCard']['balance'];
             if($money_left>$bill)
             {
                  $money_left = $money_left - $bill;
                  $this->BankCard->id = $card_number_store;
                  $this->BankCard->saveField('balance', $money_left);
                 $result = true;
              }
      }
        return $result;
    }

    public function verify_brand($card_brand,$card)
    {
        $result = false;
        $card_brand = $this->Session->read('card_brand');
        if($card_brand_EF===$card_brand)
        {
            $result = true;
        }
        return $result;
    }


}
