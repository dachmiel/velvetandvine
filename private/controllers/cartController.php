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
                $item['ProductID'],
                $item['Quantity'],
                $item['Subtotal']
            );
        }
        //var_dump($cartViewModel);
        //var_dump($cart);
        //var_dump($cartItems);
        //var_dump($cartItemViewModels);
        $this->view('viewCart', ['cart' => $cart, 'cartItems' => $cartItems]);
    }
}
