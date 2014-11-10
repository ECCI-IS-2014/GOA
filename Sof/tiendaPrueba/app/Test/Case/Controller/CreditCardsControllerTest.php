<?php
App::uses('CreditCardsController', 'Controller');

/**
 * CreditCardsController Test Case
 *
 */
class CreditCardsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.credit_card',
		'app.user'
	);

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$Cards = $this->generate('CreditCards', array(
            'components' => array(
                'Session'
            )
        ));
        $Cards->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'CreditCard' => array(
				'user_id' => '2',
				'brand' => 'Visa',
				'card_number' => '4444888877772222',
				'card_name' => 'Pepito Perez Pereira',
				'expiration_date' => array(
					'year' => '2017',
					'month' => '02',
				),
			),
		);
		$this->testAction('/credit_cards/add', array('data' => $data));

		$count = $Cards->CreditCard->find('count');
		$this->assertEquals($count, 3);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$Cards = $this->generate('CreditCards', array(
            'components' => array(
                'Session'
            )
        ));
        $Cards->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'CreditCard' => array(
				'id' => '2',
				'user_id' => '2',
				'brand' => 'Visa',
				'card_number' => '2347190873276228',
				'card_name' => 'Pepito Perez Pereira',
				'expiration_date' => array(
					'year' => '2015',
					'month' => '11',
				),
			),
		);

		// Prueba antes del edit
		$card = $Cards->CreditCard->read(null, 2);
		$this->assertEqual($card['CreditCard']['brand'], 'Mastercard');

		$this->testAction('/credit_cards/edit/2', array('data' => $data));

		// Prueba despues del edit
		$card = $Cards->CreditCard->read(null, 2);
		$this->assertEqual($card['CreditCard']['brand'], 'Visa');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$Cards = $this->generate('CreditCards', array(
            'components' => array(
                'Session'
            )
        ));
        $Cards->Session->expects($this->any())->method('setFlash');
		$this->testAction('/credit_cards/delete/1');

		$count = $Cards->CreditCard->find('count');
		$this->assertEquals($count, 1);
	}

}
