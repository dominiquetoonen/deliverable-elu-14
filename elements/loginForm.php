<?php
/**
 * LoginController form template
 */
?>
<div id="loginForm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <ul class="nav nav-tabs nav-fill" style="margin-bottom: -1px;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#loginBody" role="tab" aria-controls="login" aria-selected="true">Inloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#registerBody" role="tab" aria-controls="register" aria-selected="false">Registreren</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="loginBody" role="tabpanel" class="tab-pane modal-body active">
                    <h2 class="mb-4">Inloggen</h2>
                    <form id="loginForm" onsubmit="loginForm(this, event)">
                        <div class="form-group">
                            <label for="loginEmail">E-mailadres</label>
                            <input class="form-control" id="loginEmail" name="email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Wachtwoord</label>
                            <input class="form-control" id="loginPassword" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="rememberMe" id="rememberMe">
                            <label for="rememberMe">
                                <?php $days = LoginController::numDaysLongToken();
                                echo "Ingelogd blijven voor {$days} " . (($days > 1) ? "dagen.": "dag."); ?>
                            </label>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-primary" type="submit">Aanmelden</button>
                        </div>
                    </form>
                    <div class="loading" style="display: none;">
                        <i class="fa fa-spinner fa-pulse"></i>
                    </div>
                </div>
                <div id="registerBody" role="tabpanel" class="tab-pane modal-body">
                    <div id="registerFormContainer">
                        <h2 class="mb-3">Registreren</h2>
                        <div id="registerErrors" class="text-danger mb-3" style="display: none;"></div>
                        <p class="text-muted mb-3">
                            <small>Velden met een <span class="text-danger">*</span> zijn verplicht.</small>
                        </p>
                        <form id="registerForm" onsubmit="registrationForm(this, event)">
                            <div class="form-group">
                                <label for="firstName">Voornaam<span class="text-danger">*</span></label>
                                <input class="form-control" id="firstName" name="firstName" type="text" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label for="surNamePrefix">Tussenvoegsel</label>
                                    <input class="form-control" id="surNamePrefix" name="surNamePrefix" type="text">
                                </div>
                                <div class="col-sm-8 form-group">
                                    <label for="surName">Achternaam<span class="text-danger">*</span></label>
                                    <input class="form-control" id="surName" name="surName" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Geslacht<span class="text-danger">*</span></label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option>Selecteer uw geslacht</option>
                                    <?php foreach(Account::$genderOptions as $gender => $name) {
                                        echo "<option value='{$gender}'>{$name}</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefoonnummer</label>
                                <input class="form-control" id="phone" name="phone" type="tel">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobiel nummer</label>
                                <input class="form-control" id="mobile" name="mobile" type="tel">
                            </div>
                            <label for="email">E-mailadres<span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" id="email" name="email" type="email" placeholder="E-mailadres" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" id="repeatEmail" name="repeatEmail" type="email" placeholder="Herhaal e-mailadres" required>
                                </div>
                            </div>
                            <label for="password">Wachtwoord<span class="text-danger">*</span></label>
                            <div class="row mb-3">
                                <div class="form-group col-sm-6 mb-1">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Wachtwoord" required>
                                </div>
                                <div class="form-group col-sm-6 mb-1">
                                    <input class="form-control" id="repeatPassword" name="repeatPassword" type="password" placeholder="Herhaal wachtwoord" pattern=".{8,}" required>
                                </div>
                                <div class="col-sm-12">
                                    <small class="text-muted">Het wachtwoord moet minimaal 8 karakters bevatten.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="termsOfService" id="termsOfService" required>
                                <label for="termsOfService">Ik ga akkoord met de <a href="#TODO-link-to-terms-of-service" title="Algemene voorwaarden" target="_blank">Algemene voorwaarden</a></label>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit">Aanmelden</button>
                            </div>
                        </form>
                        <div class="loading" style="display: none;">
                            <i class="fa fa-spinner fa-pulse"></i>
                        </div>
                    </div>
                    <div id="registrationSuccess" style="display: none;">
                        <h2 class="mb-4">Registratie succesvol</h2>
                        <p>Bedankt<span id="setFirstName"></span>, je bent succesvol geregistreerd. Je kunt nu inloggen.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>