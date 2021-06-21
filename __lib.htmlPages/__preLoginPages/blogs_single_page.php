<!-- Blog -->
<header class="masthead" style="background-image: url('<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/bannerBG.svg');">
  <div class="container h-100">
  	<img src="<?php echo $CONFIG->blogs_content["post_img"]; ?>" alt="<?php echo $CONFIG->blogs_content["alt_attr"]; ?>" class="vector"/>
    <div class="CONFIG->blogs_content h-100 align-items-center">
      <div class="col-12 text-left">
        <h1 class="font-weight-light"><?php echo $CONFIG->blogs_content["post_title"]; ?></h1>
        <!-- <p class="lead">Latest updates on Financial Sector</p> -->
      </div>
    </div>
  </div>
</header>
<div class="tax_file_page">
   <div class="container">
      <section class="tm-section">
         <div class="container-fluid">
            <div class="CONFIG->blogs_content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="CONFIG->blogs_content tm-margin-t-big">
                     <div class="col-xl-12 col-lg-12 col-12">
                        <div class="card">
                           <div class="card-header text-center">
                              <?php 
                              // echo "BLOGS";
                              // print_r($CONFIG->blogs_content);
                              //if($CONFIG->blogs_content["post_img"]!=null) { ?> 
                                 <!--<img src="<?php //echo $CONFIG->blogs_content["post_img"]; ?>" class="card-img-top" alt="..."/> -->
                              <?php //} else{ ?>
                              <!-- <img src="<?php //echo $CONFIG->staticURL;?><?php //echo $CONFIG->theme_new; ?>img/blog_img.png" class="card-img-top" style ="width:40%" alt="..."/> -->
                              <?php //} ?>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title"><?php echo $CONFIG->blogs_content["post_name"]; ?></h5>
                              <p>Posted On : <?php echo $CONFIG->blogs_content["post_date"]; ?></p>
                              <p>Author : <b><?php echo $CONFIG->blogs_content["post_author"]; ?></b></p>
                              <div class="tm-margin-b-20">
                                 <?php echo $CONFIG->blogs_content["post_content"]; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--<aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">
                  <div class="tm-aside-container">
                        <h3 class="tm-gold-text tm-title">Categories</h3>
                        <nav>
                           <ul class="nav">
                           <?php
                              /*$sql1 = "select DISTINCT blog_cat from blogs";
                              $res = $db->db_run_query($sql1);
                              if($db->db_num_CONFIG->blogs_contents($res) == 0) {
                                 echo 'No CONFIG->blogs_content(s) Found.';
                              } else {
                                 while($CONFIG->blogs_content = $db->db_fetch_assoc($res)) { ?>
                                    <li><a href="#" class="tm-text-link"><?php echo $CONFIG->blogs_content["blog_cat"]; ?></a></li>
                                 <?php
                                 }
                              }*/
                           ?>
                           </ul>
                        </nav>
                        <hr class="tm-margin-t-small">   
                        <h3 class="tm-gold-text tm-title tm-margin-t-small">Useful Links</h3>
                        <nav>   
                           <ul class="nav">
                              <li><a href="#" class="tm-text-link">Suspendisse sed dui nulla</a></li>
                              <li><a href="#" class="tm-text-link">Lorem ipsum dolor sit</a></li>
                              <li><a href="#" class="tm-text-link">Duiss nec purus et eros</a></li>
                              <li><a href="#" class="tm-text-link">Etiam pulvinar et ligula sed</a></li>
                              <li><a href="#" class="tm-text-link">Proin egestas eu felis et iaculis</a></li>
                           </ul>
                        </nav>
                  </div>
               </aside>-->
            </div>
         </div>
      </section>
   </div>
</div>