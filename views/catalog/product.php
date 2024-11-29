<main>
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="/velvetandvine/images/products/product_<?php echo $model->productID ?>.jpg" alt="<?php echo $model->name; ?>" style="width: 100%; height: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo $model->name; ?></h1>
                <p><?php echo $model->description; ?></p>
                <p><strong>Price: <?php echo $model->price; ?></strong></p>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <a class="btn btn-outline-dark ">Small</a>
                        <a class="btn btn-outline-dark ">Medim</a>
                        <a class="btn btn-outline-dark ">Large</a>
                        <a class="btn btn-outline-dark ">XL</a>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"><strong>Quantity:</strong></label>
                        <div class="d-flex">
                            <button class="btn btn-outline-dark" onclick="updateQuantity(-1)">-</button>
                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1"
                                class="form-control mx-2 text-center"
                                style="width: 60px;">
                            <button class="btn btn-outline-dark" onclick="updateQuantity(1)">+</button>
                        </div>
                    </div>
                    <script>
                        function updateQuantity(amount) {
                            const quantityInput = document.getElementById('quantity');
                            let currentQuantity = parseInt(quantityInput.value);
                            if (isNaN(currentQuantity)) currentQuantity = 1;
                            const newQuantity = Math.max(1, currentQuantity + amount);
                            quantityInput.value = newQuantity;
                        }
                    </script>
                    <a href="/buy.php?pid=<?php echo urlencode($model->productID); ?>" class="btn btn-outline-dark ">Add to Cart</a>
                </div>
            </div>
        </div>
</main>
