<?php

namespace Ajax;

use Ajax\ui\Components\Dialog;
use Ajax\ui\Components\Accordion;
use Ajax\ui\Components\Menu;
use Ajax\ui\Components\Progressbar;
use Ajax\ui\Components\Selectmenu;
use Ajax\ui\Components\Slider;
use Ajax\ui\Components\Spinner;
use Ajax\ui\Components\Autocomplete;
use Ajax\ui\Components\Tabs;
use Ajax\ui\Components\Button;
use Ajax\ui\Components\Buttonset;
use Ajax\ui\Components\Tooltip;
use Ajax\common\BaseGui;

/**
 * JQuery UI Phalcon library
 *
 * @author jcheron
 * @version 1.001
 */

/**
 * Jquery JqueryUI
 */
class JqueryUI extends BaseGui {

	public function __construct($autoCompile=true) {
		parent::__construct($autoCompile);
	}

	/**
	 * Retourne un composant Dialog
	 * @return \Ajax\Components\Dialog
	 */
	public function dialog($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dialog($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Accordion
	 * @return \Ajax\Components\Accordion
	 */
	public function accordion($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Accordion($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Menu
	 * @return \Ajax\Components\Menu
	 */
	public function menu($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Menu($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Progressbar
	 * @return \Ajax\Components\Progressbar
	 */
	public function progressbar($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Progressbar($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Selectmenu
	 * @return \Ajax\Components\Selectmenu
	 */
	public function selectmenu($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Selectmenu($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Slider
	 * @return \Ajax\Components\Slider
	 */
	public function slider($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Slider($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Spinner
	 * @return \Ajax\Components\Spinner
	 */
	public function spinner($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Spinner($this->js), $attachTo, $params);
	}

	/**
	 * Retourne un composant Autocomplete
	 * @return \Ajax\Components\Autocomplete
	 */
	public function autocomplete($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Autocomplete($this->js), $attachTo, $params);
	}

	/**
	 * Create and return a Tabs component
	 * @return \Ajax\Components\Tabs
	 */
	public function tabs($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tabs($this->js), $attachTo, $params);
	}

	/**
	 * Create and return a Button component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\Button
	 */
	public function button($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Button($this->js), $attachTo, $params);
	}

	/**
	 * Create and return a ButtonSet component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\ButtonSet
	 */
	public function buttonSet($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Buttonset($this->js), $attachTo, $params);
	}

	/**
	 * Create and return a Tooltip component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\Tooltip
	 */
	public function tooltip($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tooltip($this->js), $attachTo, $params);
	}
}
