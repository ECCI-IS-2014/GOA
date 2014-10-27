<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 27/10/14
 * Time: 11:36 AM
 */
    App::uses('AppModel', 'Model');
    App::uses('CakeSession', 'Model/Datasource');

class Cart extends AppModel{
    public $useTable = false;

    //Esta funcion se encarga de añadir al carrito
    public function addProduct($productId) {
        $allProducts = array();


        $allProducts = $this->read();

            /*if (array_key_exists($productId, $allProducts)) {
                $allProducts[$productId]++;
            } else {
                $allProducts[$productId] = 1;
            }*/

           //


        $this->saveProduct($allProducts);
    }

    /*
    * get total count of products
    */


    /*
     * save data to session
     */
    public function saveProduct($data) {
        return CakeSession::write('cart',$data);
    }

    /*
     * read cart data from session
     */
    public function readProduct() {
        return CakeSession::read('cart');
    }




} 