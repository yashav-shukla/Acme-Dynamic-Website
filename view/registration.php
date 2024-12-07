<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACME | Registration</title>
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
                <h1>Registration!</h1>
                <p>*All fields are required*</p>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                    ?>
                <form action="/acme/accounts/index.php" method="post">
                First Name *:<br>
                <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required placeholder="Your name">
                <br>
                Last Name * :<br>
                <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required placeholder="Your last name">
                <br>
                Email *:<br>
                <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required placeholder="example@domain.com">
                <br>
                Password *:<br>
                <span>Password must be at least 8 characters, at least 1 uppercase letter, 1 number and 1 special character</span>
                <br>
                <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required placeholder="Write you password here">
                <br><br>
                <input type="submit" name="submit" value="Register">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="register"> 
                  

                </form>
                </div>
            </main>

 
            <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
            </footer>

        </div>
    </body>
</html>