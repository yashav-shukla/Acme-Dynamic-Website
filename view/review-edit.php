<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Review Edit | Acme, Inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
</head>

<body>
    <div id="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <?php
        if (!$_SESSION['loggedin']) {
            header('location: /acme/');
            exit;
        }
        ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <div class="login-container">

                <h1>Update Review</h1>

                <p><a href="/acme/accounts/">&#8592; Return</a></p>
                <form method="post" action="/acme/reviews/index.php" class="stacked-form">
                    <label for="reviewText">Review Content</label>
                    <textarea cols="50" id="reviewText" name="reviewText" required rows="5"><?php if (isset($reviewText)) {
                                                                                                echo $reviewText;
                                                                                            } else {
                                                                                                echo $reviewInfo['reviewText'];
                                                                                            } ?></textarea>
                    <br>
                    <input class="button" id="formButton" name="submit" type="submit" value="Save Edits">
                    <input name="action" type="hidden" value="processEditReviewview">
                    <input name="reviewId" type="hidden" value="<?php if (isset($reviewId)) {
                                                                    echo $reviewId;
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