<?php
App::uses('AddressesController', 'Controller');

/**
 * AddressesController Test Case
 *
 */
class AddressesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.address',
		'app.user'
	);

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$Addresses = $this->generate('Addresses', array(
            'components' => array(
                'Session'
            )
        ));
        $Addresses->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Address' => array(
				'user_id' => '2',
				'country' => 'Costa Rica',
				'state' => 'Heredia',
				'city' => 'Belen',
				'street' => 'Frente al mall.',
			)
		);
		$this->testAction('/addresses/add', array('data' => $data));

		$count = $Addresses->Address->find('count');
		$this->assertEquals($count, 2);
	}

/**
 * testAddBilling method
 *
 * @return void
 */
	public function testAddBilling() {
		$Addresses = $this->generate('Addresses', array(
            'components' => array(
                'Session'
            )
        ));
        $Addresses->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Address' => array(
				'user_id' => '2',
				'country' => 'Costa Rica',
				'state' => 'Heredia',
				'city' => 'Belen',
				'street' => 'Frente al mall.',
			)
		);
		$this->testAction('/addresses/addBilling', array('data' => $data));

		$count = $Addresses->Address->find('count');
		$this->assertEquals($count, 2);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$Addresses = $this->generate('Addresses', array(
			'components' => array(
				'Session'
			)
		));
		$Addresses->Session->expects($this->any())->method('setFlash');
		
		$data = array(
			'Address' => array(
				'id' => '2',
				'user_id' => '2',
				'country' => 'Costa Rica',
				'state' => 'Heredia',
				'city' => 'Belen',
				'street' => 'Frente al mall.',
			)
		);
		
		// Pruebas antes del edit
		$addr = $Addresses->Address->read(null, 2);
		$this->assertEqual($addr['Address']['city'], 'Heredia');
		$this->assertEqual($addr['Address']['street'], 'Al lado de la esquina');
		
		$this->testAction('/addresses/edit/2', array('data' => $data));
		
		// Pruebas despues del edit
		$addr = $Addresses->Address->read(null, 2);
		$this->assertEqual($addr['Address']['city'], 'Belen');
		$this->assertEqual($addr['Address']['street'], 'Frente al mall.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$Addresses = $this->generate('Addresses', array(
            'components' => array(
                'Session'
            )
        ));
        $Addresses->Session->expects($this->any())->method('setFlash');
		$this->testAction('/addresses/delete/1');

		$count = $Addresses->Address->find('count');
		$this->assertEquals($count, 1);
	}

}
