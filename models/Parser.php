<?php

require_once 'connection.php';

class Parser
{

    private $DB;

    public function __construct()
    {
        $this->DB = Db::getInstance();
    }

    public function getFolders($_rows)
    {
        $list[] = '<table class="LinksTab">';
        $id = 0;
        foreach ($_rows as $row)
        {
            $list[] = '<tr><td class="icon"><img src="resources/folder-16.png" alt=""/></td>' .
                    '<td><a href="/?controller=home&action=home&subfolder=' . $row['ID'] . '"> ' . $row['Name'] . '</a></td>' .
                    '<td class="control"><a id="editItem' . $id . '" class="open-editFolderModal edit glyphicon glyphicon-edit" data-id="' . $row['ID'] . '" data-toggle="modal" data-target="#editFolderModal"></a></td>' .
                    '<td class="control"><span id="removeItem' . $id . '" class="remove glyphicon glyphicon-remove" onclick="removeFolder(\'' . $row['ID'] . '\')"></span></td>' .
                    '</tr>';
            $id++;
        }
        $list[] = '</table>';
        return $list;
    }

    public function getFoldersForForm($_rows)
    {
        $list[] = '<option value="0">Main</option>';
        foreach ($_rows as $row)
        {
            $list[] = '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
        }
        return $list;
    }

    public function getLink($_rows)
    {
        $list[] = '<table class="LinksTab">';
        $id = 0;
        foreach ($_rows as $row)
        {
            $popoverName = $row['Name'];
            if (strlen($row['Name']) > 15)
            {
                $row['Name'] = mb_substr($row['Name'], 0, 20) . '...';
            }
            $list[] = '<tr>' .
                    '<td class="icon">' . $this->getIcon($row['URL']) . '</td>' .
                    '<td><a target="_blank" href="' . $row['URL'] . '" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="' . $popoverName . '">' . $row['Name'] . '</a></td>' .
                    '<td class="control"><a id="editItem' . $id . '" class="edit open-editModal glyphicon glyphicon-edit" data-id="' . $row['ID'] . '" data-toggle="modal" data-target="#editModal"></a></td>' .
                    '<td class="control"><span id="removeItem' . $id . '" class="remove glyphicon glyphicon-remove" onclick="removeBookmark(\'' . $row['ID'] . '\')"></span></td>' .
                    '</tr>' .
                    "\n";
            $id++;
        }
        $list[] = '</table>';
        return $list;
    }

    public function getIcon($url)
    {
        $favicon = 'https://www.google.com/s2/favicons?domain=' . $url;
        $retVal = '<img src="' . $favicon . '" alt=""/>';
        return $retVal;
    }

}

?>