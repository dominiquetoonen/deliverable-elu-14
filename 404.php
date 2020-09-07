<?php
header("HTTP/1.0 404 Not Found");
require "bootstrap.php";

$bodyClasses = [
	'page-404'
];
$styles = [
	HOME_URL . '/assets/css/bootstrap.min.css',
	HOME_URL . '/assets/css/style.css',
	'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto+Slab:300,400'
];
$scripts = [
	'https://use.fontawesome.com/2a318e150b.js'
];

echo CoreElement::header('Deliverable', $bodyClasses, $styles, $scripts);

echo CoreElement::navBar('dark');

?>

	<main class="content">
		<div class="container text-center mt-5 pt-5">
			<h1>Helaas, deze pagina bestaat niet!</h1>
		</div>
	</main>

<?php

echo CoreElement::footer([], [
	HOME_URL . '/assets/js/functions.js'
]);
