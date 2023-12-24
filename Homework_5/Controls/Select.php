<?php
require_once 'BaseClasses/Control.php';

class Select extends Control {
    private array $items = [];

    public function __construct($background, $width, $height, $name, $value, array $items) {
        parent::__construct($background, $width, $height, $name, $value);
        $this->items = $items;
    }

    public function getItems() : array {
        return $this->items;
    }

    public function setItems(array $items) : void {
        $this->items = $items;
    }
    public function render() {
        $options = '';
        foreach ($this->getItems() as $item) {
            $options .= sprintf('<option value="%s">%s</option>', $item, $item);
        }

        return sprintf(
            '<select name="%s" style="background: %s; width: %dpx; height: %dpx;">%s</select>',
            $this->getName(),
            $this->getBackground(),
            $this->getWidth(),
            $this->getHeight(),
            $options
        );
    }
}