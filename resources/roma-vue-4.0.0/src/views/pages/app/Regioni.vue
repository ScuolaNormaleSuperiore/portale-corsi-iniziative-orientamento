<style>
#map { height: 600px; }
</style>
<div id="map"></div>

<script>
var italyRegionsGeoJson = {};
</script>

<script>
// Inizializzazione della mappa
var map = L.map('map').setView([41.9028, 12.4964], 6); // Coordinate centrali dell'Italia

// Livello tiles della mappa
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 10,
}).addTo(map);

// Dati esemplificativi per le regioni
var regionData = {
    "Lombardia": 10,
    "Lazio": 5,
    "Campania": 7,
    // Altre regioni...
};

// Funzione per decidere il colore in base al valore
function getColor(d) {
    return d > 8 ? '#800026' :
        d > 6 ? '#BD0026' :
            d > 4 ? '#E31A1C' :
                d > 2 ? '#FC4E2A' :
                    d > 0 ? '#FD8D3C' :
                        '#FFEDA0';
}

// Stile da applicare a ciascuna regione
function style(feature) {
    return {
        fillColor: getColor(regionData[feature.properties.reg_name]),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}

// Aggiungi GeoJSON alla mappa
L.geoJson(italyRegionsGeoJson, {
    style: style
}).addTo(map);
</script>
