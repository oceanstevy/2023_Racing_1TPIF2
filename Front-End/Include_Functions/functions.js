let path = "../";


function getRandom(min, max) {
    return Math.random() * (max - min) + min;
}

function hasNoCookies() {
    if ( getSessionIdFromCookies() === false ){
        return true;
    } else {
        return false;
    }

}

function getSessionIdFromCookies() {
    let name = "PHPSESSID=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let cs = decodedCookie.split(';');
    for(let i = 0; i <cs.length; i++) {

        while (cs[i].charAt(0) == ' ') {
            cs[i] = cs[i].substring(1);
        }

        if (cs[i].indexOf(name) == 0) {
            return cs[i].substring(name.length, cs[i].length);
        }
    }
    return false;
}

function NewMapModelID(mapid,n) {
    let numberarr = mapid.toString().split('');
    let xi = parseInt(numberarr[0] + numberarr[1] + numberarr[2]);
    let yi = parseInt(numberarr[3] + numberarr[4] + numberarr[5]);

    if (n === "x++"){
        xi++
    } else if (n === "y++"){
        yi++
    } else if (n === "x--"){
        xi--
    } else if (n === "y--"){
        yi--
    }
    return xi +""+ yi
}

function SetRNColor() {
    $.get("https://www.thecolorapi.com/id?rgb=rgb(" + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + ")", function (color) {
        $("th").css("color", color.hex.value);
    })
}


