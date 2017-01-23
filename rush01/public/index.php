<!DOCTYPE html>
<html>
<head>
    <title>warhammer 40K</title>
    <meta charset="utf-8" />
    <style>body{margin:0;}</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.min.css" type="text/css" />
    <link rel="stylesheet" href="./css/style.css" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.6/p5.min.js"></script>
</head>
<body>
    <!-- menu -->
    <div class="menu_cont">
        <div class="menu_left">
            
        </div>
        <div class="menu_center">
            <img class="logo" src="img/logo.png">
        </div>
        <div class="menu_right">
            <div class="user_connect">
            </div>
        </div>
    </div>
    <div class="central_block">
        <div class="left_sb background shadow">
            <div class="turns opacity">
                <p class="bubon">IT'S</p><br>
                <p class="bubon"> PLAYER'S 'insert player NBR Here'</p><br>
                <p class="bubon">TURN</p>
            </div>
            <div class="infos">
                <form>
                	HP: <input type="text" class="info_field" name="HP"><br>
                	PP: <input type="text" class="info_field" name="PP"><br>
                    Shield: <input type="text" class="info_field" name="Shield"><br>
                    Speed: <input type="text" class="info_field" name="Speed"><br>
                </form>
            </div>
            <div class="filler">
                <form>
                    <input type="image" class="acti_ship" src="/public/img/bt_activate.png" action="/" method="post"/>
                </form>
            </div>
            <div class="actions">
                <form>
                    <!--ici il faudrait en fonction du nombre d'armes generer le bon nombre de se formulaire-->
                    Weapon 1<br>
                    <input type="range" name="nbr_pp_weapon_1" min="0" max="12" step="1" value="0"/>
                    <input type="image" class="butt" src="/public/img/bt_addpp.png" alt="Submit Form" />
                </form>
                <form value="SSR">
                    Shield<input type="range" name="nbr_pp_shield" min="0" max="12" step="1" value="0"/><br>
                    Speed<input type="range" name="nbr_pp_speed" min="0" max="12" step="1" value="0"/><br>
                    Repair<input type="range" name="nbr_pp_repair" min="0" max="12" step="1" value="0"/><br>
                    <input type="image" class="butt" src="/public/img/bt_addpp.png" alt="Submit Form" />
                </form>
            </div>
        </div>
        <div id="cv_cont">
        <!-- canvas -->
        </div>
        <div class="right_sb background shadow">
            <div class="chat">
                
                    <ul class="chat-list">
                    </ul>
                
            </div>
            <!-- ici on envoie le message via le form dans la variable POST -->
            <form id="chat" class="send" action="../api/chat/speak.php" method="POST"> 
		        <input id="msg" autocomplete="off" type="text" name="msg" size="82"/>
		        <input class="send_butt" type="submit" name="send" value="Scream in the VOID"/>
		        <br />
	        </form>
        </div>
    </div>
    <!-- libs -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- canvas -->
    <script type="text/javascript" src="/public/js/sketch.js"></script>
    <script type="text/javascript" src="/public/js/class/Ship.class.js"></script>
    <!-- phases -->
    <script type="text/javascript" src="/public/js/class/Lobby.class.js"></script>
    <!-- process -->
    <script type="text/javascript" src="/public/js/class/User.class.js"></script>
    <script type="text/javascript" src="/public/js/custom.js"></script>
</body>
</html>