<?php

class AccessoriesViewModel
{
    public $accessories = [];
}
class AccessoryViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}

class BottomsViewModel
{
    public $bottoms = [];
}

class BottomViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}

class DenimsViewModel
{
    public $denims = [];
}

class DenimViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}

class DressesViewModel
{
    public $dresses = [];
}

class DressViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}
class JacketsViewModel
{
    public $jackets = [];
}
class JacketViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}
class ProductsViewModel
{
    public $products = [];
}
class ProductViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}
class TopsViewModel
{
    public $tops;

    public function __construct(array $tops)
    {
        $this->tops = $tops;
    }
}
class TopViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}
