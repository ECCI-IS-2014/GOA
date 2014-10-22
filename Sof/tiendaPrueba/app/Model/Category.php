<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Product $Product
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    //Cosas de prueba para hacer lo de la relación recursiva

    public $belongsTo = array(
        'Parent' => array(
            'className' => 'Category',
            'foreignKey' => 'father_category_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $hasManyCategories  = array(
        'Children' => array(
            'className' => 'Category',
            'foreignKey' => 'father_category_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
	
	public function listCategoriesBelowLevel3( $ignore_id = null ) {
		$total = $this->find('count');
		
		$this->id = 0;
		$result[0] = $this->field('name');

		$max = $this->find('first', array('fields' => array('MAX(Category.id) as max_id')));
		
		for ($id = 1; $id <= $max[0]['max_id']; ++$id) {
			$this->id = $id;
			
			if ($this->exists() && $this->field('father_category_id') == 0 ) {
				if ($id != $ignore_id) {
					$result[$id] = $this->field('name');
				}
				$idLevel1 = $this->field('id');
				
				for ($id2 = 1; $id2 <= $max[0]['max_id']; ++$id2) {
					$this->id = $id2;
					
					if ($this->exists() && $this->field('father_category_id') == $idLevel1 ) {
						if ($id2 != $ignore_id) {
							$result[$id2] = $this->field('name');
						}
					}
				}
				
			}
		}
		
		return $result;
	}
}
