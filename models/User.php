<?php

require_once 'connection.php';
require_once 'models/Parser.php';

class User
{

    private $Name;
    private $Email;
    private $Id;
    private $SortPreferedMethod;
    private $DB;
    private $parser;

    public function __construct($_id)
    {
        $this->Id = $_id;
        $this->DB = Db::getInstance();
        $this->parser = new Parser();
        $result = $this->DB->query("SELECT Name, Email, sort FROM User WHERE ID='$this->Id'");
        $rows = $result->fetchAll();
        if (isset($rows[0]))
        {
            $this->Name = $rows[0]['Name'];
            $this->Email = $rows[0]['Email'];

            switch($rows[0]['sort'])
            {
                default:
                case "0":
                    $this->SortPreferedMethod = 'ID ASC';
                break;
                case "1":
                    $this->SortPreferedMethod = 'ID DESC';
                break;
                case "2":
                    $this->SortPreferedMethod = 'Name ASC';
                break;
                case "3":
                    $this->SortPreferedMethod = 'Name DESC';
                break;
            }
        }
        else
        {
            $this->Name = null;
            $this->Email = null;
        }
    }

    public function editLink($_name, $_url, $_parent, $_id)
    {
        $result = $this->DB->query("UPDATE Link SET Name='$_name', URL='$_url', Parent=$_parent WHERE ID=$_id;");
        return $result;
    }

    public function editFolder($_name, $_parent, $_id)
    {
        $result = $this->DB->query("UPDATE Folder SET Name='$_name', Parent=$_parent WHERE ID=$_id;");
        return $result;
    }

    public function getItem($_table, $_record, $_id)
    {
        $result = $this->DB->query("SELECT $_record FROM $_table WHERE ID=$_id");
        return $result;
    }

    public function removeItem($_table, $_id)
    {
        $result = $this->DB->query("DELETE FROM $_table WHERE ID=$_id");
        return $result;
    }

    public function removeItems($_table, $_record, $_value)
    {
        $result = $this->DB->query("DELETE FROM $_table WHERE $_record=$_value");
        return $result;
    }

    public function getFoldersForParrent($_parentId)
    {
        $result = $this->DB->query("SELECT * FROM Folder WHERE Owner='$this->Id' AND Parent='$_parentId' ORDER BY $this->SortPreferedMethod");
        $rows = $result->fetchAll();
        $listToPrint = $this->parser->getFolders($rows);
        return $listToPrint;
    }

    public function getLinksForParent($_parentId)
    {
        $result = $this->DB->query("SELECT * FROM Link WHERE Owner='$this->Id' AND Parent='$_parentId' ORDER BY $this->SortPreferedMethod");
        $rows = $result->fetchAll();
        $listToPrint = $this->parser->getLink($rows);
        return $listToPrint;
    }

    public function getFoldersForForm()
    {
        $result = $this->DB->query("SELECT * FROM Folder WHERE Owner='$this->Id'");
        $rows = $result->fetchAll();
        $listToPrint = $this->parser->getFoldersForForm($rows);
        return $listToPrint;
    }

    public function getFolderParent($_folderId)
    {
        $result = $this->DB->query("SELECT Name, Parent FROM Folder WHERE Owner='$this->Id' AND ID='$_folderId'");
        $rows = $result->fetchAll();

        if (isset($rows[0]))
        {
            return $rows[0];
        }
        else
        {
            return NULL;
        }
    }
    
    public function selectOrderMethod($_value)
    {
        $result = $this->DB->query("UPDATE User SET sort='$_value' WHERE ID=$this->Id;");
        return $result;
    }

    public function removeFolderWithContent($_folderId)
    {
        $result = $this->DB->query("SELECT ID FROM Folder WHERE Parent = $_folderId");
        $rows = $result->fetchAll();
        for ($i = 0; $i < count($rows); $i++)
        {
            $this->removeFolderWithContent($rows[$i]['ID']);
        }
        $this->removeItems('Link', 'Parent', $_folderId);
        $this->removeItem('Folder', $_folderId);
    }

    public function getFolderParentAsLink($_folderId)
    {
        if ($_folderId == 0)
        {
            return '/?controller=home&action=home';
        }
        else
        {
            $row = $this->getFolderParent($_folderId);
            if ($row['Parent'] == 0)
            {
                return '/?controller=home&action=home';
            }
            else
            {
                return "/?controller=home&action=home&subfolder=" . $row['Parent'];
            }
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

