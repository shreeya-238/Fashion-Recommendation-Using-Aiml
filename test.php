<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutiques Near You</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .boutique-list {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Boutiques Near You</h2>
    <div id="map"></div>
    <div class="boutique-list" id="boutique-list"></div>

    <script>
        let map, userLocation;

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    userLocation = { lat: position.coords.latitude, lng: position.coords.longitude };

                    map = new google.maps.Map(document.getElementById('map'), {
                        center: userLocation,
                        zoom: 13
                    });

                    // Use the new AdvancedMarkerElement
                    new google.maps.marker.AdvancedMarkerElement({
                        position: userLocation,
                        map: map,
                        title: "Your Location"
                    });

                    fetchNearbyBoutiques();
                }, () => {
                    alert("Geolocation failed. Please allow location access.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function fetchNearbyBoutiques() {
            const placesService = new google.maps.places.Place();
            
            const request = {
                location: userLocation,
                radius: 5000, // 5km range
                type: 'clothing_store',
                keyword: 'boutique'
            };

            placesService.search(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    displayBoutiques(results);
                } else {
                    console.error("Places request failed:", status);
                    alert("Failed to fetch boutiques.");
                }
            });
        }

        function displayBoutiques(boutiques) {
            let listContainer = document.getElementById('boutique-list');
            listContainer.innerHTML = "";

            if (boutiques.length === 0) {
                listContainer.innerHTML = "<p>No boutiques found nearby.</p>";
                return;
            }

            boutiques.forEach(boutique => {
                // Use AdvancedMarkerElement for markers
                new google.maps.marker.AdvancedMarkerElement({
                    position: boutique.geometry.location,
                    map: map,
                    title: boutique.name
                });

                let boutiqueItem = document.createElement("div");
                boutiqueItem.innerHTML = `
                    <p><strong>${boutique.name}</strong><br>
                    Address: ${boutique.vicinity || 'Not available'}<br>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${boutique.geometry.location.lat()},${boutique.geometry.location.lng()}" target="_blank">
                        Get Directions
                    </a></p>
                `;
                listContainer.appendChild(boutiqueItem);
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN1_ybVjpTwn34b5cKhGnfT8E7B6qBz5g&libraries=places&callback=initMap"></script>

</body>
</html>
