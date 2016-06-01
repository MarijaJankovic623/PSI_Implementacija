<!--Marko Kastratovic-->
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
        <meta name="author" content="Marko Kastratovic">
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
                            <li class="active"><a href="<?php echo base_url() . 'index.php/PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl'; ?>" class="scroll-link">Moje rezervacije</a></li>
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
                    <div class="col-sm-12">
                        <?php if (isset($otkazivanje)) echo "<h1 align = 'center' style='color: #FF0000';>" . $poruka . "<h1/>" ?>
                        <?php foreach ($rezervacije as $rezervacija) { ?>
                            <div class="jumbotron" style="background-color:rgba(237, 231, 227, 0.87)">
                                <form action="<?php echo(base_url() . 'index.php/PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl/rezervacijaCancelGrade/' . $rezervacija['IDRezervacija']); ?>" method="POST" role="form">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?php echo base_url(); ?>images/slides/1.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236">
                                        </div>
                                        <div class="col-sm-8">
                                            <h2>
                                                <?php echo "Ime restorana: " . $rezervacija['ImeObjekta']; ?>
                                            </h2>

                                            <h5> <?php echo "Vreme početka rezervacije: " . $rezervacija['VremeOd']; ?></h5>
                                            <h5> <?php echo "Vreme kraja rezervacije: " . $rezervacija['VremeDo']; ?></h5>
                                            <h5> <?php echo "Status rezervacije: " . $rezervacija['Status']; ?></h5>
                                            <p>
                                                <?php echo "Opis resotrana: " . $rezervacija['Opis']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <?php
                                        if (!strcmp($rezervacija['Status'], "Nadolazeca")) {
                                            $ispis = " 
                                        <div class='col-sm-12'>
                                        <button type='submit' class='btn btn-warning btn-lg btn-block' name = 'otkaziDugme' >Otkaži</button>
                                         </div>";
                                        }
                                        if (!strcmp($rezervacija['Ocena'], "0") && !strcmp($rezervacija['Status'], "Ostvarena")) {
                                            $ispis = " 
                                    
                                    <div class='col-sm-4'>
                                    <button type= 'submit' class='btn btn-warning btn-lg btn-block' name = 'oceniDugme' >Oceni</button> 
                                    </div>
                                    <div class='col-sm-4'>
                                        <select  name = 'ocena' class='form-group'  style='background-color: hsla(35, 8%, 14%, 0.96); color: hsla(35, 84%, 51%, 0.96);' >
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>  
                                        </select>
                                    </div>";
                                        } if (!strcmp($rezervacija['Status'], "Ocenjena")) {
                                            $ispis = $ispis = '<div class="col-sm-12"  style="background-color: hsla(35, 8%, 14%, 0.96); color: hsla(35, 84%, 51%, 0.96)";>Ovu rezervaciju ocenili ste ocenom : ' . $rezervacija['Ocena'] . '</div>';
                                        }



                                        if (!strcmp($rezervacija['Status'], "Otkazana")) {

                                            $ispis = "<div class='col-sm-12'>   </div> ";
                                        }
                                        echo $ispis;
                                        ?>


                                        <hr/>
                                    </div>


                                </form>
                            </div>
                        <?php } ?>  
                    </div>    
                </div>
                <div class="row">
                    &nbsp;
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

    </body>
</html>

