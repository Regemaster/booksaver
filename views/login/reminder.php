<div class="container" style="margin-top: 1em;">
    <div class="row">
        <div class="col-sm-4">
            <p style="color: red; font-weight: bold;"><?php
                if(isset($error))
                {
                    switch ($error) 
                    {
                        case "send":
                            echo "Message have been send to your E-mail.";
                            break;
                        case "sendError":
                            echo "An error occured while sending E-mail";
                            break;
                        case "dbError":
                            echo "E-mail not found";
                            break;
                        default:
                            echo "An error occured";
                    }
                }
            ?></p>
        </div>
        <div class="col-sm-5">
            <div class="formTitle">Enter your e-mail to change password: </div>
            <form method="POST" action="?controller=login&action=reminder" class="navbar-form">
                <div class="booksaverForm">
                    <input class="form-control" placeholder="Email" type="email" name="email" id="email" required="true"
                        <?php 
                            if(isset($incorrectEmail) && $incorrectEmail)  
                            {
                                echo 'style="border: 2px solid red; background-color: #ff9999;"';
                            }
                        ?>
                    >
                    <?php if(isset($incorrectEmail) && $incorrectEmail==true) 
                        echo  ' The e-mail was incorrect';
                    ?>
                </div>
                <button type="submit" name="send_reminder" id="send_reminder" class="btn btn-default">Send request</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
