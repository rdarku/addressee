<?php require('partials/head.php');?>
<main class="container pt-3">
    <div class="d-flex justify-content-between mb-3">
        <h1>Addresses</h1>

        <div class="p-2">
            <a href="/newAddress" class="btn btn-primary"> &plus; Add An Address</a>
        </div>
    </div>
    
    <?php if(count($addresses) > 0): ?>
    <table class="table">
        <thead>
        <tr>
            <th>Address</th>
            <th>State</th>
            <th>City</th>
            <th></th>
        </tr>
        <?php foreach ($addresses as $address): ?>
            <tr>
                <td><?=$address->address2 ?> <br> <?=$address->address1 ?></td>
                <td><?=$address->state ?></td>
                <td><?=$address->city?></td>
                <td>
                    <a href="#" class="btn btn-link">Details</a>
                    <a href="#" class="btn btn-link">Edit</a>
                    <a href="#" class="btn btn-link">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
        </thead>
    </table>

<?php else: ?>
    <div>
        NO records
    </div>

<?php endif; ?>
</main>


<?php require('partials/footer.php'); ?>