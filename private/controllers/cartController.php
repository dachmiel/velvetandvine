<?php

include_once "base/baseController.php";
include_once __DIR__ . "/../viewModels/cartViewModels.php";
include_once __DIR__ . "/../models/db.php";
include_once __DIR__ . "/../models/cartModel.php";
include_once __DIR__ . "/../models/ApplicationUser.php";

class CartController extends BaseController
{

    public function viewCart()
    {

        //if not logged in, get_out.wav
        if (!$this->isAuthenticated()) {
            header("Location: /velvetandvine/account/login");
            exit;
        }

        //get the userID
        $userId = $_SESSION['userid'];

        $cartModel = new CartModel();

        $cart = $cartModel->getCartByUserId($userId);

        //if there is no cart, make a new one
        if (!$cart) {
            $cartID = $cartModel->createEmptyCart($userId);
            $cartViewModel = new CartViewModel($cartID, $userId, date('Y-m-d H:i:s'), 0.00);
        } else {
            $cartViewModel = new CartViewModel(
                $cart['CartID'],
                $cart['UserID'],
                $cart['CreatedDate'],
                $cart['TotalAmount']
            );
        }

        //for new user
        if ($cart)
            $cartItems = $cartModel->getCartItems($cart['CartID']);
        else
            $cartItems = [];

        $cartItemViewModels = [];
        foreach ($cartItems as $item) {
            $cartItemViewModels[] = new CartItemViewModel(
                $item['CartItemID'],
                $item['CartID'],
                $item['Quantity'],
                getProductPriceById($item['ProductID']),
                getProductNameById($item['ProductID'])
            );
        }

        updateCartTotalAmount($cart, $cartItems);

        //var_dump($cartViewModel);
        //var_dump($cart);
        //var_dump($cartItems);
        //var_dump($cartItemViewModels);
        $this->view('viewCart', ['cart' => $cart, 'cartItems' => $cartItemViewModels]);
    }

    public function addToCart()
    {
        //same old same old
        if (!$this->isAuthenticated()) {
            header("Location: /velvetandvine/account/login");
            exit;
        }

        $userId = $_SESSION['userid'];

        $productId = $_POST['productId'];
        $quantity = intval($_POST['quantity']);

        //i dont even know if this is possible but we check anyways
        //also i dont remember how to do errors
        if ($quantity <= 0) {
            header("Location: /velvetandvine/cart/viewCart?error=invalid_quantity");
            exit;
        }

        $cartModel = new CartModel();

        //get tha cart
        $cart = $cartModel->getCartByUserId($userId);

        //if none, MAKE IT
        if (!$cart) {
            $cartId = $cartModel->createEmptyCart($userId);
        } else {
            $cartId = $cart['CartID'];
        }

        //add it
        addItemToCart($cartId, $productId, $quantity);

        $cartItems = $cartModel->getCartItems($cartId);
        updateCartTotalAmount($cart, $cartItems);

        //send them to the cart6
        header("Location: /velvetandvine/cart/viewCart");
        exit;
    }
}

function getProductNameById($productId)
{

    $dbContext = getDatabaseConnection();

    //select the correctproduct
    $query = "SELECT NAME FROM products WHERE ProductID = :productId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    //return the product's name
    return $product ? $product['NAME'] : null;
}

function getProductPriceById($productId)
{

    $dbContext = getDatabaseConnection();

    //get the producty
    $query = "SELECT Price FROM products WHERE ProductID = :productId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    //return the $$$
    return $product ? $product['Price'] : null;
}


function updateCartTotalAmount($cart, $cartItems)
{
    $totalAmount = 0.0;

    //get all the prices and add
    foreach ($cartItems as $item) {
        $productPrice = getProductPriceById($item['ProductID']);

        if ($productPrice !== null) {
            $totalAmount += $item['Quantity'] * $productPrice;
        }
    }
    //update it
    $cart['Total Amount'] = $totalAmount;

    $dbContext = getDatabaseConnection();

    //update in the db so it reflects on the page
    $query = "UPDATE shopping_carts SET TotalAmount = :totalAmount WHERE CartID = :cartId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':cartId', $cart['CartID'], PDO::PARAM_INT);
    $stmt->bindParam(':totalAmount', $totalAmount, PDO::PARAM_STR);
    $stmt->execute();

    return;
}

function addItemToCart($cartId, $productId, $quantity)
{
    $dbContext = getDatabaseConnection();


    //get the item if it exists
    $query = "SELECT * FROM shopping_cart_items WHERE CartID = :cartId AND ProductID = :productId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();

    //set it here
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    //if it is ther ewe update the qualitity instead of adding a new item
    if ($existingItem) {
        $newQuantity = $existingItem['Quantity'] + $quantity;
        $query = "UPDATE shopping_cart_items SET Quantity = :quantity, Subtotal = :subtotal WHERE CartItemID = :cartItemId";
        $subtotal = getProductPriceById($productId) * $newQuantity;
        $stmt = $dbContext->prepare($query);
        $stmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':subtotal', $subtotal, PDO::PARAM_STR);
        $stmt->bindParam(':cartItemId', $existingItem['CartItemID'], PDO::PARAM_INT);
        $stmt->execute();

        //otherwise we add a new item
    } else {
        $query = "INSERT INTO shopping_cart_items (CartID, ProductID, Quantity, Subtotal) VALUES (:cartId, :productId, :quantity, :subtotal)";
        $stmt = $dbContext->prepare($query);
        $subtotal = getProductPriceById($productId) * $quantity;
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':subtotal', $subtotal, PDO::PARAM_STR);
        $stmt->execute();
    }
}
