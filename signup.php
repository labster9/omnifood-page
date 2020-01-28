<?php

    session_start();

    if(isset($_POST['email'])){
        //poprawna walidacja
        $validation=true;

        $street = $_POST['street'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];

        //imie
        $name = $_POST['name'];
        if((strlen($name)<3) || (strlen($name)>20)) {
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("Name has to contain 3 to 20 letters!")';
            echo '</script>';
        }

        //nazwisko
        $surname = $_POST['surname'];
        if((strlen($surname)<3) || (strlen($surname)>30)) {
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("Surname has to contain 3 to 30 letters!")';
            echo '</script>';
        }

        //email
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("Email not valid!")';
            echo '</script>';
        }

        //haslo
        $password = $_POST['password'];
        if(strlen($password)<8){
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("Password has to contain at least 8 characters!")';
            echo '</script>';
        }
        //hashowanie hasla
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        //checkbox
        if(!isset($_POST['accept'])){
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("You have to accept the rules!")';
            echo '</script>';
        }

        //captcha
        $secret = "6Lf4LdMUAAAAADyxjxcVDdfE5bMnrkPfRU8DkWgM";

        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

        $answer = json_decode($check);

        if($answer->success==false){
            $validation=false;
            echo '<script language="javascript">';
            echo 'alert("You have to validate that you are not a robot!")';
            echo '</script>';
        }

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);

            if ($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else {
            // czy email istnieje
            $result = $connection->query("SELECT id_klient FROM klient WHERE mail='$email'");

            if(!$result) throw new Exception($connection->error);

            $mail_numbers = $result->num_rows;

            if($mail_numbers>0){
                
                $validation=false;
                echo '<script language="javascript">';
                echo 'alert("Email already used!")';
                echo '</script>';
            }


            if($validation==true){
                //tests completed
                if($connection->query("INSERT INTO klient VALUES (NULL, '$name', '$surname', '$email', '$pass_hash', '$city', '$street', '$zip')")){
                    
                    header('Location: login.php');
                }
                else {
                    throw new Exception($connection->error);
                }
            }

            $connection->close();
            }
        }

        catch(Exception $e){
            echo '<br />Informacja developerska: '.$e;
            echo '<script language="javascript">';
            echo 'alert("Server error!")';
            echo '</script>';
            }


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
    <title>Sign up</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <section class="signup">
        <header>
            <nav>
                <div class="row">
                    <img src="public/img/logo-white.png" alt="Omnifood logo" class="logo">
                    
                    <ul class="main-nav">
                        <li><a href="#">food delivery</a></li>
                        <li><a href="#">how it works</a></li> 
                        <li><a href="#">our cities</a></li>
                        <li><a href="index.php">home</a></li>
                        <li><a href="signin.php">sign in</a></li>
                    </ul>
                </div>
            </nav>
            <div class="row">
                <h2>Sign up</h2>
            </div>
        

            <div class="row">
                <form method="post" class="signup-form">
                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="text" name="name" id="name" placeholder="Your name" required>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Surname</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="text" name="surname" id="surname" placeholder="Your Surname" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Email</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="email" name="email" id="email" placeholder="Your email" required>
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

                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Street</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="text" name="street" id="street" placeholder="Street" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">City</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="text" name="city" id="city" placeholder="City" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col span-1-of-2">
                            <label for="name">Zip code</label>
                        </div>
                        <div class="col span-1-of-2">
                            <input type="text" name="zip" id="zip" placeholder="Zip" required>
                        </div>
                    </div>
                    <div class="accept">
                        <div class="check">
                            <input type="checkbox" name="accept"/> Accept the rules!
                            <div class="g-recaptcha" data-sitekey="6Lf4LdMUAAAAACMtpKKo7BOD4Adl8OlKAv-21rU4"></div>


                        </div>
                    </div>


                    <div class="su-btn">
                        <input type="submit" value="Sign up" />

                    </div>

                </form>
            </div>
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