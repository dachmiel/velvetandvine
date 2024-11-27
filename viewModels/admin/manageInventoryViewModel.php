<?php
include_once "models/db.php";

class ManageProductsViewModel
{
    public $products = [];

    public function getProducts()
    {
        //connect
        $dbContext = getDatabaseConnection();
        
        //sql query for the products
        $query = "SELECT * FROM product";
        $statement = $dbContext->query($query);

        //fetch them all
        $this->products = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
