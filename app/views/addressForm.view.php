<?php require('partials/head.php'); ?>
<main class="container pt-3">
    <h1>Address Form</h1>

    <div class="row">
        <form action="/addresses" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address2" name="address2"
                               placeholder="#12 Street Way" required>
                        <label for="address2">Address Line 1</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="SUITE K">
                        <label for="address1">Address Line 2</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="zip5"
                                        name="zip5"
                                        maxlength="5"
                                        placeholder="12345"
                                        pattern="[0-9]{5}"
                                        required>
                                <label for="zip5">Zip Code</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="zip4"
                                        name="zip4"
                                        maxlength="4"
                                        placeholder="1234"
                                        pattern="[0-9]"
                                />
                                <label for="zip5">----</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="city" name="city"
                               placeholder="RANCHO SANTA MARGARITA">
                        <label for="city">City</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="state" name="state" placeholder="CA">
                        <label for="state">State</label>
                    </div>
                </div>
                <div class="col" id="validationBox">
                    Validate
                </div>
            </div>

            <div>
                <button class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

<script>
    $(function(){
const url = "http://production.shippingapis.com/ShippingAPITest.dll?API=Verify&XML=%3CAddressValidateRequest+USERID%3D%22674PERSO4317%22%3E%0D%0A%3CRevision%3E1%3C%2FRevision%3E%0D%0A%3CAddress+ID%3D%220%22%3E%0D%0A%3CAddress1%3ESUITE+K%3C%2FAddress1%3E%0D%0A%3CAddress2%3E29851+Aventura%3C%2FAddress2%3E%0D%0A%3CCity%2F%3E%0D%0A%3CState%3ECA%3C%2FState%3E%0D%0A%3CZip5%3E92688%3C%2FZip5%3E%0D%0A%3CZip4%2F%3E%0D%0A%3C%2FAddress%3E%0D%0A%3C%2FAddressValidateRequest%3E";
        $.get(url, function(data, status){
            console.log("Data: " ,data,"\nStatus: " + status);
        });

    });
</script>
<?php require('partials/footer.php'); ?>
