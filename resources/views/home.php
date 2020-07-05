<?php
/**
 * Page: Home
 * 
 * Homepage, index template.
 * 
 * Avalible render params:
 * 
 * ---
 * @uses includes/header.php
 * @uses includes/navigation.php
 * @uses includes/footer.php
 */
?>
<!DOCTYPE html>
<html class="h-100" lang="es">
<?php require_once(views_path("includes/header.php")); ?>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once(views_path("includes/navigation.php")); ?>
        <?php require_once(views_path("includes/alerts.php")); ?>
    </header>
    <section class="container">
        <main id="app" class="flex-shrink-0" role="main">
            <?php require_once(views_path("pages/home.php")); ?>
        </main>
    </section>
    <?php require_once(views_path("includes/footer.php")); ?>
</body>

</html>