<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Category $Category
 */
class Product extends AppModel {

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
				'message' => 'Cannot be empty',
			),
			'alphaNumeric' => array(
	            'rule' => 'alphaNumeric',
	            'message' => 'Only alphabets and numbers allowed',
	            'last' => false
	         ),
	        'minLength' => array(
	            'rule' => array('minLength', 3),
	            'message' => 'Minimum length of 3 characters'
	        ),
		),
		'price' => array(
			'money' => array(
				'rule' => array('money'),
				'message' => 'Enter a valid money amount',
			),
		),
		'volume' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
			),
			'comparison' => array(
		        'rule' => array('comparison', '>=', 0),
		        'message' => 'Cannot be negative amount'
		    ),
		),
		'weight' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
			),
			'comparison' => array(
		        'rule' => array('comparison', '>=', 0),
		        'message' => 'Cannot be negative amount'
		    ),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
			),
			'comparison' => array(
		        'rule' => array('comparison', '>=', 0),
		        'message' => 'Cannot be negative amount'
		    ),
		),
		'enable_product' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'image' => array(
            'extension' => array(
                'rule' => array('extension', array('gif','png','jpg','jpeg')),
                'message' => 'Invalid file, only images allowed',
				'allowEmpty' => true,
            ),
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	/*
     * Obtiene todos los productos de la BD
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getAllProducts($order_by = null, $direction = 'DESC') {

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array( 
			'order'=>$order
		));

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD en cuales el atributo $attribute sea igual que $equals
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsByAttributeEquals($attribute, $equals, $order_by = null, $direction = 'DESC') {

		$equals = strtolower($equals);

		$conditions = array('Product.' . $attribute => $equals);

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD en cuales el atributo $attribute sea igual que $equals y que pertenezcan a la categoria $cate_id
     * Si $cate_id es cualquier número negativo, se consideran todas las categorías.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsInCategoryByAttributeEquals($attribute, $equals, $cate_id, $order_by = null, $direction = 'DESC') {

		$equals = strtolower($equals);

		$conditions = array('Product.' . $attribute => $equals);

		if($cate_id > 0) {
			$conditions = array('Product.' . $attribute => $equals, 'Product.category_id' => $cate_id);
		}

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD para los cuales su atributo $attribute contenga a $like como subcadena.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsByAttributeLike($attribute, $like, $order_by = null, $direction = 'DESC') {

		$like = strtolower($like);

		$conditions = array('Product.' . $attribute => $like);

		if($order_by != null) {
			$order = "ORDER BY " . $order_by . " " . $direction;
		}
		else {
			$order = '';
		}

		// TODO: Proteger consulta contra inyección SQL.
		$result = $this->query("SELECT * FROM products AS Product WHERE " . $attribute . " LIKE '%" . $like . "%' " . $order . ";");

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD para los cuales su atributo $attribute contenga a $like como subcadena y que pertenezcan a la categoría con id $cate_id.
     * Si $cate_id es -1 no hace restricción de categorías.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsInCategoryByAttributeLike($attribute, $like, $cate_id, $order_by = null, $direction = 'DESC') {

		$like = strtolower($like);

		if($order_by != null) {
			$order = "ORDER BY " . $order_by . " " . $direction;
		}
		else {
			$order = '';
		}

		$category_condition = " ";

		// TODO: Proteger consultas contra inyección SQL.
		if($cate_id > 0) {
			$category_condition = " category_id = " . $cate_id . " AND ";
		}

		$result = $this->query("SELECT * FROM products AS Product WHERE " . $category_condition . $attribute . " LIKE '%" . $like . "%' " . $order . ";");

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD en cuales el atributo $attribute sea mayor o igual que $greater_equals y menor o igual que $lesser_or_equals,
     * y que pertenezcan a la categoría con id $cate_id
     * Si $cate_id es -1 no hace restricción de categorías.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsInCategoryByAttributeRange($attribute, $greater_or_equals, $lesser_or_equals, $cate_id, $order_by = null, $direction = 'DESC') {

		$conditions = array(
			'Product.' . $attribute . ' BETWEEN ? AND ?' => array($greater_or_equals, $lesser_or_equals)
		);

		if($cate_id > 0) {
			$children_categories = $this->Category->getChildrenCategories($cate_id);
			$or_array = array(
				array('Product.category_id' => $cate_id)
			);
			foreach ($children_categories as $value) {
				array_push($or_array, array('Product.category_id' => $value));	
			}
			$conditions = array(
				'Product.' . $attribute . ' BETWEEN ? AND ?' => array($greater_or_equals, $lesser_or_equals), 
				'OR' => $or_array
			);
		}

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD en cuales el atributo $attribute sea menor o igual que $lesser_equals y que pertenezcan a la categoría con id $cate_id
     * Si $cate_id es -1 no hace restricción de categorías.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsInCategoryByAttributeLesserEquals($attribute, $lesser_equals, $cate_id, $order_by = null, $direction = 'DESC') {

		$conditions = array('Product.' . $attribute . ' <=' => $lesser_equals);

		if($cate_id > 0) {
			$children_categories = $this->Category->getChildrenCategories($cate_id);
			$or_array = array(
				array('Product.category_id' => $cate_id)
			);
			foreach ($children_categories as $value) {
				array_push($or_array, array('Product.category_id' => $value));	
			}
			$conditions = array(
				'Product.' . $attribute . ' <=' => $lesser_equals, 
				'OR' => $or_array
			);
		}

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}

	/*
     * Obtiene todos los productos de la BD en cuales el atributo $attribute sea mayor o igual que $greater_equals y que pertenezcan a la categoría con id $cate_id
     * Si $cate_id es -1 no hace restricción de categorías.
     * Si $order_by es especificado, ordena los resultados según el atributo $order_by, en dirección $direction
     */
	public function getProductsInCategoryByAttributeGreaterEquals($attribute, $greater_equals, $cate_id, $order_by = null, $direction = 'DESC') {

		$conditions = array('Product.' . $attribute . ' >=' => $greater_equals);

		if($cate_id > 0) {
			$children_categories = $this->Category->getChildrenCategories($cate_id);
			$or_array = array(
				array('Product.category_id' => $cate_id)
			);
			foreach ($children_categories as $value) {
				array_push($or_array, array('Product.category_id' => $value));	
			}
			$conditions = array(
				'Product.' . $attribute . ' >=' => $greater_equals, 
				'OR' => $or_array
			);
		}

		if($order_by != null) {
			$order = array('Product.' . $order_by . ' ' . $direction);
		}
		else {
			$order = array();
		}

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}

	/*
	 *	Devuelve la intersección de los arreglos $array1 y $array2, siempre y cuando correspondan a arreglos de productos bien formados.
	 */
	public function intersectResults($array1, $array2) {

		$intersection = Array();

		foreach ($array1 as $value1) {
			foreach ($array2 as $value2) {
				if($value1['Product']['id'] == $value2['Product']['id']) {
					array_push($intersection, $value1);
				}
			}
		}

		return array_unique($intersection);

	}

	/*
	 *	Devuelve la unión de los arreglos $array1 y $array2, siempre y cuando correspondan a arreglos de productos bien formados.
	 */
	public function uniteResults($array1, $array2) {

		$union = Array();

		foreach ($array1 as $value1) {
			array_push($union, $value1);
		}

		foreach ($array2 as $value2) {
			array_push($union, $value2);
		}

		//eliminate duplicates
		for($i = 0; $i < count($union); $i++) {
			for($j = $i+1; $j < count($union); $j++) {
				if($union[$i]['Product']['id'] == $union[$j]['Product']['id']){
					unset($union[$j]);
					$union = array_values($union);
				}
			}
		}

		return $union;

	}
	
	/*
     * Cambia la categoria de todos los productos cuyo categoria sea $old_cate_id por la categoria $new_cate_id
     */
    public function replaceCategory ( $old_cate_id, $new_cate_id  ) {
		
		$total = $this->find('count');

		for ($id = 1; $id <= $total; ++$id) {
			
			$this->id = $id;

	        if (!$this->exists()) {
	            throw new NotFoundException(__('Invalid product'));
	        } else {

	        	if ( $this->field('category_id') == $old_cate_id ) {
					$this->set('category_id', $new_cate_id );
					$this->save();
				}
				
			}
		}
	}

}
