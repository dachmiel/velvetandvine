<?php
include_once "base/baseController.php";
include_once "viewModels/admin/manageInventoryViewModel.php";
include_once "models/inventory.php";
include_once "models/db.php";

class AdminController extends BaseController
{
    public function ManageInventory()
    {
        $Inventory = new Inventory();
        //connect
        $dbContext = getDatabaseConnection();
        
        //sql query for the products
        $query = "SELECT * FROM products";
        $statement = $dbContext->query($query);

        //fetch them all
        $Inventory->products = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($Inventory->products);

        $this->view('ManageInventory', ['Inventory' => $Inventory]);
    }
}