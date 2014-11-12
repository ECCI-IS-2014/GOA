<?php
/**
 * BankCardFixture
 *
 */
class BankCardFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expiration_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'card_holder' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'balance' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '20,2', 'unsigned' => false),
		'card_brand' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'verification_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '2347190873276228',
			'expiration_date' => '2015-11-01',
			'card_holder' => 'Pepito Perez Pereira',
			'balance' => '20000.50',
			'card_brand' => 'Mastercard',
			'verification_number' => '000'
		),
		array(
			'id' => '2897309872176284',
			'expiration_date' => '2022-06-01',
			'card_holder' => 'Pepito Perez Pereira',
			'balance' => '20000.50',
			'card_brand' => 'Visa',
			'verification_number' => '000'
		),
		array(
			'id' => '4444888877772222',
			'expiration_date' => '2017-02-01',
			'card_holder' => 'Pepito Perez Pereira',
			'balance' => '25000.50',
			'card_brand' => 'Visa',
			'verification_number' => '000'
		),
		array(
			'id' => '3333444477771111',
			'expiration_date' => '2014-02-01',
			'card_holder' => 'Pepito Perez Pereira',
			'balance' => '90000.50',
			'card_brand' => 'Visa',
			'verification_number' => '000'
		),
	);

}
