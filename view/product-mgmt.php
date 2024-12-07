<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACME | Product Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
</head>

<body>
    <div id="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>

            <h1>Product Management</h1>
            <p>Welcome to the product management page. Please choose an option:</p>
            <ul>
                <li><a href="../products/index.php?action=newCat" title="Add new categoy">Add a new category</a></li>
                <li><a href="../products/index.php?action=newProduct" title="Add new product">Add a new product</a></li>

            </ul>

            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($categoryList)) {
                echo '<h2>Products By Category</h2>';
                echo '<p>Choose a category to see those products</p>';
                echo $categoryList;
            }
            ?>

            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>

            <table id="productsDisplay"></table>


        </main>


        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

    </div>
    <script src="../js/products.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>