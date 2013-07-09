<?php

class Item extends CActiveRecord {
    
    public $image;
    
    public function rules()
    {
        return array(
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }
    
}