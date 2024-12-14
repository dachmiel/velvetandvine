<!-- 
* File Name: Product.php
* Purpose: This file displays the product's details, including 
* its image, description, prize, and size options. It also allows 
* for users to select product quantity using the "+" and "-" buttons 
* and the nadd the product to their cart. 
* Version: 1.0
-->
<main>
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="/velvetandvine/public/images/products/product_<?php echo $model->productID ?>.jpg" alt="<?php echo $model->name; ?>" style="width: 100%; height: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo $model->name; ?></h1>
                <p><?php echo $model->description; ?></p>
                <p><strong>Price: <?php echo $model->price; ?></strong></p>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <a class="btn btn-outline-dark">S</a>
                        <a class="btn btn-outline-dark">M</a>
                        <a class="btn btn-outline-dark">L</a>
                        <a class="btn btn-outline-dark">XL</a>
                    </div>
                    <form action="/velvetandvine/cart/addToCart" method="POST">
                        <div class="mb-3">
                            <label for="quantity" class="form-label"><strong>Quantity:</strong></label>
                            <div class="d-flex">
                                <button type="button" class="btn btn-outline-dark" onclick="updateQuantity(-1)">-</button>
                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    class="form-control mx-2 text-center"
                                    style="width: 60px;">
                                <button type="button" class="btn btn-outline-dark" onclick="updateQuantity(1)">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="productId" value="<?php echo $model->productID; ?>">
                        <button type="submit" class="btn btn-outline-dark">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateQuantity(amount) {
        const quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value);
        if (isNaN(currentQuantity)) currentQuantity = 1;
        const newQuantity = Math.max(1, currentQuantity + amount);
        quantityInput.value = newQuantity;
    }
</script>