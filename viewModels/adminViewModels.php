<?php
class AddItemViewModel
{
    public $NAME;
    public $Description;
    public $Price;
    public $StockQuantity;
    public $CategoryID;

    public $error = false;
    public $name_error;

    public function validate()
    {
        if (empty($this->NAME)) {
            $this->name_error = "Name is required.";
            $this->error = true;
        }
        if (!is_numeric($this->Price) || $this->Price <= 0) {
            $this->error = true;
        }
        if (!is_numeric($this->StockQuantity) || $this->StockQuantity < 0) {
            $this->error = true;
        }
        if (!is_numeric($this->CategoryID)) {
            $this->error = true;
        }
        return !$this->error;
    }
}

class ManageInventoryViewModel
{
}

?>