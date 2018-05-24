<body id="welcomeSite">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if(isset($registredSuccessful)){echo '<p class="registerSeccessfulInfo">Registration successful. You may now login.</p>';} ?>
            </div>
            <div class="col-sm-3">
                <div id="welcome">
                    <ul>
                        <li><img src="resources/grey-checkmark-md.png" alt=""/> Anytime</li>
                        <li><img src="resources/grey-checkmark-md.png" alt=""/> Anywhere</li>
                        <li><img src="resources/grey-checkmark-md.png" alt=""/> Always Online</li>
                    </ul>
                </div>
                <a href="/?controller=login&action=register"><div id="joinBtn">Join us</div></a>
            </div>
            <div class="col-sm-5">
                <div id="welcomeText">Store your favorite bookmarks online</div>
            </div>
        </div>
    </div>
</body>