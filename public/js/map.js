function maps(place){
    var mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');
    var mymap = L.map('mapid').setView([place], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);

    mapboxgl.accessToken = 'pk.eyJ1IjoibWV0aWxrIiwiYSI6ImNqZGVrNXNtNzBkN3IzM250ajFkdDdwMHoifQ.8kBQtAj-EQzxWkEnC_MnGQ';
    var map = new mapboxgl.Map({
        container: 'YOUR_CONTAINER_ELEMENT_ID',
        style: 'mapbox://styles/mapbox/streets-v10'
    });

    var marker = L.marker([place]).addTo(mymap);
}