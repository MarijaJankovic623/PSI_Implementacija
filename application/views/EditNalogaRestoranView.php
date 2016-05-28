<!--Ivana Djunisijevic-->
<!--impl: Ivana Djunisijevic -->
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
        <meta name="author" content="Ivana Djunisijevic">
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        <!--[if lte IE 8]>
                        <script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
                <![endif]-->
        <link rel="stylesheet" href="<?php echo(base_url()); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo(base_url()); ?>css/isotope.css" media="screen" />
        <link rel="stylesheet" href="<?php echo(base_url()); ?>js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <link href="<?php echo(base_url()); ?>css/animate.css" rel="stylesheet" media="screen">
        <link href="<?php echo(base_url()); ?>flexslider/flexslider.css" rel="stylesheet" />
        <link href="<?php echo(base_url()); ?>js/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo(base_url()); ?>css/styles.css" />
        <!-- Font Awesome -->
        <link href="<?php echo(base_url()); ?>font/css/font-awesome.min.css" rel="stylesheet">
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
                            <li><a href="<?php echo base_url().'index.php/OtpustanjeKonobaraCtrl/index/'.$user['IDRestoran']; ?>" class="scroll-link">Otpusti konobara</a></li>
                            <li ><a href="<?php echo base_url().'index.php/OtpustanjeKonobaraCtrl/profil/'.$this->session->userdata('userid'); ?>" class="">Moj profil</a></li>
                            <li class="active"><a href="<?php echo base_url().'index.php/OtpustanjeKonobaraCtrl/profil/'.$this->session->userdata('userid'); ?>" class="">Napusti izmenu</a></li>
                            <li ><a href="<?php echo base_url(); ?>index.php/HomeCtrl" class="">Izloguj se</a></li>
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
                    <div class="col-sm-8 col-sm-offset-2" >


                        <form action="<?php echo(base_url()); ?>index.php/EditovanjeNalogaCtrl/confirm" method="POST" role="form">
                            <div class="form-group">
                                <legend>Izmena naloga</legend>
                                <?php echo form_error('kime'); ?>
                                <label for="" >Korisničko ime</label>
                                <input type="text" name = "kime" class="form-control"  placeholder="Unesite korisničko ime" value = "<?php print $user['KIme'] ?>" disabled="">
                                <label for="" >Lozinka</label>
                                <?php echo form_error('lozinka'); ?>
                                <input type="password"  name ="lozinka" class="form-control"  placeholder="Unesite lozinku" value = "<?php print $user['Lozinka']; ?>">
                                <label for="">Ime objekta</label>
                                <?php echo form_error('iobj'); ?>
                                <input type="text" name = "iobj" class="form-control"  placeholder="Unesite ime objekta" value = "<?php print $user['ImeObjekta']; ?>">
                                <label for="" >Ime vlasnika</label>
                                <?php echo form_error('ivlasnika'); ?>
                                <input type="text" name = "ivlasnika" class="form-control"  placeholder="Unesite Vaše ime ovde" value = "<?php print $user['ImeVlasnika']; ?>">
                                <label for="">Prezime vlasnika</label>
                                <?php echo form_error('pvlasnika'); ?>
                                <input type="text" name = "pvlasnika" class="form-control"  placeholder="Unesite Vaše prezime ovde" value = "<?php print $user['PrezimeVlasnika']; ?>">
                                <label for="">Email</label>
                                <?php echo form_error('email'); ?>
                                <input type="text" name ="email" class="form-control"  placeholder="Unesite Vas email ovde" value = "<?php print $user['Email']; ?>">
                                <label for="">Kod za registraciju konobara</label>
                                <?php echo form_error('kod'); ?>
                                <input type="text" name ="kod" class="form-control"  placeholder="Unesite Vas kod za konobare ovde" value = "<?php print $user['KodKonobara']; ?>">
                                <label for="">Opis kuhinja</label>
                                <?php echo form_error('kuhinje'); ?>
                                <input type="text" name = "kuhinje" class="form-control"  placeholder="Unesite nazive kuhinja koje Vaš restoran nudi" value = "<?php print $user['Kuhinja']; ?>">
                                <label for="">Opis objekta</label>
                                <?php echo form_error('opis'); ?>
                                <input type="text" name = "opis" class="form-control"  placeholder="Unesite opis objekta" value = "<?php print $user['Opis']; ?>">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <label for="">Raspoloživih stolova za:</label></br>
                                        <?php echo form_error('sto_2'); ?>
                                        <label for="" class="block" style="display:inline-block;">2</label>
                                        <?php $this->load->model('BusinessLogic') ?>
                                        <input type="number" min="0" step="1" name = "sto_2"  value = "<?php print ($this->BusinessLogic->getNumberOfTables($user['IDRestoran'], 2)); ?>" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>
                                        <?php echo form_error('sto_4'); ?>
                                        <label for="" class="block" style="display:inline-block;">4</label>
                                        <input type="number" min="0" step="1"  name = "sto_4" value = "<?php print ($this->BusinessLogic->getNumberOfTables($user['IDRestoran'], 4)); ?>" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>
                                        <?php echo form_error('sto_6'); ?>
                                        <label for="" class="block" style="display:inline-block;">>6</label>
                                        <input type="number" min="0" step="1" name = "sto_6"  value = "<?php print ($this->BusinessLogic->getNumberOfTables($user['IDRestoran'], 6)); ?>"style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>

                                    </div>


                                </div>

                                <div class = "row">
                                    <div class = "col-sm-12">

                                        <div class="form-group">
                                            &nbsp;
                                            <!--<font size = '5'>Odaberite opštinu:</font>

                                             <select selected="<?php print $user['Opstina']; ?>" name = "opstina" class="form-group"  style="background-color: hsla(35, 8%, 14%, 0.96); color: hsla(35, 84%, 51%, 0.96);" onpageshow="<?php print $user['Opstina']; ?>">
                                                <option >Sve opštine</option>
                                                <option >Čukarica</option>
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
                                            </select> -->

                                        </div>

                                    </div>

                                </div>
                                <label for="" class="block" style="display:inline-block;">Dodajte slike</label></br>
                                <button type="button" class="btn btn-primary" style="display:inline-block;">Učitaj</button></br>
                                </br>
                                <button type="submit" class="btn btn-primary" >Potvrdi</button>
                            </div>           
                        </form>
                    </div>
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

    </body>
</html>
