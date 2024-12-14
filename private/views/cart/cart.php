<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>Your Shopping Cart</h3>
        </div>
        <div class="row">
            <!-- Loop through the cart items -->
            <?php if (isset($model) && !empty($model->carts)): ?>
                <?php $totalCost = 0; ?>
                <?php foreach ($model->carts as $index => $cartItem): ?>
                    <div class="col-md-4 col-sm-6 mb-4">                    
                    <div class="top-card" style="padding: 20px; text-align: center;">
                    <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($cartItem->productID); ?>" style="text-decoration: none; color: inherit;">
                    <img src="/velvetandvine/public/images/products/product_<?php echo $cartItem->productID ?>.jpg" onerror="this.onerror=null;this.src='/velvetandvine/public/images/no-image.jpg';" alt="<?php echo htmlspecialchars($cartItem->productID); ?>" style="width: 300px; height: 300px; object-fit: cover; margin-bottom: 10px;">
                    <p>Item:</p>
                    <h2 style="font-size: 16px;"><?php echo htmlspecialchars($cartItem->name ?? ''); ?></h2>

                        <!-- Product price -->
                        <p style="font-size: 16px;"><?php echo '$' . number_format($cartItem->subtotal * $cartItem->quantity, 2); ?></p>
                        </p>
                        
                        <!-- Product quantity -->
                        <p>Quantity: <?php echo htmlspecialchars($cartItem->quantity ?? ''); ?></p>

                        <?php $totalCost += $cartItem->subtotal * $cartItem->quantity; ?>

                        <!-- Remove item button -->
                        <form method="POST" action="removeFromCart">
        <input type="hidden" name="productID" value="<?php echo $cartItem->productID; ?>">
        <input type="hidden" name="cartItemID" value="<?php echo $cartItem->cartItemID; ?>">
        <input type="hidden" name="quantity" value="<?php echo $cartItem->quantity; ?>">
        <input type="hidden" name="price" value="<?php echo $cartItem->price; ?>">
    <button type="submit" class="btn btn-danger">Remove</button>
</form>
                    </div> 
                </div>
                <?php endforeach; ?>
                <!-- Display total cost -->
                <div class="col-12 text-center">
                    <h4>Total Cost: $<?php echo number_format($totalCost, 2); ?></h4>
                </div>
            <?php else: ?>
                <p>No items found in your cart.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
