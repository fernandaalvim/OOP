<?php

class User
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $mail;
    private $password;



    public function updateUser($newfirstname, $newlastname, $newmail, $id)
    {
        require_once 'database.php';

        $newfirstname = $_POST['firstname'];
        $newlastname = $_POST['lastname'];
        $newmail = $_POST['mail'];

        $sanitizeMail = filter_var($newmail, FILTER_SANITIZE_EMAIL);
        $sanitizeMail = filter_var($newmail, FILTER_VALIDATE_EMAIL);

        $query = "UPDATE users SET first_name='$newfirstname', last_name='$newlastname', mail='$newmail' WHERE user_id = '$id'";
        //prepare the query
        $newUser = $pdo->prepare($query);
        //$newUser->execute();
        if ($newUser->execute()) {
            $this->setFirst_name($newfirstname);
            $this->setLast_name($newlastname);
            $this->setMail($newmail);
            return 'Profile updated';
        } else {
            echo 'FAIL';
            var_dump($newUser);
        }
    }

    /*
    public function __set($name, $value)
    {
        if ($name !== 'password') {
            $this->$name = $value;
        }
    }
    */

    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getFirst_name()
    {
        return $this->first_name;
    }


    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }


    public function getLast_name()
    {
        return $this->last_name;
    }


    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }


    public function getUser_id()
    {
        return $this->user_id;
    }
}
