<main>
    <div class="container py-4">
        <h2>Your Shopping Cart</h2>
        <hr />

        <?php if (empty($cartItems)): ?>
            <div class="alert alert-warning">
                Your cart is empty.
            </div>
        <?php else: ?>
            <!-- Cart Items Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['ProductID']) ?></td>
                            <td><?= $item['Quantity'] ?></td>
                            <td>$<?= number_format($item['Price'], 2) ?></td>
                            <td>$<?= number_format($item['Subtotal'], 2) ?></td>
                            <td>
                                <!-- Remove Item Button -->
                                <form method="POST" action="/velvetandvine/cart/remove" style="display:inline;">
                                    <input type="hidden" name="CartItemID" value="<?= $item['CartItemID'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this item?');">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Cart Total -->
            <div class="d-flex justify-content-between">
                <h4>Total: $<?= number_format($cartViewModel->TotalAmount, 2) ?></h4>
                <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</main>