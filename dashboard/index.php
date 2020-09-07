<?php require "../bootstrap.php";

$account = LoginController::check();

if(!$account) {
	header("Location: " . HOME_URL);
}

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

echo CoreElement::header('Dashboard - Deliverable', $bodyClasses, $styles, $scripts); ?>

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

    <!-- /container -->
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" href="<?php echo HOME_URL; ?>/dashboard/index.php" role="tab" aria-controls="home">Profiel</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profiel bewerken</a>
                    <a class="list-group-item list-group-item-action" id="list-home-list" href="<?php echo HOME_URL; ?>/dashboard/products/index.php" role="tab" aria-controls="home">Producten beheren</a>
                </div>
            </div>
            <div class="col-md-8">
                <h2>Deliverable dashboard</h2>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <p>De onderstaande gegevens zijn opgegeven in het registratieproces van je account. Wil je de gegevens wijzigen? Klik dan op "Profiel bewerken" in het linker menu.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Voornaam</td>
                                    <td><?php echo $account->getFirstName(); ?></td>
                                </tr>
                                <tr>
                                    <td>Tussenvoegsel</td>
                                    <td>
                                        <?php
                                            if($account->getSurNamePrefix() == "") {
                                                echo "N.v.t";
                                            }  else {
                                                echo $account->getSurNamePrefix();
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Achternaam</td>
                                    <td><?php echo $account->getSurName(); ?></td>
                                </tr>
                                <tr>
                                    <td>Geslacht</td>
                                    <td>
                                        <?php echo Account::$genderOptions[$account->getGender()]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telefoonnummer</td>
                                    <td>
                                        <?php
                                        if($account->getPhone() == "") {
                                            echo "N.v.t";
                                        }  else {
                                            echo "0" . $account->getPhone();
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobiel nummer</td>
                                    <td>
                                        <?php
                                        if($account->getMobile() == "") {
                                            echo "N.v.t";
                                        }  else {
                                            echo "0" . $account->getMobile();
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-mailadres</td>
                                    <td><?php echo $account->getEmail(); ?></td>
                                </tr>
                            </table>
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