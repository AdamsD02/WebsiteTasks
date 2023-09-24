
const data = `{"doctor":[` +
    `{"id":123,"name":"Dr.Nazareth","Lat":15.5895876,"Long":73.8166126}, `+
    `{"id":456,"name":"Dr.Gomes","Lat":15.6313672,"Long":73.7784649}, `+
    `{"id":789,"name":"Dr.Sankalp","Lat":15.4823288,"Long":73.8169355}, `+
    `{"id":101,"name":"Dr.Jonas","Lat":15.044508,"Long":73.994300}, `+
    `{"id":121,"name":"Dr.L.M.Sharma","Lat":15.381033,"Long":74.133553}] }`

let x = document.getElementById("d2");

let leti = 15.5706;
let longi = 73.8262; // 15.580899736403309,73.82628579807233
let map;

async function display() {
  map = new google.maps.Map(document.getElementById("mapholder"), {
    center: { lat: leti, lng: longi },
    zoom: 9,
  });
}

async function pointMarker(mId) {
  let dName ="" ;
  const va = JSON.parse(data) ;
  for (i in va.doctor ) {
    if( va.doctor[i]["id"] == mId ) {
      leti = va.doctor[i]["Lat"] ;
      longi = va.doctor[i]["Long"] ;
      dName = va.doctor[i]["name"] ;
      console.log(va.doctor[i] ) ;
      break ;
    }
  }
  const mapOptions = {
    zoom: 11,
    center: { lat: leti, lng: longi }
  };
  
  map = new google.maps.Map(document.getElementById("mapholder"), mapOptions) ;

  const marker = new google.maps.Marker({
    position: {lat: leti, lng: longi }, 
    map: map
  }) ;
  const infowindow = new google.maps.InfoWindow({
    content: "<p>Marker Location:" + marker.getPosition() + "<br>Name: " + dName + "</p>",
  });
  google.maps.event.addListener( marker, "mouseover", () => { infowindow.open(map, marker) ; } );
  google.maps.event.addListener( marker, "mouseout", () => { infowindow.close() ;} ) ;
}

// window.initMap = initMap ;
window.display = display ;
window.pointMarker = pointMarker ;