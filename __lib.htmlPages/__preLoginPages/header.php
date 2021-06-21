<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package styled_blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="shortcut icon" type="image/png" href="https://optymoney.com/static/th_4/img/favicon.png"/>
    <link rel='shortcut icon' type='image/x-icon' href='https://optymoney.com/static/th_4/img/favicon.ico' />
	
</head>

<body <?php body_class(); ?> >

<?php do_action( 'styled_blog_pre_loader_sec' ); ?>
	

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'styled-blog' ); ?></a>

	<div id="content" class="site-content">

		<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
 
body {
    margin-top: 0px;
}
.navbar {
  overflow: hidden;
  background-color: #fff;
 
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
   
}

.navbar a:hover {
  background: #ddd;
  color: black;
}

.main {
  padding: 16px;
  /*margin-top: 30px;*/
  height: 1500px; /* Used in this example to enable scrolling */
}
</style>
</head>
<body>

  <div class="navbar">
  <center><a href="https://optymoney.com/"><img src="https://optymoney.com/static/opty_theme/img/logo_3.png"></a></center>
  <?php wp_head(); ?>
</div>


 
<!--    <nav class="navbar   my-nav">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="<?php echo $CONFIG->siteurl;?>home.html"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>assets/images/logo.png" alt="Logo" width="160"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="<?php echo $CONFIG->siteurl;?>home.html">Home</a></li>
        <li><a href="<?php echo $CONFIG->siteurl;?>contact.html">Contact</a></li>
        <li><a href="<?php echo $CONFIG->siteurl;?>faq.html">Faq</a></li> 
        <li><a href="<?php echo $CONFIG->siteurl;?>helpcentre.html">Help Centre</a></li>
    <li><a href="<?php echo $CONFIG->siteurl;?>login.html" class="nav-color">Login / Register</a></li>
    <li><i class="fa fa-phone fa-lg cs" aria-hidden="true"></i> Call:<b>+91 080 42061247</b> </li>
      </ul>
      <ul class="nav navbar-nav brdr">
        <li><a href="<?php echo $CONFIG->siteurl;?>filetax.html">File Tax</a></li>
        <li><a href="<?php echo $CONFIG->siteurl;?>savetax.html">Save Tax</a></li>
    <li><a href="<?php echo $CONFIG->siteurl;?>createwill.html">Create Will</a></li>
      </ul>
    </div>
  </div>
</nav> --> 

