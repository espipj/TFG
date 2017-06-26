//Quita los acentos para que no interfieran en la búsqueda
function quitarAcentos(str) {
    var rExps = [
        {re: /[\xC0-\xC6]/g, ch: 'A'},
        {re: /[\xE0-\xE6]/g, ch: 'a'},
        {re: /[\xC8-\xCB]/g, ch: 'E'},
        {re: /[\xE8-\xEB]/g, ch: 'e'},
        {re: /[\xCC-\xCF]/g, ch: 'I'},
        {re: /[\xEC-\xEF]/g, ch: 'i'},
        {re: /[\xD2-\xD6]/g, ch: 'O'},
        {re: /[\xF2-\xF6]/g, ch: 'o'},
        {re: /[\xD9-\xDC]/g, ch: 'U'},
        {re: /[\xF9-\xFC]/g, ch: 'u'},
        {re: /[\xD1]/g, ch: 'N'},
        {re: /[\xF1]/g, ch: 'n'}];

    for (var i = 0, len = rExps.length; i < len; i++)
        str = str.replace(rExps[i].re, rExps[i].ch);

    return str;
}

function upload(file) {

    var tipo = $("#dropzone").data('tipo');
    var metas = document.getElementsByTagName('meta');

    console.log(tipo);


    var formData=new FormData(),xhr = new XMLHttpRequest();
    formData.append('import_file',file[0]);

    xhr.open('post','/importar/'.concat(tipo));
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    for (i=0; i<metas.length; i++) {
        if (metas[i].getAttribute("name") == "csrf-token") {
            var token=metas[i].getAttribute("content");
        }
    }

    xhr.setRequestHeader("X-CSRF-Token", token);
    xhr.send(formData);

    //setTimeout(function(){}, 1000);
    location.reload();


}

/*Funcion filtro en la tabla/buscador*/
function buscar(buscador, tabla) {
    //Declaramos variables
    var input, filter, table, tr, td, i, ac;
    input = document.getElementById(buscador);
    filter = input.value.toUpperCase();
    table = document.getElementById(tabla);
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];

        if (td) {
            ac = quitarAcentos(td.innerHTML.toUpperCase());
            if (ac.indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function recorrerFiltrarA(tr, condicion) {
    var i;
    if(condicion=="vivo"){
        for (i = 0; i < tr.length; i++) {

            var td = tr[i].getElementsByTagName("td")[0];



            if (td.data('vivo')==1) {
                tr[i].show();
            }
        }

    }else if(condicion=="muerto") {
        for (i = 0; i < tr.length; i++) {

            var td = tr[i].getElementsByTagName("td")[0];


            if (td.data('vivo')==0) {
                tr[i].show();
            }
        }

    }


}

function recorrerFiltrarD(tr, condicion) {
    var i;
    if(condicion=="vivo"){
        for (i = 0; i < tr.length; i++) {

            var td = tr[i].getElementsByTagName("td")[0];


            if (td.data('vivo')==1) {
                tr[i].hide();
            }
        }

    }else if(condicion=="muerto") {
        for (i = 0; i < tr.length; i++) {


            var td = tr[i].getElementsByTagName("td")[0];


            if (td.data('vivo')==0) {
                tr[i].hide();
            }
        }

    }



}


//Lo utilizamos para que los scripts no se ejecuten antes del document ready
$(document).ready(function () {



    $("#dropzone").on('dragenter',function (event) {
            console.log('dragenter');
            this.className='dropzone dragover';
            $(".in-dropzone").css('visibility','hidden');
            $("#titulodrop").show();
            $("#imagedrop").show();


    });


    $("#dropzone").on('dragover',function (event) {
        event.preventDefault();


    });

    $("#dropzone").on('dragleave',function (event) {
        if(event.target === this) {
            console.log('SALIDA');
            this.className='dropzone';
            $(".in-dropzone").css('visibility','visible');
            $("#titulodrop").hide();
            $("#imagedrop").hide();
        }

    });

    $("#dropzone").on('drop',function (e) {
        console.log('dropeo');
        e.preventDefault();
        this.className='dropzone';
        $(".in-dropzone").css('visibility','visible');
        $("#titulodrop").hide();
        $("#imagedrop").hide();
        console.log(e.originalEvent.dataTransfer.files);
        upload(e.originalEvent.dataTransfer.files);

    });



    //Subir el archivo nada mas seleccionado
    $("#file").change(function () {
        document.getElementById("file").submit();
    });

    $(".buscadorjs").keyup(function () {
        //alert($(this).data('tabla'));
        buscar($(this).attr('id'), $(this).data('tabla'));

    });

    //Checkboxes que filtran
    $(".tick").click(function () {
        var showAll = true;
        $('tr').not('.header').hide();
        $('input[type=checkbox]').each(function () {
            if ($(this)[0].checked) {
                showAll = false;
                var status = $(this).attr('rel');
                var value = $(this).val();
                $('td.' + status + '[rel="' + value + '"]').parent('tr').show();
            }
        });
        if(showAll){
            $('tr').show();
        }
    });

    //Filas de las tablas clickables
    $(".clickable-row").click(function () {
        window.location = $(this).data("href");
    });

    //Para que los botones no sean incluidos como parte de la fila
    $(".btn-group").click(function (event) {
        event.stopPropagation();
    });

    $(".pariente").click(function (event) {
        event.stopPropagation();
    });

    $(".role-tick").click(function (event) {
        event.stopPropagation();
    });
    function initMap() {

        var location = new google.maps.LatLng(40.978583, -5.714722);

        var mapCanvas = document.getElementById('mapa');
        var mapOptions = {
            center: location,
            zoom: 15,
            panControl: false,
            styles: [
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
    /*$('a[href*=#]:not([href=#carousel1])').click(function() {

     var href = $.attr(this, 'href');

     $root.animate({scrollTop: $(href).offset().top}, 1000, function () {
     window.location.hash = href;
     });
     return false;
     });
     */

    $(document).on('click', '.navbar-collapse.in', function (e) {

        if ($(e.target).is('a') && ( $(e.target).attr('class') != 'dropdown-toggle' )) {
            $(this).collapse('hide');
        }

    });

});




