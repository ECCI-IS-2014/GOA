<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Products');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		}else {
            $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
        }
		$categories = $this->Category->find('list',array('fields'=>array('id','name')));
        $this->set(compact('categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
        }
		$categories = $this->Category->find('list',array('fields'=>array('id','name')));
		$this->set(compact('categories'));
        $this->set('father_id', $this->Category->father_category_id);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;

		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		} else {
			$id_father = $this->Category->field('father_category_id');

			$max = $this->Category->find('first', array('fields' => array('MAX(Category.id) as max_id')));
			for ($id_cate = 1; $id_cate <= $max[0]['max_id']; ++$id_cate) {
				$this->Category->id = $id_cate;
		        if ($this->Category->exists()) {
		        	if ( $this->Category->field('father_category_id') == $id ) {
						$this->Category->set('father_category_id', $id_father );
						$this->Category->save();
					}
				}
			}

			$this->Category->id = $id;
			$this->Category->Product->replaceCategory($id, $id_father);
			$this->request->allowMethod('post', 'delete');
			$this->Category->delete();
			$this->Session->setFlash(__('The category has been deleted.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
