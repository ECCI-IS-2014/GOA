<?php
App::uses('AppController', 'Controller');
/**
 * Wishes Controller
 *
 * @property Wish $Wish
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */


class WishesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Product','Wish');
    public $helpers = array('CatalogGenerator', 'Html');
/**
 * index method
 *
 * @return void
 */
	public function index() {
        $us_id=$this->Session->read('Auth.User.id');
        $wishes = $this->Wish->find('all', array('conditions'=>array('Wish.user_id'=>$us_id)));
        $wishesPro = array();

        for($i = 0; $i < count($wishes); $i++) {
            array_push($wishesPro,$this->Product->find('first', array('conditions'=>array('Product.id'=>$wishes[$i]['Wish']['product_id']))));
        }
        $this->set('wishesPro',$wishesPro);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Wish->exists($id)) {
			throw new NotFoundException(__('Invalid wish'));
		}

	}

/**
 * add method
 *
 * @return void
 */


  public function add() {
        $prod_id = $this->passedArgs['id'];
        $us_id=$this->Session->read('Auth.User.id');
        $data = array('user_id' => $us_id,'product_id'=>$prod_id);
        try {
            if ($this->Wish->save($data)) {
                $this->Session->setFlash(__('The product has been added to your wishlist! '));
                return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));
            } else {
                $this->Session->setFlash(__('The product could not be saved in your wishlist. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Session->setFlash(__('Oops! This item is already in your wishlist!'));
            return $this->redirect(array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id));

        }

	}




/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        if ($id == null) {
            $prod_id = $this->passedArgs['id'];
            $us_id=$this->Session->read('Auth.User.id');
        } else {
            $this->request->onlyAllow('post');
            $this->Wish->id = $id;
            $prod_id = $this->Wish->query("SELECT product_id FROM WISHES WHERE id = ".$id.";");
            $us_id= $this->Wish->query("SELECT user_id FROM WISHES WHERE id = ".$id.";");
        }

            if ( !$this->Wish->query("DELETE FROM WISHES WHERE product_id = ".$prod_id." AND user_id =".$us_id.";")) {
                $this->Session->setFlash(__('The wish has been deleted.'));
            } else {
                $this->Session->setFlash(__('The wish could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
}
