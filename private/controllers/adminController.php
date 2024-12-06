<?php
/*
 * File Name: adminController.php
 * Purpose: This file holds the Admin user functionalities. The Admin can manage inventory 
 * by viewing data from the database such as product ID, Name of product, description, quanity of stock, and 
 * category name. It also allows an Admin to add or delete an item from the inventory. 
 * Version: 1.0
*/
include_once "base/baseController.php";
include_once __DIR__ . "/../viewModels/adminViewModels.php";
include_once __DIR__ . "/../models/inventory.php";
include_once __DIR__ . "/../models/db.php";

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

        $queryCategories = "
        SELECT CategoryID, NAME AS CategoryName 
        FROM product_categories
        ORDER BY NAME ASC";

        $statementCategories = $dbContext->query($queryCategories);

        //get the categories for the dropdfown
        $categories = $statementCategories->fetchAll(PDO::FETCH_ASSOC);

        // Pass products and categories to the view
        $this->view('ManageInventory', ['Inventory' => $Inventory, 'categories' => $categories]);
    }

    public function AddItem()
    {

        //if NOT admin the BEGONE
        if (!$this->isAuthenticated() || !$this->isAdmin()) {
            header("Location: /velvetandvine");
            exit;
        }

        $addItemViewModel = new addItemViewModel();

        //requesting to add to DB
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $addItemViewModel->NAME = $_POST['NAME'];
            $addItemViewModel->Description = $_POST['Description'] ?? null;
            $addItemViewModel->Price = $_POST['Price'];
            $addItemViewModel->StockQuantity = $_POST['StockQuantity'];
            $addItemViewModel->CategoryID = $_POST['CategoryID'];

            //cgeck the data
            if ($addItemViewModel->validate()) {
                //CONNECT
                $dbContext = getDatabaseConnection();

                //prepare INSERTION
                $query = "INSERT INTO products (NAME, Description, Price, StockQuantity, CategoryID) VALUES (:name, :description, :price, :stockQuantity, :categoryID)";
                $statement = $dbContext->prepare($query);

                //BIND to the new thing
                $statement->bindParam(':name', $addItemViewModel->NAME, PDO::PARAM_STR);
                $statement->bindParam(':description', $addItemViewModel->Description, PDO::PARAM_STR);
                $statement->bindParam(':price', $addItemViewModel->Price, PDO::PARAM_STR);
                $statement->bindParam(':stockQuantity', $addItemViewModel->StockQuantity, PDO::PARAM_INT);
                $statement->bindParam(':categoryID', $addItemViewModel->CategoryID, PDO::PARAM_INT);

                //do the query
                try {
                    $statement->execute();
                    //go back to inventory page
                    header("Location: /velvetandvine/admin/manageinventory");
                    exit;
                } catch (PDOException $e) {
                    $error = "Database Error: ";
                    $error .= $e->getMessage();
                    include('views/error/index.php');
                    exit();
                }
            } else {
                echo "Invalid input.";
            }
        }
    }

    public function DeleteItem()
    {
        if (!$this->isAuthenticated() || !$this->isAdmin()) {
            header("Location: /velvetandvine");
            exit;
        }

        //request to DB
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productID = $_POST['ProductID'];
            //make sure is real product
            if (!empty($productID) && is_numeric($productID)) {
                //connect to DB
                $dbContext = getDatabaseConnection();

                //query statement
                $query = "DELETE FROM products WHERE ProductID = :productID";
                $statement = $dbContext->prepare($query);

                //BIND(ing of issac)
                $statement->bindParam(':productID', $productID, PDO::PARAM_INT);

                //try to execute
                try {
                    $statement->execute();
                    //back to inventory page
                    header("Location: /velvetandvine/admin/manageinventory");
                    exit;
                } catch (PDOException $e) {
                    $error = "Database Error: ";
                    $error .= $e->getMessage();
                    include('views/error/index.php');
                    exit();
                }
            } else {
                echo "Invalid ProductID.";
            }
        } else {
            header("Location: /velvetandvine/admin/manageinventory");
            exit;
        }
    }
}
