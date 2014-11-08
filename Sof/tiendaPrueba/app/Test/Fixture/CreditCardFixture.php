<?php
/**
 * CreditCardFixture
 *
 */
class CreditCardFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'brand' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'card_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'card_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expiration_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'card_number' => array('column' => 'card_number', 'unique' => 1),
			'FK_user_id' => array('column' => 'user_id', 'unique' => 0)
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
			'id' => '1',
			'user_id' => '2',
			'brand' => 'Visa',
			'card_number' => '2897309872176284',
			'card_name' => 'Pepito Perez Pereira',
			'expiration_date' => '2022-06-01'
		),
		array(
			'id' => '2',
			'user_id' => '2',
			'brand' => 'Mastercard',
			'card_number' => '2347190873276228',
			'card_name' => 'Pepito Perez Pereira',
			'expiration_date' => '2015-11-01'
		),
	);

}
