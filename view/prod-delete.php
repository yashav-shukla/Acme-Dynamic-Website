<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACME | Product Delete</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
</head>
<?php
// Build a category dropdown list 
$catList = '<select name="categoryId">';
$catList .= '<option>Select a Category</option>';
foreach ($categories as $category) {
    $catList .= '<option value="' . $category['categoryId'] . '"';
    if (isset($categoryId)) {
        if ($categoryId == $category['categoryId']) {
            $catList .= ' selected ';
        }
    } elseif (isset($prodInfo['categoryId'])) {
        if ($category['categoryId'] === $prodInfo['categoryId']) {
            $catList .= ' selected ';
        }
    }
    $catList .= '>' . $category['categoryName'] . '</option>';
}
$catList .= '</select>';
?>

<body>
    <div id="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <div class="login-container">

                <h1><?php if (isset($prodInfo['invName'])) {
                        echo "Delete $prodInfo[invName]";
                    } ?></h1>
                <p>Confirm Product Deletion. The delete is permanent.</p>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/acme/products/index.php" method="post">
                    Inventory Name:<br>
                    <input type="text" name="invName" id="invName" <?php if (isset($prodInfo['invName'])) {
                                                                        echo "value='$prodInfo[invName]'";
                                                                    } ?>>
                    <br>
                    <br />
                    Inventory Description:<br>
                    <textarea name="invDescription" id="invDescription"><?php if (isset($prodInfo['invDescription'])) {
                                                                            echo $prodInfo['invDescription'];
                                                                        }  ?></textarea>
                    <br>
                    <br />
                    <br />
                    <input type="submit" name="submit" value="Delete Product">
                    <input type="hidden" name="action" value="deleteProd">
                    <input type="hidden" name="invId" value="<?php if (isset($prodInfo['invId'])) {
                                                                    echo $prodInfo['invId'];
                                                                } ?>">

                </form>
            </div>
        </main>


        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

    </div>
</body>

</html>