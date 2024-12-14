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
    public $Quantity;
    public $Subtotal;
    public $ProductName;

    public function __construct($CartItemID, $CartID, $Quantity, $Subtotal, $ProductName)
    {
        $this->CartItemID = $CartItemID;
        $this->CartID = $CartID;
        $this->Quantity = $Quantity;
        $this->Subtotal = $Subtotal;
        $this->ProductName = $ProductName;
    }
}
