<?php require('partials/head.php');?>
<main class="container pt-3">
    <h1>Addresses</h1>

    <div class="p-2">
        <a href="/newAddress" class="btn btn-primary">Add An Address</a>
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
                <td><address><?=$address->address2 ?><br/><?=$address->address1 ?></address></td>
                <td><?=$address->state ?></td>
                <td><?=$address->city?></td>
                <td>Details | Edit | Delete</td>
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