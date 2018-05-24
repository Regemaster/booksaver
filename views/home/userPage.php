<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="placementInfo">
                <a href="<?php echo $viewArray[3] ?>" class="backward_btn glyphicon glyphicon-circle-arrow-left"></a>
                you'r in:
                <div class='folderName'>
                    Main<?php
                    if (isset($tree))
                    {
                        echo $tree;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="height: 100%;">
    <div class="row" style="height: 100%;">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-3" style="height: 100%;">
            <div class="dataContainer">
                <h4>Folders:</h4>
                <?php
                foreach ($viewArray[0] as $element)
                {
                    echo $element;
                }
                ?>
            </div>
        </div>
        <div class="col-lg-4" style="height: 100%;">
            <div class="dataContainer">
                <h4>Links:</h4>
                <?php
                foreach ($viewArray[1] as $element)
                {
                    echo $element;
                }
                ?>
            </div>
        </div>
        <div class="col-sm-3" style="height: 100%;">
            <div class="dataContainer">
                <h4>Add Bookmark</h4>
                <form method="POST" action="?controller=home&action=addBookmark" class="navbar-form">
                    <div class="booksaverForm">
                        <input class="form-control" placeholder="Name" type="name" name="name" id="name" required="true">
                    </div>
                    <div class="booksaverForm">
                        <input class="form-control" placeholder="URL" type="url" name="url" id="url" required="true">
                    </div>
                    <div class="booksaverForm">
                        <label for="parent">Select folder:</label>
                        <select class="form-control" name="parent" id="parent">
                            <?php
                            foreach ($viewArray[2] as $element)
                            {
                                echo $element;
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="add_btn" id="add_btn" class="btn btn-default">add</button>
                </form>
                <div class="divLine"></div>
                <h4>Add Folder</h4>
                <form method="POST" action="?controller=home&action=addFolder" class="navbar-form">
                    <div class="booksaverForm">
                        <input class="form-control" placeholder="Name" type="name" name="name" id="FolderName" required="true">
                    </div>
                    <div class="booksaverForm">
                        <label for="parent">Select parent:</label>
                        <select class="form-control" name="parent" id="folderParent">
                            <?php
                            foreach ($viewArray[2] as $element)
                            {
                                echo $element;
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="add_btn" id="addFolder_btn" class="btn btn-default">add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="?controller=home&action=editBookmark" class="navbar-form">
                    <div class="booksaverForm">
                        <input class="form-control" value="" placeholder="Name" type="name" name="editName" id="editName" required="true">
                    </div>
                    <div class="booksaverForm">
                        <input class="form-control" value="" placeholder="URL" type="url" name="editUrl" id="editUrl" required="true">
                    </div>
                    <div class="booksaverForm selectFolder">
                        <label class="selectFolderTitle" for="parent">Select folder:</label>
                        <select class="form-control" value="" name="editParent" id="editParent">
                            <?php
                            foreach ($viewArray[2] as $element)
                            {
                                echo $element;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="editId" id="editId" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFolderModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFolderModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="?controller=home&action=editFolder" class="navbar-form">
                    <div class="booksaverForm">
                        <input class="form-control" value="" placeholder="Name" type="name" name="editName" id="editFolderName" required="true">
                    </div>
                    <div class="booksaverForm selectFolder">
                        <label class="selectFolderTitle" for="parent">Select folder:</label>
                        <select class="form-control" value="" name="editParent" id="editFolderParent">
                            <?php
                            foreach ($viewArray[2] as $element)
                            {
                                echo $element;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="editId" id="editFolderId" value="123455778">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="scripts/script.js" type="text/javascript"></script>