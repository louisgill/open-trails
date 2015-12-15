<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Trail Quail";
/*load head-utils.php*/
require_once("php/template/head-utils.php");
?>

<!-- ----------------------------------- -->
<!-- Quail Trail Homepage                -->
<!--
<!-- saulj@me.com  December 14, 2015
<!-- ----------------------------------- -->

<div class="sfooter-content">
	<header>
		<?php require_once("php/template/header.php"); ?>
	</header>

	<!-- Main jumbotron to welcome users and for a call to action -->
	<div class="jumbotron bg-image">
		<div class="container text-center">
			<br>
			<br>

			<h1>Explore the Outdoors around Albuquerque</h1>

			<p>Find hiking, mountain biking, skiing, <br>and horseback riding trails</p>
			<br>

			<p><a class="btn btn-primary btn-lg" role="button" href="<?php echo $PREFIX;?>trail-search">Find a Trail</a></p>

			<p><a class="btn btn-primary" role="button" href="<?php echo $PREFIX;?>trail-site-info">Learn More</a></p>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class	="col-md-12 embed-responsive embed-responsive-4by3">
				<map ng-transclude class="google-map" center="map.center" options="map.options" zoom="map.zoom">
					​<polylines coords="polylines.coords" options="polylines.options"></polylines>
				</map>
					<bicycling-layer></bicycling-layer>
				</ng-map>
			</div>

		</div>
	</div>

</div>

<footer class="footer">
	<?php require_once("php/template/footer.php"); ?>
</footer>

</body>
</html>
