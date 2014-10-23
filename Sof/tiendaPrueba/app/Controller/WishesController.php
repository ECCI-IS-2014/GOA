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


        //$this->set('wishes', $this->Wish->find('all', array('conditions'=>array('Wish.user_id'=>$us_id))));
        $wishes = $this->Wish->find('all', array('conditions'=>array('Wish.user_id'=>$us_id)));
        $wishesPro = array();

        for($i = 0; $i < count($wishes); $i++) {

            //$this->set('wishesPro', $this->Product->find('all', array('conditions'=>array('Product_id'=>$wishes[$i]['Wish']['product_id']))));
            array_push($wishesPro,$this->Product->find('first', array('conditions'=>array('Product.id'=>$wishes[$i]['Wish']['product_id']))));

        }
        $this->set('wishesPro',$wishesPro);
        /*for($i = 0; $i < count($wishesPro); $i++) {

            //$this->set('wishesPro', $this->Product->find('all', array('conditions'=>array('Product_id'=>$wishes[$i]['Wish']['product_id']))));
            echo($wishesPro[$i]['Product']['name']."->".$wishesPro[$i]['Product']['price']."<br>");

        }*/


       // $this->Wish->recursive = 0;
       //$this->set('wishes',$this->Paginator->paginate());

       // print_r($this->Product->find('all'));
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
        $this->Wish->save($data);
        $this->redirect(
            array('controller' => 'Products', 'action' => 'productInside','id'=>$prod_id)
        );

	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Wish->id = $id;
		if (!$this->Wish->exists()) {
			throw new NotFoundException(__('Invalid wish'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Wish->delete()) {
			$this->Session->setFlash(__('The wish has been deleted.'));
		} else {
			$this->Session->setFlash(__('The wish could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}


// hola
