<?php
include_once "base/baseController.php";
include_once "viewModels/admin/manageProductsViewModel.php";
include_once "models/db.php";

class AdminController extends BaseController
{
    // View all products
    public function manageProducts()
    {
        // Initialize the ViewModel
        $manageProductsViewModel = new ManageProductsViewModel();
        
        // Get all products from the database
        $manageProductsViewModel->getProducts();

    }
}