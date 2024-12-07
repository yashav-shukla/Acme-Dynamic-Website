<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACME | Product Update</title>
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
                        echo "Modify $prodInfo[invName] ";
                    } elseif (isset($invName)) {
                        echo $invName;
                    } ?></h1>
                <p>Modifiy the product below:</p>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/acme/products/index.php" method="post">
                    Inventory Name:<br>
                    <input type="text" name="invName" id="invName" <?php if (isset($invName)) {
                                                                        echo "value='$invName'";
                                                                    } elseif (isset($prodInfo['invName'])) {
                                                                        echo "value='$prodInfo[invName]'";
                                                                    } ?> required>
                    <br>
                    <br />
                    Inventory Description:<br>
                    <textarea name="invDescription" id="invDescription" required><?php if (isset($invDescription)) {
                                                                                        echo $invDescription;
                                                                                    } elseif (isset($prodInfo['invDescription'])) {
                                                                                        echo $prodInfo['invDescription'];
                                                                                    }  ?></textarea>
                    <br>
                    <br />
                    Inventory Image<br>
                    <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png" <?php if (isset($invImage)) {
                                                                                                                    echo "value='$invImage'";
                                                                                                                } elseif (isset($prodInfo['invImg'])) {
                                                                                                                    echo "value='$prodInfo[invImg]'";
                                                                                                                } ?>required>
                    <br>
                    <br />
                    Inventory Thumbnail<br>
                    <input type="text" name="invThumbnail" id="invThumbnail" <?php if (isset($invThumbnail)) {
                                                                                    echo "value='$invThumbnail'";
                                                                                } elseif (isset($prodInfo['invThumbnail'])) {
                                                                                    echo "value='$prodInfo[invThumbnail]'";
                                                                                } ?> required>

                    <br>
                    <br />
                    Inventory Price:<br>
                    <input type="number" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {
                                                                            echo "value='$invPrice'";
                                                                        } elseif (isset($prodInfo['invPrice'])) {
                                                                            echo "value='$prodInfo[invPrice]'";
                                                                        } ?> required>
                    <br>
                    <br />
                    Inventory Stock:<br>
                    <input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {
                                                                            echo "value='$invStock'";
                                                                        } elseif (isset($prodInfo['invStock'])) {
                                                                            echo "value='$prodInfo[invStock]'";
                                                                        } ?> required>
                    <br>
                    <br />
                    Inventory Size<br>
                    <input type="number" name="invSize" id="invSize" <?php if (isset($invSize)) {
                                                                            echo "value='$invSize'";
                                                                        } elseif (isset($prodInfo['invSize'])) {
                                                                            echo "value='$prodInfo[invSize]'";
                                                                        } ?> required>
                    <br>
                    <br />
                    Inventory Weight<br>
                    <input type="number" name="invWeight" id="invWeight" <?php if (isset($invWeight)) {
                                                                                echo "value='$invWeight'";
                                                                            } elseif (isset($prodInfo['invWeight'])) {
                                                                                echo "value='$prodInfo[invWeight]'";
                                                                            } ?> required>
                    <br>
                    <br />
                    Inventory Location:<br>
                    <input type="text" name="invLocation" id="invLocation" <?php if (isset($invLocation)) {
                                                                                echo "value='$invLocation'";
                                                                            } elseif (isset($prodInfo['invLocation'])) {
                                                                                echo "value='$prodInfo[invLocation]'";
                                                                            } ?> required>
                    <br>
                    <br />
                    <label>Category</label>
                    <br>
                    <?php echo $catList; ?>
                    <br>
                    <br />
                    Inventory Vendor<br>
                    <input type="text" name="invVendor" id="invVendor" <?php if (isset($invVendor)) {
                                                                            echo "value='$invVendor'";
                                                                        } elseif (isset($prodInfo['invVendor'])) {
                                                                            echo "value='$prodInfo[invVendor]'";
                                                                        } ?> required>
                    <br>
                    <br />
                    Inventory Style<br>
                    <input type="text" name="invStyle" id="invStyle" <?php if (isset($invStyle)) {
                                                                            echo "value='$invStyle'";
                                                                        } elseif (isset($prodInfo['invStyle'])) {
                                                                            echo "value='$prodInfo[invStyle]'";
                                                                        } ?> required>
                    <br>
                    <br />
                    <br />
                    <input type="submit" name="submit" value="Update Product">
                    <input type="hidden" name="action" value="updateProd">
                    <input type="hidden" name="invId" value="<?php if (isset($prodInfo['invId'])) {
                                                                    echo $prodInfo['invId'];
                                                                } elseif (isset($invId)) {
                                                                    echo $invId;
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