<?php
/**
 * Profile update form template
 */
?>
<div id="updateAccountForm">
    <div id="updateAccountBody">
        <div id="accountForm">
            <p>U kunt hier uw accountgegevens aanpassen. Velden met een <span class="text-danger">*</span> zijn
                verplicht.</p>
            <div id="updateAccountErrors" class="text-danger mb-3" style="display: none;"></div>
            <form onsubmit="updateAccountForm(this, event)">
                <div class="form-group">
                    <label for="firstName">Voornaam<span class="text-danger">*</span></label>
                    <input class="form-control" hidden id="accountId" name="accountId"
                           value="<?php echo $account->getId(); ?>">
                    <input class="form-control" id="firstName" name="firstName"
                           value="<?php echo $account->getFirstName(); ?>" type="text" required>
                </div>
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label for="surNamePrefix">Tussenvoegsel</label>
                        <input class="form-control" id="surNamePrefix"
                               value="<?php echo $account->getSurNamePrefix(); ?>" name="surNamePrefix" type="text">
                    </div>
                    <div class="col-sm-8 form-group">
                        <label for="surName">Achternaam<span class="text-danger">*</span></label>
                        <input class="form-control" id="surName" value="<?php echo $account->getSurName(); ?>"
                               name="surName" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender">Geslacht<span class="text-danger">*</span></label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option>Selecteer uw geslacht</option>
                        <?php foreach (Account::$genderOptions as $gender => $name) {
                            $selected = "";

                            if ($account->getGender() === $gender) {
                                $selected = " selected=\"selected\"";
                            }
                            echo "<option value='{$gender}' {$selected}>{$name}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Telefoonnummer</label>
                    <input class="form-control" id="phone" value="<?php echo $account->getPhone(); ?>" name="phone"
                           type="tel">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobiel nummer</label>
                    <input class="form-control" id="mobile" value="<?php echo $account->getMobile(); ?>" name="mobile"
                           type="tel">
                </div>
                <label for="email">E-mailadres<span class="text-danger">*</span></label>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <input class="form-control" id="email" name="email" value="<?php echo $account->getEmail(); ?>"
                               type="email" placeholder="E-mailadres" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <input class="form-control" id="repeatEmail" name="repeatEmail"
                               value="<?php echo $account->getEmail(); ?>" type="email"
                               placeholder="Herhaal e-mailadres" required>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary" type="submit">Update accountgegevens</button>
                </div>
            </form>
        </div>
        <div id="registrationSuccess" style="display: none;">
            <p class="alert-success">Accountgegevens succesvol geüpdatet</p>
        </div>
    </div>
</div>