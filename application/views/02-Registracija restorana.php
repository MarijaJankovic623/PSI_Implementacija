<!--Ivana Djunisijevic-->
<!--impl: Marija Jankovic -->
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
          <li class="active"><a href="<?php echo base_url(); ?>index.php/Home" class="">Napusti registraciju</a></li>
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
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="<?php echo(base_url()); ?>images/slides/1.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Best app on the market</h3>  
                </div>
              </li>
              <li>
                <img src="<?php echo(base_url()); ?>images/slides/2.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Variety of foods</h3>   
                </div>
              </li>
              <li>
                <img src="<?php echo(base_url()); ?>images/slides/3.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Amazing ambiance</h3>  
                </div>
              </li>
            </ul>
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

                
                <form action="<?php echo(base_url()); ?>index.php/RegRestController/submit" method="POST" role="form">
                    <div class="form-group">
                        <legend>Registracija restorana</legend>
                         <?php echo form_error('kime');?>
                         <label for="" >Korisničko ime</label>
                        <input type="text" name = "kime" class="form-control" id="" placeholder="Unesite korisničko ime" value = "<?php echo set_value('kime'); ?>">
                          <label for="" >Lozinka</label>
                          <?php echo form_error('lozinka');?>
                        <input type="password"  name ="lozinka" class="form-control" id="" placeholder="Unesite lozinku" value = "<?php echo set_value('loyinka'); ?>">
                        <label for="">Ime objekta</label>
                        <?php echo form_error('iobj');?>
                        <input type="text" name = "iobj" class="form-control" id="" placeholder="Unesite ime objekta" value = "<?php echo set_value('iobj'); ?>">
                        <label for="" >Ime vlasnika</label>
                        <?php echo form_error('ivlasnika');?>
                        <input type="text" name = "ivlasnika" class="form-control" id="" placeholder="Unesite Vaše ime ovde" value = "<?php echo set_value('ivlasnika'); ?>">
                        <label for="">Prezime vlasnika</label>
                        <?php echo form_error('pvlasnika');?>
                        <input type="text" name = "pvlasnika" class="form-control" id="" placeholder="Unesite Vaše prezime ovde" value = "<?php echo set_value('pvlasnika'); ?>">
                        <label for="">Email</label>
                        <?php echo form_error('email');?>
                        <input type="text"name ="email" class="form-control" id="" placeholder="Unesite Vas email ovde" value = "<?php echo set_value('email'); ?>">
                        <div class="row">
                            <div class="col-sm-6">
                        
                                <label for="">Raspoloživih stolova za:</label></br>
                                <?php echo form_error('sto_2');?>
                                <label for="" class="block" style="display:inline-block;">2</label>
                                <input type="number" min="0" step="1" name = "sto_2"  value = "<?php echo set_value('sto_2'); ?>" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>
                               <?php echo form_error('sto_4');?>
                                <label for="" class="block" style="display:inline-block;">4</label>
                                <input type="number" min="0" step="1"  name = "sto_4" value = "<?php echo set_value('sto_4'); ?>" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>
                               <?php echo form_error('sto_6');?>
                                <label for="" class="block" style="display:inline-block;">>6</label>
                                <input type="number" min="0" step="1" name = "sto_6"  value = "<?php echo set_value('sto_6'); ?>"style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:14%;"></br>
                                
                            </div>
   
                            <div class="col-sm-6">
                                
                                
                                <label for="">Kuhinja:</label></br>
                                <label for="" class="block" style="display:inline-block;">Srpska</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Italijanska</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Meksička</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Američka</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Kineska</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Rumunska</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Mediteranska</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="">Pića:</label></br>
                                <label for="" class="block" style="display:inline-block;">Kafa</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Alkoholna pića</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="">Ostalo:</label></br>
                                <label for="" class="block" style="display:inline-block;">Kolači</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
                                <label for="" class="block" style="display:inline-block;">Sendviči</label>
                                <input type="checkbox" style="border:none;padding:5px 1px;outline:none;color:#5A5A5A;margin:0;width:150px;max-width:100%;margin-bottom:20px; display:inline-block;background:#F5F2ED;font-size:inherit;border-radius:0px !important;width:8%;"></br>
 
                            </div>
                        </div>
                        <label for="" class="block" style="display:inline-block;">Dodajte slike</label></br>
                        <button type="button" class="btn btn-primary" style="display:inline-block;">Učitaj</button></br>
</br>
                        <button type="submit" class="btn btn-primary">Potvrdi</button>
                </div>
                       
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
