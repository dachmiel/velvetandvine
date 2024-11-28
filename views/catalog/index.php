<main>
    <div class="container">
        <div class="row">
            <!-- Loop through the products array in the ProductsViewModel -->
            <?php if (isset($model) && !empty($model->products)): ?>
                <?php foreach ($model->products as $index => $product): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; text-align: center;">
                            <!-- You may need to check if an image exists -->
                            <img src="<?php echo $product->image ?? '/velvetandvine/images/no-image.jpg'; ?>" alt="<?php echo htmlspecialchars($product->name); ?>" style="width: 100%; height: auto;">

                            <h2><?php echo htmlspecialchars($product->name); ?></h2>
                            <p><?php echo htmlspecialchars($product->description); ?></p>
                            <p><strong><?php echo '$' . number_format($product->price, 2); ?></strong></p>

                            <!-- Example link to a detailed page, adjust if needed -->
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($product->productID); ?>" class="btn submit-btn">View Details</a>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>
        </div>
    </div>
</main>
