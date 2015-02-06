<?php
namespace Ajax\bootstrap\html;

use Ajax\JsUtils;
use Ajax\bootstrap\html\content\HtmlDropdownItem;
use Ajax\bootstrap\html\base\CssRef;
include_once 'content/HtmlDropdownItem.php';

/**
 * Twitter Bootstrap HTML Modal component
 * @author jc
 * @version 1.001
 */
class HtmlDropdown extends HtmlButton {
	protected $btnCaption="Dropdown button";
	protected $class="dropdown-toggle";
	protected $mClass="dropdown";
	protected $mTagName="div";
	protected $items=array();
	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplDropdown.php';
		$this->tagName="a";
		$this->items=array();
	}
	/**
	 * Define the tagName of the main element
	 * @param string $value
	 * default : div
	 */
	public function setMTagName($value){
		$this->mTagName=$value;
	}


	/**
	 * define the button style
	 * avaible values : "btn-default","btn-primary","btn-success","btn-info","btn-warning","btn-danger"
	 * @param string/int $cssStyle
	 * @return \Ajax\bootstrap\html\HtmlDropdown
	 * default : "btn-default"
	 */
	public function setStyle($cssStyle){
 		if(is_int($cssStyle)){
 			return $this->addToMember($this->class, CssRef::buttonStyles()[$cssStyle]);
 		}
 		return $this->addToMemberCtrl($this->class, $cssStyle, CssRef::buttonStyles());
	}


	/**
	 * add an HtmlDropdownitem
	 * @param string $caption
	 * @param string $href
	 * @return HtmlDropdown
	 */
	public function addItem($caption,$href="#"){
		$iid=$this->getItemsCount()+1;
		$item=new HtmlDropdownItem($this->identifier."-dropdown-item-".$iid);
		$item->setCaption($caption)->setHref($href);
		$this->items[]=$item;
		return $this;
	}

	public function addDivider(){
		return $this->addItem("-");
	}

	public function addItems($items){
		$iid=$this->getItemsCount()+1;
		if(is_array($items)){
			foreach ($items as $item){
				if(is_string($item)){
					$this->addItem($item);
				}else if(is_array($item)){
					$dropDownItem=new HtmlDropdownItem($this->identifier."-dropdown-item-".$iid);
					$dropDownItem->fromArray($item);
					$this->items[]=$dropDownItem;
				}else if($item instanceof HtmlDropdownItem){
					$this->items[]=$item;
				}
			}
		}
		return $this;
	}


	/* (non-PHPdoc)
	 * @see BaseHtml::fromArray()
	 */
	public function fromArray($array) {
		if(array_keys($array) !== range(0, count($array) - 1))
			return parent::fromArray($array);
		else
			return $this->addItems($array);
	}


	public function setItems($items){
		$this->items=array();
		$this->addItems($items);
	}

	/**
	 * Return the item at $index
	 * @param int $index
	 * @return HtmlDropdownItem
	 */
	public function getItem($index){
		return $this->items[$index];
	}

	public function setBtnClass($value){
		//$this->addToMemberCtrl($this->class, $value, CssRef::buttonStyles());
		$this->class=$value;
	}

	public function setMClass($value){
		//$this->addToMemberCtrl($this->class, $value, CssRef::buttonStyles());
		$this->mClass=$value;
	}

	public function addBtnClass($value){
		$this->addToMember($this->class, $value);
	}

	public function addmClass($value){
		$this->addToMember($this->mClass, $value);
	}

	/* (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
		if($this->getProperty("role")==="nav"){
			foreach ($this->items as $dropdownItem){
				$dropdownItem->runNav($js);
			}
		}
		$this->_bsComponent=$js->bootstrap()->dropdown("#".$this->identifier);
		return $this->_bsComponent;
	}

	/**
	 * Sets the tagName's dropdown
	 * @see \Ajax\bootstrap\html\BaseHtml::setTagName()
	 */
	public function setTagName($tagName) {
		if($tagName=="button")
			$this->class="btn";
		return parent::setTagName($tagName);
	}

	public function __toString(){
		return $this->compile();
	}

	public function setBtnCaption($btnCaption) {
		$this->btnCaption = $btnCaption;
		return $this;
	}

	public function getItemsCount(){
		return sizeof($this->items);
	}

	public function setAlignment($alignment){
		if(is_int($alignment))
			$alignment="dropdown-menu-".CssRef::alignment()[$alignment];
		return $this->addToMemberCtrl("class", $alignment,CssRef::alignment());
	}

	public function dropup(){
		$this->addToMember($this->mClass, "dropup");
	}
	public function getItems() {
		return $this->items;
	}


}