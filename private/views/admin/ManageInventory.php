<!-- 
* File Name: ManageInventory.php
* Purpose: This file manages the inventory on a the website. It allows the admin to add products
* view existing products, and delete products. 
* Version: 1.0
-->
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
                        <form method="POST" action="/velvetandvine/admin/addItem">
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
                                <input type="number" step="0.01" class="form-control" id="price" name="Price" required min="0">
                            </div>
                            <div class="mb-3">
                                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stockQuantity" name="StockQuantity" required min="1">
                            </div>
                            <div class="mb-3">
                                <label for="categoryID" class="form-label">Category</label>
                                <select class="form-select" id="categoryID" name="CategoryID" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['CategoryID'] ?>">
                                            <?= htmlspecialchars($category['CategoryName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Inventory->products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['NAME']) ?></td>
                            <td><?= htmlspecialchars($product['Description']) ?></td>
                            <td>$<?= number_format($product['Price'], 2) ?></td>
                            <td><?= number_format($product['StockQuantity']) ?></td>
                            <td><?= htmlspecialchars($product['CategoryName']) ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editItemModal<?= $product['ProductID'] ?>">
                                    Edit
                                </button>
                            <td>
                                <!-- Delete Form -->
                                <form method="POST" action="/velvetandvine/admin/deleteItem" style="display:inline;">
                                    <input type="hidden" name="ProductID" value="<?= $product['ProductID'] ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            <!-- Edit Item Modal -->
                            <div class="modal fade" id="editItemModal<?= $product['ProductID'] ?>" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editItemModalLabel">Edit Item: <?= htmlspecialchars($product['NAME']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/velvetandvine/admin/editItem">
                                                <input type="hidden" name="ProductID" value="<?= $product['ProductID'] ?>">
                                                <div class="mb-3">
                                                    <label for="name<?= $product['ProductID'] ?>" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name<?= $product['ProductID'] ?>" name="NAME" value="<?= htmlspecialchars($product['NAME']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description<?= $product['ProductID'] ?>" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description<?= $product['ProductID'] ?>" name="Description"><?= htmlspecialchars($product['Description']) ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price<?= $product['ProductID'] ?>" class="form-label">Price</label>
                                                    <input type="number" step="0.01" class="form-control" id="price<?= $product['ProductID'] ?>" name="Price" value="<?= $product['Price'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stockQuantity<?= $product['ProductID'] ?>" class="form-label">Stock Quantity</label>
                                                    <input type="number" class="form-control" id="stockQuantity<?= $product['ProductID'] ?>" name="StockQuantity" value="<?= $product['StockQuantity'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="categoryID<?= $product['ProductID'] ?>" class="form-label">Category</label>
                                                    <select class="form-select" id="categoryID<?= $product['ProductID'] ?>" name="CategoryID" required>
                                                        <option value="" disabled selected>Select a Category</option>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= htmlspecialchars($category['CategoryID']) ?>"
                                                                <?= (isset($product['CategoryID']) && $category['CategoryID'] == $product['CategoryID']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($category['CategoryName'] ?? 'Unknown Category') ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</main>
