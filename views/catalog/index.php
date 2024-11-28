<main>
    <?php if (isset($model) && !empty($model)): ?>
        <?php foreach ($model as $categoryId => $categoryProducts): ?>
            <div style="width: 100%; padding: 20px 0;">
                <div class="container-fluid">
                    <!-- Center the category name -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3>
                                <a href="/velvetandvine/catalog/<?php echo htmlspecialchars(strtolower($categoryMap[$categoryId])); ?>"
                                    style="text-decoration: none; color: inherit;">
                                    <?php echo htmlspecialchars($categoryMap[$categoryId] ?? 'Unknown'); ?>
                                </a>
                            </h3>
                        </div>
                    </div>

                    <!-- Create a scrollable row for products in this category -->
                    <div class="overflow-auto">
                        <div class="product-row d-flex flex-nowrap">
                            <!-- Loop through the products for the current category -->
                            <?php foreach ($categoryProducts as $index => $product): ?>

                                <div class="product-card col-md-3 col-sm-4 mb-3" style="min-width: 200px;">
                                    <div class="top-card" style="padding: 20px; text-align: center;">
                                        <!-- Check if image exists, otherwise use a default image -->
                                        <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($product['ProductID']); ?>" style="text-decoration: none; color: inherit;">
                                            <img src="<?php echo isset($product['image']) ? $product['image'] : '/velvetandvine/images/no-image.jpg'; ?>" alt="<?php echo htmlspecialchars($product['product_name'] ?? 'No Name'); ?>" style="width: 100%; height: auto; margin-bottom: 10px;">

                                            <h2 style="font-size: 16px;"><?php echo htmlspecialchars($product['NAME'] ?? 'No Name'); ?></h2>
                                        </a>

                                        <p style="font-size: 16px;"><?php echo '$' . number_format($product['Price'] ?? 0, 2); ?></p>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div> <!-- End of product-row -->
                    </div> <!-- End of product-row-wrapper -->
                </div> <!-- End of container-fluid for full width content -->
            </div> <!-- End of full-width background section -->
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</main>
