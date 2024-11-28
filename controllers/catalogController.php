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
        // Connect to the DB
        include "models/db.php";
        $dbContext = getDatabaseConnection();

        // Query to fetch all products
        $query = "SELECT * FROM products";
        $statement = $dbContext->prepare($query);
        $statement->execute();

        // Fetch the products
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Query to fetch categories
        $categoryQuery = "SELECT CategoryID, NAME FROM product_categories";
        $categoryStatement = $dbContext->prepare($categoryQuery);
        $categoryStatement->execute();
        $categories = $categoryStatement->fetchAll(PDO::FETCH_ASSOC);

        // Map categoryId to categoryName
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category['CategoryID']] = $category['NAME'];
        }

        // Group the products by categoryId
        $groupedProducts = [];
        foreach ($products as $product) {
            $categoryId = $product['CategoryID'];
            if (!isset($groupedProducts[$categoryId])) {
                $groupedProducts[$categoryId] = [];
            }
            $groupedProducts[$categoryId][] = $product;
        }

        // Pass grouped products and category names to the view
        $this->view('index', ['model' => $groupedProducts, 'categoryMap' => $categoryMap]);
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
    public function denims($id = null)
    {
        $this->view('denims');
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
