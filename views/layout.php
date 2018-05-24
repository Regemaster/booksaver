<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BookSaver</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/en/thumb/8/89/Wizards_of_the_Coast_Rarity_Symbol_-_Very_Rare.svg/1024px-Wizards_of_the_Coast_Rarity_Symbol_-_Very_Rare.svg.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body style="background-color:#505051;">
        <nav class="navbar navbar-inverse navbar-dark navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">

                        <div class="pageName">Book Saver</div>
                        <span class="icon-bar"></span>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'])
                        {
                            ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="glyphicon glyphicon-menu-hamburger">
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/?controller=home&action=about">About</a></li>
                                    <li><a href="/?controller=home&action=fastaddingInfo">Fast Bookmark adding</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a href="/?controller=home&action=about">About</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'])
                        {
                            ?>
                            
                            <ul class="nav navbar-nav">
                            <?php
                            if (isset($_SESSION['login']) && $_SESSION['login'])
                            {
                                ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Sort <span class="glyphicon glyphicon-triangle-bottom">
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href = "/?controller=home&action=sort&by=DATE&type=ASC"><span class = "glyphicon glyphicon-sort-by-order"> Date - inc</span></a></li>
                                        <li><a href = "/?controller=home&action=sort&by=DATE&type=DESC"><span class = "glyphicon glyphicon-sort-by-order-alt"> Date - dec</span></a></li>
                                        <li><a href = "/?controller=home&action=sort&by=ALPHABET&type=ASC"><span class = "glyphicon glyphicon-sort-by-alphabet"> Alphabeticaly - inc</span></a></li>
                                        <li><a href = "/?controller=home&action=sort&by=ALPHABET&type=DESC"><span class = "glyphicon glyphicon-sort-by-alphabet-alt"> Alphabeticaly - dec</span></a></li>
                                    </ul>
                                </li>
                                <?php
                            }
                            else
                            {
                                ?>
                                <li><a href="/?controller=home&action=about">About</a></li>
                                <?php
                            }
                            ?>
                            </ul>

                            <li><a href = "/?controller=home&action=userPage"> Hello <?php echo $_SESSION['Name']; ?></a></li>
                            <li><a href = "/?controller=login&action=logout"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a href = "/?controller=login&action=register"><span class = "glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <ul class = "nav navbar-nav">
                                <li class = "dropdown">
                                    <a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">
                                        <span class = "glyphicon glyphicon-log-in"></span> Login
                                    </a>
                                    <ul class = "dropdown-menu">
                                        <li>
                                            <?php require_once 'views/login/loginForm.php';
                                            ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br/><br/><br/>

        <?php
//        require_once 'models/EmailSender.php';
//        $Mailer = new EmailSender;
//        if($Mailer->sendEmail('lukaszoswald@interia.pl', 'test', 'helloWorld'))
//        {
//            echo 'ok';
//        }
//        else
//        {
//            echo 'false';
//        }
        require_once 'routes.php';
        ?>

    </body>
    <footer>
        @Copyright &#321;ukasz Oswald
    </footer>
</html>﻿
