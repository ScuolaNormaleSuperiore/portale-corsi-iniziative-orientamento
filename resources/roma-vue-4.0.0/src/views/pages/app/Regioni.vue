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

// Aggiungi GeoJSON alla mappa
L.geoJson(italyRegionsGeoJson, {
    style: style
}).addTo(map);
</script>
