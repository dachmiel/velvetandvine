<?php
include_once "base/baseController.php";  // Adjust the path as needed
include_once "viewModels/TopsViewModel.php";
include_once "viewModels/TopViewModel.php";


class CatalogController extends BaseController
{
    public function index($id = null)
    {
        $this->view('index');
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
        $this->view('dresses');
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
