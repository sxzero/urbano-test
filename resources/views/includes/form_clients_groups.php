<?php
/**
 * Template Part: Form Clients Groups
 * 
 * Forms of Client Groups.
 *
 */
?>

<div class="col-12">
    <a class="btn btn-secondary my-3 mx-2" data-toggle="collapse" href="#new_client_group" role="button"
        aria-expanded="false" aria-controls="collapseExample">Nuevo Grupo</a>

    <a id="btn_edit" class="btn btn-secondary my-3 mx-2" data-toggle="collapse" href="#update_client_group"
        role="button" aria-expanded="false" aria-controls="collapseExample">Editar Grupo</a>
</div>

<div class="col-12 col-md-6">
    <div id="new_client_group" class="collapse border my-2">
        <form id="frm_client_group" class="p-3" name="frm_client_group" method="POST" action="/api/v1/client-groups">
            <div class="form-row">
                <?php include(views_path('includes/fields_clients_groups.php')); ?>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Crear</button>
        </form>
    </div>
</div>

<div class="col-12 col-md-6">
    <div id="update_client_group" class="collapse border my-2">
        <form id="frm_client_group_edit" class="p-3" name="frm_client_group_edit" method="POST">
            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="group_id">Grupo</label>
                    <select id="group_id" class="custom-select" name="group_id">
                        <option selected>Seleccione un grupo</option>
                    </select>
                </div>

                <?php include(views_path('includes/fields_clients_groups.php')); ?>
            </div>
            <button type="submit" class="btn btn-success mb-2">Guardar</button>
        </form>
    </div>
</div>