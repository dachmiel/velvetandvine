<?php include_once "views/admin/adminHeader.php"; ?>

<div class="container mt-4">
    <h2>Manage Products</h2>

    <!-- Table to display products -->
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
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo $product['stockQuantity']; ?></td>
                    <td><?php echo $product['categoryID']; ?></td>
                    <td>
                        <!-- Edit button -->
                        <a href="/admin/updateProduct/<?php echo $product['productID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Delete button -->
                        <a href="/admin/deleteProduct/<?php echo $product['productID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once "views/admin/adminFooter.php"; ?>
