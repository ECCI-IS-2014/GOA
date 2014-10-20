<?php
/**
 * ProductFixture
 *
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'price' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'unsigned' => false),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'image' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'enable_product' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'rating' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'description' => array('type' => 'string', 'null' => false, 'default' => 'No description.', 'length' => 1000, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_category_id' => array('column' => 'category_id', 'unique' => 0)
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
			'category_id' => '2',
			'name' => 'sandalias',
			'price' => '2500.00',
			'quantity' => '14',
			'image' => null,
			'enable_product' => 0,
			'rating' => '0',
			'description' => 'No description.'
		),
		array(
			'id' => '2',
			'category_id' => '2',
			'name' => 'botas',
			'price' => '2500.00',
			'quantity' => '8',
			'image' => null,
			'enable_product' => 1,
			'rating' => '0',
			'description' => 'No description.'
		),
		array(
			'id' => '3',
			'category_id' => '2',
			'name' => 'burros',
			'price' => '2500.00',
			'quantity' => '11',
			'image' => null,
			'enable_product' => 1,
			'rating' => '0',
			'description' => 'No description.'
		),
		array(
			'id' => '4',
			'category_id' => '1',
			'name' => 'fedora',
			'price' => '8200.00',
			'quantity' => '7',
			'image' => '1413218846-1.jpg',
			'enable_product' => 1,
			'rating' => '0',
			'description' => 'No description.'
		),
	);

}
