<?php

namespace Ajax\common\html\html5;

use Ajax\common\html\HtmlDoubleElement;

abstract class HtmlCollection extends HtmlDoubleElement {

	public function __construct($identifier,$tagName="div"){
		parent::__construct($identifier,$tagName);
		$this->content=array();
	}

	public function addItems($items){
		foreach ($items as $item){
			$this->addItem($item);
		}
	}

	public function setItems($items){
		$this->content=$items;
		return $this;
	}

	public function getItems(){
		return $this->content;
	}

	/**
	 * adds and returns an item
	 * @param HtmlDoubleElement|string $item
	 * @return \Ajax\common\html\HtmlDoubleElement
	 */
	public function addItem($item){
		$itemO=$item;
		if(\is_object($item)===false){
			$itemO=$this->createItem($item);
		}
		$this->addContent($itemO);
		return $itemO;
	}

	/**
	 * Return the item at index
	 * @param int|string $index the index or the item identifier
	 * @return \Ajax\common\html\HtmlDoubleElement
	 */
	public function getItem($index) {
		if (is_int($index))
			return $this->content[$index];
		else {
			$elm=$this->getElementById($index, $this->content);
			return $elm;
		}
	}

	public function setItem($index, $value) {
		$this->content[$index]=$value;
		return $this;
	}

	public function count(){
		return \sizeof($this->content);
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::fromDatabaseObject()
	 */
	public function fromDatabaseObject($object, $function) {
		$this->addItems($function($object));
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::fromArray()
	 */
	public function fromArray($array) {
		$this->addItems($array);
	}
	/**
	 * The item factory
	 * @param string|HtmlDoubleElement $value
	 */
	protected abstract function createItem($value);
}