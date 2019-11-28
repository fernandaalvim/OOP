<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header>
        <?php
        require_once 'menu.html';
        ?>
    </header>


    <h1>Log in</h1>

    <form action="#" method="post">
        <label for="email">Enter your e-mail</label>
        <br>
        <input type="email" name="email" id="">
        <br>
        <label for="password">Enter a password</label>
        <br>
        <input type="password" name="password" id="">
        <br>
        <input type="submit" name="submit" value="send">

    </form>
    <?php



    function data_check($mail, $pass)
    {
        require_once "./database.php";
        $query = "SELECT * FROM users WHERE mail=" . "'" . $mail . "'";

        require_once 'User.php';
        $result = $pdo->query($query);
        $user = $result->setFetchMode(PDO::FETCH_CLASS, 'User');
        $user = $result->fetch();

        var_dump($user);
        $n_row = $result->rowCount();

        if ($n_row == 0) {
            echo "User not found <br>";
        } elseif (!password_verify($pass, $user->getPassword()))
            echo "<div class='error'>Invalid password</div> <br>";
        else {
            echo "User is logged in <br>";
            $_SESSION['user'] = serialize($user);
            var_dump($_SESSION);
        }
    }

    if (isset($_POST['submit'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($email && isset($password)) {
            data_check($email, $password);
        } else {
            echo "empty fields";
        }
    }
    ?>



</body>

</html>