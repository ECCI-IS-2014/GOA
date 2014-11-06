<?php
/**
 * SaleFixture
 *
 */
class SaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'method_payment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subtotal' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'frequenly_costumer_discount' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'tax' => array('type' => 'integer', 'null' => false, 'default' => '13', 'length' => 3, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
			'id' => 1,
			'user_id' => 1,
			'method_payment_id' => 1,
			'subtotal' => '',
			'frequenly_costumer_discount' => '',
			'total' => '',
			'created' => '2014-11-05 03:48:50',
			'modified' => '2014-11-05 03:48:50',
			'tax' => 1
		),
	);

}