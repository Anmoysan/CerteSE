function maps(place){
    var map = L.map('map').setView(place, 13);

    L.marker([51.5, -0.09]).addTo(map)
        .bindPopup('Esta aqui el evento')
        .openPopup();

    var maps = document.getElementById("map");
}