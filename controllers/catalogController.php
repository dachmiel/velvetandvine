<?php
include_once "base/baseController.php";  // Adjust the path as needed
include_once "viewModels/TopsViewModel.php";
include_once "viewModels/TopViewModel.php";
include_once "viewModels/DressViewModel.php";
include_once "viewModels/DressesViewModel.php";
include_once "viewModels/ProductViewModel.php";
include_once "viewModels/ProductsViewModel.php";

class CatalogController extends BaseController
{
    public function index($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $ProductsViewModel = new ProductsViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products";
        $statement = $dbContext->prepare($query);

        $statement->execute();

        //fetch them all
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($products) {
            foreach ($products as $product) {
                // Output or process each product here
                $ProductViewModel = new ProductViewModel();
                $ProductViewModel->productID = $product['ProductID'];
                $ProductViewModel->name = $product['NAME'];
                $ProductViewModel->description = $product['Description'];
                $ProductViewModel->price = $product['Price'];
                $ProductsViewModel->products[] = $ProductViewModel;
            }
        } else {
            echo "No products found.";
        }
        $this->view('index', ['model' => $ProductsViewModel]);
    }
    public function product()
    {
        $this->view('product');
    }
    public function new($id = null)
    {
        $this->view('new');
    }
    public function tops($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $TopsViewModel = new TopsViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 2;

        $statement->execute();

        //fetch them all
        $tops = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($tops) {
            foreach ($tops as $top) {
                // Output or process each product here
                $TopViewModel = new TopViewModel();
                $TopViewModel->productID = $top['ProductID'];
                $TopViewModel->name = $top['NAME'];
                $TopViewModel->description = $top['Description'];
                $TopViewModel->price = $top['Price'];
                $TopsViewModel->tops[] = $TopViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('tops', ['model' => $TopsViewModel]);
    }
    public function dresses($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $DressesViewModel = new DressesViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 5;

        $statement->execute();

        //fetch them all
        $dresses = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($dresses) {
            foreach ($dresses as $dress) {
                // Output or process each product here
                $DressViewModel = new DressViewModel();
                $DressViewModel->productID = $dress['ProductID'];
                $DressViewModel->name = $dress['NAME'];
                $DressViewModel->description = $dress['Description'];
                $DressViewModel->price = $dress['Price'];
                $DressesViewModel->dresses[] = $DressViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('dresses', ['model' => $DressesViewModel]);
    }
    public function bottoms($id = null)
    {
        $this->view('bottoms');
    }
    public function denim($id = null)
    {
        $this->view('denim');
    }
    public function accessories($id = null)
    {
        $this->view('accessories');
    }
    public function jackets($id = null)
    {
        $this->view('jackets');
    }
    public function sale($id = null)
    {
        $this->view('sale');
    }
}
