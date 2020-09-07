<?php require "../../bootstrap.php";

$account = LoginController::check();

if(!$account) {
	header("Location: " . HOME_URL);
}

$ean = $_GET['ean'];

$product = new Product();
$product->get($ean);

$compayProduct = new CompanyProduct();
$compayProduct = $compayProduct->getBy("product_id", $ean);

// $products = $category->getProducts();

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
        <a href="<?php echo HOME_URL . "/dashboard/products/index.php"; ?>">Terug naar producten overzicht</a>
        <form id="updateProductForm" onsubmit="productForm(this, event)">
            <div style="padding-bottom: 24px;">
                <h2 style="display: inline-block;">Product</h2><button class="btn btn-outline-dark pull-right" type="submit">Wijzigingen opslaan</button>   
                <div id="productErrors" class="text-danger mb-3" style="display: none;"></div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">EAN</th>
                        <td><input id="productEanInput" class="form-control" style="pointer-events: none; background: #ccc; color: white;" name="ean" value="<?php echo $product->getEan(); ?>"></input></td>
                    </tr>
                    <tr>
                        <th scope="row">Naam</th>
                        <td><input id="productNameInput" class="form-control" name="name" value="<?php echo $product->getName(); ?>"></input></td>
                    </tr>
                    <tr>
                        <th scope="row">Beschrijving</th>
                        <td>
                            <textarea id="productDescriptionInput" rows="5" class="form-control" name="description"><?php echo $product->getDescription(); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <h2>Geadverteerde producten</h2>
        <p>Producten geadverteerd door bedrijven</p>
        <table id="productTable" class="display">
            <thead>
                <tr>
                    <th>Bedrijf</th>
                    <th>Prijs</th>
                    <th>Status</th>
                    <th>Voorraad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compayProduct as $product) : ?>
                    <tr>
                        <td><?php echo $product['company_id']; ?></a></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['status']; ?></td>
                        <td><?php echo $product['instock']; ?></td>
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