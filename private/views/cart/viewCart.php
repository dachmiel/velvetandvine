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
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="row g-0 align-items-center">
                                <!-- Images -->
                                <div class="col-md-2">
                                    <img src="/velvetandvine/public/images/products/product_<?php echo $item->ProductID ?>.jpg"
                                        alt="<?php echo $item->ProductName; ?>" class="img-fluid" style="height: 200px; width: 200px; object-fit: cover;">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body py-2">
                                        <h5 class="card-title" style="margin-bottom: 0.5rem;">
                                            <?= htmlspecialchars($item->ProductName); ?>
                                        </h5>
                                        <p class="card-text" style="margin-bottom: 0.5rem;"><strong>Price:</strong> $<?= number_format($item->Subtotal, 2); ?></p>
                                        <p class="card-text" style="margin-bottom: 0.5rem;"><strong>Quantity:</strong> <?= htmlspecialchars($item->Quantity); ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Edit Quantity Button -->
                                            <form method="POST" action="/velvetandvine/cart/updateQuantity">
                                                <input type="hidden" name="productId" value="<?= htmlspecialchars($item->ProductID); ?>">
                                                <input type="number" name="quantity" value="<?= htmlspecialchars($item->Quantity); ?>"
                                                    min="1" class="form-control mb-2" style="width: 70px;">
                                                <button type="submit" class="btn btn-outline-primary btn-sm">Update Quantity</button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form method="POST" action="/velvetandvine/cart/deleteItem" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                                <input type="hidden" name="productId" value="<?= htmlspecialchars($item->ProductID); ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Cart Total -->
            <div class="d-flex justify-content-between mt-3">
                <h4>Total: $<?= number_format($cart['TotalAmount'], 2); ?></h4>
                <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</main>
