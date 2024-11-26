<main>

    <body>
        <?php
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
        ?>
        <div class="container">
            <div class="row">
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-md-4 col-sm-6">
                        <div style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; text-align: center;">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100%; height: auto;">
                            <h2><?php echo $product['name']; ?></h2>
                            <p><?php echo $product['description']; ?></p>
                            <p><strong><?php echo $product['price']; ?></strong></p>
                            <a href="product?product_name=<?php echo urlencode($product['name']); ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                    <?php if (($index + 1) % 3 == 0): ?>
            </div>
            <div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
            </div>
        </div>
    </body>
</main>
