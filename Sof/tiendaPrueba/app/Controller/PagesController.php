<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Product');

    public $helpers = array('CatalogGenerator', 'Html');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

    public function home() {

	    if(!isset($parts['query'])) {

	    	// HOME CATEGORIES

	        $this->set( 'products_hot', $this->Product->getHotProducts() );
	        $this->set( 'products_sale', $this->Product->getSaleProducts() );
	        $this->set( 'products_top_rated', $this->Product->getTopRatedProducts() );
	        $this->set( 'products_new', $this->Product->getNewProducts() );
	        $this->set( 'products_picks', $this->Product->getPicksProducts($this->Session->read('Auth.User.id')) );

	    }
	    else {

	    	// SEARCH FUNCTION

        	$query = array();
        	$url = $_SERVER['REQUEST_URI'];
	    	$parts = parse_url($url);
	    	debug($parts);

	    	parse_str($parts['query'], $query);

	    	if(isset($query['op'])) {

	    		switch ($query['type']) {

	    			case '1':	//Searchbar search
	    				$res = array(
	    					//persistent params
					    	'op' => $query['op'],
					    );

			        	//optional params
			        	if(isset($query['val']) && $query['val'] != '') {
					    	$res['val'] = $query['val'];
					    }
					    if(isset($query['cat']) && $query['cat'] != '') {
					    	$res['cat'] = $query['cat'];
					    }

					    $this->set('s_params', $res);

					    $arr = Array();

					    if(isset($res['val'])) {
			        		$arr['keyword'] = $this->Product->getProductsInCategoryByAttributeLike('name', strtolower($res['val']), $res['cat'], $order_by = null, $direction = 'DESC');
			        	}

			        	$this->set('s_results', $arr['keyword']);
	    				break;

	    			case '2':   //Search by equal
	    				$res = array(
	    					//persistent params
					    	'op' => $query['op'],
					    	'cat' => $query['cat'],
					    	'match_all' => $query['match_all']
					    );
					    //optional params
					    if(isset($query['keyword']) && $query['keyword'] != '') {
					    	$res['keyword'] = $query['keyword'];
					    }
					    if(isset($query['attr']) && $query['attr'] != '' && isset($query['match_val']) && $query['match_val'] != '') {
					    	$res['attr'] = $query['attr'];
					    	$res['val'] = $query['match_val'];
					    }
					    
			        	$this->set('s_params', $res);

			        	$arr = Array();

			        	if(isset($res['keyword'])) {
			        		$arr['keyword'] = $this->Product->getProductsInCategoryByAttributeLike('name', strtolower($res['keyword']), $res['cat'], $order_by = null, $direction = 'DESC');
			        	}
			        	if(isset($res['attr']) && isset($res['val'])) {
			        		if(strtolower($res['attr']) == 'any') {
			        			$arr['attr'] = Array();
			        			$arr['attr'] = $this->Product->uniteResults(
			        				$this->Product->getProductsInCategoryByAttributeEquals('price', $res['val'], $res['cat'], $order_by = null, $direction = 'DESC'), 
			        				$arr['attr']
			        			);
			        			$arr['attr'] = $this->Product->uniteResults(
			        				$this->Product->getProductsInCategoryByAttributeEquals('rating', $res['val'], $res['cat'], $order_by = null, $direction = 'DESC'), 
			        				$arr['attr']
			        			);
			        			$arr['attr'] = $this->Product->uniteResults(
			        				$this->Product->getProductsInCategoryByAttributeEquals('weight', $res['val'], $res['cat'], $order_by = null, $direction = 'DESC'), 
			        				$arr['attr']
			        			);
			        			$arr['attr'] = $this->Product->uniteResults(
			        				$this->Product->getProductsInCategoryByAttributeEquals('volume', $res['val'], $res['cat'], $order_by = null, $direction = 'DESC'), 
			        				$arr['attr']
			        			);
			        		}
			        		else {
			        			$arr['attr'] = $this->Product->getProductsInCategoryByAttributeEquals(strtolower($res['attr']), $res['val'], $res['cat'], $order_by = null, $direction = 'DESC');
			        		}
			        	}

			        	$result = Array();

			        	if($res['match_all'] == 'true') {
			        		//Intersection of all results
			        		if(isset($arr['keyword']) && isset($arr['attr'])) {
			        			$result = $this->Product->intersectResults($arr['keyword'], $arr['attr']);
			        		}
			        		else {
			        			if(isset($arr['keyword'])) {
			        				$result = $arr['keyword'];
			        			}
			        			else {
			        				if(isset($arr['attr'])) {
			        					$result = $arr['attr'];	
			        				}
			        			}
			        		}
			        	}
			        	else {
			        		//Union of all results
			        		if(isset($arr['keyword']) && isset($arr['attr'])) {
			        			$result = $this->Product->uniteResults($arr['keyword'], $arr['attr']);
			        		}
			        		else {
			        			if(isset($arr['keyword'])) {
			        				$result = $arr['keyword'];
			        			}
			        			else {
			        				if(isset($arr['attr'])) {
			        					$result = $arr['attr'];	
			        				}
			        			}
			        		}

			        		
			        	}

			        	$this->set('s_results', $result);
	    				break;

	    			case '3':	//Search by range
			        	$res = array(
	    					//persistent params
					    	'op' => $query['op'],
					    	'cat' => $query['cat'],
					    	'match_all' => $query['match_all']
					    );
					    //optional params
					    if(isset($query['keyword']) && $query['keyword'] != '') {
					    	$res['keyword'] = $query['keyword'];
					    }
					    if(isset($query['attr']) && $query['attr'] != '' && ((isset($query['match_lt']) && $query['match_lt'] != '') || (isset($query['match_gt']) && $query['match_gt'] != ''))) {
					    	$res['attr'] = $query['attr'];
					    	if(isset($query['match_gt'])) {
					    		$res['val_gt'] = $query['match_gt'];
					    	}
					    	if(isset($query['match_lt'])) {
					    		$res['val_lt'] = $query['match_lt'];	
					    	}
					    }
					    
			        	$this->set('s_params', $res);

			        	$arr = Array();

			        	if(isset($res['keyword'])) {
			        		$arr['keyword'] = $this->Product->getProductsInCategoryByAttributeLike('name', strtolower($res['keyword']), $res['cat'], $order_by = null, $direction = 'DESC');
			        	}
			        	if(isset($res['attr'])) {
			        		if(isset($res['val_gt']) && isset($res['val_lt'])) {
			        			//match between two values
			        			if(strtolower($res['attr']) == 'any') {
			        				$arr['attr'] = Array();
				        			$arr['attr'] = $this->Product->uniteResults(
				        				$this->Product->getProductsInCategoryByAttributeRange('price', $res['val_gt'], $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
				        				$arr['attr']
				        			);
				        			$arr['attr'] = $this->Product->uniteResults(
				        				$this->Product->getProductsInCategoryByAttributeRange('rating', $res['val_gt'], $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
				        				$arr['attr']
				        			);
				        			$arr['attr'] = $this->Product->uniteResults(
				        				$this->Product->getProductsInCategoryByAttributeRange('weight', $res['val_gt'], $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
				        				$arr['attr']
				        			);
				        			$arr['attr'] = $this->Product->uniteResults(
				        				$this->Product->getProductsInCategoryByAttributeRange('volume', $res['val_gt'], $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
				        				$arr['attr']
				        			);
			        			}
			        			else {
			        				$arr['attr'] = $this->Product->getProductsInCategoryByAttributeRange(strtolower($res['attr']), $res['val_gt'], $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC');
			        			}
			        		}
			        		else {
			        			if(isset($res['val_gt'])) {
			        				//match greater than value
			        				if(strtolower($res['attr']) == 'any') {
			        					$arr['attr'] = Array();
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeGreaterEquals('price', $res['val_gt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeGreaterEquals('rating', $res['val_gt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeGreaterEquals('weight', $res['val_gt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeGreaterEquals('volume', $res['val_gt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
				        			}
				        			else {
				        				$arr['attr'] = $this->Product->getProductsInCategoryByAttributeGreaterEquals(strtolower($res['attr']), $res['val_gt'], $res['cat'], $order_by = null, $direction = 'DESC');
				        			}
			        			}
			        			else {
			        				//match lesser than value
			        				if(strtolower($res['attr']) == 'any') {
			        					$arr['attr'] = Array();
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeLesserEquals('price', $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeLesserEquals('rating', $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeLesserEquals('weight', $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
					        			$arr['attr'] = $this->Product->uniteResults(
					        				$this->Product->getProductsInCategoryByAttributeLesserEquals('volume', $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC'), 
					        				$arr['attr']
					        			);
				        			}
				        			else {
				        				$arr['attr'] = $this->Product->getProductsInCategoryByAttributeLesserEquals(strtolower($res['attr']), $res['val_lt'], $res['cat'], $order_by = null, $direction = 'DESC');
				        			}
			        			}
			        		}
			        	}

			        	$result = Array();

			        	if($res['match_all'] == 'true') {
			        		//Intersection of all results
			        		if(isset($arr['keyword']) && isset($arr['attr'])) {
			        			$result = $this->Product->intersectResults($arr['keyword'], $arr['attr']);
			        		}
			        		else {
			        			if(isset($arr['keyword'])) {
			        				$result = $arr['keyword'];
			        			}
			        			else {
			        				if(isset($arr['attr'])) {
			        					$result = $arr['attr'];	
			        				}
			        			}
			        		}
			        	}
			        	else {
			        		//Union of all results
			        		if(isset($arr['keyword']) && isset($arr['attr'])) {
			        			$result = $this->Product->uniteResults($arr['keyword'], $arr['attr']);
			        		}
			        		else {
			        			if(isset($arr['keyword'])) {
			        				$result = $arr['keyword'];
			        			}
			        			else {
			        				if(isset($arr['attr'])) {
			        					$result = $arr['attr'];	
			        				}
			        			}
			        		}
			        	}

			        	$this->set('s_results', $result);
	    				break;
	    			
	    			default:
	    				# code...
	    				break;
	    				
	    		}

	    	}

	    }
	   
    }

}
