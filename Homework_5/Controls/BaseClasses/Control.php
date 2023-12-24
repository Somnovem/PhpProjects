<?php

class Control {
    private string $_background;
    private int $_width;
    private int $_height;
    private string $_name;
    private $_value;

    public function __construct($background, $width, $height, $name, $value) {
        $this->_background = $background;
        $this->_width = $width;
        $this->_height = $height;
        $this->_name = $name;
        $this->_value = $value;
    }

    public function getBackground() : string {
        return $this->_background;
    }

    public function getWidth() : int {
        return $this->_width;
    }

    public function getHeight() : int {
        return $this->_height;
    }

    public function getName() : string {
        return $this->_name;
    }

    public function getValue() {
        return $this->_value;
    }
}