<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACME | Home</title>
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
                <h1>Welcome to Acme!</h1>
                <article class="coyoterocket">
                    <img class="coyoteimage" src="/acme/images/site/rocketfeature.jpg" alt="A coyote riding a rocket">
                    <div class="coyotetext-block">
                        <ul>
                            <li><h2>Acme Rocket</h2></li>
                            <li>Quick lighting fuse</li>
                            <li>NHTSA approved seat belts</li>
                            <li>Mobile launch stand included</li>
                            <li><a class="iwantit" href="/acme/cart/"><img class="iwantit" id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
                        </ul>
                    </div>
                </article>             
            </main>
            <section class="row">
                <div class="column" id="left-section">
                    <h3>Featured Recipes</h3>
                    <table>
                        <tr>
                            <th>
                            <img src="/acme/images/recipes/bbqsand.jpg" alt="Roadrunner BBQ">
                            <br />
                                <a href="#">Pulled Roadrunner BBQ</a>
                            </th>
                            <th>
                            <img src="/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie">
                            <br />
                                <a href="#">Roadrunner Pot Pie</a>
                            </th>
                        </tr>
                        <tr>
                            <th>
                            <img src="/acme/images/recipes/soup.jpg" alt="Roadrunner soup">
                            <br />
                                <a href="#">Roadrunner Soup</a>
                            </th>
                            <th>
                            <img src="/acme/images/recipes/taco.jpg" alt="Roadrunner taco">
                            <br />
                                <a href="#">Roadrunner Tacos</a>
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="column" id="right-right">
                    <h3>Acme Rocket Reviews</h3>
                    <ul>
                        <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                        <li>"That thing was fast!" (4/5)</li>
                        <li>"Talk about fast delivery." (5/5)</li>
                        <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                        <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                    </ul>
                </div>
            </section>

 
            <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
            </footer>

        </div>
    </body>
</html>