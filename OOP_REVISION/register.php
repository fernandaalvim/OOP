<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>



<body>
    <?php
    require_once 'menu.html';
    ?>
    <h1>Sign Up</h1>
    <form action="#" method="post">
        <label for="email">Enter your e-mail</label>
        <br>
        <input type="email" name="mail" id="">
        <br>
        <label for="password">Enter a password</label>
        <br>
        <input type="password" name="password" id="">
        <br>
        <input type="submit" name="submit" value="send">

    </form>

    <?php
    $mail = '';
    $password = '';

    if (isset($_POST['submit'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $sanitizeMail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        $sanitizeMail = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if (empty($mail) || empty($password)) {
            // Check if the fields are empty
            echo '<div class:"error">Please fill all fields</div>';
        } elseif (!$sanitizeMail) {
            // Check if the mail is ok
            echo '<div class:"error">You must enter a valid email</div>';
        } else {
            require_once 'database.php';

            //save 
            $securePassword = password_hash($password, PASSWORD_DEFAULT);

            $query = 'INSERT INTO users (mail, password) VALUES(?, ?)';
            //prepare the query
            $newUser = $pdo->prepare($query);
            $newUser->bindValue(1, $mail);
            $newUser->bindValue(2, $securePassword);

            //execute the query
            if ($newUser->execute()) {
                //if the query execution was successful display this message
                echo 'success';
            } else {
                //if the query execution was NOT successful display this message
                echo 'FAIL';
            }
        }
    }
    ?>
</body>

</html>