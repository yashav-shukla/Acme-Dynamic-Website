<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Admin | Acme, Inc.</title>
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
                <h1>Welcome, <?php echo $_SESSION['clientData']['clientFirstname']; ?>! you are logged in</h1>

                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];

                    // unset message after displaying it
                    unset($_SESSION['message']);
                }
                ?>

                <ul class="user-data">
                    <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                    <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                    <li>Email address: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                </ul>

                <p><a href="/acme/accounts/?action=updateClient" title="update user's information">Update your info</a></p>

                <?php
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                ?>
                    <h2>You are allowed to:</h2>
                    <p>Use the following options to manage products.</p>
                    <p><a href="/acme/products" title="Go to products page">Manage Products</a></p>
                <?php
                }
                ?>

                <h2>Your product reviews</h2>
                <?php
                if (isset($reviewList)) {
                    echo $reviewList;
                } else {
                    echo "You haven't done review to our products yet. When you do, they'll show here.";
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