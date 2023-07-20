$(document).ready(function () {
  if (top.location.pathname === '/resellers/') {
    initAutocomplete();
  }
});

/**
 * Initial map and address auto complete field
 */
function initAutocomplete()
{
  var markers = [];
  var options = {
    center: { lat: -26.719704, lng: 135.60836 },
    zoom: 4,
    mapTypeId: 'roadmap',
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM,
    },
    fullscreenControl: false,
    streetViewControl: false,
    mapTypeControl: false,

    styles: [
      {
        elementType: 'geometry',
        stylers: [
          {
            color: '#f5f5f5',
          },
        ],
      },
      {
        elementType: 'labels.icon',
        stylers: [
          {
            visibility: 'off',
          },
        ],
      },
      {
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#616161',
          },
        ],
      },
      {
        elementType: 'labels.text.stroke',
        stylers: [
          {
            color: '#f5f5f5',
          },
        ],
      },
      {
        featureType: 'administrative.land_parcel',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#bdbdbd',
          },
        ],
      },
      {
        featureType: 'poi',
        elementType: 'geometry',
        stylers: [
          {
            color: '#eeeeee',
          },
        ],
      },
      {
        featureType: 'poi',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#757575',
          },
        ],
      },
      {
        featureType: 'poi.park',
        elementType: 'geometry',
        stylers: [
          {
            color: '#e5e5e5',
          },
        ],
      },
      {
        featureType: 'poi.park',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#9e9e9e',
          },
        ],
      },
      {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [
          {
            color: '#ffffff',
          },
        ],
      },
      {
        featureType: 'road.arterial',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#757575',
          },
        ],
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [
          {
            color: '#dadada',
          },
        ],
      },
      {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#616161',
          },
        ],
      },
      {
        featureType: 'road.local',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#9e9e9e',
          },
        ],
      },
      {
        featureType: 'transit.line',
        elementType: 'geometry',
        stylers: [
          {
            color: '#e5e5e5',
          },
        ],
      },
      {
        featureType: 'transit.station',
        elementType: 'geometry',
        stylers: [
          {
            color: '#eeeeee',
          },
        ],
      },
      {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [
          {
            color: '#c9c9c9',
          },
        ],
      },
      {
        featureType: 'water',
        elementType: 'labels.text.fill',
        stylers: [
          {
            color: '#9e9e9e',
          },
        ],
      },
    ],
  };
  var searchBox = [];
  var map = new google.maps.Map(document.getElementById('reseller-map'), options);
  // Create the search box and link it to the UI element.
  var input = document.getElementsByClassName('section-reseller-map__input');
  searchBox = mapSearchBoxes(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function () {
    addBoundChanged(searchBox, map);
  });

  //Add markers to the map from the sidebar store location
  var list = [];
  $('.section-reseller-map__sidebar-acc-box').each(function () {
    list.push({
      title: $(this).find('.section-reseller-map__sidebar-acc-title').text().trim(),
      lat: $(this).data('lat'),
      lng: $(this).data('lng'),
      address: $(this).data('address'),
      contact: $(this).find('.section-reseller-map__sidebar-acc-phone a').text(),
      direction: 'https://www.google.com/maps/dir/?api=1&origin=&destination=' + $(this).data('address'),
      category: $(this).find('.section-reseller-map__sidebar-acc-category').text().trim(),
    });
  });

  var bounds = new google.maps.LatLngBounds();
  var infoWindow = new google.maps.InfoWindow();
  var iconList = ({
    url: '/wp-content/themes/klyp/assets/dist/img/marker.png',
    scaledSize: new google.maps.Size(24, 35), // scaled size
    origin: new google.maps.Point(0, 0), // origin
    anchor: new google.maps.Point(0, 0), // anchor
  });

  list.forEach(function (data, index, array) {
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(list[index].lat, list[index].lng),
      map: map,
      icon: iconList,
      draggable: false,
    });
    markers.push(marker);
    bounds.extend(marker.position);
    (function (marker, data) {
      google.maps.event.addListener(marker, 'click', function (e) {
        infoWindow.setContent(`
          <div class="section-reseller-map__tooltip">
            <div class="section-reseller-map__tooltip-cat">` + data.category + `</div>
              <h2 class="section-reseller-map__tooltip-title">` + data.title + `</h2>
              <div class="section-reseller-map__tooltip-list">
                  <img src="/wp-content/themes/klyp/assets/dist/img/pin.png"><span class="section-reseller-map__tooltip-txt">` + data.address + `</span>
              </div>
              <div class="section-reseller-map__tooltip-list">
                  <img src="/wp-content/themes/klyp/assets/dist/img/phone.png">
                  <span class="section-reseller-map__tooltip-txt"><a href="` + data.contact + `">` + data.contact + `</a></span>
              </div>
              <div class="section-reseller-map__tooltip-list">
                  <img src="/wp-content/themes/klyp/assets/dist/img/pin.png">
                  <span class="section-reseller-map__tooltip-txt"><a href="` + data.direction + `">Get Direction</span>
              </div>
            </div>
          </div>`);
        infoWindow.open(map, marker);
      });
    })(marker, data);
  });

  //show tooltip when clicked
  $(document).on('click', '.section-reseller-map__sidebar-acc-box', function() {
      $('.section-reseller-map__sidebar-acc-box').removeClass('section-reseller-map__sidebar-acc-box--active');
      var clickId = $(this).attr('data-mclick');
      $('.section-reseller-map__sidebar-acc-box').each(function () {
        if ($(this).data('mclick') == clickId) {
          $(this).addClass('section-reseller-map__sidebar-acc-box--active');
        }
      });
      google.maps.event.trigger(markers[clickId], 'click');
    });
  
  //Category filter on selection
  $(document).on('change', '.section-reseller-map__dropdown', function () {
    var category = $(this).val(),
        filterList = getFilterList(list, category);

    if (filterList.length > 0) {
      markers.forEach(function (marker) {
        marker.setMap(null);
      });
      markers = [];
      filterList.forEach(function (data, index, array) {
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(list[index].lat, list[index].lng),
          map: map,
          icon: iconList,
          draggable: true,
        });
        markers.push(marker);
        bounds.extend(marker.position);
        (function (marker, data) {
          google.maps.event.addListener(marker, 'click', function (e) {
            infoWindow.setContent(`
            <div class="section-reseller-map__tooltip">
              <div class="section-reseller-map__tooltip-cat">` + data.category + `</div>
                <h2 class="section-reseller-map__tooltip-title">` + data.title + `</h2>
                <div class="section-reseller-map__tooltip-list">
                    <img src="/wp-content/themes/klyp/assets/dist/img/pin.png"><span class="section-reseller-map__tooltip-txt">` + data.address + `</span>
                </div>
                <div class="section-reseller-map__tooltip-list">
                    <img src="/wp-content/themes/klyp/assets/dist/img/phone.png">
                    <span class="section-reseller-map__tooltip-txt"><a href="` + data.contact + `">` + data.contact + `</a></span>
                </div>
                <div class="section-reseller-map__tooltip-list">
                    <img src="/wp-content/themes/klyp/assets/dist/img/pin.png">
                    <span class="section-reseller-map__tooltip-txt"><a href="` + data.direction + `">Get Direction</span>
                </div>
              </div>
            </div>`);
            infoWindow.open(map, marker);
          });
        })(marker, data);
      });
    }
  });

  searchBox.forEach(function (value, index) {
    value.addListener('places_changed', function() {
      var places = value.getPlaces();
      if (places.length == 0) {
        return;
      }
     
      markers = [];
      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function (place) {
        if (!place.geometry) {
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25),
        };

        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location,
        }));
        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }

        //Retrive state name from new address and open accordion accordingly
        var componentForm = ({administrative_area_level_1: 'short_name'});
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]]
            if (addressType == 'administrative_area_level_1') {
              $('.section-reseller-map__sidebar-acc-content').removeClass('show');
              $('#' + val.toLowerCase()).addClass('show');

              $('#' + val.toLowerCase() + ' .section-reseller-map__sidebar-acc-box').each(function() {
                var store_pos = new google.maps.LatLng($(this).data('lat'), $(this).data('lng'));
                var new_pos = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                var distance = calcDistance(store_pos, new_pos);
                $(this).attr('data-distance', distance);
                $(this).find('.store_distance_text').remove();
                $('<p class="store_distance_text">' + distance + 'km</p>').appendTo($(this));
              });

              var $wrapper = $('#' + val.toLowerCase());
              $wrapper.find('.section-reseller-map__sidebar-acc-box').sort(function (a, b) {
                  return +a.getAttribute('data-distance') - +b.getAttribute('data-distance');
              }).appendTo($wrapper);
            }
          }
        }
      });
      map.fitBounds(bounds);
    });
  });
}

/**
 * Get list of filter by category
 * @param list list need to be filtered
 * @param category to be excluded
 * @return filtered list 
 */
function getFilterList(list, category) {
  var filterList = [];
  list.forEach(function (data, index, array) {
    if (data.category == category) {
      filterList.push(data);
    }
  })
  return filterList;
}

/**
 * Create direction navigation url
 * @param location new location
 * @return direction url
 */
function createDirectionUrl(location) {
  var directionUrl,
      destinationAddress,
      startAddress = '',
      url = {};
  url.target = 'target="_blank"';
  destinationAddress = location.address + ', ' + location.city + ', ' + location.country;
  url.src = 'https://www.google.com/maps/dir/?api=1&origin=' + rfc3986EncodeURIComponent(startAddress) + '&destination=' + rfc3986EncodeURIComponent(destinationAddress) + '';
  directionUrl = "<a class='wpsl-directions' " + url.target + " href='" + url.src + "'>" + 'Get Direction' + '</a>';
  return directionUrl;
}

/**
 * Sanitize inputs
 * @params str input
 * @return sanitized output
 */
function rfc3986EncodeURIComponent(str) {
  return encodeURIComponent(str).replace(/[!'()*]/g, escape);
}

/**
 * Add search box to map
 * @params str input
 * @return search box
 */
function mapSearchBoxes(input) {
  var searchBox = [];
  for (var i = 0; i < input.length; i++) {
    searchBox.push(new google.maps.places.SearchBox(input[i]));
  }
  return searchBox;
}

/**
 * Bind new location to map
 * @params search box
 * @return map
 * @return void
 */
function addBoundChanged(searchBox, map) {
  searchBox.forEach(function (value, index) {
    value.setBounds(map.getBounds());
  })
}

/**
 * Calculate distance between store and the chosen location
 * @params p1 original location
 * @params p2 new location
 * @return distance by km
 */
function calcDistance(p1, p2) {
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(1);
}