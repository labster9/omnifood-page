<?php

session_start();

    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
        header('Location: logged.php');
        exit();
    }

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link rel="stylesheet" type="text/css" href="public/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="public/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <link rel="stylesheet" type="text/css" href="public/queries.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
    <title>Sign in</title>
</head>

<body>
    <section class="login">
        <header>
            <nav>
                <div class="row">
                    <img src="public/img/logo-white.png" alt="Omnifood logo" class="logo">
                    
                    <ul class="main-nav">
                        <li><a href="#">food delivery</a></li>
                        <li><a href="#">how it works</a></li> 
                        <li><a href="#">our cities</a></li>
                        <li><a href="index.php">home</a></li>
                        <li><a href="signup.php">sign up</a></li>
                    </ul>
                </div>
            </nav>

            <div class="row">
                <h2>Sign in</h2>
            </div>

            <div class="row">
                <form method="post" action="login.php" class="signup-form">
                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Email</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="email" name="email" id="email" placeholder="email@email.com" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Password</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="password" name="password" id="password" placeholder="********" required>
                        </div>
                    </div>

                    <div class="su-btn">
                        <input type="submit" value="Sign up" />
                    </div>
                    
                </form>

    </header>

    <footer>
        <div class="row">
            <div class="col span-1-of-2">
                <ul class="footer-nav">
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">iOS App</a></li>
                    <li><a href="#">Android App</a></li>
                </ul>
            </div>
            <div class="col span-1-of-2">
                <ul class="social-links">
                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <p>
                Copyright &copy; 2020 by Omnifood. All rights reserved. 
            </p>
        </div>

    </footer>

</section>





</body>