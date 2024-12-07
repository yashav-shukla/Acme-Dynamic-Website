<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Image Management | Acme, Inc.</title>
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
            <div>
                <h1>Image Management</h1>
                <h2>Add New Product Image</h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];

                    // unset message after displaying it
                    unset($_SESSION['message']);
                }
                ?>
                <!-- <div id="img-update"> -->
                <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
                    <label id="invItem">Product</label><br>
                    <?php echo $prodSelect; ?><br><br>
                    <label>Upload Image:</label><br>
                    <input type="file" name="file1"><br>
                    <input type="submit" class="regbtn" value="Upload">
                    <input type="hidden" name="action" value="upload">
                </form>
                <!-- </div> -->
                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <div id="img-update">
                    <?php
                    if (isset($imageDisplay)) {
                        echo $imageDisplay;
                    } ?>
                </div>



            </div>
        </main>


        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

    </div>
</body>

</html>