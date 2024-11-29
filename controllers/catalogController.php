<?php
include_once "base/baseController.php";  // Adjust the path as needed
include_once "viewModels/CatalogViewModel.php";


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
        // connect to the DB
        include "models/db.php";
        $BottomsViewModel = new BottomsViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 3;

        $statement->execute();

        //fetch them all
        $bottoms = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($bottoms) {
            foreach ($bottoms as $bottom) {
                // Output or process each product here
                $BottomViewModel = new BottomViewModel();
                $BottomViewModel->productID = $bottom['ProductID'];
                $BottomViewModel->name = $bottom['NAME'];
                $BottomViewModel->description = $bottom['Description'];
                $BottomViewModel->price = $bottom['Price'];
                $BottomsViewModel->bottoms[] = $BottomViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('bottoms', ['model' => $BottomsViewModel]);
    }
    public function denims($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $DenimsViewModel = new DenimsViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 7;

        $statement->execute();

        //fetch them all
        $denims = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($denims) {
            foreach ($denims as $denim) {
                // Output or process each product here
                $DenimViewModel = new DenimViewModel();
                $DenimViewModel->productID = $denim['ProductID'];
                $DenimViewModel->name = $denim['NAME'];
                $DenimViewModel->description = $denim['Description'];
                $DenimViewModel->price = $denim['Price'];
                $DenimsViewModel->denims[] = $DenimViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('denims', ['model' => $DenimsViewModel]);
    }
    public function accessories($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $AccessoriesViewModel = new AccessoriesViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 4;

        $statement->execute();

        //fetch them all
        $accessories = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($accessories) {
            foreach ($accessories as $accessory) {
                // Output or process each product here
                $AccessoryViewModel = new AccessoryViewModel();
                $AccessoryViewModel->productID = $accessory['ProductID'];
                $AccessoryViewModel->name = $accessory['NAME'];
                $AccessoryViewModel->description = $accessory['Description'];
                $AccessoryViewModel->price = $accessory['Price'];
                $AccessoriesViewModel->accessories[] = $AccessoryViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('accessories', ['model' => $AccessoriesViewModel]);
    }
    public function jackets($id = null)
    {
        // connect to the DB
        include "models/db.php";
        $JacketsViewModel = new JacketsViewModel();
        //connect
        $dbContext = getDatabaseConnection();

        //sql query for the products
        $query = "SELECT * FROM products WHERE categoryid = :categoryid";
        $statement = $dbContext->prepare($query);

        $statement->bindParam(':categoryid', $categoryid, PDO::PARAM_INT);

        $categoryid = 6;

        $statement->execute();

        //fetch them all
        $jackets = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Check if any products were returned
        if ($jackets) {
            foreach ($jackets as $jacket) {
                // Output or process each product here
                $JacketViewModel = new JacketViewModel();
                $JacketViewModel->productID = $jacket['ProductID'];
                $JacketViewModel->name = $jacket['NAME'];
                $JacketViewModel->description = $jacket['Description'];
                $JacketViewModel->price = $jacket['Price'];
                $JacketsViewModel->jackets[] = $JacketViewModel;
            }
        } else {
            echo "No products found in this category.";
        }
        $this->view('jackets', ['model' => $JacketsViewModel]);
    }
    public function sale($id = null)
    {
        $this->view('sale');
    }
}
