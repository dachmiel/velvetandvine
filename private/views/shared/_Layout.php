<!DOCTYPE html>
<html lang="en">

<?php
include "LayoutParts/_Head.php";
?>

<body>

    <?php
    include "LayoutParts/_Header.php";
    include "LayoutParts/_Navbar.php";
    ?>
    <div class="body-content pb-5">
        <div class="container">
            <!-- The content of each page will be injected here -->
            <?php include $pageContent; ?>
        </div>
    </div>


    <?php
    include "LayoutParts/_Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
