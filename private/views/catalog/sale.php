<!-- 
* File Name: sale.php
* Purpose: This file displays a catalog of sale products in a grid layout on the user interface. 
* It retrieves sale data passed from the controller and renders each item with an image, name, and price. 
* The file also handles cases when no sale items are available to display.
* Version: 1.0
-->
<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>Sale</h3>
        </div>
        <div class="row">
            <!-- Loop through the jackets array in the jacketsViewModel -->
            <?php if (isset($model) && !empty($model->sales)): ?>
                <?php foreach ($model->sales as $index => $sale): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="padding: 20px; margin-bottom: 20px; text-align: center;">
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($sale->productID); ?>" style="text-decoration: none; color: inherit;">
                                <img src="/velvetandvine/public/images/products/product_<?php echo $sale->productID ?>.jpg" onerror="this.onerror=null;this.src='/velvetandvine/public/images/no-image.jpg';" alt="<?php echo htmlspecialchars($jacket->name); ?>" style="width: 300px; height: 300px; object-fit: cover; margin-bottom: 10px;">

                                <h2 style="font-size: 16px;"><?php echo htmlspecialchars($nsaleew->name); ?></h2>
                            </a>

                            <p style="font-size: 16px;"><?php echo '$' . number_format($sale->price, 2); ?></p>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No sale found in this category.</p>
<?php endif; ?>
        </div>
    </div>
</main>
