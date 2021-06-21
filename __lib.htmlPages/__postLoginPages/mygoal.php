<div class="top_tile">
	<div class="container">
		<h2>ME.MYGOAL...</h2>
		<!--<a class="btn login_btn btn-lg" data-toggle="modal" data-target="#login_form">PARTICIPATE NOW</a> -->
	</div>
</div>
<div class="mainborder">
	<div class="mainbg">
		<div class="row mb-4">
			<div class="col-md-5">
				<h4 class="reg_title">Register to Participate</h4>
				<form class="register_form" action="<?= $CONFIG->siteurl; ?>ajax-request/ajax_response.php?action=par_reg&subaction=submit" method="post" name="eventForm" id="eventForm" enctype="multipart/form-data" >
					<div class="form-group">
						<input type="text" class="form-control"  placeholder="NAME" name="par_name" id="par_name">
						<input type="hidden" class="form-control"  value="mygoal" name="par_cam_code" id="par_cam_code">
					</div>
					<div class="form-group">
						<input type="email" class="form-control"  placeholder="E-MAIL" name="par_email" id="par_email">
					</div>
					<div class="form-group">
						<input type="tel" class="form-control"  placeholder="PHONE" name="par_mob" id="par_mob">
					</div>
					<!--<div class="form-group">
						<input type="text" class="form-control"  placeholder="CITY" name="par_city" id="par_city">
					</div> -->
					<div class="form-group">
						<div class="upload-btn-wrapper">
							<button class="btns" id="uploadBtnText">PHOTO UPLOAD (JPG/PNG)</button>
							<input type="file" name="par_myphoto" id="par_myphoto"/>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" id="eventFormSubmit" class="btn submitt">SUBMIT<!--<i class="fa fa-chevron-right orange"></i>--></button>
					</div>
				</form>
				<div id="evf_success" class="evf_msg text-center"></div>
			</div>
			<div class="col-md-6 col-md-6 col-12">
				<img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/slider-right.png" class="mygoal" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-4 col-12">
				<div class="contest_period">
					<h4>Registration&nbsp;Period</h4>
					<h6>28th&nbsp;April&nbsp;to&nbsp;31st&nbsp;MAY&nbsp;2021</h6>
				</div>
			</div>
			<div class="col-md-8 col-md-8 col-12">
				<div class="container">
					<div class="row imagetiles">
						<div class="col-lg-4 col-md-4 col-12 text-center">
							<img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/process-1.png" class="img-responsive">
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-center">
							<img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/process-2.png" class="img-responsive">
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-center">
							<img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/process-3.png" class="img-responsive">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container-fluid">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Basic carousel</h4>
                        <div class="owl-carousel">
                            <div class="item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204140/banner_12.jpg" alt="image" /> </div>
                            <div class="item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204172/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204663/park-4174278_640.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204172/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204663/park-4174278_640.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                            <div class="item"> <img src="http://www.urbanui.com/fily/template/images/carousel/banner_2.jpg" alt="image" /> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="brands">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="brands_slider_container">
					<h4>CONTEST PARTICIPANTS</h4>
					<div class="owl-carousel owl-theme brands_slider">
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/mygoal/461_mygoal_2021-05-11-09-33-13.jpg" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/mygoal/2514_mygoal_Screenshot_20210509-233915_Gallery.jpg" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/mygoal/2465_mygoal_My goal.jpg" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/mygoal/2516_mygoal_IMG-20210511-WA0004.jpg" alt=""></div>
						</div>
						<!--<div class="owl-item">
							<div class="brands_item d-flex  justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/dummy.JPG" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/dummy.JPG" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/dummy.JPG" alt=""></div>
						</div>
						<div class="owl-item">
							<div class="brands_item d-flex justify-content-center"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/dummy.JPG" alt=""></div>
						</div>-->
					</div>
					<div class="brands_nav brands_prev"><i class="fa fa-chevron-left"></i></div>
					<div class="brands_nav brands_next"><i class="fa fa-chevron-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="textDataCamp">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="font-weight-light">All you need to know about optymoney Financial Goal Challenge</h2>
				<p>Optymoney is a fintech Platform for Personal Financial Management and encourages all to Earn Save Invest!!</p>
				<br>
				<p>A nice read before you start!!!</p>
				<br>
				<p><strong>Earn!!, Earn!!, Earn!!</strong></p>
				<p>Don&rsquo;t let any avenues to make money go begging. Start early.</p>
				<p>Work to learn and earn while you learn; not only gain some extra bucks, but also gain the practical experience which would come good in your career, future education. It could be a formal vocational training or a corporate assignment or work in your family business or be part of the gig economy. The mantra is to not only earn now, but also to get the self-confidence, imbibe discipline in life and learn time management for a lucrative career.</p>
				<p>If you have hobby you love to do, let your hobby earn for you. Earn from what you enjoy doing. Do you have a passion for Writing, Cooking, Photography, DJing, Blogging, Travelling, Gaming, Arts &amp; Crafts, Fitness etc. In this digital age, the audience is unlimited, medium is seamless and sky is the limit for opportunities. Recognize your passion and seize them now. This is the age to start, as the saying goes, &ldquo;You have to learn to crawl before you run&rdquo;, take the baby steps now. If not solo, partner with people who share your passion. Fine tune your passion to earn now and more later.</p>
				<p>If you already have a job, if you have extra skill sets and time to spare, perfect your skills and earn in the process. If you have the skills, Freelancing is the way to use the skills you have already developed to boost your earning. You can work as much-or-as little as you want. Browse the work postings on Upwork portal or other popular Freelancing opportunities sites. If you want the second job to be less taxing than the first job, choose accordingly, go for market survey/research, customer service, tele-caller, event executives, data entry, book-keeping, fitness instructor among many others.</p>
				<p><strong>Earn!!, Earn!!, Earn!!</strong></p>
				<p></p>
				<p><strong>Save!!, Save!!, Save!!</strong></p>
				<p>With early money in hand, along with the financial education &amp; independence you get, make your money work. It is not how much money you make but how much money you keep (save). Don&rsquo;t forget to save when the financials commitments are zilch.</p>
				<p>Make saving a habit. Keep a goal (amount) to save and invest, this will ensure you either cut down on your expenses or find avenues to earn more. Easier of the two is to cut down expenses. Record and track your expenses, prioritize spending, save while spending and cut down on non-essentials. Use a mobile app to do the heavy lifting. Money saved is money earned, alternatively, it is important to save money. It is not about only earning but rather it is about not losing even an iota of what you earned.</p>
				<p>Let&rsquo;s not forget, little drops of water make a mighty ocean.</p>
				<p><strong>Save!!, Save!!, Save!!</strong></p>
				<p><strong>Invest!!, Invest!!, Invest!!</strong></p>
				<p>Let your money work. Let your saving work. Let the money you keep work. Invest in assets, increase your assets; assets that earn income or appreciate in value or both. Don&rsquo;t let the money idle. The various avenues to invest are in equity stocks, mutual funds, retirement-oriented funds, real estate, small business or a combination of all. Investing at an age (younger) with minimum responsibilities allows one to take a longer investment horizon, thereby allowing more time for investments to grow. Start early, have an investment goal, if you are not able to decide on the assets, get professional advice today.</p>
				<p>Visit www.optymoney.com to find out more.</p>
				<p>Don&rsquo;t forget to take risks, don&rsquo;t fear of losing money. As the saying goes&rdquo; No Risk, No Gain&rdquo;.</p>
				<p></p>
				<p><strong>Invest!!, Invest!!, Invest!!</strong></p>
				<br><br>

				<p><b>Eligibility Criteria</b></p>
				<p>The competion is open to all in the Age Group of 18-25 who have a vision to Earn Save Invest</p>
				<p><strong>Things to do :</strong></p>
				<p>1. Write a Goal &amp; Take a Selfie with the Goal &amp; Post on the link</p>
				<p>2. Follow on Insta &amp; Facebook for update</p>
				<p>3. Answer the questions on the page and get exciting prizes or gift vouchers</p>
				<p>4. The selected participants will have to create a video with the execution plan of the goal</p>
				<p>5. Also the selected few will get a Mentorship session with the Founders of optymoney</p>
				<p>6. The winners get cash prizes</p>
				<p>7. Winner <strong>7.5K</strong>, Runners up <strong>5K</strong> and 2nd Runners up <strong>3K</strong></p>
				<p>8. Also the lucky few can get placement offers and intership projects.</p>
				<p>9. All partcipants get e certificate</p>
				<p></p>
				<p><b>Important Dates</b></p>
			</div>
		</div>
		<div class="row">
			<div class='col-3 border-right'><div class='description-block'><span class='description-text'>Registration open till</span><h5 class='description-header'>31st May</h5></div></div>
			<div class='col-3 border-right'><div class='description-block'><span class='description-text'>1st Round Result</span><h5 class='description-header'>5th June</h5></div></div>
			<div class='col-3 border-right'><div class='description-block'><span class='description-text'>Video Plan submission by</span><h5 class='description-header'>15th June</h5></div></div>
			<div class='col-3'><div class='description-block'><span class='description-text'>Final Results by</span><h5 class='description-header'>20th June</h5></div></div>
		</div>
		<br><br>
	</div>
</div>