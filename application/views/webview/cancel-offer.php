<style>
    *{
          font-family: "Calibri";
    }
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}
.offer_win_side {
	margin-left: 45px;
	font-family: "Calibri";
}
    .offer_made_side {
      font-family: "Calibri";   
    }
.offer_bordered {
	border: 1px solid #ccc;
	padding: 10px;
	border-radius: 3px;
	width: 780px;
    
}
.c_offer_msg.hour_btn {
	margin-left: -25px;
}
.dicline_btn {
	margin-right: 55px;
}
.dicline_btn:hover {
      background: #fff;
    }
.offer_title {
    font-size: 16px; 
    font-family: "Calibri";
    }
.offer_date span {
	margin-left: 65px;
    font-family: "Calibri";
}
</style>
<section id="big_header" class="custom_canceloffer"style="margin-top: 40px; margin-bottom: 40px; height: auto;">

	<div style="margin-left: 14px;" class="container">
		<div class="row">
			<div class="col-md-9 white-box offer_bordered">
			<p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>

				<div class="row">

					<div class="col-md-10">
						<div class="offer_win_side">
						    <div class="row">
							<div class="row margin-top-2">
								<div class="col-md-12 margin-left-3">
									<h4>Offer Win to</h4>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2 margin-left-">
								<div class="st_img">
								    <?php  if($freelancer_details[0]->webuser_picture !=""){ ?>
									<img src="<?php echo base_url().$freelancer_details[0]->webuser_picture ?>" width="64" height="64" />
								<?php }else{ ?>
									<img src="<?php echo base_url()?>assets/img/profile_img.jpg" width="64" height="64" />
								<?php  } ?>
								</div>
							</div>
							<div class="col-md-7 text-left margin-left">
								<div class="offer_win_details">
								    <label class="blue-text"><?=$freelancer_details[0]->webuser_fname ?> <?=$freelancer_details[0]->webuser_lname ?></label> <br><?=$freelancer_details[0]->tagline ?>
								</div>
							</div>
						</div>
						</div>
					</div>

					<div class="col-md-2 text-center gray-text margin-top-4">
						<div class="c_offer_msg hour_btn">
						    <input type="button" class="btn-primary transparent-btn big_mass_button" onclick="loadmessage(<?=$bid_details[0]->id?>,<?=$freelancer_details[0]->webuser_id?>,<?=$bid_details[0]->job_id?>)" value="Message" />
						</div>
					</div>
					
					<!-- <div class="col-md-5">
						<div class="offer_made_side">
						    <div class="row">
							<div class="row margin-top-2">
								<div class="col-md-12 margin-left-3">
									<h4>Offer Made By</h4>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2 margin-left-">
								<div class="st_img">
								    <?php  if(isset($client_details[0]->webuser_picture) && $client_details[0]->webuser_picture !=""){ ?>
									<img src="<?php echo base_url().$client_details[0]->webuser_picture ?>" width="64" height="64" />
								<?php }else{ ?>
									<img src="<?php echo base_url()?>assets/img/profile_img.jpg" width="64" height="64" />
								<?php  } ?>
								</div>
							</div>
							<div class="col-md-7 text-left margin-left-4">
								<label class="blue-text"><?php if(isset($client_details[0]->webuser_fname)) echo $client_details[0]->webuser_fname; ?> <?php if(isset($client_details[0]->webuser_lname)) echo $client_details[0]->webuser_lname; ?></label> <br> <?php if(isset($client_details[0]->webuser_company)) echo $client_details[0]->webuser_company; ?>
							</div>
						</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<div class="row ">
			<div style="padding-bottom: 30px;" class="col-md-9 white-box offer_bordered custom_offer_bordered remove-border-top">

				<div class="row">
					<div class="col-md-12 text-left blue-text">
					   <div class="offer_date">
					        <span>Pending, Expire on <?php echo date(' F j, Y ',strtotime(' + 30 day', strtotime($bid_details[0]->start_date)));?></span>
					   </div>
					</div>
					
				</div>
				
				
                <div class="row">
					<div class="col-md-4 text-center blue-text">
					</div>
					
					<div class="col-md-4 text-center blue-text" style="padding-left: 0px; padding-right: 0px">
					    <hr>
					</div>
					
					<div class="col-md-4 text-center blue-text">
					</div>
					
				</div>
				<div class="row">
				    <div class="col-md-3 col-md-offset-1">
				      <div class="offer_title">
				          <label class=""><b>Job Title: </b></label>
				      </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt" style="font-size:17px;">
						<b>
						    
						<?php if($bid_details[0]->hire_title !=""){
							$job_title = $bid_details[0]->hire_title;
						}else{
							$job_title = $job_details[0]->title;
						}?>
						<?=$job_title;?>
						</b>
						<br/>
						
						<a href="<?php echo base_url() ?>jobs/<?php echo str_replace(' ', '-', $job_details[0]->title) ?>/<?php echo base64_encode($bid_details[0]->job_id);?>">View Origial job post</a></div>
				</div>
				 <?php
				$perHrs = '';
				   if ($job_details[0]->job_type == 'hourly'){
					   $perHrs = '/hr';
				   }
				  ?>
				  <?php if($bid_details[0]->offer_bid_amount !=""){
							$hourlyreate = $bid_details[0]->offer_bid_amount;
						}else{
							$hourlyreate = $bid_details[0]->bid_amount;
				
						}?>
				<?php if ($job_details[0]->job_type == 'hourly'){	 ?>	
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				     <label class="">Hourly Rate: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt" style="font-size:17px;"><b>$<?=$hourlyreate;?><?=$perHrs;?></b></div>
				</div>
				
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				        <label class="">Weekly Limit: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt" style="font-size:17px;"><b><?php echo $bid_details[0]->weekly_limit;?></b> Hrs</div>
				</div>
				<?php } ?>
				<?php if ($job_details[0]->job_type == 'fixed'){	 ?>	
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				        <label class="">Amount: </label>
				    </div>
				    </div>
				    <div style="font-size:17px;" class="col-md-8 canceloffer_cus_right_txt"><b>$<?php echo $bid_details[0]->hired_on;?></b></div>
				</div>
				
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				     <label class="">Payment Type: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt" ><?php $type = $bid_details[0]->fixed_pay_status;
							if($type == 1){ echo " Paid All";}
							if($type == 0){ echo "Paid Nothing";}
							if($type == 2){ echo " Milestone";}
							
					?>
					</div>
				</div>
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				        <label class="">Paid Amount: </label>
				    </div>
				    </div>
				    <div style="font-size:17px;" class="col-md-8 canceloffer_cus_right_txt"><b><?php if($type == 1 ||$type == 2){ echo '$'.$bid_details[0]->fixedpay_amount;   } else{ echo '$0.00';}?> </b></div>
				</div>
				<?php } ?>
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				    <label class="">Offer date: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt"><?php  echo date(' M j, Y ', strtotime($bid_details[0]->start_date)); ?></div>
				</div>
				
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				      <label class="">Job Duration: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt"><?php echo str_replace('_', '-', $job_details[0]->job_duration) ?></div>
				</div>
				<div class="row margin-top-2">
				    <div class="col-md-3 col-md-offset-1">
				    <div class="offer_title">
				       <label class="">Message: </label>
				    </div>
				    </div>
				    <div class="col-md-8 canceloffer_cus_right_txt"><?php echo $bid_details[0]->hire_message; ?></div>
				</div>
				<div class="row margin-top-2">
				    <div class="col-md-6 text-right">
				       <div class="dicline_btn">
				            <button style="float: right;margin-right: 2px;" class="btn-primary big_mass_active transparent-btn big_mass_button" onclick="decline(<?=$bid_details[0]->id?>)">Decline Offer</button>
				       </div>
				    </div>
				    <div class="col-md-6">
				        <div class="dicline_btn">
				            <button style="float: left;margin-left: -60px;" class="btn-primary transparent-btn big_mass_button" onclick="">Cancel</button>
				       </div>
				    </div>
				</div>

			</div>
		</div>
	</div>

</section>

</div>

</section>
<!-- big_header-->


<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog cccc_massage_box">
    <div style="padding: 30px;padding-bottom: 60px;" class="modal-content">
        <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup()">&times;</button>
        <h4 class="modal-title">Message</h4>
	  
      <div class="modal-header">
			<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
				<div class="chat-details-topbar">
					<h3><?=$job->webuser_fname ?> <?=$job->webuser_lname ?></h3>
					<h5><?=$job_title;?> </h5>
									
				</div>
			</div>
      </div>
		<div style="padding-bottom: 20px !important;" class="modal-body">
			<div style="min-height: 250px;" class="message_lists chat-details form-group" ></div>
			<form style="position:relative;" name="message" action="" method="post" id="conversion_message">
				 <textarea style="width: 76%;" name="usermsg"  id="usermsg"></textarea>
					<div style="position: absolute;right: 23%;font-size: 26px;top: 35%;color:#a2a2a2;transform: rotate(90deg);" class="attach_icon">
					<i style="cursor: pointer;" class="fa fa-paperclip" aria-hidden="true"></i>
					</div>
				   <input name="job_id" type="hidden" id="job_id"  value="" />
				   <input name="bid_id" type="hidden" id="bid_id"  value=""  />
				   <input name="sender_id" type="hidden" id="sender_id"  value="<?php echo $this->session->userdata('id');?>"  />
				   <input name="receiver_id" type="hidden" id="receiver_id"  value=""  />
				 <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
			</form>
		</div>
    </div>
 </div>
</div>

<script>
    function loadmessage( b_id, u_id, j_id ){
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:b_id, user_id : u_id, job_id : j_id },  function(data) {
			$('.message_lists').html(data.html);
            $('#job_id').val( j_id );
            $('#bid_id').val( b_id );
            $('#receiver_id').val( u_id );
            // $('#message_convertionModal').modal('show');
			modal.style.display = "block";
           // $('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
            autoloading();
		}, 'json');
       
    }
	 function hidemessagepopup(){
        var modal = document.getElementById('message_convertionModal');
        modal.style.display = "none";
    }
	 
    $("#conversion_message").on("submit", function(e) {
          e.preventDefault();
          var $form = $("#conversion_message");
          if ( $('#usermsg').val().trim().length > 0 ) {
                $.post("<?php echo site_url('jobconvrsation/add_conversetion');?>", { form: $form.serialize() },  function(data) {
                    if(data.success){
                        $form[0].reset();
                        loadmessage( $('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val() );
                         
                    }
                    else{
                        alert('Opps!! Something went wrong.')
                    }
                   
                }, 'json');
          }
         
    });
    
      function loadmessage_auto( ){
        
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:auto_bid_id, user_id : auto_receiver_id, job_id : auto_job_id },  function(data) {
			$('.message_lists').html(data.html);
           
            //$('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
		}, 'json');
    }
    
    function autoloading() {
        //alert('hi');
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
       
        if (auto_job_id) { auto_job_id = auto_job_id;}else{auto_job_id = 0}
        if (auto_bid_id) { auto_bid_id = auto_bid_id;}else{auto_bid_id = 0}
        if (auto_receiver_id) { auto_receiver_id = auto_receiver_id;}else{auto_receiver_id = 0}
       
        if (auto_job_id && auto_bid_id && auto_receiver_id) {
            setInterval('loadmessage_auto()', 5000);
        }
    }
  autoloading();
  
  function decline(bid_id){
	  $.post("<?php echo site_url('canceloffer/decline');?>", { bid_id:bid_id },  function(data) {
			
			if(data.success){
					$('.result-msg').html(data.message);
					$(".result-msg").show().delay(4000).fadeOut('slow');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					window.setTimeout(function() {
						window.location.href = base_url() + 'jobs-home';
					}, 5000);
			}
		}, 'json');
  }
  
</script>