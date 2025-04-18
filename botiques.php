<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fashion Recommendation - Boutiques</title>
    <?php require('inc/links.php'); ?>
    <?php include 'config.php'; ?> <!-- Secure API Key -->
    
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #boutique-list {
            margin: 20px 0;
            list-style-type: none;
            padding: 0;
        }
        #boutique-list li {
            cursor: pointer;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
        #boutique-list li:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="hero-content">
            <h1>Our Partner Boutiques</h1>
            <p class="lead">Discover exclusive fashion destinations</p>
        </div>
    </section>

    <!-- Google Map -->
    <div id="map"></div>

    <!-- Boutique List -->
    <ul id="boutique-list"></ul>

    <?php require('inc/footer.php'); ?>

    <!-- Google Maps API Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&libraries=places&callback=initMap" async defer></script>

    <!-- JavaScript for Map -->
    <script>
        let map, userMarker, directionsService, directionsRenderer;
        let boutiques = [];  // Store boutiques data

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 28.6139, lng: 77.2090 }, // Default: New Delhi
                zoom: 13,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Get user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        map.setCenter(userLocation);

                        // Mark the user's location
                        userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "You are here",
                            icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        });

                        // Find boutiques around user's location
                        findNearbyBoutiques(userLocation);
                    },
                    () => {
                        alert("Location access denied. Using default location.");
                        findNearbyBoutiques({ lat: 28.6139, lng: 77.2090 }); // New Delhi fallback
                    }
                );
            } else {
                alert("Geolocation not supported.");
                findNearbyBoutiques({ lat: 28.6139, lng: 77.2090 }); // New Delhi fallback
            }
        }

        function findNearbyBoutiques(location) {
            const service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: location,
                radius: 5000, // Search within 5km
                type: ["clothing_store"]
            }, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    if (results.length === 0) {
                        alert("No boutiques found nearby.");
                        return;
                    }

                    boutiques = results; // Store the boutiques in the array
                    displayBoutiques(results);
                } else {
                    alert("Could not fetch boutiques. Status: " + status);
                }
            });
        }

        function displayBoutiques(boutiques) {
            const boutiqueList = document.getElementById("boutique-list");
            boutiqueList.innerHTML = ""; // Clear previous list

            boutiques.forEach((place, index) => {
                const listItem = document.createElement("li");
                listItem.textContent = place.name;
                listItem.addEventListener("click", () => {
                    showBoutiqueOnMap(index); // Show the selected boutique on the map
                });
                boutiqueList.appendChild(listItem);
            });
        }

        function showBoutiqueOnMap(index) {
            const boutique = boutiques[index];
            const location = boutique.geometry.location;

            map.setCenter(location);
            map.setZoom(15);

            // Mark the boutique on the map
            new google.maps.Marker({
                position: location,
                map: map,
                title: boutique.name,
            });
        }

        function getDirections(origin, destination) {
            directionsService.route(
                {
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                (response, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(response);
                    } else {
                        alert("Could not find directions. Status: " + status);
                    }
                }
            );
        }
    </script>

    <?php require('inc/scripts.php'); ?>
</body>
</html>
