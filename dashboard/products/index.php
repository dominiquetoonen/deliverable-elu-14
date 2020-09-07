<?php require "../../bootstrap.php";

$account = LoginController::check();

if(!$account) {
	header("Location: " . HOME_URL);
}

//create product
$product = new Product();

$allProducts = $product->getAll();

// var_dump($allProducts);

$bodyClasses = [
	'dashboard'
];
$styles = [
	HOME_URL . '/assets/css/bootstrap.min.css',
    HOME_URL . '/assets/css/style.css',
    'https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css',
    'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Roboto+Slab:300,400'
];
$scripts = [
    'https://use.fontawesome.com/2a318e150b.js',
];

echo CoreElement::header('Manage products - Deliverable', $bodyClasses, $styles, $scripts); ?>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand before" href="<?php echo HOME_URL; ?>">
            <img src="<?php echo HOME_URL . "/assets/images/logo-light.png"; ?>" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <a href="/api/account.php?action=logout" class="btn btn-outline-success deliv mr-sm-2">UITLOGGEN</a>
        </div>
    </nav>

    <div class="container" style="margin-top: 150px;">
        <a href="<?php echo HOME_URL . "/dashboard/index.php"; ?>">Terug naar dashboard</a>
        <h2>Producten beheren</h2>
        <table id="productTable" class="display">
            <thead>
                <tr>
                    <th>EAN</th>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allProducts as $product) : ?>
                    <tr>
                        <td><a href="product.php?ean=<?php echo $product['ean'] ?>"><?php echo $product['ean']; ?></a></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php echo CoreElement::footer([], [
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
    'https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js',
    HOME_URL . '/assets/js/functions.js'
]); ?>