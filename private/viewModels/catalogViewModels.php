<?php
/**
 * File Name: catalogViewModels.php
 * Purpose: This file contains the ViewModel classes for all of the website categories. 
 * Each ViewModel holds item details like product ID, name, description and price. 
 * Version: 1.0
 * 
 */

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
    public $tops = [];
}
class TopViewModel
{
    public $productID;
    public $name;
    public $description;
    public $price;
}

class CartsViewModel
{
    public $carts = [];
}
class CartViewModel
{
    public $cartItemID;
    public $cartID;
    public $productID;
    public $quantity;
    public $subtotal = 0.0;
    public $size;
    public $carts = [];

}

class AccountCartsViewModel
{
    public $Accountcarts = [];
}
class AccountCartViewModel
{
    public $cartID;
    public $userID;
    public $createdDate;
    public $totalAmount;
}