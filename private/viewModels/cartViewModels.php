<?php

class CartViewModel
{
    public $CartID;
    public $UserID;
    public $CreatedDate;
    public $TotalAmount;

    public function __construct($CartID, $UserID, $CreatedDate, $TotalAmount)
    {
        $this->CartID = $CartID;
        $this->UserID = $UserID;
        $this->CreatedDate = $CreatedDate;
        $this->TotalAmount = $TotalAmount;
    }
}

class CartItemViewModel
{
    public $CartItemID;
    public $CartID;
    public $ProductID;
    public $Quantity;
    public $Price;
    public $Subtotal;
    public $ProductName;

    public function __construct($CartItemID, $CartID, $ProductID, $Quantity, $Price, $Subtotal, $ProductName)
    {
        $this->CartItemID = $CartItemID;
        $this->CartID = $CartID;
        $this->ProductID = $ProductID;
        $this->Quantity = $Quantity;
        $this->Price = $Price;
        $this->Subtotal = $Subtotal;
        $this->ProductName = $ProductName;
    }
}
