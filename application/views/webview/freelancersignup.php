   <div class="main_area_div">
   <div class="row"> 
	    <div class="col-md-5">
		   <div class="main_area_div_sub_div1">
		     <h1>Create a Free Freelancer Account </h1>
			 		<p>Looking to hire? <a href="<?php echo site_url("employeersignup/") ?>">Sign up as a Employer</a> </p>
			<?php if(isset($_GET['email'])){ ?>
		<p>Email Allready Exists </p>
		<?php } ?>
			<?php if(isset($_GET['username'])){ ?>
		<p>Username Allready Exists </p>
		<?php } ?>
		
	   <form id="basic" method="post" action="<?php echo site_url("registercheck"); ?>">
<input type="hidden" name="type" value="2">

             
                        <div class="col-md-10 col-xs-12 form-group">
                                                            <input type="text" name="fname" value="" class="form-control" id="firstname" autocomplete="false" placeholder="First Name">
                                                        </div>
                        <div class="col-md-10 col-xs-12 form-group">
                                                            <input type="text" class="form-control" name="lname" value="" id="lastname" placeholder="Last Name">
                                                        </div>
											<?php			
														
			  echo $this->Adminforms->selectdbnewxgdcv("Country","country","Select Country","country","id","name","index","asc","",true,array("all","All Country"));
			  
?>
														
                        <div class="col-md-10 col-xs-12 form-group">
                                                            <input type="text" class="form-control" name="username" value="" id="username"  placeholder="Username">
                                                        </div>
                    <div class="col-md-10 col-xs-12  form-group">
                        <div class="form-group">
                                                            <input type="email" class="form-control" id="emaila" value="" placeholder="Email" name="email">
                                                        </div>
                    </div>

                    <div class="col-md-10 col-xs-12 form-group ">
                        <input type="password" value="" name="password" class="form-control" id="password"  placeholder="Password">
						<div id="pswd_info">
    <h4>Password must meet the following requirements:</h4>
    <ul>
        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
        <li id="number" class="invalid">At least <strong>one number</strong></li>
        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
    </ul>
</div>
                    </div>


                    <div class="col-md-10 col-xs-12 form-group ">
                        <input type="password" value="" name="confirm_password" class="form-control" id="confirm_password"  placeholder="Password">
						

<div id="pswd_infob">
    <ul>
        <li id="vefyx" class="invalid">Verify Password</li>
    </ul>
</div>
                    </div>
                    <div class="col-md-10 col-xs-12 form-group ">
						<div id="captchaContainer" data-sitekey="6Lf-tggUAAAAAOzXu2Ub57Ws-IxAVy_WxEkB6WZ5"></div>

						

                    </div>	
          
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Get Started" id="next" class="btn btn-success"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>--> <div class="col-xs-12  col-sm-12  col-md-12">
			   <h2>By creating an account, you agree to our</h2>
			   <h3><a href="#">Winjob Marketplace User Agreement</a> <span>and</span> <a href="#">Privacy policy</a></h3>
			 </div>

			 <div class="clear" style="
    margin-bottom: 70px;"></div>
                </form>
			
		   </div> 
		   
		   
		 </div>
		   
	    <div class="col-sm-12 col-md-2">
		<div class="main_area_div_sub_div2_main">
		    <div class="main_area_div_sub_div2">
		      <div></div>  
			  <div><p>OR</p></div>
			  <div></div>
		   </div>
		   
		</div>
		 
		</div>
		 
	    <div class="col-sm-12 col-md-5">
		     <div class="main_area_div_sub_div3">
		       <h1>Login with your social networks</h1>
			 <a href="https://www.facebook.com/"  target="_blank"> <button class="btn btn-success  btn-social btn-facebook" >
			  <i class="fa fa-facebook"></i>Login With Facebook</button></a>
			  <div class="clear"></div>
			 <a href="https://www.linkedin.com/"  target="_blank">  <button class="btn btn-success  btn-social btn-Linkedin" >
			  <i class="fa fa-linkedin-square"></i>Login With Linkedin</button></a> 
			  <div class="clear"></div>
			  <a href="https://www.linkedin.com/"  target="_blank">  <button class="btn btn-success  btn-social btn-google" >
			  <i class="fa fa-google-plus-square"></i>Login With  Google+</button></a>
			
		    </div> 
		</div>
	 </div><!-- row-->
   </div>

   
   