<main>
    <div class="container">
        <div class="row">
            <!-- Loop through the tops array in the TopsViewModel -->
            <?php if (isset($model) && !empty($model->tops)): ?>
                <?php foreach ($model->tops as $index => $top): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; text-align: center;">
                            <!-- You may need to check if an image exists -->
                            <img src="<?php echo $top->image ?? 'path_to_default_image.jpg'; ?>" alt="<?php echo htmlspecialchars($top->name); ?>" style="width: 100%; height: auto;">

                            <h2><?php echo htmlspecialchars($top->name); ?></h2>
                            <p><?php echo htmlspecialchars($top->description); ?></p>
                            <p><strong><?php echo '$' . number_format($top->price, 2); ?></strong></p>

                            <!-- Example link to a detailed page, adjust if needed -->
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($top->productID); ?>" class="btn submit-btn">View Details</a>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No tops found in this category.</p>
<?php endif; ?>
        </div>
    </div>
</main>
