<?php

namespace MickaelBaudoin\SimplePhp;

class Dispatcher{
	
	protected $_request;

	protected $_controller;

	protected $_view;

	public function __construct($request, $view)
	{
		$this->_request = $request;
		$this->_view = $view;
		$this->_resolveController();
	}

	public function getRequest()
	{
		return $this->_request;
	}

	protected function _resolveController()
	{
		$controller = sprintf("\\App\\Modules\\%s\\Controllers\\%sController", ucfirst($this->_request->getModuleName()), ucfirst($this->_request->getControllerName()));
		if(!class_exists($controller)){
			throw new \Exception("Controller $controller not found");
		}
		$this->_controller = new $controller($this->_request, $this->_view);
	}

	public function dispatch()
	{
		$action = ucfirst($this->_request->getActionName()) . "Action";
		if(!method_exists($this->_controller, $action)){
			throw new \Exception("$action action not found");
		}
		$this->_controller->$action();
	}
}