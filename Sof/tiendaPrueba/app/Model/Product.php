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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
                'message' => 'Invalid file, only images allowed.',
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
	 * 
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

		var_dump($order);

		$result = $this->find('all', array(
			'conditions'=>$conditions, 
			'order'=>$order
		));

		return $result;

	}


	/*
	 *
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
	 *
	 */
	public function getProductsByAttributeRange($attribute, $greater_or_equals, $lesser_or_equals, $order_by = null, $direction = 'DESC') {

		$conditions = array('Product.' . $attribute . ' >=' => $greater_or_equals, 'Product.' . $attribute . ' <=' => $lesser_or_equals);

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
	 *
	 */
	public function getProductsByAttributeLesserEquals($attribute, $lesser_equals, $order_by = null, $direction = 'DESC') {

		$conditions = array('Product.' . $attribute . ' <=' => $lesser_equals);

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
	 *
	 */
	public function getProductsByAttributeGreaterEquals($attribute, $greater_equals, $order_by = null, $direction = 'DESC') {

		$conditions = array('Product.' . $attribute . ' >=' => $greater_equals);

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
