<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>SPPMO</title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon-logo.ico'); ?>" />
  <!-- CSS  -->
  <link href="<?php echo base_url('assets/css/materialize.min.css'); ?>" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url('assets/css/dataTable.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url('assets/css/select2.min.css'); ?>" media="screen,projection" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/select2Materialize.css'); ?>" media="screen,projection" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700" rel="stylesheet"/>
  <link href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>" rel="stylesheet"/>
  <style>
    #load { height: 100%; width: 100%; }
    #load {
      position    : fixed;
      z-index     : 99999; /* or higher if necessary */
      top         : 0;
      left        : 0;
      overflow    : hidden;
      text-indent : 100%;
      font-size   : 0;
      opacity     : 0.8;
      background  : #ffffff  url(<?php echo base_url('assets/images/load.gif');?>) center no-repeat;
    }

    input.cusInput {
    background-color: transparent;
    border: none;
    border: 1px solid #9e9e9e6b !important;
    border-radius: 4px !important;
    outline: none;
    height: 1rem !important;
    padding: 6px 12px !important;
    border-radius: 5px;
    width: 96%;
    font-size: 1rem;
     margin: 0 0 0 0 !important; 
    padding: 0;
    box-shadow: none;
    box-sizing: content-box;

}

ul#dropdown2 {
    top: 60px !important;
}


  </style>


  <!-- Latest compiled and minified CSS -->
   <!--  <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script> -->
    <script src="<?php echo base_url('assets/js/JsBarcode.all.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
   
</head>
<body>
  <div id="load">Please wait ...</div>
<header>
  <div class="navbar-fixed <?php if($this->router->class!="home" ) echo "navnorm"; ?>">
    <nav class="<?php if($this->router->class=="home") echo "large"; ?>" role="navigation">
      <div class="nav-wrapper container">

 
        <a style="height: 2em" id="logo-container" href="<?php echo base_url('home'); ?>" class="brand-logo">
          <img class='imglogo' style="height: 2em" src="<?php echo base_url('assets/images/logo/vsulogo.png'); ?>" alt="Visayas State University">
        </a>
        <ul class="right hide-on-med-and-down">
          <li>
              <a href="<?php echo base_url('home/'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Home"><div class="fa fa-lg fa-home"></div>
              </a>
          </li>
   <!--        <li>
              <a href="<?php echo base_url('user/register'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Register"><div class="fa fa-lg fa-user"></div></a>
          </li> -->
          <li>
              <a href="<?php echo base_url('summaries/enduser'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Summary"><div class="fa fa-clipboard"></div></a>
          </li>
          <?php if($this->session->userdata('sppmo')): ?>
          <li>
              <a href="<?php echo base_url('supply/view'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Property Section">
                <div class="fa fa-lg fa-television">
                </div>
              </a>
          </li>

          <!-- personel section btn -->

          <li>
              <a href="<?php echo base_url('person/view'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Personel Section">
                <div class="fa fa-lg fa-user">
                </div>
              </a>
          </li>

          <li>
              <a href="<?php echo base_url('supply/track'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="track Management">
                <div class="fa fa-lg fa-trash">
                </div>
              </a>
          </li>


          <!-- personel section btn -->

          <?php endif; ?>
          <?php if(!$this->session->userdata('sppmo')): ?>
            <li><a href="<?php echo base_url('user/login'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Login"><div class="fa fa-lg fa-sign-in"></div></a></li>
          <?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?>
            <li><a href="<?php echo base_url('settings/view'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Config"><div class="fa fa-lg fa-gear"></div></a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?>
     <!--        <li><a href="<?php echo base_url('user/logout'); ?>" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Logout"><div class="fa fa-lg fa-sign-out"></div></a></li> -->
            <li>
              <div style="padding: 0 5px;">
    
              <a class="dropdown-button" href="#" data-activates="dropdown2">
              <div class="fa fa-lg fa-ellipsis-v"></div>
              </a>
              <ul id="dropdown2" class="dropdown-content">
                <li><a href="<?php echo base_url('user/register'); ?>" class="green-text text-darken-4"> Register</a></li>
                <li><a href="<?php echo base_url('user/logout'); ?>" class="green-text text-darken-4"> Logout</a></li>
              </ul>

      
            </div>
            </li>
          <?php endif; ?>
        </ul>

         <!-- Dropdown Trigger -->

        <ul id="nav-mobile" class="side-nav">
          <li>
              <div  class="user-view green darken-4">
              <img src="<?php echo base_url('assets/images/logo/vsulogo.png'); ?>">
              </div>
          </li>
          <li>
            <a href="<?php echo base_url('home'); ?>">
              <div class="fa fa-lg fa-home"></div> Home
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('summaries/enduser'); ?>">
            <div class="fa fa-clipboard"></div> Summary
            </a>
          </li>
     

          <?php if($this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('supply/view'); ?>"><div class="fa fa-lg fa-television"></div> Property Section</a></li><?php endif; ?>
          <?php if(!$this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('user/login'); ?>"><div class="fa fa-lg fa-sign-in"></div> Login</a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('settings/view'); ?>"><div class="fa fa-lg fa-gear"></div> Config</a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?>
          <li>
            <a href="<?php echo base_url('user/logout'); ?>">
            <div class="fa fa-lg fa-sign-out"></div> Logout
            </a>
          </li>
          <?php endif; ?>
        </ul>

        <a href="#" data-activates="nav-mobile" class="button-collapse"><div class="fa fa-lg fa-bars"></div></a>
      </div>
    </nav>
  </div>
</header>
<main>
<?php if($this->router->class=="supply"): ?>
  <div class="fixed-action-btn">
      <a class="btn-floating btn-large blue darken-1">
        <div class="large fa fa-bars"></div>
      </a>
      <ul>
        <li><a class="btn-floating red tooltipped" data-position="left" data-delay="1" data-tooltip="PAR/ICS" href="<?php echo base_url('supply/view'); ?>"><div class="fa fa-gears"></div></a></li>
        <li><a class="btn-floating red tooltipped" data-position="left" data-delay="1" data-tooltip="Property Transfer" href="<?php echo base_url('supply/transfer'); ?>"><div class="fa fa-share"></div></a></li>
        <li><a class="btn-floating red tooltipped" data-position="left" data-delay="1" data-tooltip="IAR/SP" href="<?php echo base_url('supply/iar'); ?>"><div class="fa fa-low-vision"></div></a></li>
        <li><a class="btn-floating red tooltipped" data-position="left" data-delay="1" data-tooltip="Property Management Office" href="<?php echo base_url('supply/pmo'); ?>"><div class="fa fa-television"></div></a></li>
      </ul>
    </div>
<?php endif; ?>
