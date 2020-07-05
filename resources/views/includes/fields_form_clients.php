<?php
/**
 * Template Part: Fields Form Clients
 * 
 * Fields for Form Clients.
 *
 */
?>
<div class="form-group col-12 col-md-6">
    <label for="client_name">Nombre</label>
    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Nombre" required>
</div>

<div class="form-group col-12 col-md-6">
    <label for="client_name">Apellido</label>
    <input type="text" class="form-control" id="client_lastname" name="client_lastname" placeholder="Apellido" required>
</div>

<div class="form-group col-12 col-md-6">
    <label for="client_name">Email</label>
    <input type="email" class="form-control" id="client_email" name="client_email" placeholder="Email" required>
</div>

<div class="form-group col-12 col-md-6">
    <label for="client_group_id">Grupo</label>
    <select id="client_group_id" class="custom-select" name="client_group_id">
        <option selected>Seleccione un grupo</option>
    </select>
</div>
