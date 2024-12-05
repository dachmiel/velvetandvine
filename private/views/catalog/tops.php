<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>Tops</h3>
        </div>
        <div class="row">
            <!-- Loop through the tops array in the TopsViewModel -->
            <?php foreach ($model->tops as $index => $top): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="top-card" style="padding: 20px; margin-bottom: 20px; text-align: center;">
                        <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($top['ProductID']); ?>" style="text-decoration: none; color: inherit;">
                            <img src="/velvetandvine/public/images/products/product_<?php echo $top['ProductID'] ?>.jpg" onerror="this.onerror=null;this.src='/velvetandvine/public/images/no-image.jpg';"
                                alt="<?php echo htmlspecialchars($top['NAME']); ?>" style="width: 300px; height: 300px; object-fit: cover; margin-bottom: 10px;">

                            <h2 style="font-size: 16px;"><?php echo htmlspecialchars($top['NAME']); ?></h2>
                        </a>

                        <p style="font-size: 16px;"><?php echo '$' . number_format($top['Price'], 2); ?></p>

                    </div>
                </div>

                <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (empty($model->tops)): ?>
        <p>No tops found in this category.</p>
    <?php endif; ?>
        </div>
    </div>
</main>
