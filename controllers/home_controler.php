<?php

require_once 'connection.php';
require_once 'models/User.php';
require_once 'models/Bookmark.php';
require_once 'models/Folder.php';
require_once 'redirect.php';

class HomeController
{

    public function home()
    {
        if (isset($_SESSION['login']))
        {
            $viewArray = $this->userPageData();
            if (isset($_GET['subfolder']))
            {
                $tree = $this->getFoldersTree();
            }
            require_once 'views/home/userPage.php';
        }
        else
        {
            require_once 'views/home/home.php';
        }
    }

    public function about()
    {
        require_once 'views/home/about.php';
    }

    public function fastaddingInfo()
    {
        require_once 'views/home/fastaddingInfo.php';
    }

    public function addFast()
    {
        if (isset($_GET['title']) && isset($_GET['page']))
        {
            $viewArray = $this->userPageData();
            $viewData[] = filter_input(INPUT_GET, 'title');
            $viewData[] = filter_input(INPUT_GET, 'page');
        }
        else
        {
            $viewData[] = ' ';
            $viewData[] = ' ';
        }
        require_once 'views/home/add.php';
    }

    public function addByExtension()
    {      
        if (!isset($_SESSION['login']) || !$_SESSION['login'])
        {
            echo '1';
            exit;
        }
        if (isset($_GET['title']) && isset($_GET['page']))
        {
            $BM = new Bookmark(filter_input(INPUT_GET, 'title'), filter_input(INPUT_GET, 'page'), $_SESSION['uid'], '0');
            $BM->add();
            echo '0';
            exit;
        }
        echo '2';
    }

    public function addBookmark()
    {
        if (!isset($_SESSION['login']) || !$_SESSION['login'])
        {
            exit;
        }
        if (isset($_POST['add_btn']))
        {
            $BM = new Bookmark(filter_input(INPUT_POST, 'name'), filter_input(INPUT_POST, 'url'), $_SESSION['uid'], filter_input(INPUT_POST, 'parent'));
            $BM->add();

            if (isset($_POST['fastadding']))
            {
                echo '<script type="text/javascript">window.close();</script>';
                return;
            }
            //header("Location: /index.php?controller=home&action=home&subfolder=" . filter_input(INPUT_POST, 'parent'));
            redirect("/index.php?controller=home&action=home&subfolder=" . filter_input(INPUT_POST, 'parent'));
            exit;
        }
        redirect("");
        exit;
    }

    public function addFolder()
    {
        if (isset($_POST['add_btn']))
        {
            $Folder = new Folder(filter_input(INPUT_POST, 'name'), $_SESSION['uid'], filter_input(INPUT_POST, 'parent'));
            $Folder->add();

            redirect("/index.php?controller=home&action=home&subfolder=" . filter_input(INPUT_POST, 'parent'));
            exit;
        }
        redirect("");
        exit;
    }

    public function removeBookmark()
    {
        if (!isset($_GET['removeId']) || !isset($_SESSION['uid']))
        {
            exit;
        }
        $User = new User($_SESSION['uid']);
        $result = $User->removeItem('Link', filter_input(INPUT_GET, 'removeId'));
        redirect("");
        exit;
    }

    public function removeFolder()
    {
        if (!isset($_GET['removeId']) || !isset($_SESSION['uid']))
        {
            exit;
        }
        $User = new User($_SESSION['uid']);

        $result = $User->removeFolderWithContent($_GET['removeId']);
    }

    public function editBookmark()
    {
        if (isset($_POST['edit_btn']))
        {
            if (!isset($_SESSION['uid']))
            {
                redirect("/index.php");
                exit;
            }

            $User = new User($_SESSION['uid']);
            $name = filter_input(INPUT_POST, 'editName');
            $url = filter_input(INPUT_POST, 'editUrl');
            $parent = filter_input(INPUT_POST, 'editParent');
            $id = filter_input(INPUT_POST, 'editId');
            $result = $User->editLink($name, $url, $parent, $id);

            $result = $User->getItem('Link', 'Parent', $id);
            $rows = $result->fetchAll();
            redirect("/index.php?controller=home&action=home&subfolder=" . $rows[0]['Parent']);
            exit;
        }

        redirect("");
        exit;
    }

    public function getEditBookmarkData()
    {
        if (!isset($_SESSION['uid']))
        {
            exit;
        }

        $User = new User($_SESSION['uid']);
        $result = $User->getItem('Link', '*', $_GET['editId']);
        $rows = $result->fetchAll();

        echo $rows[0]['Parent'] . '#' . $rows[0]['Name'] . '#' . $rows[0]['URL'] . '#' . $rows[0]['ID'];
    }

    public function editFolder()
    {
        if (isset($_POST['edit_btn']))
        {
            if (!isset($_SESSION['uid']))
            {
                redirect("");
                exit;
            }

            $User = new User($_SESSION['uid']);
            $name = filter_input(INPUT_POST, 'editName');
            $parent = filter_input(INPUT_POST, 'editParent');
            $id = filter_input(INPUT_POST, 'editId');
            $result = $User->editFolder($name, $parent, $id);

            $result = $User->getItem('Folder', 'Parent', $id);
            $rows = $result->fetchAll();
            redirect("/index.php?controller=home&action=home&subfolder=" . $rows[0]['Parent']);
            exit;
        }
        redirect("");
        exit;
    }

    public function getEditFolderData()
    {
        if (!isset($_SESSION['uid']))
        {
            exit;
        }

        $User = new User($_SESSION['uid']);
        $result = $User->getItem('Folder', '*', $_GET['editId']);
        $rows = $result->fetchAll();

        echo $rows[0]['Parent'] . '#' . $rows[0]['Name'] . '#' . $rows[0]['ID'];
    }

    public function error()
    {
        require_once 'views/home/error.php';
    }

    public function userPage()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'])
        {
            $viewArray = $this->userPageData();
            if (isset($_GET['subfolder']))
            {
                $tree = $this->getFoldersTree();
            }
            require_once 'views/home/userPage.php';
        }
        else
        {
            require_once 'views/home/home.php';
        }
    }
    
    public function sort()
    {
        if((isset($_GET['by']) && isset($_GET['type'])) && (isset($_SESSION['login']) && $_SESSION['login']))
        {
            $User = new User($_SESSION['uid']);
            $value = 0;
            if(strcmp(filter_input(INPUT_GET, 'by'), 'DATE') == 0)
            {
                if(strcmp(filter_input(INPUT_GET, 'type'), 'DESC') == 0)
                {
                    $value = 1;
                }
            }
            else if(strcmp(filter_input(INPUT_GET, 'by'), 'ALPHABET') == 0)
            {
                if(strcmp(filter_input(INPUT_GET, 'type'), 'DESC') == 0)
                {
                    $value = 3;
                }
                else
                {
                    $value = 2;
                }
            }
            $User->selectOrderMethod($value);
        }
        redirect("");
    }

    private function getFoldersTree()
    {
        $currentFolder = filter_input(INPUT_GET, 'subfolder');
        $User = new User($_SESSION['uid']);

        $row = $User->getFolderParent($currentFolder);
        $Tree[] = $row['Name'];

        while ($row['Parent'] != 0)
        {
            $row = $User->getFolderParent($row['Parent']);
            $Tree[] = $row['Name'];
        }

        $hierarchy = '';
        for ($i = count($Tree) - 1; $i >= 0; $i--)
        {
            $hierarchy = $hierarchy . '/' . $Tree[$i];
        }
        return $hierarchy;
    }

    private function userPageData()
    {
        if (!isset($_SESSION['uid']))
        {
            exit;
        }

        $User = new User($_SESSION['uid']);

        if (isset($_GET['subfolder']))
        {
            $parent = filter_input(INPUT_GET, 'subfolder');
        }
        else
        {
            $parent = 0;
        }

        return $this->getViewData($User, $parent);
    }

    private function getViewData($User, $parent)
    {
        $retArray[] = $User->getFoldersForParrent($parent);
        $retArray[] = $User->getLinksForParent($parent);
        $retArray[] = $User->getFoldersForForm($parent);
        $retArray[] = $User->getFolderParentAsLink($parent);
        return $retArray;
    }

}

?>
