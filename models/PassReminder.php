<?php

require_once 'connection.php';
require_once 'seed.php';

class PassReminder
{
    private $Email;
    private $Password;
    private $DB;

    public function __construct($_email)
    {
        $this->Email = $_email;
        $this->DB = Db::getInstance();
    }

    public function sendRequest()
    {
        $result = $this->DB->query("SELECT * FROM User WHERE Email='$this->Email';");
        $row = $result->fetchAll()[0];
        
        if (isset($row) && $row!=null)
        {
            $this->Password = hash('sha256', $seed.$row['Password']);
            require_once 'models/EmailSender.php';
            $Mailer = new EmailSender;
            if($Mailer->sendChangePasswordEmail($row['Email'], $row['Name'], $row['Email'], $this->Password))
            {
                return 'send';
            }
            else
            {
                return 'sendError';
            }
        }
        else
        {
            return 'dbError';
        }
    }
    
    public function isEmailInDB()
    {
        $result = $this->DB->query("SELECT COUNT(*) AS Num FROM User WHERE Email='$this->Email';");
        if ($result->fetchAll()[0]['Num'] > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function isRequestValid($hash)
    {
        $result = $this->DB->query("SELECT * FROM User WHERE Email='$this->Email';");
        $row = $result->fetchAll()[0];
        
        if (isset($row) && $row!=null)
        {
            $this->Password = hash('sha256', $seed.$row['Password']);
            if(strcmp($this->Password, $hash) == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function updateUserPassword($_password)
    {
        $result = $this->DB->query("UPDATE `User` SET `Password`='".hash('sha256', $_password)."' WHERE Email='$this->Email';");
        return $result;
    }
}
?>

