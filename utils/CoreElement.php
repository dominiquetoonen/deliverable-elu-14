<?php

class CoreElement {

	/**
	 * @param string $title
	 * @param array $bodyClasses
	 * @param array $styles
	 * @param array $scripts
	 *
	 * @return string
	 */
	public static function header(string $title, array $bodyClasses = [], array $styles = [], array $scripts = [])
	{
		ob_start(); ?>

		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="">
			<title><?php echo $title; ?></title>
			<?php // Scripts
			foreach($scripts as $script) {
				echo "<script src=\"$script\" type=\"text/javascript\"></script>";
			}
			// Styles
			foreach($styles as $style) {
				echo "<link href=\"$style\" rel=\"stylesheet\">";
			} ?>
		</head>

		<body<?php echo empty($bodyClasses) ? '': ' class="' . implode(' ', $bodyClasses) . '"'; ?>>

		<?php $html = ob_get_clean();

		return $html;
	}

	/**
     * Website navigation bar
     *
	 * @param string $type
	 *
	 * @return string
	 */
	public static function navBar(string $type = 'light')
    {
        $logo = ($type === 'light') ? HOME_URL . '/assets/images/logo-light.png': HOME_URL . '/assets/images/logo-dark.png';
        $buttonStyle = ($type === 'light') ? 'deliv': 'deliv-dark';

	    ob_start(); ?>

        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand before" href="/">
                <img src="<?php echo $logo;?>" alt="Deliverable Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="btn btn-outline-success mr-sm-2 ml-auto <?php echo $buttonStyle; ?>" data-toggle="modal" data-target="#loginForm">AANMELDEN</button>
                <a href="underConstruction.html" class="btn btn-outline-success my-2 my-sm-0 <?php echo $buttonStyle; ?>" type="submit">MENU</a>
            </div>
        </nav>

        <?php $html = ob_get_clean();

        return $html;
    }

    public static function productOverview(array $products)
    {
        ob_start(); ?>

        <div class="products row">
            <?php
            /** @param object $product **/
            foreach($products as $product) { ?>
                <div class="col-sm-12 col-md-4">
                    <a class="product" href="<?php echo HOME_URL . '/Product.php?ean=' . $product->getEan(); ?>" title="<?php echo $product->getName(); ?>">
                        <h2 class="title"><?php echo $product->getName(); ?></h2>
                        <div class="img-container">
                            <img src="<?php echo $product->getFirstImage()->getPath(); ?>" title="<?php echo $product->getName(); ?>" alt="<?php echo $product->getName(); ?>">
                        </div>
                        <div class="price-container">
                            Vanaf <span class="from"><?php echo StringFormat::price($product->getMinPrice()); ?></span>
                            t/m <span class="till"><?php echo StringFormat::price($product->getMaxPrice()); ?></span>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>

        <?php $html = ob_get_clean();

        return $html;
    }

	/**
     * Website footer
     *
	 * @param array $styles
	 * @param array $scripts
	 *
	 * @return string
	 */
	public static function footer(array $styles = [], array $scripts = [])
	{
		ob_start(); ?>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Required scripts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

		<?php // Additional scripts
		foreach($scripts as $script) {
			echo "<script src=\"$script\" type=\"text/javascript\"></script>";
		}
		// Additional styles
		foreach($styles as $style) {
			echo "<link href=\"$style\" rel=\"stylesheet\">";
		} ?>

		<script>
            $(document).ready(function () {
                var scroll_start = 0;
                var startchange = $('#startchange');
                var offset = startchange.offset();
                if (startchange.length) {
                    $(document).scroll(function () {
                        scroll_start = $(this).scrollTop();
                        if (scroll_start > offset.top) {
                            $(".navbar").css('background-color', '#052F5F');
                        } else {
                            $('.navbar').css('background-color', 'transparent');
                        }
                    });
                }
            });
		</script>
		</body>

		</html>

		<?php $html = ob_get_clean();

		return $html;
	}

}