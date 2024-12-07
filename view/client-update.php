<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACME | Client Update</title>
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
                <h1>Update client information</h1>
                <p>*All fields are required*</p>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];

                    // unset message after displaying it
                    unset($_SESSION['message']);
                }
                ?>
                <form action="/acme/accounts/index.php" method="post">
                    First Name *:<br>
                    <input type="text" name="clientFirstname" id="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                                        echo "value='$clientFirstname'";
                                                                                    } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                        echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'";
                                                                                    }
                                                                                    ?> required>
                    <br>
                    Last Name * :<br>
                    <input type="text" name="clientLastname" id="clientLastname" <?php if (isset($clientLastname)) {
                                                                                        echo "value='$clientLastname'";
                                                                                    } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                        echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";
                                                                                    }
                                                                                    ?> required>
                    <br>
                    Email *:<br>
                    <input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) {
                                                                                echo "value='$clientEmail'";
                                                                            } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                echo "value='" . $_SESSION['clientData']['clientEmail'] . "'";
                                                                            }
                                                                            ?> required>

                    <br><br>
                    <input type="submit" name="submit" value="Update your info">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateClientInformation">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">

                    <br>
                    <br>

                </form>

                <h2>Change your password</h2>
                <form action="/acme/accounts/index.php" method="post">
                    <p>Change your password here :)</p>
                    <br>
                    Password *:<br>
                    <span>Password must be at least 8 characters, at least 1 uppercase letter, 1 number and 1 special character</span>
                    <br>
                    <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                    <br><br>
                    <input type="submit" name="submit" value="Change password">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateClientPassword">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">

                </form>

            </div>
        </main>


        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

    </div>
</body>

</html>