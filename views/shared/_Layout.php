<?php
// Initialize the session
$authenticated = false;
if (isset($_SESSION["userid"])) {
    $authenticated = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include "Views/Shared/LayoutParts/_Head.php";
?>

<body>

    <?php
    include "Views/Shared/LayoutParts/_Header.php";
    include "Views/Shared/LayoutParts/_Navbar.php";
    ?>
    <div class="body-content pb-5">
        <div class="container">
            <!-- The content of each page will be injected here -->
            <?php include $pageContent; ?>
        </div>
    </div>


    <?php
    include "Views/Shared/LayoutParts/_Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
