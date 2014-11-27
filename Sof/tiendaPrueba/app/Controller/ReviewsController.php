<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReviewsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('ProductSale','Rating','Sale','Review','Product');



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->Paginator->paginate());
	}



/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
		$this->set('review', $this->Review->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		$users = $this->Review->User->find('list');
		$products = $this->Review->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
			$this->request->data = $this->Review->find('first', $options);
		}
		$users = $this->Review->User->find('list');
		$products = $this->Review->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('The review has been deleted.'));
		} else {
			$this->Session->setFlash(__('The review could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


    public function verify_purchase()
    {
        $prod_id = $this->passedArgs['id'];
        $user_id=$this->Session->read('Auth.User.id');
        $bills = $this->Sale->find('all', array('conditions'=>array('Sale.user_id'=>$user_id)));
        $result = false;
        for($i = 0; $i<count($bills); $i++)
        {
            $exist =  $this->ProductSale->find('first', array('conditions'=>array('ProductSale.sale_id'=>$bills[$i]['Sale']['id'],'ProductSale.product_id'=>$prod_id)));
            if($exist!=null)
            {
                $result = true;
            }
        }

        if($result==true)
        {
            return $this->redirect(array('controller' => 'Reviews', 'action' => 'add_review','id'=>$prod_id));
        }
        else
        {
            $this->Session->setFlash(__('You need to buy this product before you can review it!'));
            return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));
        }
    }

    public function add_review()
    {
        $prod_id = $this->passedArgs['id'];
        $this->set( 'prod_name', $this->Product->find('first', array('conditions' => array('Product.id' => $prod_id)))['Product']['name']);
        $this->set( 'prod_id', $prod_id);
        $this->set( 'rating', 0);
    }

    public function save_review()
    {
        $prod_id = $this->passedArgs['id'];
        $rating = $this->passedArgs['rating'];
        $description = $this->passedArgs['description'];
        $user_id=$this->Session->read('Auth.User.id');
        $data = array('user_id' => $user_id,'product_id'=>$prod_id,'description'=>$description,'rating'=>$rating);
        $this->Review->save($data);
        if($rating>0)
        {
           $this->rateProduct($prod_id,$rating);
        }
        $this->Session->setFlash(__('Thank you for your review!'));
        return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));
    }

    public function rateProduct( $id, $newRating  ) {
        $this->Product->id = $id;
        if ( $this->Product->exists() && $newRating > 0 && $newRating <= 5 ) {
            $prod = $this->Product->Rating->read( null, $id );
            switch ( $newRating ) {
                case 1:
                    $rating = $prod['Rating']['rating1'] + 1;
                    $this->Product->Rating->set('rating1', $rating );
                    $this->Product->Rating->save();
                    break;
                case 2:
                    $rating = $prod['Rating']['rating2'] + 1;
                    $this->Product->Rating->set('rating2', $rating );
                    $this->Product->Rating->save();
                    break;
                case 3:
                    $rating = $prod['Rating']['rating3'] + 1;
                    $this->Product->Rating->set('rating3', $rating );
                    $this->Product->Rating->save();
                    break;
                case 4:
                    $rating = $prod['Rating']['rating4'] + 1;
                    $this->Product->Rating->set('rating4', $rating );
                    $this->Product->Rating->save();
                    break;
                case 5:
                    $rating = $prod['Rating']['rating5'] + 1;
                    $this->Product->Rating->set('rating5', $rating );
                    $this->Product->Rating->save();
                    break;
            }
            $prod = $this->Product->Rating->read( null, $id );
            $numRates = $prod['Rating']['rating1'] + $prod['Rating']['rating2'] + $prod['Rating']['rating3']
                + $prod['Rating']['rating4'] + $prod['Rating']['rating5'];
            $rating = $prod['Rating']['rating1'] + $prod['Rating']['rating2']*2 + $prod['Rating']['rating3']*3
                + $prod['Rating']['rating4']*4 + $prod['Rating']['rating5']*5;
            $rating = $rating/$numRates;
            $this->Product->set('rating', $rating );
            $this->Product->save();
        }


    }

}
