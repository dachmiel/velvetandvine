<main>
    <?php if (isset($model) && !empty($model)): ?>
        <?php foreach ($model as $categoryId => $categoryProducts): ?>
            <div style="width: 100%; padding: 20px 0;">
                <div class="container-fluid">
                    <!-- Center the category name with scroll arrows -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3>
                                <a href="javascript:void(0);" class="scroll-left" onclick="scrollRow('left', event)">
                                    <span class="material-icons">keyboard_arrow_left</span>
                                </a>
                                <a href="/velvetandvine/catalog/<?php echo htmlspecialchars(strtolower($categoryMap[$categoryId])); ?>"
                                    style="text-decoration: none; color: inherit;">
                                    <?php echo htmlspecialchars($categoryMap[$categoryId] ?? 'Unknown'); ?>
                                </a>
                                <a href="javascript:void(0);" class="scroll-right" onclick="scrollRow('right', event)">
                                    <span class="material-icons">keyboard_arrow_right</span>
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

<!-- CSS for Arrow Styling -->
<style>
    .scroll-left,
    .scroll-right {
        cursor: pointer;
        font-size: 24px;
        color: #333;
        padding: 0 10px;
        text-decoration: none;
    }

    .scroll-left:hover,
    .scroll-right:hover {
        color: #007bff;
        /* Change the hover color as needed */
    }

    .product-row {
        display: flex;
        overflow-x: auto;
        padding-bottom: 20px;
        /* Space at the bottom for the arrows */
    }

    .product-row .product-card {
        margin-right: 10px;
        /* Space between the products */
    }
</style>

<!-- JavaScript for Scrolling -->
<script>
    function scrollRow(direction, event) {
        // Get the closest .product-row to the clicked arrow
        const row = event.target.closest('.container-fluid').querySelector('.product-row');
        const scrollAmount = 200; // Adjust this value based on how much you want to scroll per click

        if (direction === 'left') {
            row.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        } else if (direction === 'right') {
            row.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    }
</script>
