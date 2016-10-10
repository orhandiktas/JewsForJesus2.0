<?php
/*
Plugin Name: Tricorder (event search)
Plugin URI: https://www.youtube.com/watch?v=dQw4w9WgXcQ
Description: How you find people that are speaking in your area
Version: 1.1
Author: Danny Shafer
Author URI: http://dannyshafer.github.io
*/

function speakerSearch($speakerName) {

echo '<br><span class="speaker-name">' . $speakerName . '</span>'; //chances are we don't need this because it'll be on a speaker page
echo '<span id="speaker-container" class="speaker-container"></span><br>';
echo '<script type="text/javascript">';
echo '  function eventLoop(eventArray) {
        var currentEvents = ""
        for (var i = 0; i < eventArray.length; i++) {
            currentEvents = currentEvents + eventArray[i] + "<br>"
        }
        return currentEvents;
     }
     function makeAddressUrlFriendly(address1, address2, address3) {
        return "http://maps.google.com/?q=" + address1 + " " + address2 + " " + address3
     }';
echo '  function displayData(x) {
        x.success(function(realData) {
            console.log(realData);
            
            for (var i = 0; i < realData.length; i++) {
            $("#speaker-container").append("<br>" + 
            eventLoop(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])) +
            "<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + "\">" + realData[i].Values.v[6] + "</a>" + 
            "<br>" + 
            realData[i].Values.v[3] +
            "<br>_______________");
            console.log(realData[i].Values.v[3]); 
            console.log(realData[i].Values.v[6]); 
            console.log(realData[i].Values.v[12]); 
            console.log(realData[i].Values.v[13]); 
            console.log(realData[i].Values.v[14]); 
            console.log("<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + "\">" + realData[i].Values.v[6] + "</a>")
            console.log(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])[0]); 
            }
        });
    }

    var promise = shortcodeSearch("speaker", "' . $speakerName . '");

    displayData(promise); ';

    echo '</script>';

}

function venueSearch($venueName) {

echo '<br><span class="venue-name">' . $venueName . '</span>'; //chances are we don't need this because it'll be on a venue page
echo '<span id="venue-container" class="venue-container"></span><br>';
echo '<script type="text/javascript">';
echo '  function eventLoop(eventArray) {
        var currentEvents = ""
        for (var i = 0; i < eventArray.length; i++) {
            currentEvents = currentEvents + eventArray[i] + "<br>"
        }
        return currentEvents;
     }
     function makeAddressUrlFriendly(address1, address2, address3) {
        return "http://maps.google.com/?q=" + address1 + " " + address2 + " " + address3
     }';
echo '  function displayData(x) {
        x.success(function(realData) {
            console.log(realData);
            
            for (var i = 0; i < realData.length; i++) {
            $("#venue-container").append("<br>" + 
            eventLoop(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])) +
            realData[i].Values.v[9] + 
            "<br>" + 
            realData[i].Values.v[3] +
            "<br>" +
            "<img src=\"http://dev01.jewsforjesus.org/wp-content/uploads/" + realData[i].Values.v[9].toLowerCase().replace(".","").replace(" ","-").replace(" ","-") + ".jpg\">" + 
            "<br>" +
            "_______________");
            console.log(realData[i].Values.v[3]); 
            console.log(realData[i].Values.v[6]); 
            console.log(realData[i].Values.v[13]); 
            console.log(realData[i].Values.v[14]); 
            console.log(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])[0]); 
            }
        });
    }

    var promise = shortcodeSearch("venue", "' . $venueName . '");

    displayData(promise); ';

    echo '</script>';
}

function regionSearch($postCode, $distance) {

echo '<br><span class="region-name">' . $postCode . " " . $distance . '</span>'; //chances are we don't need this because it'll be on a region page
echo '<span id="region-container" class="region-container"></span><br>';
echo '<script type="text/javascript">';
echo '  function eventLoop(eventArray) {
        var currentEvents = ""
        for (var i = 0; i < eventArray.length; i++) {
            currentEvents = currentEvents + eventArray[i] + "<br>"
        }
        return currentEvents;
     }
     function makeAddressUrlFriendly(address1, address2, address3) {
        return "http://maps.google.com/?q=" + address1 + " " + address2 + " " + address3
     }';
echo '  function displayData(x) {
        x.success(function(realData) {
            console.log(realData);
            
            for (var i = 0; i < realData.length; i++) {
            $("#region-container").append("<br>" + 
            eventLoop(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])) + 
            "<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + "\">" + realData[i].Values.v[6] + "</a>" + " " + realData[i].Values.v[9] + 
            "<br>" + 
            realData[i].Values.v[3] +
            "<br>" +
            "<img src=\"http://dev01.jewsforjesus.org/wp-content/uploads/" + realData[i].Values.v[9].toLowerCase().replace(".","").replace(" ","-").replace(" ","-") + ".jpg\">" + 
            "<br>" +
            "_______________");
            console.log(realData[i]); 
            console.log(realData[i].Values.v[2]); 
            console.log(realData[i].Values.v[3]); 
            console.log(realData[i].Values.v[6]); 
            console.log(realData[i].Values.v[13]); 
            console.log(realData[i].Values.v[14]); 
            console.log(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])); 
            }
        });
    }

    var promise = shortcodeSearch("region", "' . $postCode . '", "' . $distance . '");

    displayData(promise); ';

    echo '</script>';
}

function countrySearch($countryName) {

echo '<br><span class="country-name">' . $countryName . '</span>'; //chances are we don't need this because it'll be on a country page
echo '<span id="country-container" class="country-container"></span><br>';
echo '<script type="text/javascript">';
echo '  function eventLoop(eventArray) {
        var currentEvents = ""
        for (var i = 0; i < eventArray.length; i++) {
            currentEvents = currentEvents + eventArray[i] + "<br>"
        }
        return currentEvents;
     }
     function makeAddressUrlFriendly(address1, address2, address3) {
        return "http://maps.google.com/?q=" + address1 + " " + address2 + " " + address3
     }';
echo '  function displayData(x) {
        x.success(function(realData) {
            console.log(realData);
            
            for (var i = 0; i < realData.length; i++) {
            $("#country-container").append("<br>" + 
            eventLoop(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])) + 
            "<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + " " + realData[i].Values.v[14] + "\">" + realData[i].Values.v[6] + "</a>" + " " + realData[i].Values.v[9] + 
            "<br>" + 
            realData[i].Values.v[3] +
            "<br>" +
            "<img src=\"http://dev01.jewsforjesus.org/wp-content/uploads/" + realData[i].Values.v[9].toLowerCase().replace(".","").replace(" ","-").replace(" ","-") + ".jpg\">" + 
            "<br>" +
            "_______________");
            console.log(realData[i]); 
            console.log(realData[i].Values.v[2]); 
            console.log(realData[i].Values.v[3]); 
            console.log(realData[i].Values.v[6]);
            console.log("<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + "\">" + realData[i].Values.v[6] + "</a>"); 
            console.log(realData[i].Values.v[13]); 
            console.log(realData[i].Values.v[14]); 
            console.log(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])); 
            }
        });
    }

    var promise = shortcodeSearch("country", "' . $countryName . '");

    displayData(promise); ';

    echo '</script>';
}

// function runShortcode( $params ) {
//     // THIS FUNCTION IS DEPRECATED AS OF THE SHORTCODE IMPLEMENTATION BEING ABANDONED. You'll call this via something like this [danny_events resource_type="region" post_code="94107" distance="5"] OR [danny_events resource_type="speaker" resource_name="Aaron Abramson"] OR [danny_events resource_type="venue" resource_name="Cornerstone Bible Church"] and it will return to you a collection of spans containing your data to be customized as you see fit
//     $taken_params = shortcode_atts( array(
//         'resource_type' => '',
//         'resource_name' => '',
//         'resource_distance' => '25',
//         'postcode' => '',
//         ), $params );
//     if ($taken_params['resource_type'] == "venue") {
//         venueSearch($taken_params[ 'resource_name' ]);
//     } else if ($taken_params['resource_type'] == "speaker") {
//         speakerSearch($taken_params[ 'resource_name' ]);
//     } else if ($taken_params['resource_type'] == "region") {
//         regionSearch($taken_params['postcode'], $taken_params[ 'resource_distance' ]);
//     } else if ($taken_params['resource_type'] == "country") {
//         countrySearch($taken_params[ 'resource_name' ]);
//     }
//     ob_start(); 

//     return ob_get_clean();
// }

// add_shortcode( 'danny_events', 'runShortcode' );

function runSearch($resource_type, $resource_name, $postcode = "", $distance = "") {
    if ($resource_type == "venue") {
        venueSearch($resource_name);
    } else if ($resource_type == "speaker") {
        speakerSearch($resource_name);
    } else if ($resource_type == "region") {
        regionSearch($postcode, $distance);
    } else if ($resource_type == "country") {
        countrySearch($resource_name);
    }
}

echo '<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>';

runSearch("country", "United States");

?>