<main>
    <div class="container">
        <!-- Loop through each category -->
        <?php if (isset($model) && !empty($model)): ?>
            <?php foreach ($model as $categoryId => $categoryProducts): ?>
                <div class="category-section mb-4">
                    <!-- Center the category name -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3><?php echo htmlspecialchars($categoryMap[$categoryId] ?? 'Unknown'); ?></h3>
                        </div>
                    </div>
                    <!-- Create a new row for products in this category -->
                    <div class="product-row row d-flex justify-content-start">
                        <!-- Loop through the products for the current category -->
                        <?php foreach ($categoryProducts as $index => $product): ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="top-card" style="border: 1px solid #ccc; padding: 20px; text-align: center;">
                                    <!-- Check if image exists, otherwise use a default image -->
                                    <img src="<?php echo isset($product['image']) ? $product['image'] : '/velvetandvine/images/no-image.jpg'; ?>" alt="<?php echo htmlspecialchars($product['product_name'] ?? 'No Name'); ?>" style="width: 100%; height: auto;">

                                    <h2><?php echo htmlspecialchars($product['NAME'] ?? 'No Name'); ?></h2>
                                    <p><?php echo htmlspecialchars($product['Description'] ?? 'No description available'); ?></p>
                                    <p><strong><?php echo '$' . number_format($product['Price'] ?? 0, 2); ?></strong></p>

                                    <!-- View details link -->
                                    <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($product['ProductID']); ?>" class="btn submit-btn">View Details</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div> <!-- End of product-row -->
                </div> <!-- End of category-section -->
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</main>
