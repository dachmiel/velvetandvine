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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->ProductName) ?></td>
                            <td><?= $item->Quantity ?></td>
                            <td>$<?= number_format($item->Subtotal, 2) ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Cart Total -->
            <div class="d-flex justify-content-between">
                <h4>Total: $<?= number_format($cart['TotalAmount'], 2) ?></h4>
                <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</main>