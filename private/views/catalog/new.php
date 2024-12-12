<!-- 
* File Name: new.php
* Purpose: This file displays a catalog of new arrival products in a grid layout on the user interface. 
* It retrieves new arrival data passed from the controller and renders each item with an image, name, and price. 
* The file also handles cases when no new arrival items are available to display.
* Version: 1.0
-->
<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>New Arrivals!</h3>
        </div>
        <div class="row">
            <!-- Loop through the jackets array in the jacketsViewModel -->
            <?php if (isset($model) && !empty($model->news)): ?>
                <?php foreach ($model->news as $index => $new): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="padding: 20px; margin-bottom: 20px; text-align: center;">
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($new->productID); ?>" style="text-decoration: none; color: inherit;">
                                <img src="/velvetandvine/public/images/products/product_<?php echo $new->productID ?>.jpg" onerror="this.onerror=null;this.src='/velvetandvine/public/images/no-image.jpg';" alt="<?php echo htmlspecialchars($jacket->name); ?>" style="width: 300px; height: 300px; object-fit: cover; margin-bottom: 10px;">

                                <h2 style="font-size: 16px;"><?php echo htmlspecialchars($new->name); ?></h2>
                            </a>

                            <p style="font-size: 16px;"><?php echo '$' . number_format($new->price, 2); ?></p>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No new arrivals found in this category.</p>
<?php endif; ?>
        </div>
    </div>
</main>
