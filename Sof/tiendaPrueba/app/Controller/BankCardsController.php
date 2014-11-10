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


    public function pruebaVerificaciones() {
        $result = $this->BankCard->balance_decrease(1000.00,'7829367022378349');
        if($result)
        {
            echo('SI PASO');
        }
        else
        {
            echo('NO PASO');
        }
    }

}
