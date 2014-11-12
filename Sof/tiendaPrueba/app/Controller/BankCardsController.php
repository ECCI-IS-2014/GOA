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

	public $components = array('Paginator', 'Session');

}
