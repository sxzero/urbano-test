<?php
/**
 * Template Part: Search Form Clients
 *
 */
?>

<div class="col-md-6 box">
    <form id="search_form" class="mt-3">
        <div class="form-row">
            <div class="form-group col-6 col-md-6">
                <label for="client_search_name">Nombre</label>
                <input class="form-control" type="text" name="client_search_name" placeholder="Nombre">
            </div>
            <div class="form-group col-6 col-md-6">
            <label for="client_search_lastname">Apellido</label>
                <input class="form-control" type="text" name="client_search_lastname" placeholder="Apellido" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6 col-md-6">
            <label for="client_search_email">Email</label>
                <input class="form-control mr-sm-2" type="email" name="client_search_email" placeholder="Email" >
            </div>
            
            <div class="form-group col-6 col-md-6">
                <label for="client_search_group_id">Grupo</label>
                <select id="client_search_group_id" class="custom-select" name="client_search_group_id">
                    <option selected>Seleccionar</option>
                </select>
            </div>
        </div>
    
        <button class="btn btn-outline-success" type="submit" title="Buscar">Buscar</button>
    </form>
</div>