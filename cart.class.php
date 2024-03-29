<?php

class CartItem {
    private $id;
    private $name;
    private $price;
    private $qty;
    private $customizations = array();

    function  __construct($id, $name, $price, $qty) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
    }

    function addCustomization($id, $name, $price) {
        array_push($this->customizations, new Customization($id, $name, $price));
    }

    function removeCustomization($id) {
        $pos = -1;
        for($i = 0; $i < count($this->customizations); $i++) {
            if($this->customizations[$i]->getId() == $id) {
                $pos = $i;
                break;
            }
        }
        if($pos != -1) {
            unset($this->customizations[$pos]);
            $this->customizations = array_values($this->customizations);
            return true;
        } else {
            return false;
        }
    }

    function getID() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getQty() {
        return $this->qty;
    }

    function getCustomizations() {
        return $this->customizations;
    }

    function setQty($qty) {
        $this->qty = $qty;
    }
}

class Customization {
    private $id;
    private $name;
    private $price;

    function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }
}
