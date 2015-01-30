<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
use Phalcon\Text;
use Phalcon\Mvc\Url;
use Ajax\Properties\Position;
require_once 'SimpleComponent.php';
/**
 * JQuery UI Autocomplete component
 * @author jc
 * @version 1.001
 */
class Autocomplete extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="autocomplete";
		$this->setParam("minLength", 3);
	}

	/**
	 * Define source property with an ajax request based on $url
	 * $url must return a JSON array of values
	 * @param String $url
	 */
	public function setAjaxSource($url){
		if(Text::startsWith($url, "/")){
			$u=$this->js->getDi()->get("url");
			$url=$u->getBaseUri().$url;
		}
		$ajax="%function (request, response) {
			$.ajax({
				url: '{$url}',
				dataType: 'jsonp',
				data: {q : request.term},
				success: function(data) {response(data);}
			});
		}%";
		$this->setParam("source", $ajax);
	}

	/**
	 * Define the source property
	 * with a JSON Array of values
	 * Example : ["Bordeaux","Alsace","Bourgogne"]
	 * Example : [{value : "BO", label : "Bordeaux"}, {value : "AL", label : "Alsace"}, {value : "BOU", label : "Bourgogne"}]
	 * @param String $source
	 */
	public function setSource($source){
		$source=str_ireplace(array("\"","'"), "%quote%", $source);
		$this->setParam("source", "%".$source."%");
	}

	/**
	 * If set to true the first item will automatically be focused when the menu is shown.
	 * default : false
	 * @param Boolean $value
	 */
	public function setAutofocus($value){
		$this->setParamCtrl("autoFocus", $value,"is_bool");
	}

	/**
	 * The delay in milliseconds between when a keystroke occurs and when a search is performed.
	 * A zero-delay makes sense for local data (more responsive), but can produce a lot of load for remote data,
	 * while being less responsive.
	 * default : 300
	 * @param int $value
	 */
	public function setDelay($value){
		$this->setParamCtrl("delay", $value,"is_int");
	}

	/**
	 * Disables the autocomplete if set to true.
	 * @param Boolean $value
	 * default : false
	 */
	public function setDisabled($value){
		$this->setParamCtrl("disabled", $value, "is_bool");
	}

	/**
	 * The minimum number of characters a user must type before a search is performed.
	 * Zero is useful for local data with just a few items,
	 * but a higher value should be used when a single character search could match a few thousand items.
	 * @param int $value
	 * default : 1
	 */
	public function setMinLength($value){
		$this->setParamCtrl("minLength", $value, "is_int");
	}

	/**
	 * Identifies the position of the suggestions menu in relation to the associated input element.
	 * The of option defaults to the input element, but you can specify another element to position against.
	 * You can refer to the jQuery UI Position utility for more details about the various options.
	 * @param int $position
	 * default : { my: "left top", at: "left bottom", collision: "none" }
	 */
	public function setPosition(Position $position){
		$this->setParam("position", $position->getParams());
	}

	/**
	 * Triggered when the field is blurred, if the value has changed.
	 * @param string $jsCode
	 */
	public function onChange($jsCode){
		$this->addEvent("change", $jsCode);
	}

	/**
	 * Triggered when the menu is hidden. Not every close event will be accompanied by a change event.
	 * @param string $jsCode
	 */
	public function onClose($jsCode){
		$this->addEvent("close", $jsCode);
	}

	/**
	 * Triggered when focus is moved to an item (not selecting).
	 * The default action is to replace the text field's value with the value of the focused item,
	 * though only if the event was triggered by a keyboard interaction.
	 * Canceling this event prevents the value from being updated, but does not prevent the menu item from being focused.
	 * @param string $jsCode
	 */
	public function onFocus($jsCode){
		$this->addEvent("focus", $jsCode);
	}

	/**
	 * Triggered when the suggestion menu is opened or updated.
	 * @param string $jsCode
	 */
	public function onOpen($jsCode){
		$this->addEvent("open", $jsCode);
	}

	/**
	 * Triggered after a search completes, before the menu is shown.
	 * Useful for local manipulation of suggestion data, where a custom source option callback is not required.
	 * This event is always triggered when a search completes, even if the menu will not be shown because there are no results or the Autocomplete is disabled.
	 * @param string $jsCode
	 */
	public function onResponse($jsCode){
		$this->addEvent("response", $jsCode);
	}

	/**
	 * Triggered before a search is performed, after minLength and delay are met.
	 * If canceled, then no request will be started and no items suggested.
	 * @param string $jsCode
	 */
	public function onSearch($jsCode){
		$this->addEvent("search", $jsCode);
	}

	/**
	 * Triggered when an item is selected from the menu.
	 * The default action is to replace the text field's value with the value of the selected item.
	 * Canceling this event prevents the value from being updated, but does not prevent the menu from closing.
	 * @param string $jsCode
	 */
	public function onSelect($jsCode){
		$this->addEvent("select", $jsCode);
	}
}