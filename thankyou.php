<?php 
session_start();

$sendername=$_POST['sendername'];
$emailaddress=$_POST['emailaddress'];
$senderphone=$_POST['phone'];
$sendercp=$_POST['cp'];
$senderservice=$_POST['senderservice'];
$sendermessage=$_POST['sendermessage'];



    $to = "urbancleansanluis@gmail.com";
//$to = "redoxz811@gmail.com"; 
    $receiver_subject = "Tienes una nueva Cotizacion Servicio por Correo - Anana";
    
    $message=" De parte de:'.$sendername.' Correo:'.$emailaddress.' Telefono: '.$senderphone.' Codigo Postal: '$sendercp.' Servicio: '.$senderservice.' Mensaje:'.$sendermessage.' ";
    
    $headers = "De:" . $emailaddress;
    $headers2 = "Para:" . $to;
    
    mail($to,$receiver_subject,$message,$headers);
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Urban Clean SLP - Thank You Page</title>
    <!-- Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <link href="linearicons/fonts.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#landingkit-navbar" data-offset="74">
    <div id="preloader">
        <div id="preloader-inner"></div>
    </div>
    <!--/preloader-->

    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                    <img src="images/logoUrbanCleanWeb.png" alt="">
                </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#landingkit-navbar" aria-controls="landingkit-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="landingkit-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" data-scroll href="#home"> <span class="sr-only"></span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#features"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#why"> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#faqs"></a>
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto navbar-right">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" target="_blank" href="https://www.facebook.com/pg/urbancleanslp/photos/?ref=page_internal">CONTÁCTANOS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div id="home" class=" parallax-hero" data-jarallax='{"speed": 0.2}' style='background-image: url("images/bg1.jpg")'>
        <div class="parallax-overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pb50">
                    <h5 class="text-white font400 text-uppercase">TU CODIGÓ: DESC-ANANA</h5>
                    <h3 class="mb20 text-white title-font text-capitalize h1">GRACIAS POR DEJARNOS TUS DATOS.</h3>
                    <p class="text-white-gray mb30 lead">
                        Pronto alguien de Urban Clean se pondra en contacto contigo <strong><?php echo $_session['sendername'];?></strong>
                    </p>
                   
                </div>

            </div>
        </div>
    </div>


    <!--main-content-->

    <footer class="footer">
        <div class="container">

            <div class="row align-items-end">

                <div class="col-lg-8 text-right">
                    <div class="row">
                        <div class="col-lg-4 mb20">
                            <h5 class=" mb20">Regálanos una llamada</h5>
                            <p class="lead"> 4444083381</p>
                        </div>
                        <div class="col-lg-4 mb20">
                            <h5 class=" mb20">Mandanos un correo</h5>
                            <p class="lead">covalia@urbanclean.mx</p>
                        </div>

                    </div>


                    <ul class="list-inline pb20">
                        <li class="list-inline-item">
                            <a href="#">Plaza Covalia Local 108</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">Real de Lomas 350 Lomas 4ta Sección</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">Terminos & condiciones</a>
                        </li>
                        <li class="list-inline-item">
                            Pagina hecha por <a href="http://www.anana.mx/" target="_blank">Ananá</a> &copy; Derechos reservados 2018.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--back to top-->
    <a href="#" class="back-to-top" id="back-to-top"><i class="icon-chevron-up"></i></a>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script type="text/javascript" src="js/plugins/plugins.js"></script>
    <!--tweet-scroller-->
    <script src="tweetie/tweetie.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/landing.custom.js"></script>
        <!--smart-form script-->
        <script src="smart-form/contact/js/jquery.form.min.js" type="text/javascript"></script>
        <script src="smart-form/contact/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="smart-form/contact/js/additional-methods.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="smart-form/contact/js/smart-form.js"></script> 
</body>

</html>
