<?php
include_once "base/baseController.php";  // Adjust the path as needed

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
        $this->view('tops');
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
