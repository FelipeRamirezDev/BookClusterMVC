<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/img/logo.png">
        <title>BookCluster</title>
        <link rel="stylesheet" href="/css/styles.min.css">
    </head>
    <body>
        
        <div class="main-app">
            <?php 
            session_start();
            if(isset($_SESSION['login'])) {
                include_once __DIR__ .  "/partials/header-logged.php";
            } else {
                include_once __DIR__ .  "/partials/header.php";
            }
            ?>
            
            <!-- contenido de las vistas -->
            <?php echo $content ?>
            
            <?php include_once __DIR__ .  "/partials/footer.php"; ?>
        </div>
        
        <script src="/js/bundle.min.js"></script>
    </body>
</html>