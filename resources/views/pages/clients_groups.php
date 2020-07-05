<?php
/**
 * Page: Clients Groups
 * 
 * Main Clients Groups page template.
 *
 */
?>

<div class="row client_group">
    <div class="col-12 text-center">
        <h1 class="mt-4">Grupos de Clientes</h1>
    </div>

    <?php require_once(views_path('includes/form_search.php')); ?>

    <div id="tbl_client_group" class="table-responsive mt-3 col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="column">ID</th>
                    <th scope="column">Nombre</th>
                    <th scope="column"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <?php require_once(views_path("includes/form_clients_groups.php")); ?>

</div>