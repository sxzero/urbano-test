<?php
/**
 * Template part: Navigation
 * 
 * Main navigation.
 * 
 */
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Urbano Exercises</a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbar" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/home" data-load="none">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/clients" data-load="/clients">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/clients-groups" data-load="/client-groups">Grupos de clientes</a>
            </li>
            
        </ul>
    </div>
</nav>