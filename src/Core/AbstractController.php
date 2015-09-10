<?php

namespace MickaelBaudoin\SimplePhp;

abstract class AbstractController{

	/**
	 * @var Request
	 */
	protected $_request;

	protected $_view;

	public function __construct(Request $request, \MickaelBaudoin\SimpleRender\Render\SimpleRender $view)
	{
		$this->_request = $request;
		$this->_view = $view;
	}

	public function setNameLayout($name)
	{
		$view->setNameLayout($name);
	}

	public function render($name, array $params = array())
	{
		$layoutName = $this->_view->getNameLayout();
		if(empty($layoutName)){
			$this->_view->setNameLayout("default");
		}

		$this->_view->render($name, $params);
	}
}