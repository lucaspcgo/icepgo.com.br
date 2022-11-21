<?php
/**
 * Main abstract function.
 *
 * @package Hesta
 */

/**
 * Class hesta_Abstract
 */
abstract class hesta_Abstract {

	abstract public function __construct();

	/**
	 * Initialize the control. Add all the hooks necessary.
	 */
	abstract public function init();
}