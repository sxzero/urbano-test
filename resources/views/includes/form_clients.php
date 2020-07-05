<?php
/**
 * Template Part: Form Clients
 * 
 * Forms of Client.
 *
 */
?>

<a id="btn_new" class="btn btn-secondary my-3 mx-2" data-toggle="collapse" href="#new_client" role="button"
    aria-expanded="false" aria-controls="collapseExample">Nuevo Cliente</a>

<a id="btn_edit" class="btn btn-secondary my-3 mx-2" data-toggle="collapse" href="#update_client" role="button"
    aria-expanded="false" aria-controls="collapseExample">Editar Cliente</a>

<div class="row">
    <div id="new_client" class="collapse border m-auto col-12 col-md-5">
        <form id="frm_client" class="p-3" name="frm_client" method="POST">

            <div class="form-row">
                <?php include(views_path('includes/fields_form_clients.php')); ?>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Crear</button>
        </form>
    </div>

    <div id="update_client" class="collapse border m-auto col-12 col-md-5">
        <form id="frm_client_edit" class="p-3" name="frm_client_edit" method="POST">

            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="client_id">Cliente</label>
                    <select id="client_id" class="custom-select" name="client_id">
                        <option selected>Seleccione un cliente</option>
                    </select>
                </div>

                <?php include(views_path('includes/fields_form_clients.php')); ?>
            </div>

            <button type="submit" class="btn btn-success mb-2">Guardar</button>
        </form>
    </div>
</div>