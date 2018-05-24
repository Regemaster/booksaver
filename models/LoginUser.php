<?php

require_once 'connection.php';

class LoginUser
{

    private $Name;
    private $Email;
    private $Id;
    private $Password;
    private $DB;

    public function __construct($_email, $_passwd)
    {
        $this->Email = $_email;
        $this->Password = hash('sha256', $_passwd);
        $this->DB = Db::getInstance();
    }
    public function mayPass()
    {
        $result = $this->DB->query("SELECT * FROM User WHERE Email='$this->Email';");
        $rows = $result->fetchAll();
        if (isset($rows[0]))
        {
            if ($rows[0]['Password'] == $this->Password)
            {
                $this->Name = $rows[0]['Name'];
                $this->Id = $rows[0]['ID'];
                return true;
            }
            return false;
        }
        else
        {
            return false;
        }
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

