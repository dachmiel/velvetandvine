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
                <form method="post", action="addToCart">
        <input type="hidden" name="productID" value="<?php echo $model->productID; ?>">
        <input type="hidden" name="name" value="<?php echo $model->name; ?>">
        <input type="hidden" name="price" value="<?php echo $model->price; ?>">
        <input type="hidden" name="description" value="<?php echo $model->description; ?>">
        <label for="size">Size:</label>
        <select name="size">
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
  </select>
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
                     document.querySelectorAll('.btn-outline-dark').forEach(btn => {
                        btn.addEventListener('click', () => {
                        document.getElementById('selectedSize').value = btn.innerText.trim();
                        });
                        });
                    </script>
                        <button type="submit" class="btn submit-btn">Add to Cart</button>
                </div>
            </div>
        </div>
</main>
<script>
    function updateQuantity(amount) {
        event.preventDefault();
        const quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value);
        if (isNaN(currentQuantity)) currentQuantity = 1;
        const newQuantity = Math.max(1, currentQuantity + amount);
        quantityInput.value = newQuantity;
    }
</script>
