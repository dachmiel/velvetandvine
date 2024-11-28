<main>
    <div class="container">
        <div class="col-12 text-center">
            <h3>Dresses</h3>
        </div>
        <div class="row">
            <!-- Loop through the dresses array in the dressesViewModel -->
            <?php if (isset($model) && !empty($model->dresses)): ?>
                <?php foreach ($model->dresses as $index => $dress): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="top-card" style="padding: 20px; margin-bottom: 20px; text-align: center;">
                            <a href="/velvetandvine/catalog/product?pid=<?php echo urlencode($dress->productID); ?>" style="text-decoration: none; color: inherit;">
                                <img src="<?php echo $dress->image ?? '/velvetandvine/images/no-image.jpg'; ?>" alt="<?php echo htmlspecialchars($dress->name); ?>" style="width: 100%; height: auto;">

                                <h2 style="font-size: 16px;"><?php echo htmlspecialchars($dress->name); ?></h2>
                            </a>

                            <p style="font-size: 16px;"><?php echo '$' . number_format($dress->price, 2); ?></p>

                        </div>
                    </div>

                    <!-- Create a new row every 3 items (for Bootstrap grid layout) -->
                    <?php if (($index + 1) % 3 == 0): ?>
        </div>
        <div class="row">
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No dresses found in this category.</p>
<?php endif; ?>
        </div>
    </div>
</main>
