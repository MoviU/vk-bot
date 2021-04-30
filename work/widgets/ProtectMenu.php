<?php
namespace app\widgets;
use yii\base\Widget;

class ProtectMenu extends Widget{

	function init(){
		parent::init();
		
	}
	function run(){
		return $this->render("protectmenu");
	}
}
