<?php

namespace App\Modules\Front\Controllers;

class IndexController extends \MickaelBaudoin\SimplePhp\AbstractController{

	public function indexAction()
	{
		$this->render('index', array('test' => 'hello world'));
	}
}