<form method="POST" action="?controller=login&action=login" class="navbar-form">
    <div class="booksaverForm">
        <input class="form-control" placeholder="E-mail" type="email" name="email" id="email" required="true">
        <?php if(isset($LoginDataCorrect) && !$LoginDataCorrect) 
            echo  ' The e-mail or password was incorrect';?>
    </div>
    <div class="booksaverForm">
        <input class="form-control" placeholder="Password" type="password" name="password" id="password" required="true">
    </div>
    <button type="submit" name="login_btn" id="login_btn" class="btn btn-default">Login</button>
    <div class="reminderPass">
        <a href="?controller=login&action=reminder">
            forgot password?
        </a>
    </div>
</form>


