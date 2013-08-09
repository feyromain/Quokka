<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form;

/**
 * \Quokka\Form\Form
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Form {

    /**
     * @var array
     */
    private $_elements = [];

    /**
     * @var array
     */
    private $_errors = [];

    /**
     * @var boolean
     */
    private $_valid = true;

    /**
     *
     * @return void
     */
    public function __construct() {

        $this->init();
    }

    /**
     *
     * @param $element Quokka\Form\Element\AbstractElement
     * @return void
     */
    public function addElement($element) {

        $this->_elements[$element->getName()] = $element;
    }

    /**
     *
     * @param $data array
     * @return void
     */
    public function bind($data) {

        foreach ($data as $key => $value) {

            $value = (isset($value)) ? $value : '';
            $this->_elements[$key]->setValue($value);
        }
    }

    /**
     *
     * @param $name string
     * @param $msg string
     * @return void
     */
    public function addError($name, $msg) {

        $this->_errors[$name] = $msg;
        $this->_valid = false;
    }

    /**
     *
     * @param $data array
     * @return boolean
     */
    public function isValid($data) {

        $this->bind($data);
        foreach ($this->_elements as $element) {

            if (!$element->isValid())
                $this->addError($element->getName(), $element->getErrorMessage());
        }
        return $this->_valid;
    }

    public function getElement($key) {

        return $this->_elements[$key];
    }

    /**
     *
     * @return void
     */
    public function init() { }
}