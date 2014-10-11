<?php
/**
 * RatingFixture
 *
 */
class RatingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'enable_rating' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'rating1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'rating2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'rating3' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'rating4' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'rating5' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'product_id', 'unique' => 1),
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
			'product_id' => 1,
			'enable_rating' => 1,
			'rating1' => 1,
			'rating2' => 1,
			'rating3' => 1,
			'rating4' => 1,
			'rating5' => 1
		),
	);

}
