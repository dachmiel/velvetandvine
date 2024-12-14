<?php


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
    public $name;

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