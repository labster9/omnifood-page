<?php
    session_start();

    if((!isset($_POST['email'])) || (!isset($_POST['password']))){
        header('Location: signin.php');
        exit();
    }

    require_once "connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno!=0){
        echo "Error:".$connection->connect_errno;
    }
    else {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $email = htmlentities($login, ENT_QUOTES);
        $password = htmlentities($password, ENT_QUOTES);

        if ($result = @$connection->query(
        sprintf("SELECT * FROM klient WHERE mail='%s' AND haslo='%s'",
        mysqli_real_escape_string($connection, $email),
        mysqli_real_escape_string($connection, $password)))){
            $users = $result->num_rows;
            if($users>1){
                $_SESSION['zalogowany'] = true;

                $row = $result->fetch_assoc();
                $_SESSION['id_klient'] = $row['id_klient'];
                $_SESSION['imie'] = $row['imie'];
                $_SESSION['nazwisko'] = $row['nazwisko'];
                $_SESSION['mail'] = $row['mail'];
                $_SESSION['miasto'] = $row['miasto'];
                $_SESSION['ulica'] = $row['ulica'];
                $_SESSION['zip'] = $row['zip'];
                
                unset($_SESSION['blad']);
                $result->close();
                header('Location: logged.php');
            }
            else {
                $_SESSION['blad'] = '<span style="color:red"> Wrong email or password!</span>';
                header('Location: signin.php'); 
            }
        }

        $connection->close();
    }



?>