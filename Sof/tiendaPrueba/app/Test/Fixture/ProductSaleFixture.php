<?php
/**
 * ProductSaleFixture
 *
 */
class ProductSaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'sale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'price' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'discount' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'noRepit' => array('column' => array('sale_id', 'product_id'), 'unique' => 1),
			'user_id' => array('column' => array('sale_id', 'product_id'), 'unique' => 1),
			'FK_sale_id' => array('column' => 'sale_id', 'unique' => 0),
			'FK_product_id' => array('column' => 'product_id', 'unique' => 0)
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
			'sale_id' => 1,
			'product_id' => 1,
			'quantity' => 1,
			'price' => '',
			'discount' => ''
		),
	);

}
