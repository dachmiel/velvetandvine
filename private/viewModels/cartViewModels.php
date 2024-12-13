<?php

class CartViewModel
{
    public $CartID;
    public $UserID;
    public $CreatedDate;
    public $TotalAmount;
}

class CartItemViewModel
{
    public $CartItemID;
    public $CartID;
    public $ProductID;
    public $Quantity;
    public $Subtotal;
    public $ProductName;
}
