<?php

require_once 'connection.php';

class RegisterUser
{

    private $Name;
    private $Email;
    private $Id;
    private $Password;
    private $DB;

    public function __construct($_name, $_email, $_passwd)
    {
        $this->Name = $_name;
        $this->Email = $_email;
        $this->Password = hash('sha256', $_passwd);
        $this->DB = Db::getInstance();
    }

    public function isNameAvilable()
    {
        $result = $this->DB->query("SELECT COUNT(*) AS Num FROM User WHERE Name='$this->Name';");
        if ($result->fetchAll()[0]['Num'] > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function isEmailAvilable()
    {
        $result = $this->DB->query("SELECT COUNT(*) AS Num FROM User WHERE Email='$this->Email';");
        if ($result->fetchAll()[0]['Num'] > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function addUserToDB()
    {
        $result = $this->DB->query("INSERT INTO User(`Name`, `Email`, `Password`) VALUES ('$this->Name', '$this->Email', '$this->Password');");
        return $result;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getId()
    {
        return $this->Id;
    }

}
?>

