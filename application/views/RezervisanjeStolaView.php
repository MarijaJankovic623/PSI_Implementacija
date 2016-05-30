<!--Marija Jankovic-->
<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--[if lt IE 9]> 
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>Restooking - It's restaurants and booking.</title>
        <meta name="description" content="">
        <meta name="author" content="Marija Jankovic">
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        <!--[if lte IE 8]>
                        <script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
                <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/isotope.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>flexslider/flexslider.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>js/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css" />
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>font/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/lightbox.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>/ss/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>/ss/bootstrap.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <header class="header">
            <div class="container">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        <a href="#" class="navbar-brand scroll-top logo  animated bounceInLeft"><b><i>Restooking</i></b></a> 
                    </div>
                    <!--/.navbar-header-->
                    <div id="main-nav" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav" id="mainNav">
                            <li><a href="<?php echo base_url() . 'index.php/PrelistavanjeRestoranaCtrl'; ?>" class="scroll-link">Prelistavanje restorana</a></li>
                            <li><a href="<?php echo base_url() . 'index.php/EditovanjeNalogaCtrl'; ?>" class="scroll-link">Izmena naloga</a></li>
                            <li><a href="<?php echo base_url() . 'index.php/PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl'; ?>" class="scroll-link">Moje rezervacije</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/EditovanjeNalogaCtrl/profileUser" class="scroll-link">Moj profil</a></li>
                            <li><a href="<?php echo base_url() . 'index.php/LogoutCtrl'; ?>" class="scroll-link">Izloguj se </a></li>
                        </ul>
                    </div>
                    <!--/.navbar-collapse--> 
                </nav>
                <!--/.navbar--> 
            </div>
            <!--/.container--> 
        </header>
        <!--/.header-->
        <div id="#top"></div>
        <section id="home">
            <div class="banner-container"> 
                <!-- Slider -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" > 
                            <img src="<?php echo base_url(); ?>images/slides/1.jpg" alt="Chania">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>images/slides/2.jpg" alt="Chania">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>images/slides/3.jpg" alt="Flower">
                        </div>
                    </div>
                </div>
                <!-- end slider -->
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <form action="<?php echo base_url() . 'index.php/RezervisanjeStolaCtrl/rezervisi/' . $restoran['IDRestoran']; ?>" method="POST" role="form">
                            <div class="control-group">
                                <label class="control-label">Odaberite vreme i datum od:</label>
                                <div class="controls input-append date form_datetime" data-date="2016-01-01T05:25:07Z" data-date-format="yyyy-mm-dd  hh:ii " data-link-field="dtp_input1">
                                    <input size="16" type="text" value="" readonly name="vremeOd">
                                    <span class="add-on"><i class="icon-remove"></i></span>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                                <input type="hidden" id="dtp_input1" value="" /><br/>
                            </div> 
                            <div class="control-group">
                                <label class="control-label">Odaberite vreme i datum do:</label>
                                <div class="controls input-append date form_datetime" data-date="2016-09-16T05:25:07Z" data-date-format="yyyy-mm-dd  hh:ii " data-link-field="dtp_input1">
                                    <input size="16" type="text" value="" readonly name="vremeDo">
                                    <span class="add-on"><i class="icon-remove"></i></span>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                                <input type="hidden" id="dtp_input1" value="" /><br/>
                            </div>
                            <label class="control-label">Unesite broj ljudi:</label><br />
                            <input type="number" name="brLjudi" />
                            <div>
                                &nbsp;&nbsp;&nbsp;
                            </div>

                            <button  type="submit" class=" btn-warning btn-lg btn-block">Rezervisi</button>
                        </form> 
                    </div>

                </div>
                <div class="row">  
                    <div class="col-sm-12 ">
                        &nbsp;
                    </div>  
                    <div class="col-sm-4 col-sm-offset-4">
                        <img src="<?php echo base_url(); ?>images/slides/1.jpg" class="img-circle" alt="Cinque Terre" width="1504" height="1236">
                    </div>

                    <div class="col-sm-8 col-sm-offset-2">
                        <font size = '10' style = "color: hsla(35, 84%, 51%, 0.96); ">
                        <?php echo $restoran['ImeObjekta']; ?>
                        </font>
                        <h3>
                            Opis objekta : <b><?php echo " " . $restoran['Opis']; ?></b>
                        </h3>
                        <h3>
                            Kuhinje:<b> <?php echo " " . $restoran['Kuhinja'] ?> </b>
                        </h3>
                        <h3>
                            Opstina: <b><?php echo " " . $restoran['Opstina'] ?> </b>
                        </h3>
                        <h3>
                            Kontakt email: <b><?php echo " " . $restoran['Email'] ?></b> 
                        </h3>
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" >
                        <h2>Galerija</h2>
                    </div>

                    <div class="col-sm-8 col-sm-offset-2" >

                        <div class="col-md-3 img-portfolio">
                            <a href="images/image-M-2.jpg" data-lightbox="roadtrip">
                                <img class="img-responsive img-hover" src="images/image-M-2.jpg" alt="">
                            </a>
                        </div>
                        <div class="col-md-3 img-portfolio">
                            <a href="images/image-M-3.jpg" data-lightbox="roadtrip">
                                <img class="img-responsive img-hover" src="images/image-M-3.jpg" alt="">
                            </a>
                        </div>
                        <div class="col-md-3 img-portfolio">
                            <a href="images/image-M-4.jpg" data-lightbox="roadtrip">
                                <img class="img-responsive img-hover" src="images/image-M-4.jpg" alt="">
                            </a>
                        </div>
                        <div class="col-md-3 img-portfolio">
                            <a href="images/image-M-5.jpg" data-lightbox="roadtrip">
                                <img class="img-responsive img-hover" src="images/image-M-5.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
            </div>
        </section>



        <!--/.page-section-->
        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center"> Copyright 2016 <a href="http://etf.bg.ac.rs">ETF Belgrade</a> </div>
                </div>
                <!-- / .row --> 
            </div>
        </section>
        <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a> 

<!--[if lte IE 8]><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><![endif]--> 
        <script src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js" charset="UTF-8"></script>  
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.rs.js" charset="UTF-8"></script>


        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                language: 'rs',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
        </script>









    </body>
</html>
