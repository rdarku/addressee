<?php require('partials/head.php'); ?>
<main class="container pt-3">
    <div class="d-flex justify-content-between mb-3">
        <h1>Address Form</h1>
        <div class="p-2">
            <a href="/" class="btn btn-secondary"> &leftarrow; Back to Address</a>
        </div>
    </div>
    

    <div class="row">

        <form action="/addresses" method="POST" id="addressForm">
            <div class="row" id="visibleFields">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address2" name="address2"
                               placeholder="#12 Street Way" required>
                        <label for="address2">Address Line 1
                            <sstrong class="text-danger">*</sstrong>
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="SUITE K">
                        <label for="address1">Address Line 2</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="city" name="city"
                               placeholder="RANCHO SANTA MARGARITA"/>
                        <label for="city">City</label>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-md mb-3"
                                        aria-label=".form-select-lg example"
                                        id="state" name="state"
                                >
                                    <option selected>Choose the State</option>
									<?php foreach ($states as $state): ?>
                                        <option value="<?= $state->code; ?>"><?= $state->name; ?></option>
									<?php endforeach; ?>
                                </select>
                                <label for="state">State</label>
                            </div>
                        </div>
                        <div class="col row p-0 m-0">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text"
                                           class="form-control"
                                           id="zip5"
                                           name="zip5"
                                           maxlength="5"
                                           placeholder="12345"
                                           pattern="[0-9]{5}"
                                           required/>
                                    <label for="zip5">Zip Code
                                        <sstrong class="text-danger">*</sstrong>
                                    </label>
                                </div>
                            </div>
                            <div class="d-none d-sm-flex col-1 align-items-center justify-content-center mb-3 mx-0">
                                &dash;
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text"
                                           class="form-control"
                                           id="zip4"
                                           name="zip4"
                                           maxlength="4"
                                           placeholder="1234"
                                           pattern="[0-9]{4}"/>
                                    <label for="zip5">----</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3" id="validated">
                </div>
            </div>
            <div id="hiddenFields"></div>
            <div id="actionButtons" class="d-grid gap-2"></div>
        </form>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

<script src="/app/scripts/addressForm.js"></script>

<?php require('partials/footer.php'); ?>
