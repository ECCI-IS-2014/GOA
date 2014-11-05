<?php
/**
 * CardFixture
 *
 */
class CardFixture extends CakeTestFixture {

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
			'id' => 'Lorem ipsum do',
			'expiration_date' => '2014-11-05',
			'card_holder' => 'Lorem ipsum dolor sit amet',
			'balance' => '',
			'card_brand' => 'Lorem ipsum dolor '
		),
	);

}
