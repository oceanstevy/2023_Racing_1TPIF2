let path = "http://localhost/Github/2023_Racing_1TPIF2/";


function getRandom(min, max) {
    return Math.random() * (max - min) + min;
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
    return SessionID;
}
