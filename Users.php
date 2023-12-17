<?php
class Users
{
    private $uid;
    private $username;
    private $email;
    private $phoneNumber;
    private $regDate;
    private $password;
    private $role;

    function __construct()
    {
        $this->uid = null;
        $this->username = null;
        $this->email = null;
        $this->phoneNumber = null;
        $this->regDate = null;
        $this->password = null;
        $this->role = null;

    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getRegDate()
    {
        return $this->regDate;
    }

    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }


    function initWithUid($uid)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select * from users where uid = ' . $uid);
        $this->initWith(
            $data->uid,
            $data->username,
            $data->email,
            $data->phoneNumber,
            $data->password,
            $data->regDate,
            $data->role
        );
    }

    function initWithUserName()
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select * from users where username = \'' . $this->username . '\'');
        if ($data != null) {
            return false;
        }
        return true;
    }

    function initWith($uid, $userName, $phoneNumber, $email, $password, $regDate, $role)
    {
        $this->uid = $uid;
        $this->username = $userName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->regDate = $regDate;
        $this->role = $role;
    }

    public function isValid()
    {
        $errors = true;
        if (empty($this->username)) {
            $errors = false;
        } else {
            if (!$this->initWithUserName()) {
                $errors = false;
            }
        }

        if (empty($this->email)) {
            $errors = false;
        }

        if (empty($this->password)) {
            $errors = false;
        }

        return $errors;
    }


    function registerUser()
    {
        if ($this->isValid()) {
            try {
                $hashed_pwd = password_hash($this->password, PASSWORD_DEFAULT);
                $db = Database::getInstance();
                $data = "insert into users (uid, username,  email, phoneNumber, RegDate, password, role) values (null, '$this->username', '$this->email', '$this->phoneNumber', NOW(), '$hashed_pwd', '$this->role')";

                $db->querySQL($data);
                //echo $data;
                return true;
            } catch (Exception $ex) {
                echo 'exception: ' . $ex;
                return false;
            }
        } else {
            return false;
        }
    }

    
    function changePassword($username, $password)
    {
        try {
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $db = Database::getInstance();
            $data = "UPDATE users SET `password` = '$hashed_pwd' where username = '$username'";
            $db->querySQL($data);
            //echo $data;
            return true;
        } catch (Exception $ex) {
            echo 'exception: ' . $ex;
            return false;
        }
    }


    function deleteUser()
    {
        try {
            $db = Database::getInstance();
            $db->querySQL('delete from users where uid = ' . $this->uid);
            return true;
        } catch (Exception $ex) {
            echo 'exception: ' . $ex;
            return false;
        }
    }
    function checkUser($username, $password)
    {
        $db = Database::getInstance();

        $userData = $db->singleFetch("SELECT * FROM users WHERE username = '$username'");

        if ($userData) {
            $retrieved_pwd = $userData->password;
            if (password_verify($password, $retrieved_pwd)) {
                $this->initWith(
                    $userData->uid,
                    $userData->username,
                    $userData->phoneNumber,
                    $userData->email,
                    $userData->password,
                    $userData->regDate,
                    $userData->role
                );
                return true;
            }
        }
        return false;
    }

    function login($username, $password)
    {
        try {
            if ($this->checkUser($username, $password)) {
                $_SESSION['uid'] = $this->getUid();
                $_SESSION['username'] = $this->getUsername();
                $_SESSION['phoneNumber'] = $this->getPhoneNumber();
                $_SESSION['role'] = $this->getRole();

                return true;
            } else {
                $error = 'Wrong username or password';
            }
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }
        return false;
    }
    function getAllUsers()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('select * from users');
        return $data;
    }


    function logout()
    {
        unset($_SESSION['uid'],
            $_SESSION['username'],
            $_SESSION['phoneNumber'],
            $_SESSION['role']);
        session_destroy();
    }
}
?>