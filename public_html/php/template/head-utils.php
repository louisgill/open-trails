<?php
require_once(dirname(__DIR__) . "/classes/autoload.php");
/**
 * Get the relative path.
 * @see https://raw.githubusercontent.com/kingscreations/farm-to-you/master/php/lib/_header.php FarmToYou Header
 **/
require_once(dirname(dirname(__DIR__)) . "/root-path.php");
$CURRENT_DEPTH = substr_count($CURRENT_DIR, "/");
$ROOT_DEPTH = substr_count($ROOT_PATH, "/");
$DEPTH_DIFFERENCE = $CURRENT_DEPTH - $ROOT_DEPTH;
$PREFIX = str_repeat("../", $DEPTH_DIFFERENCE);

/**
 * open a session and set XSRF protection
 **/
require_once(dirname(__DIR__) . "/lib/xsrf.php");
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
setXsrfCookie("/"); ?>

<!DOCTYPE html>
<html lang="en" ng-app="TrailQuail">
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- added to see if this will fix routing issues with main site-->
		<!--<base herf="/">-->

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional Bootstrap theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
				integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!--  -->
		<!-- ALL OTHER 3RD PARTY CSS FILES GO HERE, FONTAWESOME, GOOGLE FONTS, ETC. -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<!--  -->

		<!-- CUSTOM CSS GOES HERE -->
		<link rel="stylesheet" href="<?php echo $PREFIX; ?>css/style.css" type="text/css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script type="text/javascript" src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (required for Bootstrap's JS plugins) -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<!-- Bootstrap latest compiled and minified Javascript -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
				  integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc="
				  crossorigin="anonymous"></script>

		<!-- Angular.js -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.8/angular-route.min.js"></script>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.min.js"></script>

		<!--  -->
		<!-- include all your angular files (.js files) down here -->
		<!--  -->
		<script src="<?php echo $PREFIX; ?>angular/trail-quail.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/route-config.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/login-service.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/sign-up-service.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/trail-service.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/comment-services.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/sign-up-modal.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/sign-up-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/login-modal.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/login-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/logout-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/logout-service.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/trail-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/comment-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/directives/trail-view.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/trail-alert-modal.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/trail-add-modal.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/search-controller.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/services/search-service.js"></script>
		<script src="<?php echo $PREFIX; ?>angular/controllers/search-results-controller.js"></script>

		<!-- load the googlemaps api -->
		<script src="<?php echo $PREFIX; ?>angular/ng-map.min.js"></script>
		<!--		<script src="https://maps.googleapis.com/maps/api/js?=trailquail-1152"></script>-->
		<script async defer src="https://maps.googleapis.com/maps/api/js?trailquail-1152&callback=initMap"></script>

		<!-- Initialize the Google Map -->
		<!--		<script>-->
		<!--			function initialize() {-->
		<!--				var mapCanvas = document.getElementById('map');-->
		<!--				var mapOptions = {-->
		<!--					center: new google.maps.LatLng(35.1318, -106.5925),-->
		<!--					zoom: 8,-->
		<!--					mapTypeId: google.maps.MapTypeId.TERRAIN-->
		<!--				}-->
		<!--				var map = new google.maps.Map(mapCanvas, mapOptions);-->
		<!---->
		<!--				// Map 2-->
		<!--				var mapCanvas2 = document.getElementById('map2');-->
		<!--				var mapOptions2 = {-->
		<!--					center: new google.maps.LatLng(35.1318, -106.5925),-->
		<!--					zoom: 8,-->
		<!--					mapTypeId: google.maps.MapTypeId.TERRAIN-->
		<!--				}-->
		<!--				var map2 = new google.maps.Map(mapCanvas2, mapOptions2);-->
		<!--			}-->
		<!--			google.maps.event.addDomListener(window, 'load', initialize);-->
		<!--		</script>-->

		<!-- Angular Google Maps-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-google-maps/2.2.0/angular-google-maps_dev_mapped.js"></script>

		<!-- Page Title -->
		<title><?php echo $PAGE_TITLE; ?></title>
	</head>
	<body class="sfooter">