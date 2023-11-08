function callReload() {
    alert("page will reload.")
    window.open("SignUpResult.php") ;
}

function callAssign() {
    location.assign("SignUpResult.php") ;
}

function iconOn() {
    let v = document.getElementById("picon");
    let l = document.getElementById("login");
    v.style.display = "block" ;
    l.style.display = "hidden" ;
}

function iconOff() {
    let v = document.getElementById("picon");
    let l = document.getElementById("login");
    v.style.display = "hidden" ;
    l.style.display = "block" ;
}