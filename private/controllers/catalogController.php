<?php
/*
 * File Name: catalogController.php
 * Purpose: This file jhandles requests related to the products on the website. 
 * It uses the databse to get products in different categories and uses 
 * the data to display product information.
 * Version: 1.0
*/
include_once "base/baseController.php";  // Adjust the path as needed
include_once __DIR__ . "/../viewModels/catalogViewModels.php";
include_once __DIR__ . "/../models/db.php";

class CatalogController extends BaseController
{
    public function Index($id = null)
    {
        // Connect to the DB
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


    public function Product()
    {
        $ProductViewModel = new ProductViewModel();
        $dbContext = getDatabaseConnection();

        $query = "SELECT ProductID, NAME, Description, Price FROM products WHERE ProductID = :pid";
        $statement = $dbContext->prepare($query);
        $statement->bindParam(':pid', $pid, PDO::PARAM_INT);
        $pid = $_GET['pid'];
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $ProductViewModel->productID = $product['ProductID'];
            $ProductViewModel->name = $product['NAME'];
            $ProductViewModel->description = $product['Description'];
            $ProductViewModel->price = $product['Price'];
        } else {
            echo "No product found.";
        }
        $this->view('product', ['model' => $ProductViewModel]);
    }
    public function New($id = null)
    {
        $this->view('new');
    }
    public function Tops($id = null)
    {
        // connect to the DB
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
    public function Dresses($id = null)
    {
        // connect to the DB
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
    public function Bottoms($id = null)
    {
        // connect to the DB
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
    public function Denims($id = null)
    {
        // connect to the DB
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
    public function Accessories($id = null)
    {
        // connect to the DB
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
    public function Jackets($id = null)
    {
        // connect to the DB
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
        var_dump($JacketsViewModel);

        $this->view('jackets', ['model' => $JacketsViewModel]);
    }

public function Cart(){
    $dbContext = getDatabaseConnection();
    $CartsViewModel = new CartViewModel;
    //sql query for the products
    $query = "SELECT * FROM shopping_cart_items WHERE cartId = :cartId";
    $cartID = $_SESSION['cartId'];
    
    //echo 'Found Cart ID: ' . $cartID;
    $statement = $dbContext->prepare($query);
    $statement->bindParam(':cartId', $_SESSION['cartId'], PDO::PARAM_INT);
    $statement->execute();

    
    //fetch them all
    $carts = $statement->fetchAll(PDO::FETCH_ASSOC);
    // Check if any products were returned
    if ($carts) {
        foreach ($carts as $cart) {
            // Output or process each product here
            $CartViewModel = new CartViewModel();  // New instance for each cart
            $CartViewModel->cartItemID = isset($cart['CartItemID']) ? $cart['CartItemID'] : null;
            $CartViewModel->cartID = isset($cart['cartId']) ? $cart['cartId'] : null;
            $CartViewModel->productID = isset($cart['ProductID']) ? $cart['ProductID'] : null;
            $CartViewModel->quantity = isset($cart['Quantity']) ? $cart['Quantity'] : 0;
            $CartViewModel->subtotal = isset($cart['Subtotal']) ? $cart['Subtotal'] : 0.00;
            $CartViewModel->size = isset($cart['size']) ? $cart['size'] : 'N/A';
            
            // Add the CartViewModel instance to the CartsViewModel
            $CartsViewModel->carts[] = $CartViewModel;
        }
    }
    $this->view('cart', ['model' => $CartsViewModel]);
}
 

 public function addToCart($id = null)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbContext = getDatabaseConnection();
        $CartViewModel = new CartViewModel();
        $productID = $_POST['productID']; 
        $size = $_POST['size'];   
        $quantity = $_POST['quantity']; 
        $subtotal = $_POST['price'];
        if (isset($_SESSION['userid'])) {
            $userId = $_SESSION['userid'];
            echo "User ID: " . $userId; // Debugging user ID

            // Query to get the cart ID associated with the user
            $statement = $dbContext->prepare("SELECT cartId FROM shopping_carts WHERE userid = :userid LIMIT 1");
            $statement->bindParam(':userid', $userId, PDO::PARAM_INT);
            $statement->execute();

            // Fetch the result to get the cartId
            $cart = $statement->fetch(PDO::FETCH_ASSOC);

            if ($cart) {
                $cartID = $cart['cartId']; // Retrieve cartId
                echo 'Found Cart ID: ' . $cartID;
            }   else {
                // If no cart exists, create a new cart for the user
                $insertCartQuery = "INSERT INTO shopping_carts (userid) VALUES (:userid)";
                $insertCartStatement = $dbContext->prepare($insertCartQuery);
                $insertCartStatement->bindParam(':userid', $userId, PDO::PARAM_INT);
                $insertCartStatement->execute();

                // Get the newly created cart ID
                $cartID = $dbContext->lastInsertId(); 
                echo 'Created New Cart ID: ' . $cartID;
            }
        } else {
            // If user is not logged in, handle appropriately (optional)
            echo "User not logged in.";
            return;
        }
                
        //$cartID = $_POST['quantity'];
       // $cartItemID = $_POST['quantity'];
        

        
        // Insert query
        $query = "INSERT INTO shopping_cart_items (cartItemID,cartID,productID, quantity, subtotal) 
                  VALUES (:cartItemID,:cartID,:productID, :quantity, :subtotal)";
        $statement = $dbContext->prepare($query);


        // Bind parameters
        $statement->bindParam(':cartItemID', $cartItemID, PDO::PARAM_INT);
        $statement->bindParam(':cartID', $cartID, PDO::PARAM_INT);
        $statement->bindParam(':productID', $productID, PDO::PARAM_INT);
        $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $statement->bindParam(':subtotal', $subtotal, PDO::PARAM_INT);

        // Execute
        if ($statement->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Failed to add product to cart.";
        }

        header("Location: /velvetandvine/catalog/cart");

    }
}
public function removeFromCart($id = null){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbContext = getDatabaseConnection();
        $CartViewModel = new CartViewModel();

        // Get values from POST data
        $productID = $_POST['productID'];
        $cartItemID = $_POST['cartItemID'];  // Make sure cartItemID is passed
        $quantity = $_POST['quantity'];
        $subtotal = $_POST['price'];

        // Check if the user is logged in
        if (isset($_SESSION['userid'])) {
            $userId = $_SESSION['userid'];
            echo "User ID: " . $userId; // Debugging user ID

            // Query to get the cart ID associated with the user
            $statement = $dbContext->prepare("SELECT cartId FROM shopping_carts WHERE userid = :userid LIMIT 1");
            $statement->bindParam(':userid', $userId, PDO::PARAM_INT);
            $statement->execute();

            // Fetch the result to get the cartId
            $cart = $statement->fetch(PDO::FETCH_ASSOC);

            if ($cart) {
                $cartID = $cart['cartId']; // Retrieve cartId
                echo 'Found Cart ID: ' . $cartID;
            } else {
                // If no cart exists, create a new cart for the user
                $insertCartQuery = "INSERT INTO shopping_carts (userid) VALUES (:userid)";
                $insertCartStatement = $dbContext->prepare($insertCartQuery);
                $insertCartStatement->bindParam(':userid', $userId, PDO::PARAM_INT);
                $insertCartStatement->execute();

                // Get the newly created cart ID
                $cartID = $dbContext->lastInsertId();
                echo 'Created New Cart ID: ' . $cartID;
            }
        } else {
            // If user is not logged in, handle appropriately (optional)
            echo "User not logged in.";
            return;
        }

        // DELETE query to remove the item from shopping_cart_items
        $query = "DELETE FROM shopping_cart_items WHERE cartItemID = :cartItemID AND cartID = :cartID AND productID = :productID";
        $statement = $dbContext->prepare($query);

        // Bind parameters
        $statement->bindParam(':cartItemID', $cartItemID, PDO::PARAM_INT);
        $statement->bindParam(':cartID', $cartID, PDO::PARAM_INT);
        $statement->bindParam(':productID', $productID, PDO::PARAM_INT);

        // Execute the query to remove the product from the cart
        if ($statement->execute()) {
            echo "Product removed from cart successfully!";
        } else {
            echo "Failed to remove product from cart.";
        }

        // Redirect to the cart page
        header("Location: /velvetandvine/catalog/cart");
        exit; // Make sure to stop further script execution
    }
}
    public function Sale($id = null)
    {
        $this->view('sale');
    }
}
