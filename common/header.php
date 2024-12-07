<div class="header">
    <div class="header-left">
        <a href="/acme/" class="logo"><img id="logo" src="/acme/images/site/logo.gif" alt="Acme logo"></a>
    </div>    
    <div class="header-right">
        <?php 

         ?>

        <?php
            if (isset($_SESSION['loggedin'])){ ?>
                <a href="/acme/accounts/index.php?action=logout" class="account"><img id="account" src="/acme/images/site/account.gif" alt="Image of a folder"> Logout</a>
            <?php echo "<span id='welcome'><a href='/acme/accounts/index.php'>Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a></span>"; } else { ?>
                <a href="/acme/accounts/index.php?action=login" class="account"><img id="account" src="/acme/images/site/account.gif" alt="Image of a folder">  My Account</a>
            <?php }
        ?>
    </div>            
</div>

<!--echo "<span id='welcome'><a href='/acme/accounts/admin.php'>Welcome " . $clientData['clientFirstname'] . "</a></span>";-->
