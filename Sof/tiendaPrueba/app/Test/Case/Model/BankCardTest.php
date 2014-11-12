<?php
App::uses('Card', 'Model');

/**
 * Card Test Case
 *
 */
class BankCardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bank_card'
	);


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BankCard = ClassRegistry::init('BankCard');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BankCard);
		parent::tearDown();
	}


    public function test_verify_brand()
    {
        $result = $this->BankCard->verify_brand('VISA','VISA');
        $expected = true;
        $this->assertEquals($expected, $result);
    }

    public function test_verify_name()
    {
        $result = $this->BankCard->verify_brand('Momo','Momo');
        $expected = true;
        $this->assertEquals($expected, $result);
    }

    public function test_expiration()
    {
        $registry = $this->BankCard->find('first',array('conditions'=>array('id'=>'3333444477771111')) );
        $result = $this->BankCard->verify_expiration($registry['BankCard']['expiration_date']);
        $expected = false;
        $this->assertEquals($expected, $result);
    }

    public function test_verify_information()
    {
        $result = $this->BankCard->verify_information('2347190873276228','Pepito Perez Pereira','Mastercard','2015-11-01');
        $expected = true;
        $this->assertEquals($expected, $result);
    }

    public function test_balance_decrease()
    {
        $result = $this->BankCard->balance_decrease(40.32,'8926738498762934');
        $expected = false;
        $this->assertEquals($expected, $result);

    }



}
