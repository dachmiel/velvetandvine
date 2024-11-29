<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>Jackets</h3>
        </div>
        <div class="row">
            <!-- Loop through the jackets array in the jacketsViewModel -->
            <?php if (isset($model) && !empty($model->jackets)): ?>
                <?php foreach ($model->jackets as $index => $jacket): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="padding: 20px; margin-bottom: 20px; text-align: center;">
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($jacket->productID); ?>" style="text-decoration: none; color: inherit;">
                                <img src="/velvetandvine/images/products/product_<?php echo $jacket->productID ?>.jpg" onerror="this.onerror=null;this.src='/velvetandvine/images/no-image.jpg';" alt="<?php echo htmlspecialchars($jacket->name); ?>" style="width: 300px; height: 300px; object-fit: cover; margin-bottom: 10px;">

                                <h2 style="font-size: 16px;"><?php echo htmlspecialchars($jacket->name); ?></h2>
                            </a>

                            <p style="font-size: 16px;"><?php echo '$' . number_format($jacket->price, 2); ?></p>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No jackets found in this category.</p>
<?php endif; ?>
        </div>
    </div>
</main>
