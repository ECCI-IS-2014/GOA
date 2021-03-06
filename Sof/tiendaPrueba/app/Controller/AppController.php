<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


    public $helpers = array('Js' => array('Jquery'));
	
	
    public $components = array(
        'DebugKit.Toolbar',
		'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'home'

            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            //'authorize' => 'controller', extra
            'allowedActions' => array('edit','delete')
        )
    );



    public function isAuthorized() {
        // Admin can access every action
        if ($this->Session->read('Auth.User.role')== 'admin') {
            return true;
        } else {
            $this->Auth->deny(array('controller'=>'products', 'action'=>'index'),array('controller'=>'products', 'action'=>'add'));

        }
        // Default deny
        return false;
    }




    public function beforeFilter() {
        $this->Auth->allow('home','productInside');
        // extra
        $this->Auth->deny('edit', 'delete');
    }
	
}
