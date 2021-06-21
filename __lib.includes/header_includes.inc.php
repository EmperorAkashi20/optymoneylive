<?php clearstatcache(); ?>
<head>
    <?php 
    $interface1 = $_SERVER['REQUEST_URI'];
    $request_sch = explode("?", $interface1);
    if ($_SESSION[$CONFIG->sessionPrefix . 'loginstatus']) {
        if(base64_decode($_GET["module_interface"])=="blogs_single_page") {
            $sql1 = "select * from blogs left join meta_tag_tbl on (blogs.post_meta_id = meta_tag_tbl.meta_id) where ID=".base64_decode(base64_decode($_GET["blog"]))." ";
            $res = $db->db_run_query($sql1);
            $CONFIG->blogs_content = $db->db_fetch_assoc($res);
            // print_r($CONFIG->blogs_content);
            if ($CONFIG->blogs_content['meta_title']) {
                echo "<title>" . $CONFIG->blogs_content['meta_title'] . "</title>";
            } else {
                echo "<title>Optymoney</title>";
            }
            if ($CONFIG->blogs_content['meta_description']) {
                echo '<meta name="description"   content="' . $CONFIG->blogs_content['meta_description'] . '">';
            } else {
                echo '<meta name="description" content="">';
            }
            if ($CONFIG->blogs_content['meta_keywords']) {
                echo '<meta name="keywords" content="' . $CONFIG->blogs_content['meta_keywords'] . '">';
            } else {
                echo '<meta name="keywords" content="">';
            }
        } else {
            if(base64_decode($_GET["module_interface"])=="create_will") {
                echo "<title>Secure your family’s future with us and Reward your loved ones !!</title>";
                echo '<meta name="description"   content="Succession Planning is easiest with Will Creation. With Optymoney, you can create your own Will - Do It Yourself and get access to expert assistance on demand. Wealth is precious and Optymoney helps you real time in preserving your Wealth and making it Grow. Write your WILL today before it’s too late. Register || Add Details || Get e-Will">';
                echo '<meta name="keywords" content="">';
                echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
            } else {
                if(base64_decode($_GET["module_interface"])=="helpdesk") {
                    echo "<title>E-Connect today to file your Tax Returns now !! </title>";
                    echo '<meta name="description" content="Our platform brings to you maximum tax savings and ensures up-to-date tax compliances. With our experience and innovation, we offer the best solutions to address tax notices and minimise your tax outflows. The new Income Tax Portal brings with it new set of challenges and Optymoney’s team is committed to address the same efficiently. Register || Add Details || Consult || File Returns">';
                    echo '<meta name="keywords" content="">';
                    echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                } else {
                    if(base64_decode($_GET["module_interface"])=="all_product") {
                        echo "<title>Achieve your Goals with Optymoney Intelligence!! </title>";
                        echo '<meta name="description" content="Goal Based Savings is the best strategy to achieve your dreams. Uncertain times and bouncy markets will expose you to shaky situations. At Optymoney, use our free goal calculators and make your investments in a hassle free manner. Our tech automations make is extra simple for you to track your investments with options for effortless redemptions. Register || eKYC || Invest || Track Portfolio">';
                        echo '<meta name="keywords" content=" ">';
                        echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                    } else {
                        echo "<title>Explore & Simplify your Individual Financial Management !!</title>";
                        echo '<meta name="description" content="We offer a complete range of financial solutions with integrated platform for Tax Returns, Wealth Management, Document Management, and Do it Yourself - Will Creation which makes financial management more convenient and Wealth Creation more realistic. Our innovative platform ensures that every individual is financially independent.">';
                        echo '<meta name="keywords" content="">';
                        echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                    }
                }
            }
        }
    } else {
        if($request_sch[0]=="/blogs_single_page.html") {
            // echo "page : ".$request_sch[0];
            $sql1 = "select * from blogs left join meta_tag_tbl on (blogs.post_meta_id = meta_tag_tbl.meta_id) where ID=".base64_decode(base64_decode($request_sch[1]))." ";
            // echo "<br>sql : ".$sql1;
            $res = $db->db_run_query($sql1);
            $CONFIG->blogs_content = $db->db_fetch_assoc($res);
            if ($CONFIG->blogs_content['meta_title']) {
                echo "<title>" . $CONFIG->blogs_content['meta_title'] . "</title>";
            } else {
                echo "<title>Optymoney</title>";
            }
            if ($CONFIG->blogs_content['meta_description']) {
                echo '<meta name="description"   content="' . $CONFIG->blogs_content['meta_description'] . '">';
            } else {
                echo '<meta name="description" content="">';
            }
            if ($CONFIG->blogs_content['meta_keywords']) {
                echo '<meta name="keywords" content="' . $CONFIG->blogs_content['meta_keywords'] . '">';
            } else {
                echo '<meta name="keywords" content="">';
            }
        } else {
            if($request_sch[0]=="/createwill.html") {
                    echo "<title>Secure your family’s future with us and Reward your loved ones !! Register || Add Details || Get e-Will</title>";
                    echo '<meta name="description"   content="Succession Planning is easiest with Will Creation. With Optymoney, you can create your own Will - Do It Yourself and get access to expert assistance on demand. Wealth is precious and Optymoney helps you real time in preserving your Wealth and making it Grow. Write your WILL today before it’s too late. Register || Add Details || Get e-Will">';
                    echo '<meta name="keywords" content="">';
                    echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
            } else {
                if($request_sch[0]=="/tax.html") {
                    echo "<title>E-Connect today to file your Tax Returns now !! Register || Add Details || Consult || File Returns</title>";
                    echo '<meta name="description"   content="Our platform brings to you maximum tax savings and ensures up-to-date tax compliances. With our experience and innovation, we offer the best solutions to address tax notices and minimise your tax outflows. The new Income Tax Portal brings with it new set of challenges and Optymoney’s team is committed to address the same efficiently. ">';
                    echo '<meta name="keywords" content="">';
                    echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                } else {
                    if($request_sch[0]=="/all_product.html") {
                        echo "<title>Achieve your Goals with Optymoney Intelligence!! Register || eKYC || Invest || Track Portfolio</title>";
                        echo '<meta name="description"   content="Goal Based Savings is the best strategy to achieve your dreams. Uncertain times and bouncy markets will expose you to shaky situations. At Optymoney, use our free goal calculators and make your investments in a hassle free manner. Our tech automations make is extra simple for you to track your investments with options for effortless redemptions. ">';
                        echo '<meta name="keywords" content=" ">';
                        echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                    } else {
                        echo "<title>Explore & Simplify your Individual Financial Management !!</title>";
                        echo '<meta name="description"   content="We offer a complete range of financial solutions with integrated platform for Tax Returns, Wealth Management, Document Management, and Do it Yourself - Will Creation which makes financial management more convenient and Wealth Creation more realistic. Our innovative platform ensures that every individual is financially independent.">';
                        echo '<meta name="keywords" content="">';
                        echo '<meta property="og:image" content="https://optymoney.com/static/opty_theme/img/optymoney_icon.png" />';
                    }
                }
            }
        } 
    }
    ?>
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- CSS here -->

    <!-------BOOTSTRAP 4.6.0------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <?php if ($_SESSION[$CONFIG->sessionPrefix . 'loginstatus'] || $_SESSION[$CONFIG->sessionPrefix . 'pre_login_pg'] == "all_product.php") { ?>
        <!-- <link href="<?php //echo $CONFIG->staticURL;
                            ?><?php //echo $CONFIG->theme_new; 
                                ?>css/bootstrap.min.css" rel="stylesheet" /> -->
        <link href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/jqvmap.min.css" rel="stylesheet" />
        <!-- Icons Css -->
        <link href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <!-- <link href="<?php //echo $CONFIG->staticURL;
                            ?><?php //echo $CONFIG->theme_new; 
                                ?>css/app.min.css" rel="stylesheet" type="text/css" /> -->
    <?php } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>css/animate.min.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>css/slicknav.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/hummingbird-treeview.css"> 
    <?php
    //}
    ?>
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>vendors/aos/aos.css">
    <script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/vendor/modernizr-3.5.0.min.js"></script>

    <!--FONT AWESOME 5 KIT added 21 May 2021-->
    <script src="https://kit.fontawesome.com/3b9844d59a.js" crossorigin="anonymous"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
</head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154419016-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-154419016-1');
</script>