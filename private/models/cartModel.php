<?php

class CartModel
{
    public function getCartByUserId($userId)
    {

        $dbContext = getDatabaseConnection();

        $stmt = $dbContext->prepare("SELECT * FROM shopping_carts WHERE UserID = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEmptyCart($userId)
    {
        $dbContext = getDatabaseConnection();

        $stmt = $dbContext->prepare("INSERT INTO shopping_carts (UserID, CreatedDate, TotalAmount) VALUES (:userId, NOW(), 0.00)");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $dbContext->lastInsertId();
    }

    public function getCartItems($cartId)
    {
        $dbContext = getDatabaseConnection();

        $stmt = $dbContext->prepare("SELECT * FROM shopping_cart_items WHERE CartID = :cartId");
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
