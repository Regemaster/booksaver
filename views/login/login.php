<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <p style="color: red; font-weight: bold;"><?php if(isset($comment)){echo $comment;} ?></p>
        </div>
        <div class="col-sm-7">
            <div class="formTitle">Login: </div>
            <?php include 'views/login/loginForm.php'; ?>
        </div>
    </div>
</div>

