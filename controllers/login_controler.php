<?php

require_once 'models/RegisterUser.php';
require_once 'models/PassReminder.php';
require_once 'models/LoginUser.php';
require_once "models/recaptchalib.php";
require_once "redirect.php";

class LoginController
{

    public function login()
    {
        if (isset($_POST["login_btn"]))
        {
            $LoginDataCorrect = false;
            $LoginUser = new LoginUser(filter_input(INPUT_POST, 'email'), filter_input(INPUT_POST, 'password'));
            if ($LoginUser->mayPass())
            {
                $LoginDataCorrect = true;
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $LoginUser->getId();
                $_SESSION['Name'] = $LoginUser->getName();
                //Redirect browser
#                header("Location: index.php");
#                exit;
#                require_once 'redirect.html';
                redirect("/");
                exit;
            }
        }
        require_once 'views/login/login.php';
    }

    public function register()
    {
        if (isset($_POST['register_btn']))
        {
            $avilableEmail = false;
            $avilableName = false;
            $RegisterUser = new RegisterUser(filter_input(INPUT_POST, 'name'), filter_input(INPUT_POST, 'email'), filter_input(INPUT_POST, 'password'));
            if ($RegisterUser->isEmailAvilable())
            {
                $avilableEmail = true;
            }
            if ($RegisterUser->isNameAvilable())
            {
                $avilableName = true;
            }
            if ($avilableEmail && $avilableName)
            {
                // your secret key
                $secret = "6Le4m0EUAAAAAPFeQRmMPVsLMtSOBgwgkqsEAFgE";
                // empty response
                $response = null;
                // check secret key
                $reCaptcha = new ReCaptcha($secret);
                // if submitted check response
                if ($_POST["g-recaptcha-response"])
                {
                    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
                }

                if ($response != null && $response->success)
                {
                    $this->addToDB($RegisterUser);
                    $registredSuccessful = true;
                    require_once 'views/home/home.php';
                    return;
                }
                else
                {
                    $reCaptchaAnswer = false;
                }
            }
        }
        require_once 'views/login/register.php';
    }

    public function logout()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'])
        {
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
            //Redirect browser
            redirect("/");
            exit;
        }
        require_once 'views/home/home.php';
    }
    
    public function reminder()
    {
        if(isset($_POST['send_reminder']))
        {
            $Reminder = new PassReminder(filter_input(INPUT_POST, 'email'));
            
            if($Reminder->isEmailInDB())
            {
                $error = $Reminder->sendRequest();
            }
            else
            {
                $incorrectEmail = true;
            }
        }
        require_once 'views/login/reminder.php';
    }
    
    public function changePassword()
    {
        if(isset($_POST['change']))
        {
            if(strcmp(filter_input(INPUT_POST, 'password'), filter_input(INPUT_POST, 'repassword')) == 0)
            {
                $Reminder = new PassReminder(filter_input(INPUT_POST, 'email'));
                $Reminder->updateUserPassword(filter_input(INPUT_POST, 'password'));
                $comment = 'You may now Login';
                require_once 'views/login/login.php';
            }
            else
            {
                $error=true;
                require_once 'views/login/changePassword.php';
            }
            exit;
        }
        
        if(isset($_GET['r']))
        {
            $Reminder = new PassReminder(filter_input(INPUT_GET, 'e'));
            if($Reminder->isRequestValid(filter_input(INPUT_GET, 'r')))
            {
                $email = filter_input(INPUT_GET, 'e');
                require_once 'views/login/changePassword.php';
            }
            exit;
        }
        require_once 'views/home/error.php';
    }

    private function addToDB($_RegisterUser)
    {
        try
        {
            $_RegisterUser->addUserToDB();
            $result = "Registred Succesfully";
        }
        catch (PDOException $e)
        {
            $result = $e->getMessage();
        }
    }

}

?>
