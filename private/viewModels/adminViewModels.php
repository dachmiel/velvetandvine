<?php
/**
 * File Name: adminViewModels.php
 * Purpose: This file contains the Add Item ViewModel class for handling item operations
 * such as adding an item to the inventory. It includes validation checks to make sure that all 
 * fields such as Name, Price, Stock Quantity, and Category ID are filled out.
 * Version: 1.0
 * 
 */
class AddItemViewModel
{
    public $NAME;
    public $Description;
    public $Price;
    public $StockQuantity;
    public $CategoryID;

    public $error = false;
    public $name_error;

    public function Validate()
    {
        if (empty($this->NAME)) {
            $this->name_error = "Name is required.";
            $this->error = true;
        }
        if (!is_numeric($this->Price) || $this->Price < 0) {
            $this->error = true;
        }
        if (!is_numeric($this->StockQuantity) || $this->StockQuantity < 0) {
            $this->error = true;
        }
        if (!is_numeric($this->CategoryID) || $this->CategoryID < 1) {
            $this->error = true;
        }
        return !$this->error;
    }
}

class ManageInventoryViewModel {}
