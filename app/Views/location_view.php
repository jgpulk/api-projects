<!DOCTYPE html>
<html lang="en" ng-app="weatherApp">
<head>
    <meta charset="UTF-8">
    <title>Weather App</title>
    <!-- Include AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>
<body>
    <div ng-controller="LocationController">
        <!-- Form to input location -->
        <form ng-submit="submitLocation()">
            <label>Enter your location:</label>
            <input type="text" ng-model="location">
            <button type="submit">Submit</button>
        </form>

        <br>
        <br>
        OR
        <br>
        <br>

        <button type="button" ng-click="getCurrentLocation()">Use current location</button>

        <!-- Display user's location -->
        <div ng-if="userLocation">
            <p>Your location: {{ userLocation }}</p>
        </div>
    </div>

    <script>
        angular.module('weatherApp', [])
        .controller('LocationController', ['$scope', '$http', function($scope, $http) {
            // $scope.location = "kottayam"
            $scope.submitLocation = function() {
                $scope.userLocation = $scope.location;
                $http.get('https://api.openweathermap.org/geo/1.0/direct', {
                    params: {
                        q: $scope.location,
                        appid: 'b837dc105e3e8f2b7b83a715424d46fa'
                    }
                }).then(function(response) {
                    console.log(response);
                    $scope.weatherData = response.data;
                }).catch(function(error) {
                    console.error('Error fetching weather data:', error);
                });
            };

            $scope.getCurrentLocation = function(){
                console.log("Btn clicked");
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        console.log(position);
                        $scope.$apply(function() {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;
                            $scope.userLocation = "Latitude: " + latitude + ", Longitude: " + longitude;
                        });
                    }, function(error) {
                        console.error("Error getting user location:", error);
                    });
                } else {
                    console.error("Geolocation is not supported by this browser.");
                }
            }
        }]);
    </script>
</body>
</html>
