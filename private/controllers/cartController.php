<?php

include_once "base/baseController.php";
include_once __DIR__ . "/../views/cart/viewCart.php";
include_once __DIR__ . "/../viewModels/cartViewModels.php";
include_once __DIR__ . "/../models/db.php";
include_once __DIR__ . "/../models/cartModel.php";
include_once __DIR__ . "/../models/ApplicationUser.php";

class CartController extends BaseController
{

    public function viewCart()
    {

        if (!$this->isAuthenticated()) {
            header("Location: /velvetandvine/account/login");
            exit;
        }

        $userId = $_SESSION['userid'];

        $cartModel = new CartModel();

        $cart = $cartModel->getCartByUserId($userId);

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

        $cartItems = $cartModel->getCartItems($cart['CartID']);

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
        var_dump($cart);
        //var_dump($cartItems);
        //var_dump($cartItemViewModels);
        $this->view('viewCart', ['cart' => $cart, 'cartItems' => $cartItemViewModels]);
    }
}

function getProductNameById($productId)
{

    // Prepare the statement
    $dbContext = getDatabaseConnection();

    $query = "SELECT NAME FROM products WHERE ProductID = :productId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product ? $product['NAME'] : null;
}

function getProductPriceById($productId)
{

    // Prepare the statement
    $dbContext = getDatabaseConnection();

    $query = "SELECT Price FROM products WHERE ProductID = :productId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product ? $product['Price'] : null;
}


function updateCartTotalAmount($cart, $cartItems)
{
    $totalAmount = 0.0;

    foreach ($cartItems as $item) {
        $productPrice = getProductPriceById($item['ProductID']);

        if ($productPrice !== null) {
            $totalAmount += $item['Quantity'] * $productPrice;
        }
    }
    $cart['Total Amount'] = $totalAmount;

    $dbContext = getDatabaseConnection();

    $query = "UPDATE shopping_carts SET TotalAmount = :totalAmount WHERE CartID = :cartId";
    $stmt = $dbContext->prepare($query);
    $stmt->bindParam(':cartId', $cart['CartID'], PDO::PARAM_INT);
    $stmt->bindParam(':totalAmount', $totalAmount, PDO::PARAM_STR);
    $stmt->execute();

    return;
}
