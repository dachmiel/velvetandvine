<main>
    <div class="container py-4">
        <h2>Your Shopping Cart</h2>
        <hr />

        <?php if (empty($cartItems)): ?>
            <div class="alert alert-warning">
                Your cart is empty.
            </div>
        <?php else: ?>
            <!-- Cart Items -->
            <div class="row">
                <?php foreach ($cartItems as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <!-- No clue how to do images -->
                            <img src="/velvetandvine/public/images/products/product_<?= htmlspecialchars($item->ProductID); ?>.jpg"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($item->ProductName); ?>"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item->ProductName); ?></h5>
                                <p class="card-text"><strong>Price:</strong> $<?= number_format($item->Subtotal, 2); ?></p>
                                <p class="card-text"><strong>Quantity:</strong> <?= htmlspecialchars($item->Quantity); ?></p>
                                <div class="d-flex justify-content-between">
                                    <!-- Edit Quantity Button -->
                                    <form action="/velvetandvine/cart/updateQuantity" method="POST">
                                        <input type="hidden" name="productId" value="<?= htmlspecialchars($item->ProductID); ?>">
                                        <input type="number" name="quantity" value="<?= htmlspecialchars($item->Quantity); ?>"
                                            min="1" class="form-control mb-2" style="width: 70px;">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Update Quantity</button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="/velvetandvine/cart/deleteItem" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                        <input type="hidden" name="productId" value="<?= htmlspecialchars($item->ProductID); ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Cart Total -->
            <div class="d-flex justify-content-between mt-4">
                <h4>Total: $<?= number_format($cart['TotalAmount'], 2); ?></h4>
                <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</main>