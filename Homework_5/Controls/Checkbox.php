<?php
require_once 'BaseClasses/Input.php';

class Checkbox extends Input {
    private bool $_isChecked;

    public function __construct($background, $width, $height, $name, $value, $isChecked) {
        parent::__construct($background, $width, $height, $name, $value);
        $this->_isChecked = $isChecked;
    }

    public function getCheckedState() : bool {
        return $this->_isChecked;
    }

    public function setCheckedState() : void {
        $this->_isChecked = true;
    }

    public function render() {
        $checkedAttribute = $this->getCheckedState() ? 'checked' : '';
        return sprintf(
            '<input type="checkbox" name="%s" value="%s" %s style="background-color: %s; width: %dpx; height: %dpx;">',
            $this->getName(),
            $this->getValue(),
            $checkedAttribute,
            $this->getBackground(),
            $this->getWidth(),
            $this->getHeight()
        );
    }
}