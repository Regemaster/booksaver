<?php

require_once 'connection.php';

class Bookmark
{

    private $Name;
    private $url;
    private $Owner;
    private $Parent;
    private $DB;

    public function __construct($_name, $_url, $_owner, $_parent)
    {
        $this->DB = Db::getInstance();
        $this->Name = $_name;
        $this->url = $_url;
        $this->Owner = $_owner;
        $this->Parent = $_parent;
    }

    public function add()
    {
        $result = $this->DB->query("INSERT INTO Link (`Name`, `URL`, `Owner`, `Parent`) VALUES ('$this->Name', '$this->url', '$this->Owner', '$this->Parent');");
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

