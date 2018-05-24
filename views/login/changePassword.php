<div class="container" style="margin-top: 1em;">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5">
            <form method="POST" action="?controller=login&action=changePassword" class="navbar-form">
                <div class="booksaverForm">
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password" required="true">
                </div>
                <div class="booksaverForm">
                    <input class="form-control" placeholder="Re-enter password" type="password" name="repassword" id="repassword" required="true">
                </div>
                <input class="form-control" type="hidden" name="email" id="email" value="<?php if(isset($email)){echo $email;} ?>" required="true">
                <button type="submit" name="change" id="change" class="btn btn-default">Change Password</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
