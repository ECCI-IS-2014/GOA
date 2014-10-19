<?php
/**
 * CategoryFixture
 *
 */
class CategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_category_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_category_father_id' => array('column' => 'father_category_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		/*array(
			'id' => '1',
			'name' => 'ropa',
			'father_category_id' => null
		),
		array(
			'id' => '2',
			'name' => 'higiene personal',
			'father_category_id' => null
		),
		array(
			'id' => '3',
			'name' => 'alimentos',
			'father_category_id' => null
		),
		array(
			'id' => '4',
			'name' => 'electrodomesticos',
			'father_category_id' => null
		),
		array(
			'id' => '5',
			'name' => 'muebles',
			'father_category_id' => null
		),
		array(
			'id' => '6',
			'name' => 'hogar',
			'father_category_id' => null
		),*/
		array(
			'id' => '1',
			'name' => 'sombreros',
			'father_category_id' => null
		),
		array(
			'id' => '2',
			'name' => 'calzado',
			'father_category_id' => '1'
		),
		/*array(
			'id' => '9',
			'name' => 'limpieza',
			'father_category_id' => null
		),
		array(
			'id' => '10',
			'name' => 'miscelaneo',
			'father_category_id' => null
		),*/
	);

}
