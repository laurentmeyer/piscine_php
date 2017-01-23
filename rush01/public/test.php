<?php
require_once('../class/User.class.php');
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/style.css" type="text/css" />
    </head>
    <body>
        <div class="menu_cont">
            <div class="menu_left">
                
            </div>
            <div class="menu_center">
                <img class="logo" src="img/logo.png">
            </div>
            <div class="menu_right">
                <?php if (isset($_SESSION['user'])): ?>
                        <p>Login : <?= $_SESSION['user']->get('_login') ?></p>
                        <p>Elo : <?= $_SESSION['user']->get('_elo') ?></p>
                        <!--<a href='/api/user/logout.php'>Se deconnecter</a>-->
                        <form class="user_connect" method="POST" action="/api/user/logout.php">
                            <input type="image" class="butt" src="/public/img/btn_deco.png" alt="submit"/>
                        </form>
                <?php else: ?>
                        <form class="user_connect" method="POST" action="/api/user/login.php">
                            <p>login : <input type="text" name="user"/></p>
                            <p>password : <input type="text" name="password"/></p>
                            <!--<input class="butt" type="submit" name="submit" value="se connecter"/>-->
                            <input type="image" class="butt" src="/public/img/btn_connection.png" alt="Submit" />
                        </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="central_block">
            <div class="left_sb background">
                <div class="infos">
                    <form>
                    	HP: <input type="text" class="info_field" name="HP"><br>
                    	PP: <input type="text" class="info_field" name="PP"><br>
	                    truc: <input type="text" class="info_field" name="truc"><br>
	                    Bidule: <input type="text" class="info_field" name="bidule"><br>
                    </form>
                </div>
                <div class="filler">
                    
                </div>
                <div class="actions">
                    <form style="">
                        <input type="text" name=""/>
                        <input type="submit" value="Submit"/>
                    </form>
                </div>
                
            </div>
            <div class="cv_cont background">
                <div class="fake_cv">
                    
                </div>
            </div>
            <div class="right_sb background">
                <iframe class="chat" src="/api/chat/chat.php"></iframe>
                <form class="send" action="../api/chat/speak.php" method="POST"> <!-- ici on envoie le message via le form dans la variable POST -->
			        <input type="text" name="msg" size="82"/>
			        <input class="send_butt" type="submit" name="send" value="Send"/>
			        <br />
		        </form>
                
            </div>
        </div>
    </body>
</html>