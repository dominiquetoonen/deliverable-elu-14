<?php require "bootstrap.php";

$bodyClasses = [
	'homepage'
];
$styles = [
	HOME_URL . '/assets/css/bootstrap.min.css',
	HOME_URL . '/assets/css/style.css',
	'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto+Slab:300,400'
];
$scripts = [
    'https://use.fontawesome.com/2a318e150b.js'
];

echo CoreElement::header('Deliverable', $bodyClasses, $styles, $scripts); ?>

    <?php include "elements/loginForm.php"; ?>

    <?php echo CoreElement::navBar(); ?>

    <div id="fb-root"></div>
    <div class="jumbotron d-flex flex-column">
        <div class="intro-container align-self-center">
            <div class="d-flex flex-column">
                <h1>
                    <span class="splash-text">Vind jouw producten</span>
                </h1>
                <h3>
                    <span class="splash-text">Daarna laten bezorgen of direct ophalen!</span>
                </h3>
            </div>
            <div class="d-flex flex-row">
                <form action="api/search.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12 form-row">
                            <input type="text" name="searchtag" class="col-md-9" id="text" placeholder="Zoek je product">
                            <button type="submit" class="btn btn-primary align-self-center col-md-3">ZOEKEN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="promotion-container" id="startchange">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-276583.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Design bank</h4>
                            <p class="caption"> €899,99</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-346767.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Polkadot rugzak</h4>
                            <p class="caption"> €59,49</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-350417.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Handgemaakte lepels</h4>
                            <p class="caption"> €13,49</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row pt-2 pb-5">
                <div class="col-md-12 offset-md-2 text-center">
                    <h3 class="footnote">Wat is Deliverable?</h3>
                    <p>Met Deliverable kun je het artikel vinden wat je zoekt, direct zien waar je het in jouw buurt kunt vinden
                        en vergelijken met andere aanbieders. Je kunt het dan direct zelf ophalen in de winkel, zodat je
                        het meteen in huis hebt. Lukt het je niet om het zelf op te halen, of heb je daar gewoon geen zin
                        in, dan kun je ook gebruik maken van de bezorgservice.</p>
                    <h4 class="mt-4 mb-4">Wat vind je bij Deliverble?</h4>
                    <p>Alles wat je maar kunt bedenken! Kleding, boeken, games, laptops, meubels, levensmiddelen, accessoires
                        voor in huis, sieraden, cosmetica, schoonmaakmiddelen, sportartikelen, keukengerei, gereedschap en
                        noem maar op.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" style="padding: 0;">
                    <div class="col-md-12">
                        <div class="box-item-big">
                            <a href="underConstruction.html">
                                <img src="assets/images/product/pexels-photo-324028.jpg" class="img-fill" alt="Responsive image">
                                <h4 class="caption">Espresso kopjes (set 4 stuks)</h4>
                                <p class="caption"> €27,50</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 hidden-md-down">
                        <div class="box-item-big">
                            <a href="underConstruction.html">
                                <img src="assets/images/stappen.png" class="img-fill" alt="Responsive image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a href="underConstruction.html">
                        <img src="assets/images/product/pexels-photo-212289.jpg" class="img-fill" alt="Responsive image">
                        <h4 class="caption-app">Download onze App voor Android en iOS</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="recruitment-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pb-5">
                    <h3 class="footnote">Werk met ons samen</h3>
                    <p>Ben je ondernemer en heb je een winkel? Via Deliverable creëer je een groter bereik en komt jouw aanbod
                        terecht bij de klant die op zoek is naar juist dát product! We komen graag bij je langs om onze werkwijze
                        toe te lichten.</p>
                </div>
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-375889.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Winkeliers</h4>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-541523.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Vacatures</h4>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-item">
                        <a href="underConstruction.html">
                            <img src="assets/images/product/pexels-photo-350417.jpg" class="img-fill" alt="Responsive image">
                            <h4 class="caption">Word bezorger!</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container hyperlinks-container">
            <div class="col-md-3 col-sm-12">
                <h5>Algemene links</h5>
                <ul>
                    <li>
                        <a href="underConstruction.html">Klantenservice</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Winkel aanmelden</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Vacatures</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Word bezorger</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Algemene voorwaarden</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Privacy statements</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Cookieverklaring</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12">
                <h5>Nieuwe winkels</h5>
                <ul>
                    <li>
                        <a href="underConstruction.html">Open32</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Omoda</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Hunkemöller</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Van Donzel</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Blokker</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Goosens</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">HoutBrox</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Jysk</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12">
                <h5>Populaire categoriën</h5>
                <ul>
                    <li>
                        <a href="underConstruction.html">Meubels</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Mode</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Fietsen</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Speelgoed</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Elektronica</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Huisdieren</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12">
                <h5>Contact</h5>
                <p>
                    Hogeschoollaan 1
                    <br> 4818 CR Breda
                </p>
                <p>
                    Telefoon:
                    <a href="tel:+31881234567">088 123 45 67</a>
                    <br> Email: info@deliverable.dev
                </p>
                <ul>
                    <li>
                        <a href="underConstruction.html">Facebook</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Twitter</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Google+</a>
                    </li>
                    <li>
                        <a href="underConstruction.html">Youtube</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="footer-bar text-center">
            <p>&copy; Deliverable - Afbeeldingen
                <a href="https://www.pexels.com/">Pexels</a>
            </p>
        </div>
    </footer>

    </div>
    <!-- /container -->

<?php echo CoreElement::footer([], [
    HOME_URL . '/assets/js/functions.js'
]); ?>