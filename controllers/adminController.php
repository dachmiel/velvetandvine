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
        $query = "SELECT * FROM products";
        $statement = $dbContext->query($query);

        //fetch them all
        $Inventory->products = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($Inventory->products);

        $this->view('ManageInventory', ['Inventory' => $Inventory]);
    }

    public function addItem() {

        //if NOT admin the BEGONE
        if (!$this->isAuthenticated() || !$this->isAdmin()) {
            header("Location: /velvetandvine");
            exit;
        }

        //requesting to add to DB
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $name = $_POST['NAME'];
            $description = $_POST['Description'] ?? null;
            $price = $_POST['Price'];
            $stockQuantity = $_POST['StockQuantity'];
            $categoryID = $_POST['CategoryID'];
    
            //cgeck the data
            if (!empty($name) && is_numeric($price) && is_numeric($stockQuantity) && is_numeric($categoryID)) {
                //CONNECT
                $dbContext = getDatabaseConnection();
    
                //prepare INSERTION
                $query = "INSERT INTO products (NAME, Description, Price, StockQuantity, CategoryID) VALUES (:name, :description, :price, :stockQuantity, :categoryID)";
                $statement = $dbContext->prepare($query);
    
                //BIND to the new thing
                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                $statement->bindParam(':description', $description, PDO::PARAM_STR);
                $statement->bindParam(':price', $price, PDO::PARAM_STR);
                $statement->bindParam(':stockQuantity', $stockQuantity, PDO::PARAM_INT);
                $statement->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    
                //do the query
                if ($statement->execute()) {
                    //go back to inventory page
                    header("Location: /velvetandvine/admin/manageinventory");
                    exit;
                } else {
                    echo "Error adding product.";
                }
            } else {
                echo "Invalid input.";
            }
        }
    }
    

}
