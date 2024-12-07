<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACME | New Product</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
    </head>
    <?php 
    // Build a category dropdown list 
       $catList = '<select name="categoryId">';
       $catList .= '<option>Select a Category</option>';
       foreach ($categories as $category) {
        $catList .= '<option value="' . $category['categoryId']. '"';
            if (isset($categoryId)){
                if ($categoryId == $category['categoryId']){
                    $catList.= ' selected ';
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
                <div  class="login-container">
                <h1>Add a New Product</h1>
                <p>Add a new product</p>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/acme/products/index.php" method="post">
                Inventory Name:<br>
                <input type="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";}  ?> required>
                <br>
                <br />
                Inventory Description:<br>
                <textarea name="invDescription" id="invDescription" required> <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> </textarea>
                <br>
                <br />
                Inventory Image<br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}  ?>required>
                <br>
                <br />
                Inventory Thumbnail<br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/products/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required>
                <br>
                <br />
                Inventory Price:<br>
                <input type="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>
                <br>
                <br />
                Inventory Stock:<br>
                <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
                <br>
                <br />
                Inventory Size<br>
                <input type="number" name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> required>
                <br>
                <br />
                Inventory Weight<br>
                <input type="number" name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> required>
                <br>
                <br />
                Inventory Location:<br>
                <input type="text" name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> required>
                <br>
                <br />
                <label>Category</label>
                <br>
                <?php echo $catList; ?>
                <br>
                <br />
                Inventory Vendor<br>
                <input type="text" name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> required>
                <br>
                <br />
                Inventory Style<br>
                <input type="text" name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> required>
                <br>
                <br />
                <br />
                <input type="submit" name="submit" value="Add Product">
                <input type="hidden" name="action" value="newProd">   

                </form>
                </div>
            </main>

 
            <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
            </footer>

        </div>
    </body>
</html>