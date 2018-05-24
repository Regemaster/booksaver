<?php

require_once 'connection.php';

class Folder
{

    private $Name;
    private $Owner;
    private $Parent;
    private $DB;

    public function __construct($_name, $_owner, $_parent)
    {
        $this->DB = Db::getInstance();
        $this->Name = $_name;
        $this->Owner = $_owner;
        $this->Parent = $_parent;
    }

    public function add()
    {
        $result = $this->DB->query("INSERT INTO Folder (`Name`, `Owner`, `Parent`) VALUES ('$this->Name', '$this->Owner', '$this->Parent');");
        return $result;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getUrl()
    {
        return $this->url;
    }

}
?>

