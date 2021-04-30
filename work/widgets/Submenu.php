<?php

namespace app\widgets;
use yii\base\Widget;

class Submenu extends Widget{
    public $left;
    public $right;
    function init(){
        parent::init();
        if(empty($this->left))
            $this->left= [];
        if(empty($this->right))
            $this->right= [];
    }
    function run(){
        return $this->render("submenu",["left"=>$this->left,"right"=>$this->right]);
    }
}
