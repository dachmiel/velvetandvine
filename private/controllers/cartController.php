<?php
/*
 * File Name: catalogController.php
 * Purpose: This file jhandles requests related to the products on the website. 
 * It uses the databse to get products in different categories and uses 
 * the data to display product information.
 * Version: 1.0
*/
include_once "base/baseController.php";  // Adjust the path as needed
include_once __DIR__ . "/../viewModels/cartViewModels.php";
include_once __DIR__ . "/../models/db.php";


class CartController extends BaseController
{
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

                $productID = $CartViewModel->productID;
                $productQuery = "SELECT name FROM products WHERE productID = :productID";
                $productStatement = $dbContext->prepare($productQuery);
                $productStatement->bindParam(':productID', $productID, PDO::PARAM_INT);
                $productStatement->execute();
                $product = $productStatement->fetch(PDO::FETCH_ASSOC);
    
                if ($product) {
                    $CartViewModel->name = $product['name'];  // Add the product name to the CartViewModel
                } else {
                    $CartViewModel->name = 'Unknown Product';  // Default value if product not found
                }
    
    
                // Add the CartViewModel instance to the CartsViewModel
                $CartsViewModel->carts[] = $CartViewModel;
                
            }

        }
        $this->view('cart', ['model' => $CartsViewModel]);
    }
     
    
     public function addToCart($id = null)
    {
        session_start();
        include_once __DIR__ . "/../product.php"; 

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
                    $query = "INSERT INTO shopping_carts (userid) VALUES (:userid)";
                    $Statement = $dbContext->prepare($insertCartQuery);
                    $Statement->bindParam(':userid', $userId, PDO::PARAM_INT);
                    $Statement->execute();
    
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
    
            header("Location: /velvetandvine/cart/cart");
    
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
            header("Location: /velvetandvine/cart/cart");
            exit; // Make sure to stop further script execution
        }
    }
    public function getName() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Start the session if it's not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            $dbContext = getDatabaseConnection();  // Assuming you have a function to get the database connection
            $CartViewModel = new CartViewModel();
    
            // Get the user ID from the session
            if (isset($_SESSION['userid'])) {
                $userID = $_SESSION['userid'];
    
                // Query to get the user's name based on the userID
                $query = "SELECT name FROM application_users WHERE userid = :userid";
                val_dump($query); 
                $statement = $dbContext->prepare($query);
                $statement->bindParam(':userid', $userID, PDO::PARAM_INT);  // Bind the user ID to the query
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
    
                if ($user) {
                    // If a user is found, bind the name to the view model or directly to the view
                    $userName = $user['name'];
                } else {
                    $userName = "Unknown User";  // If no user is found, use a default value
                }
            } else {
                $userName = "Guest";  // If no user is logged in
            }
    
            // Now pass the user's name and cart data to the view
            $CartViewModel->name = $userName;  // Add the user name to your view model
    
            // Pass the CartViewModel to the view
            $this->view('cart', ['model' => $CartViewModel]);
        }
    }
    

}