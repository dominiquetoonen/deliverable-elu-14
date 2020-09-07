<?php require "bootstrap.php";

$categoryId = $_GET['id'];

if(!is_numeric($categoryId)) {
	require "404.php";
	exit;
}

$category = new ProductCategory();
$category->get($categoryId);

if(!$category->getId()) {
	require "404.php";
	exit;
}

$category->setFilters($_GET['attr']);

$products = $category->getProducts();
$attributes = $category->getAttributes();

$bodyClasses = [
	'category',
	"category-{$category->getId()}"
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

echo CoreElement::navBar('dark'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <form class="product-filter" method="get">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($category->getId(), ENT_QUOTES); ?>" />
                <h3>Filter producten</h3>
                <?php foreach($attributes as $attributeCat) { ?>
                    <h4 class="filter-category-title"><?php echo $attributeCat['name']; ?></h4>
                    <div class="filters">
                        <?php foreach($attributeCat['values'] as $attribute) {
	                        $checked = false;
	                        if(in_array($attribute['value'], $category->getFilters()[$attributeCat['id']])) {
                                $checked = true;
                            } ?>
                            <label><input type="checkbox"
                                          name="attr[<?php echo $attributeCat['id']; ?>][]"
                                          value="<?php echo $attribute['value']; ?>" <?php echo ($checked) ? 'checked="checked"': ''; ?>>
                                <?php echo $attribute['value'] ?>
                            </label>
                        <?php } ?>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary">Toepassen</button>
            </form>
        </div>
        <div class="col-sm-12 col-md-9">
	        <?php echo CoreElement::productOverview($products); ?>
        </div>
    </div>
</div>

<?php echo CoreElement::footer([], [
	HOME_URL . '/assets/js/functions.js'
]);
