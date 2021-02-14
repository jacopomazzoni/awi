<?php
 /* Main header Code */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo esc_url( get_template_directory_uri() );?>/assets/js/fadeout.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() );?>/assets/js/fittext.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() );?>/assets/jquery/jquery-3.5.1.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() );?>/assets/bootstrap-4.6.0-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() );?>/assets/bootstrap-4.6.0-dist/css/bootstrap.css" type='text/css'>
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() );?>/assets/css/typography.css" type='text/css'>




<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <main class="container-fluid m-0 p-0">
        <div id="overlay"></div>
        <div class="row m-0">
            <nav id="menu" class="col-md-3 m-0 navbar-light navbar-expand-md">
                <a id="site-title" class="navbar-brand impact" href="<?php echo esc_url(home_url()); ?>">ART WORKERS ITALIA</a>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon custom-toggler"></span>
                </button>
                <div class="navbar-left collapse navbar-collapse text-align-left" id="navbarsExampleDefault">
                    <?php
                        wp_nav_menu($arg = array(
                            'menu_class' => 'nav-link',
                            'container' => false,
                            'theme_location' => 'primary'
                        ));
                    ?>
<!--                     <a class="nav-link active" href="#">About</a>
                    <a class="nav-link sub-1" href="#">Chi Siamo</a>
                    <a class="nav-link sub-1" href="#">Cosa Facciamo</a>
                    <a class="nav-link sub-1" href="#">Manifesto</a>
                    <a class="nav-link" href="#">Tools</a>
                    <a class="nav-link sub-1" href="#">Indagine Di Settore</a>
                    <a class="nav-link sub-1" href="#">Toolbox</a>
                    <a class="nav-link sub-2" href="#">Intro Schede “How To”</a>
                    <a class="nav-link sub-2" href="#">Intro Modelli Contratti</a>
                    <a class="nav-link sub-2" href="#">Intro Tariffario</a>
                    <a class="nav-link sub-1" href="#">Codice Etico Per Istituzioni</a>
                    <a class="nav-link sub-1" href="#">Modelli Internazionali</a>
                    <a class="nav-link" href="#">Hyperunionisation</a>
                    <a class="nav-link sub-1" href="#">Programma</a>
                    <a class="nav-link sub-1" href="#">Hypermates</a>
                    <a class="nav-link" href="#">News</a>
                    <a class="nav-link sub-1" href="#">Cosa Abbiamo Fatto Ad Oggi</a>
                    <a class="nav-linksub-1" href="#">Rassegna Stampa</a>
                    <a class="nav-link" href="#">Get Involved</a>
                    <a class="nav-link sub-1" href="#">Se Sei Un Art Worker</a>
                    <a class="nav-link sub-1" href="#">Se Sei Un’istituzione</a>
                    <a class="nav-link sub-1" href="#">Se Sei Un Policymaker</a>
                    <a class="nav-link" href="#">Dona Ad Awi</a> -->
                </div>
            </nav>