<?php

namespace MickaelBaudoin\SimplePhp;

use MickaelBaudoin\SimpleRender\Render\SimpleRender;
use Pimple\Container;

class Application Extends Container{

	protected $container = array();

	public function __construct()
	{
		parent::__construct();
		$this['Request'] = $this->factory(function(){
			return new Request();
		});

	} 

	public function run()
	{
		if(isset($this['Debug']) && $this['Debug'] == true){
			ini_set('display_errors', -1);
		}
		
		$dispatcher = new Dispatcher( $this['Request'], $this['ViewRender']);
		$dispatcher->dispatch();
	}
}