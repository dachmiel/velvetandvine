<main>
    <div class="container py-4">
        <h2>Manage Inventory</h2>
        <hr />

            <!-- Add Item Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>



        <?php if (!empty($Inventory->products)): ?>
            <!-- Product Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Inventory->products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['NAME']) ?></td>
                            <td><?= htmlspecialchars($product['Description']) ?></td>
                            <td>$<?= number_format($product['Price'], 2) ?></td>
                            <td><?= $product['StockQuantity'] ?></td>
                            <td><?= $product['CategoryID'] ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</main>
