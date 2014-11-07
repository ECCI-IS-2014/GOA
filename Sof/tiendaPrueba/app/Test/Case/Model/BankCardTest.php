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
		'app.BankCard'
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
		unset($this->Card);

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
        $registry = $this->BankCard->find('first',array('conditions'=>array('BankCard.id'=>'8926738498762934')) );
        $result = $this->BankCard->verify_expiration($registry['BankCard']['expiration_date']);
        $expected = false;
        $this->assertEquals($expected, $result);
    }

    public function test_verify_information()
    {
        $result = $this->BankCard->verify_information('2347190873276228','Pepito Perez Pereira','Mastercard');
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
