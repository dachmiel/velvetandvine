<?php
include_once "base/baseController.php";
include_once "viewModels/admin/manageInventoryViewModel.php";
include_once "models/inventory.php";
include_once "models/db.php";

class AdminController extends BaseController
{
    public function ManageInventory()
    {
        if (!$this->isAuthenticated() || !$this->isAdmin()) {
            header("Location: /velvetandvine");
            exit;
        }
        $Inventory = new Inventory();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "
        SELECT 
            p.ProductID, 
            p.NAME, 
            p.Description, 
            p.Price, 
            p.StockQuantity, 
            c.NAME AS CategoryName 
        FROM products p
        LEFT JOIN product_categories c ON p.CategoryID = c.CategoryID
        ORDER BY p.CategoryID ASC";

        $statement = $dbContext->query($query);

        //fetch them all
        $Inventory->products = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($Inventory->products);

        $this->view('ManageInventory', ['Inventory' => $Inventory]);
    }
}
