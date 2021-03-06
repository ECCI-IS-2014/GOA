<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */



class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $helpers = array('StringFormatter');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'view', 'home');
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->isAuthorized()) { // if is admin
                    return $this->redirect(array('controller'=>'products', 'action'=>'index'));
                } else {
                    return $this->redirect(array('controller'=>'Pages', 'action'=>'home'));
                }
            } else {
                return $this->Session->setFlash(__('Invalid username or password, try again. </br> If this is your first time here, create an <a href="http://localhost/blog/TiendaOnline/users/add">account</a>'));
            }
        }

        $this->Session->write('cart');
        $cart = array(0);
        $this->Session->write('cart',$cart);

        $this->Session->write('numProducts');
        $numProducts = array(0);
        $this->Session->write('numProducts',$numProducts);

        $this->Session->write('totalCartProducts');
        $totalCartProducts = 0;
        $this->Session->write('totalCartProducts',$totalCartProducts);

        $this->Session->write('flag',0);
    }

    public function profile(){
        $id=$this->Session->read('Auth.User.id');
        $this->set('user', $this->User->read(null, $id));
		$fclient = $this->User->find('all',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));
        $this->set('frecuentuser',$fclient[0]['User']['frecuent_client']);
    }


    public function logout() {
        $this->Session->setFlash(__('You have logged out.'));
        return $this->redirect($this->Auth->logout());
    }

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $this->set('user', $this->User->read(null, $id));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
			$this->request->data['User']['address'] = "null";
            try {
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved! Login to start using FutureStore!'));
                    return $this->redirect(array('controller' => 'Pages','action' => 'home'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash(__('This Username is taken, please try another Username'));
                return $this->redirect(array('action' => 'add'));

            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

        $id=$this->Session->read('Auth.User.id');

        $this->User->id = $id;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
                $this->Session->setFlash(__('The user has been updated.'));
                return $this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}

		} else {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
        $this->request->onlyAllow('post');
		$this->User->id = $id;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
        $this->Auth->logout();
		return $this->redirect(array('controller' => 'Pages','action' => 'home'));
	}

    public function disable($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        } else {
            $this->User->set('status', 0 );
            $this->User->save();
            $this->Session->setFlash(__('The user has been disabled.'));
        }

        return $this->redirect(array('action' => 'index'));
    }
	
	public function enable($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        } else {
            $this->User->set('status', 1 );
            $this->User->save();
            $this->Session->setFlash(__('The user has been enabled.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    function convertPasswords() {
        if(!empty( $this->data['User']['password'] ) ){
            $this->data['User']['password'] = $this->Auth->password($this->data['User']['password'] );
        }
        if(!empty( $this->data['User']['confirm_password'] ) ){
            $this->data['User']['confirm_password'] = $this->Auth->password( $this->data['User']['confirm_password'] );
        }
    }
}



