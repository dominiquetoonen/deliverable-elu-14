<?php require "../bootstrap.php";

$bodyClasses = [
    'dashboard'
];
$styles = [
    HOME_URL . '/assets/css/bootstrap.min.css',
    HOME_URL . '/assets/css/style.css',
    'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto+Slab:300,400'
];
$scripts = [
    'https://use.fontawesome.com/2a318e150b.js'
];

echo CoreElement::header('Dashboard - Deliverable', $bodyClasses, $styles, $scripts);

session_start();
$companyProducts = [];
if (isset($_GET['id'])) {
    $productEan = $_GET['id'];
    $companyProducts = CompanyProduct::getAvaibleBy('product_id', $productEan);
}

foreach ($companyProducts as $key => $value) {
    $prImg = ProductImage::getImage($value['product_id']);
    $companyProducts[$key]['imagePath'] = $prImg[0]['path'];
}
?>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand before" href="<?=HOME_URL?>">
            <img src="<?= HOME_URL . "/assets/images/logo-light.png"; ?>" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <a href="/api/account.php?action=logout" class="btn btn-outline-success deliv mr-sm-2">UITLOGGEN</a>
        </div>
    </nav>

    <!-- /container -->
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-2">
                <!--TODO: zoekfilters-->
            </div>
            <div class="col-md-10">
                <h2>Producten</h2>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                         aria-labelledby="list-home-list">
                        <div class="row">
                            <?php foreach ($companyProducts as $key => $product): ?>
                                <div class="col-md-4">
                                    <div class="box-item">
                                        <a href="<?= HOME_URL . '/underConstruction.html' ?>">
                                            <img src="<?= $product['imagePath'] ?? '' ?>"
                                                 class="img-fill img-fill-grid"
                                                 alt="Responsive image">
                                            <p class="caption"><?= $product['price']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <?php include "../elements/profileUpdateForm.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo CoreElement::footer([], [
    HOME_URL . '/assets/js/functions.js'
]); ?>