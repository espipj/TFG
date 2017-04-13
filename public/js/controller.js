//Quita los acentos para que no interfieran en la búsqueda
	function quitarAcentos(str)
	{
	 var rExps=[
	 {re:/[\xC0-\xC6]/g, ch:'A'},
	 {re:/[\xE0-\xE6]/g, ch:'a'},
	 {re:/[\xC8-\xCB]/g, ch:'E'},
	 {re:/[\xE8-\xEB]/g, ch:'e'},
	 {re:/[\xCC-\xCF]/g, ch:'I'},
	 {re:/[\xEC-\xEF]/g, ch:'i'},
	 {re:/[\xD2-\xD6]/g, ch:'O'},
	 {re:/[\xF2-\xF6]/g, ch:'o'},
	 {re:/[\xD9-\xDC]/g, ch:'U'},
	 {re:/[\xF9-\xFC]/g, ch:'u'},
	 {re:/[\xD1]/g, ch:'N'},
	 {re:/[\xF1]/g, ch:'n'} ];

	 for(var i=0, len=rExps.length; i<len; i++)
	  str=str.replace(rExps[i].re, rExps[i].ch);

	 return str;
	}
	
	/*Funcion filtro en la tabla/buscador*/
	function buscar() {
	//Declaramos variables
		  var input, filter, table, tr, td, i,ac;
		  input = document.getElementById("mibuscador");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("miTabla");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];

			if (td) {
				ac=quitarAcentos(td.innerHTML.toUpperCase());
			  if (ac.indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			} 
		  }
}


//Lo utilizamos para que los scripts no se ejecuten antes del document ready
$(document).ready(function(){
	
	
	

	//Filas de las tablas clickables
	$(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
	
	

	//Cada fila es clickable
	/*jQuery(document).ready(function($) {
		$(".clickable-row").click(function() {
			window.document.location = $(this).data("href");
		});
	});
	*/


    function initMap() {

        var location = new google.maps.LatLng(40.978583, -5.714722);

        var mapCanvas = document.getElementById('mapa');
        var mapOptions = {
            center: location,
            zoom: 15,
            panControl: false,
			styles:[
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f7f1df"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#d0e3b4"
      }
    ]
  },
  {
    "featureType": "landscape.natural.terrain",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.business",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.medical",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#fbd3da"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#bde6ab"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffe15f"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#efd151"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "black"
      }
    ]
  },
  {
    "featureType": "transit.station.airport",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#cfb2db"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#a2daf2"
      }
    ]
  }
]
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        var markerImage = '/images/map-marker-icon.png';

        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        

    }
	
    google.maps.event.addDomListener(window, 'load', initMap);
	
	
	var $root = $('html, body');
	$('a[href*=#]:not([href=#carousel1])').click(function() {
		
		var href = $.attr(this, 'href');
		
		$root.animate({scrollTop: $(href).offset().top}, 1000, function () {
			window.location.hash = href;
		});
		return false;
	});
	
	
	$(document).on('click','.navbar-collapse.in',function(e) {

		if( $(e.target).is('a') && ( $(e.target).attr('class') != 'dropdown-toggle' ) ) {
			$(this).collapse('hide');
		}

	});
	
});




