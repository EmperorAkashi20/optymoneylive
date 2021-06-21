<!-- Blog -->
<header class="masthead" style="background-image: url('<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/bannerBG.svg');">
   <div class="container h-100">
      <img src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/blog.svg" class="vector d-none d-lg-block" />
      <div class="row h-100 align-items-center">
         <div class="col-12 mt-5 mt-lg-0 text-left">
            <h1 class="font-weight-light">News & Updates</h1>
            <p class="lead">Latest updates on Financial Sector</p>
         </div>
      </div>
   </div>
</header>
<div class="tax_file_page">
   <div class="container">
      <section class="tm-section">
         <div class="container-fluid">
            <div class="row">

               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                  <div class="row tm-margin-t-big blogHeight" style="overflow:auto;">
                     <?php
                     $count = 1;
                     $sql1 = "select * from blogs order by ID desc";
                     $res = $db->db_run_query($sql1);
                     if ($db->db_num_rows($res) == 0) {
                        //echo '<tr><td class="center red" colspan="11"> No Row(s) Found.</td></tr>';
                     } else {
                        while ($row = $db->db_fetch_assoc($res)) {
                           if ($row["post_status"] == "publish") {
                     ?>
                              <div class="col-xl-4 col-lg-4 col-12 mt-2 mb-3">
                                 <!--mt-2 added on 20 May 2020-->
                                 <div class="card">
                                    <?php if ($row["post_img"] != null) { ?>
                                       <img src="<?php echo $row["post_img"]; ?>" class="card-img-top img-thumbnail" alt="..." />
                                    <?php } else { ?>
                                       <img src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/blog_img.png" class="card-img-top img-thumbnaail" alt="..." />
                                    <?php
                                    }
                                    ?>
                                    <div class="card-body blogs" style="line-height: 3.5ex; height: 25.5ex; overflow: hidden;">
                                       <h5 class="card-title"><?php echo $row["post_title"]; ?></h5>
                                       <div class="tm-margin-b-20 blog_content text-justify">
                                          <?php echo $row["post_content"]; ?>
                                       </div>
                                       <div class="contentHidden"><?php echo $row["post_content"]; ?></div>
                                    </div>
                                    <div class="card-footer text-muted text-center">
                                       <a href="blogs_single_page.html?<?php echo base64_encode(base64_encode($row['ID'])); ?>" class="btn btn-primary">Read More</a>
                                    </div>
                                 </div>
                              </div>
                     <?php  }
                        }
                     }
                     ?>
                  </div>
               </div>
               <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">
                  <div class="tm-aside-container">
                     <!--<h3 class="tm-gold-text tm-title">Categories</h3>
                     <?php
                     $sql1 = "select DISTINCT post_category from blogs";
                     $res = $db->db_run_query($sql1);
                     if ($db->db_num_rows($res) == 0) {
                        echo 'No Row(s) Found.';
                     } else {
                        while ($row = $db->db_fetch_assoc($res)) { ?>
                           <a href="#" class="tm-text-link"><?php echo $row["post_category"]; ?></a><br>
                     <?php
                        }
                     }
                     ?>-->
                     <!-- <hr class="tm-margin-t-small">
                     <h3 class="tm-gold-text tm-title tm-margin-t-small">Useful Links</h3>
                        <nav>   
                           <ul class="nav">
                              <li><a href="#" class="tm-text-link">Suspendisse sed dui nulla</a></li>
                              <li><a href="#" class="tm-text-link">Lorem ipsum dolor sit</a></li>
                              <li><a href="#" class="tm-text-link">Duiss nec purus et eros</a></li>
                              <li><a href="#" class="tm-text-link">Etiam pulvinar et ligula sed</a></li>
                              <li><a href="#" class="tm-text-link">Proin egestas eu felis et iaculis</a></li>
                           </ul>
                        </nav>-->
                     <!-------------------------------------25 MAY 2021 CATEGORIES

                     <div class="card">
                        <div class="activeRedefined card-header">
                           <h6 class="mb-0">Categories</h6>
                        </div>
                        

                        <div class="card-body">
                           <div class="list-group">
                              <a href="#" class="list-group-item list-group-item-action-mine" aria-current="true">
                                 TAX
                                 <span class="badge badge-primary badge-pill ml-3">14</span>
                              </a>
                              <a href="#" class="list-group-item list-group-item-action-mine">Finance</a>
                              <a href="#" class="list-group-item list-group-item-action-mine">Gold</a>

                              <a href="#" class="list-group-item list-group-item-action-mine">Capital Market</a>
                              <a href="#" class="list-group-item list-group-item-action-mine">General</a>
                           </div>
                        </div>
                     </div>--->

                     <div class="list-group list-group-flush mb-5 mt-3">
                        <button type="button" class="list-group-item list-group-item-action activeRedefined text-center" style="cursor: default;">Categories</button>
                        <button type="button" class="list-group-item list-group-item-action text-center"><a href="">Tax</a></button>
                        <button type="button" class="list-group-item list-group-item-action text-center"><a href="">Finance</a></button>
                        <button type="button" class="list-group-item list-group-item-action text-center"><a href="">Gold</a></button>
                        <button type="button" class="list-group-item list-group-item-action text-center"><a href="">Capital Market</a></button>
                        <button type="button" class="list-group-item list-group-item-action text-center" style="border-bottom: 1px solid rgb(219, 219, 219);"><a href="">General</a></button>
                     </div>

                     <!------------------------------------- RECENT & POPULAR IMAGES--------------------->

                     <!--  <div class="list-group list-group-flush mb-5 mt-3">
  <button type="button" class="list-group-item list-group-item-action activeRedefined text-center" style="cursor: default;">Recent</button>
  <button type="button" class="list-group-item list-group-item-action text-center">  </button>
   
  <button type="button" class="list-group-item list-group-item-action text-center" style="border-bottom: 1px solid rgb(219, 219, 219);">  </button>
</div>-->

                     <!-------------------------------------Archive--------------------->

                     <!--     <div class="list-group list-group-flush mb-5 mt-3">
  <button type="button" class="list-group-item list-group-item-action activeRedefined text-center" style="cursor: default;">Archive</button>
  <button type="button" class="list-group-item list-group-item-action text-center">  </button>
   
  <button type="button" class="list-group-item list-group-item-action text-center">  </button>
  <button type="button" class="list-group-item list-group-item-action text-center" style="border-bottom: 1px solid rgb(219, 219, 219);">  </button>
</div>-->

                  </div>
               </aside>
            </div>
         </div>
      </section>
   </div>
</div>
<div class="modal fade" id="myBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            ...
         </div>
      </div>
   </div>
</div>