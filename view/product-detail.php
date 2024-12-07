<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Products | Acme, Inc.</title>
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
                <h1>Product</h1>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];

                    // unset message after displaying it
                    unset($_SESSION['message']);
                }
                ?>

                <?php
                // For images with no thubnail
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $productInfo['invImage'])) {
                    $image = '/acme/images/no-image.png';
                } else {
                    $image = $productInfo['invImage'];
                }
                ?>

                <ul id="detail-display">
                    <li>
                        <img src='<?php echo $image ?>' alt='Image of <?php $productInfo['invName'] ?> product on Acme.com'>
                    </li>
                    <li id="detail-description">
                        <ul>
                            <li id='detailDesc'><?php echo $productInfo['invDescription'] ?></li>
                            <li id='detailVendor'>By <?php echo $productInfo['invVendor'] ?></li>
                            <li>&nbsp;
                            <li>
                            <li id='detailStyle'>&#8658;Material: <?php echo $productInfo['invStyle'] ?></li>
                            <li id='detailWeight'>&#8658;Weight: <?php echo $productInfo['invWeight'] ?> lbs.</li>
                            <li id='detailSize'>&#8658;Size: <?php echo $productInfo['invSize'] ?> W x H x L</li>
                            <li>&nbsp;
                            <li>
                            <li id='detailLocation'>At: <?php echo $productInfo['invLocation'] ?> warehouse</li>
                            <li id='detailStock'>Only <?php echo $productInfo['invStock'] ?> In stock</li>
                            <li>&nbsp;
                            <li>
                            <li id='detailPrice'>Price: $<?php echo $productInfo['invPrice'] ?></li>
                        </ul>

                    </li>

                </ul>
                <h2>Product Thumbnails</h2>
                <ul id="thumb-display">
                    <?php foreach ($productThumbnails as $thumbnails) { ?>
                        <li>
                            <img src='<?php echo $thumbnails['imgPath']; ?>' alt='Image of <?php echo $thumbnails['imgName']; ?> product on Acme.com'>
                        </li>
                    <?php } ?>



                </ul>

                <?php
                if (isset($_SESSION['loggedin'])) {
                    $first = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
                    $last = $_SESSION['clientData']['clientLastname'];
                    $screenName = $first . $last;
                    $sessionClientDataClientId = $_SESSION['clientData']['clientId'];

                    if (isset($reviewFormMessage)) {
                        echo $reviewFormMessage;
                    }

                    echo '<form action="/acme/reviews/index.php" method="post" id="review-form">' . "\n";
                    echo "<label for='reviewText'>Review this product as $screenName</label>" . "\n";
                    echo '<br>' . "\n";
                    echo '<textarea cols="50" id="reviewText" name="reviewText" placeholder="Did you like this product? Tell us more..." required rows="5"></textarea>' . "\n";
                    echo '<br>' . "\n";
                    echo '<input class="button" name="submit" type="submit" value="Submit Review">' . "\n";
                    echo "<input type='hidden' name='clientId' value='$sessionClientDataClientId'>" . "\n";
                    echo "<input type='hidden' name='invId' value='$invId'>" . "\n";
                    echo '<input type="hidden" name="action" value="newReview">' . "\n";
                    echo '</form>' . "\n";
                } else {
                    echo "<p><a href='/acme/accounts/index.php?action=login'>Login</a> to review this product." . "\n";
                }

                echo '<br>';
                echo '<a id="bottom"></a>';
                echo '<h2>Customer Reviews</h2>';

                if (count($itemReviews) > 0) {
                    echo $reviewsDisplay;
                } else {
                    echo '<p>This product hasnt received reviews yet.</p>' . "\n";
                }
                ?>


            </div>
        </main>


        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

    </div>
</body>

</html>