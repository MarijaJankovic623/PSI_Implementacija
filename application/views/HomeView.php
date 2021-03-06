<!--Marko Kastratovic-->
<!--Impl:Marko Kastratovic-->
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
                            <li><a href="<?php echo base_url(); ?>index.php/LoginCtrl" class="scroll-link">Uloguj se  </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/RegistracijaKorisnikaCtrl" class="scroll-link">Registruj se kao korisnik</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/RegistracijaKonobaraCtrl"  class="scroll-link">Registruj se kao konobar</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/RegistracijaRestoranaCtrl" class="scroll-link">Registruj se kao restoran </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/RegistracijaAdminaCtrl" class="scroll-link">Registruj se kao administrator </a></li>
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
                    <div class="col-sm-3" style="background-color: hsla(35, 8%, 14%, 0.96); color: hsla(35, 84%, 51%, 0.96);"  >
                        <form action="<?php echo base_url() . 'index.php/HomeCtrl/criteriaRestaurants'; ?>" method="POST" role="form">
                            <div class="row">
                                &nbsp;
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        &nbsp;
                                        <label class="control-label">Unesite broj ljudi:</label><br />
                                        <input type="number" min="1" value="1" name="brLjudi" />  
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div class = "row">
                                <div class = "col-sm-12">
                                    <div class="form-group">
                                        &nbsp;
                                        <font size = '5'>Odaberite opštinu:</font>

                                        <select class="form-group"  name ="opstina" style="background-color: hsla(35, 8%, 14%, 0.96); color: hsla(35, 84%, 51%, 0.96);">
                                            <option selected>Čukarica</option>
                                            <option>Novi Beograd</option>
                                            <option>Palilula</option>
                                            <option>Rakovica</option>
                                            <option>Savski venac</option>
                                            <option>Stari grad</option>
                                            <option>Voždovac</option>
                                            <option>Vračar</option>
                                            <option>Zemun</option>         
                                            <option>Zvezdara</option>
                                            <option>Barajevo</option>
                                            <option>Grocka</option>
                                            <option>Lazarevac</option>
                                            <option>Mladenovac</option>
                                            <option>Obrenovac</option>
                                            <option>Sopot</option>
                                            <option>Surčin</option>   
                                        </select>

                                    </div>

                                </div>

                            </div>

                            <hr/>

                            <div class = "row">
                                <div class = "col-sm-12">             
                                    <div class="form-group">
                                        <label class="control-label">Odaberite vreme i datum od:</label>
                                        <div class="controls input-append date form_datetime" data-date="2016-01-01T05:25:07Z" data-date-format="yyyy-mm-dd  hh:ii " data-link-field="dtp_input1">
                                            <input size="16" type="text" value="" readonly name="vremeOd">
                                            <span class="add-on"><i class="icon-remove"></i></span>
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" /><br/>
                                    </div>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-sm-12">             
                                    <div class="form-group">
                                        <label class="control-label">Odaberite vreme i datum do:</label>
                                        <div class="controls input-append date form_datetime" data-date="2016-01-01T05:25:07Z" data-date-format="yyyy-mm-dd  hh:ii " data-link-field="dtp_input1">
                                            <input size="16" type="text" value="" readonly name="vremeDo">
                                            <span class="add-on"><i class="icon-remove"></i></span>
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" /><br/>
                                    </div>
                                </div>
                            </div>

                            <hr/>    

                            <div class = "row">
                                <div class = "col-sm-10 col-sm-offset-1">       
                                    <button type="submit" class="btn btn-warning btn-lg btn-block">Pretraži</button>
                                    &nbsp;
                                </div>
                            </div> 
                        </form>
                    </div>
                    <div class="col-sm-9">
                        <?php foreach ($restorani as $restoran) { ?>
                            <div class="jumbotron" style="background-color:rgba(237, 231, 227, 0.87)">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?php echo base_url(); ?>images/slides/1.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236">
                                    </div>
                                    <div class="col-sm-8">
                                        <h2>
                                            Ime objekta : <b><?php echo $restoran['ImeObjekta']; ?></b>    
                                        </h2>
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
                                        <h3>
                                            Ocena restorana: <b><?php echo " " . $restoran['Ocena'] ?></b> 
                                        </h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="<?php echo base_url(); ?>index.php/LoginCtrl" class="btn btn-warning btn-lg">Rezervacija</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>   
                    </div>
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
