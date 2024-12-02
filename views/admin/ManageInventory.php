<main>
    <div class="container py-4">
        <h2>Manage Inventory</h2>
        <hr />

            <!-- Add Item Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>

        <!-- Add Item Form -->
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/admin/addItem">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="NAME" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="Description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stockQuantity" name="StockQuantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoryID" class="form-label">Category ID</label>
                                <input type="number" class="form-control" id="categoryID" name="CategoryID" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



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
