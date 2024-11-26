<?php

class CatalogController
{
    public function index($id = null)
    {
        $pageContent = 'Views/Catalog/index.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function product()
    {
        $pageContent = 'Views/Catalog/product.php';
        include "Views/Shared/_Layout.php";
    }
    public function new($id = null)
    {
        $pageContent = 'Views/Catalog/new.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function tops($id = null)
    {
        $pageContent = 'Views/Catalog/tops.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function dresses($id = null)
    {
        $pageContent = 'Views/Catalog/dresses.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function bottoms($id = null)
    {
        $pageContent = 'Views/Catalog/bottoms.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function denim($id = null)
    {
        $pageContent = 'Views/Catalog/denim.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function accessories($id = null)
    {
        $pageContent = 'Views/Catalog/accessories.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function jackets($id = null)
    {
        $pageContent = 'Views/Catalog/jackets.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
    public function sale($id = null)
    {
        $pageContent = 'Views/Catalog/sale.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
}
