<?php
/**
 * Page: Clients
 * 
 * Main Clients page template.
 *
 */
?>
<div class="row client">
    <div class="col-12 text-center">
        <h1 class="mt-4">Clientes</h1>
    </div>

    <?php require_once(views_path('includes/form_search_clients.php')); ?>

    <div id="tbl_client" class="table-responsive mt-4 col-md-6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="column">ID</th>
                    <th scope="column">Nombre</th>
                    <th scope="column">Apellido</th>
                    <th scope="column">Email</th>
                    <th scope="column">Grupo</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="col-12 text-center">
        <?php require_once(views_path("includes/form_clients.php")); ?>
    </div>
</div>