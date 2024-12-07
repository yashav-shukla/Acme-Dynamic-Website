<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACME Login</title>
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
                <div  class="login-container">
                <h1>ACME | Add Category</h1>
                <p>Add a new category for products</p>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/acme/products/index.php" method="post">
                New category<br>
                <input type="text" name="categoryName" id="categoryName" <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?> required>
                <br>
                <br />
                <input type="submit" name="submit" value="Add Category">
                <input type="hidden" name="action" value="addCat">   

                </form>
                </div>
            </main>

 
            <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
            </footer>

        </div>
    </body>
</html>