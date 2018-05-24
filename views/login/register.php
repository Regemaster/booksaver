<div class="container">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-7">
            <div class="formTitle">Register:</div>
            <form method="POST" action="?controller=login&action=register" class="navbar-form">
                <div class="booksaverForm">
                    <input class="form-control" placeholder="Name" type="name" name="name" id="name" required="true" 
                           <?php 
                                if(isset($avilableName))  
                                {
                                    if($avilableName) echo "value=\"".$RegisterUser->getName()."\"";
                                    else echo 'style="border: 2px solid red; background-color: #ff9999;"' . "value=\"".$RegisterUser->getName()."\"";
                                }
                            ?>
                    ><?php if(isset($avilableName) && !$avilableName) echo ' Given name is unavilable';?>
                </div>
                <div class="booksaverForm">
                    <input class="form-control" placeholder="E-mail" type="email" name="email" id="email" required="true"
                           <?php 
                                if(isset($avilableEmail))  
                                {
                                    if($avilableEmail) echo "value=\"".$RegisterUser->getEmail()."\"";
                                    else echo 'style="border: 2px solid red; background-color: #ff9999;"' . "value=\"".$RegisterUser->getEmail()."\"";
                                }
                            ?>
                    ><?php if(isset($avilableEmail) && !$avilableEmail) echo ' Given e-mail is unavilable';?>
                </div>
                <div class="booksaverForm">
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password" required="true">
                </div>
                <div class="booksaverForm">
                    <div class="g-recaptcha" data-sitekey="6Le4m0EUAAAAAKKY4HMzAARO-HCtnvg1pFA_A27a"></div>
                    <?php if(isset($reCaptchaAnswer) && !$reCaptchaAnswer) echo ' reCaptcha failed';?>
                </div>
                <button type="submit" name="register_btn" id="register_btn" class="btn btn-default">Register</button>
            </form>
        </div>
    </div>
</div>

