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


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


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
	
	/*
     * Devuelve una lista de la forma [id] => 'nombreCategoria' de todas las categorias que se 
     * encuentran en los niveles 0, 1 o 2 del arbol de categorias. No incluye en la lista la 
     * categoria con id igual a $ignore_id y a sus categorís hijas.
     */
	public function listCategoriesBelowLevel3( $ignore_id = null ) {
		
		$this->id = 0;
		if ($this->exists()) {
			$result[0] = $this->field('name');
		} else {
			$result[0] = 'No category.';
		}

		$max = $this->find('first', array('fields' => array('MAX(Category.id) as max_id')));
		
		for ($id = 1; $id <= $max[0]['max_id']; ++$id) {
			
			if ( $id != $ignore_id ) {
				$this->id = $id;
			
				if ( $this->exists() && $this->field('father_category_id') == 0 ) {
					
					$result[$id] = $this->field('name');
					$idLevel1 = $this->field('id');
					
					for ($id2 = 1; $id2 <= $max[0]['max_id']; ++$id2) {
						if ($id2 != $ignore_id) {
							
							$this->id = $id2;
						
							if ($this->exists() && $this->field('father_category_id') == $idLevel1 ) {
								$result[$id2] = $this->field('name');
							}
						}
					}
				}	
			}
		}
		
		return $result;
	}

	/*
     * Delvuelve una lista de la forma [id] => 'nombreCategoria' de todas las categorias en forma de
     * arbol. Ademas incluye la opcion [-1] => 'All Categories'.
     */
	public function listCategoriesForHome () {
		
		$result[-1] = 'All Categories';

		$max = $this->find('first', array('fields' => array('MAX(Category.id) as max_id')));
		
		for ($id = 1; $id <= $max[0]['max_id']; ++$id) {						// categorias de nivel 1
			$this->id = $id;
			
			if ($this->exists() && $this->field('father_category_id') == 0 ) {
				$result[$id] = $this->field('name');
				$idLevel1 = $this->field('id');
				
				for ($id2 = 1; $id2 <= $max[0]['max_id']; ++$id2) {				// categorias de nivel 2
					$this->id = $id2;
					
					if ($this->exists() && $this->field('father_category_id') == $idLevel1 ) {
						$result[$id2] = "- " . $this->field('name');
						$idLevel2 = $this->field('id');

						for ($id3 = 1; $id3 <= $max[0]['max_id']; ++$id3) {		// categorias de nivel 3
							$this->id = $id3;
							
							if ($this->exists() && $this->field('father_category_id') == $idLevel2 ) {
								$result[$id3] = "- - " . $this->field('name');
							}
						}
					}
				}
			}
		}
		return $result;

	}

	public function getChildrenCategories($cate_id) {

		$temp1 = $this->find('all', array('conditions' => array('Category.father_category_id' => $cate_id)));
		$temp2 = Array();
		foreach ($temp1 as $entry) {
			array_push($temp2, $entry['Category']['id']);
		}

		$exit_sentinel = false;
		while($exit_sentinel != true) {

			$exit_sentinel = true;
			foreach ($temp2 as $entry) {

				$temp1 = $this->find('all', array('conditions' => array('Category.father_category_id' => $entry)));
				foreach ($temp1 as $entry3) {
					if(in_array($entry3['Category']['id'], $temp2) != true) {
						array_push($temp2, $entry3['Category']['id']);
						$exit_sentinel = false;
					}
				}

			}

		}

		return $temp2;

	}
}
