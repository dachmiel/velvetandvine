<main>
<?php
// Simulate a product database
$products = [
    [
        "name" => "Classic White T-Shirt",
        "price" => "$20.00",
        "description" => "A classic white t-shirt made of 100% cotton.",
        "image" => "../images/classic-white-tshirt.png"
    ],
    [
        "name" => "Denim Jacket",
        "price" => "$45.00",
        "description" => "A stylish denim jacket for all seasons.",
        "image" => "../images/denim-jacket.png"
    ],
    [
        "name" => "Black Jeans",
        "price" => "$35.00",
        "description" => "A pair of classic black jeans.",
        "image" => "../images/black-jeans.png"
    ]
];
// Get the product name from the query string
$product_name = $_GET['product_name'] ?? null;
// Find the product
$product = null;
foreach ($products as $p) {
    if ($p['name'] === $product_name) {
        $product = $p;
        break;
    }
}
if (!$product) {
    // If the product is not found, redirect to an error page or show a message
    echo "<h1>Product not found!</h1>";
    exit;
}
?>

<body>
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100%; height: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo $product['name']; ?></h1>
                <p><?php echo $product['description']; ?></p>
                <p><strong>Price: <?php echo $product['price']; ?></strong></p>
                <div class="row align-items-center">
                <div class="col-md-6">
                <a href="/buy.php?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-outline-dark ">Small</a>
                <a href="/buy.php?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-outline-dark ">Medim</a>
                <a href="/buy.php?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-outline-dark ">Large</a>
                <a href="/buy.php?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-outline-dark ">XL</a>
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
                <a href="/buy.php?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-outline-dark ">Add to Cart</a>
            </div>
        </div>
    </div>
</body>

</main>
