<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 01/09/14
 * Time: 09:52 AM
 */

class Post extends AppModel{

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }

} 