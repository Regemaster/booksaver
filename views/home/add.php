<div class='container'>
    <div class='row'>
        <div class="col-sm-3">
            <div class="dataContainer">
                <h4>Add Bookmark</h4>
                <form method="POST" action="?controller=home&action=addBookmark" class="navbar-form">
                    <div class="booksaverForm">
                        <input class="form-control" value="<?php echo $viewData[0] ?>" placeholder="Name" type="name" name="name" id="name" required="true">
                    </div>
                    <div class="booksaverForm">
                        <input class="form-control" value="<?php echo $viewData[1] ?>" placeholder="URL" type="url" name="url" id="url" required="true">
                    </div>
                    <div class="booksaverForm">
                        <label for="parent">Select folder:</label>
                        <select class="form-control" name="parent" id="parent">
                            <?php
                            if (isset($viewArray))
                            {
                                foreach ($viewArray[2] as $element)
                                {
                                    echo $element;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" value="fastadding" name="fastadding">
                    <button type="submit" name="add_btn" id="add_btn" class="btn btn-default">add</button>
                </form>
            </div>
        </div>
    </div>
</div>