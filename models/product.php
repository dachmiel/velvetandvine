<?php
class Product
{
    public $productID;
    public $name;
    public $description;
    public $price;
    public $stock_quantity;
    public $categoryID;

    public function getAllProducts()
    {
        include "db.php";
        $dbContext = getDatabaseConnection();
        $statement = $dbContext->prepare("SELECT * FROM products");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
