function selectClicked(ch) {
    const el = document.getElementById("selectbox") ;
    switch(ch) {
        case 1: el.style.boxShadow = 'none' ;
          break ;
        case 2: el.style.boxShadow = 'inset 0px 0px 5px gray' ;
          break ;
        default: break;
    }
}

function displayList() {
    let list = document.getElementById("details") ;
    list.style.visibility = 'visible' ;
    // list.style.animationName = "displist" ;
    // list.style.animationDuration = "1s" ;
}
function closelist() {
    let list = document.getElementById("details") ;
    list.style.visibility = 'hidden' ;
}