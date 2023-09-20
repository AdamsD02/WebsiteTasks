
// API-key: AIzaSyCD9S7Nei4tqpky64zpMmPaQb5J-oTC64w
let x = document.getElementById("d2");
let YOUR_KEY = "AIzaSyCD9S7Nei4tqpky64zpMmPaQb5J-oTC64w" ;

function selectClicked(ch) {
    const el = document.getElementById("selectbox") ;
    switch(ch) {
        case 1: el.style.boxShadow = 'none' ;
          break ;
        case 2: el.style.boxShadow = 'inset 0px 0px 5px gray' ;
          displayList() ;
          break ;
        default: break;
    }
}


function closelist() {
    let list = document.getElementById("details") ;
    list.style.visibility = 'hidden' ;
}

function displayList() {
  let list = document.getElementById("details") ;
  list.style.visibility = 'visible' ;
}

//   x.innerHTML = "<br> Hi!" ;
//   if (navigator.geolocation) {
//     navigator.geolocation.watchPosition(showPosition);
//   } else {
//     x.innerHTML = "Geolocation is not supported by this browser.";
//   }
// }

// function showPosition(position) {
//   x.innerHTML += "Latitude: " + position.coords.latitude +
//     "<br>Longitude: " + position.coords.longitude + 
//     "Accuracy: " + position.coords.accuracy +
//     "<br> Altitude: " + position.coords.altitude ;

//     let lat = 30.02 ;
//     let lon = 73.85 ;
//     let latlon = lat + ',' + lon ;
//     let img_url = "https://maps.googleapis.com/maps/api/staticmap?center=" + 
//       latlon + "&zoom=14&size=400x300&sensor=false&key=" + YOUR_KEY ;
//     document.getElementById("mapholder").innerHTML = 
//       "<img src='" + img_url + "'> " ;

// }