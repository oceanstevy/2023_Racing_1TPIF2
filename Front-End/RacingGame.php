<?php
session_start();

include_once "../Back-End/Functions/Credentials.php";
include_once "../Back-End/Functions/Functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kult Racing</title>
    <link rel="stylesheet" href="../Style/css.css">
    <script src="Include_Functions/jquery.html"></script>
    <script src="Include_Functions/functions.js"></script>
</head>
<script>

    //Timer Definieren
    let timergame = "";
    let timerItemGenerator = "";

    let arrowW = "";
    let arrowA = "";
    let arrowS = "";
    let arrowD = "";

    //Auto einstellungen
    let xAchse = 0;
    let speed = 0;
    let deg = 0;

    <?php
        $connect = db_Connect();

        $query = "SELECT idCar, dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl
                  FROM tblCar
                  WHERE idCar = 1";

        $result = mysqli_query($connect, $query);

        if (mysqli_errno($connect)) {
            echo 'Error ' . mysqli_errno($connect) . 'Error : ' . mysqli_error($connect);
        }

        if (mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            echo "let maxspeed = " . $row['dtMaxSpeed'] . ";\n";
            echo "let maxbackspeed = " . $row['dtMaxBackSpeed'] . ";\n";
            echo "let speedcontrol = " . $row['dtSpeedControl'] . ";\n";
            echo "let maxxAchse = " . $row['dtMaxAchse'] . ";\n";
            echo "let xAchseControl = " . $row['dtXAchsControl'] . ";\n";
            echo "let carwidth = " . $row['dtWidth'] . ";\n";
            echo "let carheight = " . $row['dtHeight'] . ";";
        } else {
            // Default Fahrzeug, wenn das Fahrzeug von der DatenBank fehlt
            echo "let maxspeed = 150";
            echo "let maxbackspeed = -25";
            echo "let speedcontrol = 3";
            echo "let maxxAchse = 50";
            echo "let xAchseControl = 3";
            echo "let carwidth = 50";
            echo "let carheight = 100";
        }

    ?>

    //Coin
    let CoinWidth = 25;
    let CoinHeight = 25;

    let GameStatusRunning = true;

    //Fahrzeug wir generiert und Spiel wird gestartet
    function GameStart(){
        $( "#MyCar" )[0].style.transform = "rotate(0deg)";
        $( "#MyCar" )[0].style.top = "200px";
        $( "#MyCar" )[0].style.left = "300px";

        $( "#MyCar" )[0].style.width = carwidth+"px";
        $( "#MyCar" )[0].style.height = carheight+"px";

        clearInterval(timergame);
        timergame = setInterval("step()",50);

        clearInterval(timerItemGenerator);
        timerItemGenerator = setInterval("generateCoin()",500);

    }

    //Check ob der Status geändert wurde, wenn ja. startet/stoppt er das Spiel
    function CheckGameStatus() {
        if (GameStatusRunning){
           if (timerItemGenerator === null){
               clearInterval(timerItemGenerator);
               timerItemGenerator = setInterval("generateCoin()",500);
           }
        } else {
            clearInterval(timerItemGenerator);
            timerItemGenerator = null;
        }
    }

    // Game status wird geändert und das PauseMenü kommt
    function ChangeGameStatus(){
        if (GameStatusRunning){
            GameStatusRunning = false;
            $("#PauseMenuTransperent")[0].style.display = "block";
        } else {
            GameStatusRunning = true;
            $("#PauseMenuTransperent")[0].style.display = "none";
        }
    }

    // Generiert auf der Map eine Münze
    function generateCoin() {
        // Aktuelle Chance: 10% pro Sekunde = timer(500ms) * (1 - 0.95)
        if (getRandom(0,1) > 0.95){
            let top = Math.floor(getRandom(100,window.innerHeight-100));
            let left = Math.floor(getRandom(100,window.innerWidth-100));
            $('#img').append("<img src='../Images/Coin.png' alt='coin' class='coins' style='position: absolute; top:" + top + "px; left:" + left + "px; width: "+ CoinWidth +"px  ; height: "+ CoinHeight +"px'>");
        }

    }

    // Checkt op ein Coin getroffen wurde | Funktioniert noch nicht zu 100%
    function CeckHitCoin() {
        if ($( ".coins" ).length > 0){
            let savecar =  $( "#MyCar" )[0];
            for (let i=0;i<$( ".coins" ).length;i++){
                let coin =  $( ".coins" )[i];

                //Checkt ob treffer
                if (parseInt(savecar.style.left) < parseInt(coin.style.left)
                    && parseInt(coin.style.left) < (parseInt(savecar.style.left) + carwidth)
                    && parseInt(savecar.style.top) < parseInt(coin.style.top)
                    && parseInt(coin.style.top) < (parseInt(savecar.style.top) + carheight)) {

                    //Coin wird gelöscht
                    $( ".coins" )[i].remove()
                }
            }

        }
    }



    function step(){
        // Ckeckt op Game status
        CheckGameStatus();
        //Wenn Gamestatus false (not running) dan macht er kein zug
        if (!GameStatusRunning){
            return
        }

        //Wenn er "W" gedrückt hat wird er schneller
        if (arrowW === "w"){
            if (speed < 0){
                speed=speed+speedcontrol;
            } else if (speed < 80) {
                speed=speed+speedcontrol/100*66
            } else {
                speed=speed+speedcontrol/100*33
            }
            if (maxspeed < speed){
                speed = maxspeed;
            }

        }

        //Wenn er "s" gedrückt hat wird er langsamer
        if (arrowS === "s"){
            if (speed < 0){
                speed=speed-speedcontrol/100*33
            } else if (speed < 80){
                speed=speed-speedcontrol/100*66*1.7
            } else {
                speed=speed-speedcontrol*2
            }
            if (maxbackspeed > speed){
                speed = maxbackspeed;
            }
        }

        //Wenn er kein "W + S" gedrückt hat wird er auf 8-0km/h gebracht
        if (arrowW !== "w" && arrowS !== "s"){
            if (speed > 8){
                speed=speed-speedcontrol/100*20
                if (speed > 7 && speed < 9){
                    speed = 8
                }
            }
            if (speed < 0){
                speed=speed+speedcontrol/100*20
                if (speed > -1 && speed < 1){
                    speed = 0
                }
            }
        }

        //Wenn er "A" gedrückt hat, lenkt er nach Rechts
        if (arrowA === "a"){
            if (xAchse > -maxxAchse){
                if (xAchse > 0){
                    xAchse=xAchse-xAchseControl*3
                } else {
                    xAchse=xAchse-xAchseControl
                }
            } else {
                xAchse = -maxxAchse;
            }

        }

        //Wenn er "D" gedrückt hat, lenkt er nach links
        if (arrowD === "d"){
            if (xAchse < maxxAchse){
                if (xAchse < 0){
                    xAchse=xAchse+xAchseControl*3
                } else {
                    xAchse=xAchse+xAchseControl
                }
            } else {
                xAchse = maxxAchse;
            }
        }

        //Wenn er kein "A + D" gedrückt hat, färt er gerade aus
        if (arrowA !== "a" && arrowD !== "d"){
            if (xAchse !== 0){
                for (let i=0;i<xAchseControl;i++){
                    if (xAchse > 0){
                        xAchse = xAchse - 3
                    } else if (xAchse < 0){
                        xAchse = xAchse + 3
                    }
                }
                if (-5 < xAchse && xAchse < 5){
                    xAchse = 0
                }
            }
        }

        // Eine neue Fahrtrichtung wird berechnet,
        // Wenn er sich bewegt und lenkt
        if (xAchse !== 0 && speed !== 0){
            //XAchseControlCalc = maxspeed/maxxAchse*xAchse/speed
            XAchseControlCalc = xAchse;
            if (XAchseControlCalc > 5){
                XAchseControlCalc = 5;
            } else if (XAchseControlCalc < -5){
                XAchseControlCalc = -5;
            }



            deg = XAchseControlCalc + parseInt($( "#MyCar" )[0].style.transform.slice(7));

            //console.log(parseInt(document.getElementById("MyCar").style.transform.slice(7)));
            $( "#MyCar" )[0].style.transform = "rotate("+ deg +"deg)";
        }

        // Eine neue Position wird berechnet,
        // Wenn er sich bewegt
        if (speed !== 0){
            let positioncontrol = 10;
            let pixel = 0;
            let toppixel = 0;
            let leftpixel = 0;

            //in welche richtung schaut das Fahrzeug
            deg = parseInt($("#MyCar")[0].style.transform.slice(7));

            deg = deg%360;

            if (deg < 0){
                deg = -deg;
                deg= 360 - deg;
            }

            pixel = (deg%90)/0.9;

            // Neue Position wird bestimmt
            if ((deg) < 90){
                toppixel = (positioncontrol*speed/100)*((100-pixel)/100);
                leftpixel = (positioncontrol*speed/100)*(pixel/100);
            } else if ((deg) < 180){
                leftpixel = (positioncontrol*speed/100)*((100-pixel)/100);
                toppixel = -((positioncontrol*speed/100)*(pixel/100));
            } else if ((deg) < 270){
                toppixel = -(positioncontrol*speed/100)*((100-pixel)/100);
                leftpixel = -(positioncontrol*speed/100)*(pixel/100);
            } else{
                leftpixel = -(positioncontrol*speed/100)*((100-pixel)/100);
                toppixel = ((positioncontrol*speed/100)*(pixel/100));
            }


            // Alte Position wird genommen
            let top = parseFloat($( "#MyCar" )[0].style.top);
            let left = parseFloat($( "#MyCar" )[0].style.left);

            // Neue Position wird bestimmt
            $( "#MyCar" )[0].style.top = top-toppixel +"px";
            $( "#MyCar" )[0].style.left = left+leftpixel+"px";

            // Checkt on er ein Coin Berührt hat
            CeckHitCoin();
        }


        // Nur zum testen
        document.getElementById('pressedKey').innerHTML = arrowW + " " + arrowA + " " + arrowS + " " + arrowD;
        document.getElementById('speedMeter').innerHTML = speed;
        document.getElementById('xAchse').innerHTML = xAchse;
    }

    // Was drückt er
    document.addEventListener('keydown', function(event) {
        if (event.keyCode === 87) { //Press w
            arrowW = "w";
        }
        else if (event.keyCode === 65) { //Press a
            arrowA = "a";
        }
        else if (event.keyCode === 83) { //Press s
            arrowS = "s";
        }
        else if (event.keyCode === 68) { //Press d
            arrowD = "d";
        }
        else if (event.keyCode === 27) { //Press ESC
            ChangeGameStatus();
        }
    }, true);

    // Was hat er losgelassen
    document.addEventListener('keyup', function(event) {
        if (event.keyCode === 87) { //Press w
            arrowW = "";
        }
        else if (event.keyCode === 65) { //Press a
            arrowA = "";
        }
        else if (event.keyCode === 83) { //Press s
            arrowS = "";
        }
        else if (event.keyCode === 68) { //Press d
            arrowD = "";
        }
    }, true);

</script>
<body onload="GameStart()">
<p id="pressedKey"></p>

<img id="MyCar" src="../Images/Car_Police01.png">




<div id="Tempomat">
    <p id="speedMeter"></p>
    <br>
    <p id="xAchse"></p>
</div>

<div id="img">
</div>

<?php
    include_once "./Pause-Menu.html";
?>


</body>
</html>