<?php
session_start();
require_once './User.php';

if ($_SESSION['user']) {
    $user = unserialize($_SESSION['user']);
    var_dump($user);
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Account</title>
    </head>

    <body>
        <h1>Update my Account</h1>

        <form action="#" method="post">
            <label for="email">E-mail</label>
            <br>
            <input type="email" name="mail" value="<?php echo $user->getMail() ?>" id="">
            <br>
            <br>
            <label for="firstname">First Name</label>
            <br>
            <input type="text" name="firstname" value="<?php echo $user->getFirst_name() ?>" id="">
            <br>
            <br>
            <label for="lastname">Last Name</label>
            <br>
            <input type="text" name="lastname" value="<?php echo $user->getLast_name() ?>" id="">
            <br>
            <br>
            <input type="submit" name="submit" value="update!">

        </form>


        <?php
            if (isset($_POST['submit'])) {
                $newfirstname = $_POST['firstname'];
                $newlastname = $_POST['lastname'];
                $newmail = $_POST['mail'];
                $id = $user->getUser_id();

                $user->updateUser($newfirstname, $newlastname, $newmail, $id);
                var_dump($user);
            }

            ?>

        <p><strong>You cannot change your password. Passwords are forever.</strong> </p>


    <?php
    } else {
        header('Location: ./register.php');
    }
    ?>
    </body>

    </html>