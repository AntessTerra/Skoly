var mymap = L.map('mapid').setView([49.030146, 17.342677], 15);


L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiYW50ZXNzIiwiYSI6ImNrZ2F3MW4xYjAwengycXA4eGVjNXB1bjIifQ.fSHhgMYuqETrJm_lpFxulg'
    }).addTo(mymap);

    function onMapClick(e) {
        alert("Na mapě jsi kliknul na " + e.latlng);
    }
    
    mymap.on('click', onMapClick);