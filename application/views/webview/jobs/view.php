<?php
//die();
//date_default_timezone_set("UTC");
function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array(365 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    $a_plural = array('year' => 'years',
        'month' => 'months',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
?>

<?php

/* find client payment set status start */

$this->db->select('*');
$this->db->from('billingmethodlist');
$this->db->where('billingmethodlist.belongsTo', $value->webuser_id);
// $this->db->where('billingmethodlist.paymentMethod', "stripe");
$this->db->where('billingmethodlist.isDeleted', "0");
$query = $this->db->get();
$paymentSet = 0;
if (is_object($query)) {
    $paymentSet = $query->num_rows();
}
/* find client payment set status end */


/* find total spent by client start */
$client_id=$value->webuser_id;
$query_spent = $this->db->query("SELECT SUM(payment_gross) as total_spent FROM `payments` INNER JOIN `webuser` ON `webuser`.`webuser_id` = `payments`.`user_id` INNER JOIN `jobs` ON `jobs`.`id` = `payments`.`job_id` INNER JOIN `job_accepted` ON `job_accepted`.`job_id` = `payments`.`job_id` INNER JOIN `job_bids` ON `job_bids`.`job_id` = `payments`.`job_id` WHERE `job_accepted`.`fuser_id` = `payments`.`user_id` AND
    `job_bids`.`user_id` = `payments`.`user_id` AND `payments`.`buser_id` = $client_id");
$row_spent = $query_spent->row();
$total_spent=$row_spent->total_spent;
/* find total soent by client end */




$total_feedbackScore=0 ;
$total_budget=0 ;
foreach($accepted_jobs as $job_data){
	$this->db->select('*');
	$this->db->from('job_feedback');
	$this->db->where('job_feedback.feedback_userid',$job_data->fuser_id);
	$this->db->where('job_feedback.sender_id !=',$job_data->fuser_id);
	$this->db->where('job_feedback.feedback_job_id',$job_data->job_id);
	$query=$this->db->get();
	$jobfeedback= $query->row();
	
	if($job_data->jobstatus == 1){
		if(!empty($jobfeedback)){
			if($job_data->job_type == "fixed"){
				$total_price_fixed=$job_data->fixedpay_amount;
				$total_feedbackScore += ($jobfeedback->feedback_score *$total_price_fixed);
				$total_budget += $total_price_fixed;
			}else{
				$this->db->select('*');
				$this->db->from('job_workdairy');
				$this->db->where('fuser_id',$job_data->fuser_id);
				$this->db->where('jobid',$job_data->job_id);
				$query_done = $this->db->get();
				$job_done = $query_done->result();
				$total_work = 0;
				foreach($job_done as $work){
					$total_work +=$work->total_hour;
				}
				
				if($job_data->offer_bid_amount) {
				$amount = $job_data->offer_bid_amount;
				} else {$amount =  $job_data->bid_amount;} 
				 $total_price= $total_work *$amount;
				$total_budget += $total_price ;
				$total_feedbackScore += ($jobfeedback->feedback_score *$total_price);
			}
		}
	}
}
?>

<p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container">
        <div class="row">
             <?php
           // print_r($value);
            
            if($value->status=='0'){?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> The job does not exist.
                </div>
                <?php }
                ?>
            <div class="col-md-9 col-md-offset-0 white-box" style="padding: 20px 30px;">
                <?php
                $marginClass = '';
                if ($this->session->userdata('type') == '1')
                {
                    ?>
                    <?php
                    $marginClass = 'margin-top';
                }
                ?>
                <div class="row <?php echo $marginClass; ?>">
                    <div class="col-md-6 page-label">
                        <h1 class="job-title cos_job-title"><?php echo ucfirst($value->title) ?></h1>
                    </div>
                    <div class="col-md-6 page-label">
                        
                        <span style="margin-top: -15px;" class="pull-right"><?php
                       // date_default_timezone_set("Asia/Bangkok");
                        $timeDate = strtotime($value->created);
                        $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                            
                        echo time_elapsed_string(strtotime($dateInLocal)); ?></span>
                    </div>
                </div>
                <div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                     
                    <div class="col-md-3 text-center">
                        <label>Job Type</label> <br /> <span><?php echo ucfirst($value->job_type) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label>
                            <?php
                            if ($value->job_type == 'hourly')
                            {
                                echo "Hourly Per week";
                            } else
                            {
                                echo 'Budget $';
                            }
                            ?>
                        </label><br /><span><?php
                            if ($value->job_type == 'hourly')
                            {
                                echo $value->hours_per_week;
                            } else
                            {
                                echo '$' . round($value->budget, 2);
                            }
                            ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label>Job Duration</label><br /> <span><?php echo str_replace('_', '-', $value->job_duration) ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label>Experience Level</label><br /> <span><?php echo ucfirst($value->experience_level); ?></span>
                    </div>
                   
                </div>
                </div>    
                <div style="margin-top: 15px;" class="row margin-top">
                    <div class="col-md-2">
                        <label style="font-family: calibri;font-size: 16px;">Job Category</label>
                    </div>
                    <div style="margin-top: 4px;" class="col-md-10">
                       <?php 
                       
                       $this->db->select('*');
				$this->db->from('job_subcategories'); 
				$this->db->where('subcat_id',$value->category);
				$query_done = $this->db->get();
                                $result= $query_done->row();
                                echo $result->subcategory_name;
                       ?>
                    </div>
                    </div>
                <div style="margin-top: 10px;" class="row req-skills margin-top page-label">
                    <div class="col-md-2">
                        <label style="font-family: calibri; font-size: 16px; color: rgb(51, 51, 51);margin-top: -7px;">Skills</label>
                    </div>

                    <div class="col-md-10 skills page-label">
						<div class="custom_user_skills">
							<?php
							if (isset($value->job_skills) && !empty($value->job_skills))
							{
								$skills =$value->job_skills;
							 
								if(count($skills)<=1){
									echo "<span> ".$skills[0]['skill_name']."</span> ";
								}else{
									foreach ($skills as $skill)
										echo "<span> ".$skill['skill_name']."</span> ";
								}
								
							}
							?>
						</div>
                    </div>
                </div>

                <div style="margin-top: 5px;" class="row margin-top page-label">
                    <div class="col-md-9">
                        <label style="font-family: calibri;font-size: 16px;margin-top: 9px;">Details</label>
                        <label style="font-family: calibri;font-size: 16px;margin-top: 9px;">Details</label>
                    </div>
                    <div style="font-family: calibri; font-size: 15px; margin-bottom: 17px; margin-top: 8px;" class="col-md-12 text-justify page-label"><?php echo ucfirst($value->job_description) ?></div>
                </div>
<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-4 text-center">
 <?php 
$this->db->select('*');
$this->db->from('job_bids');
$this->db->where(array('job_id'=>$value->id,'bid_reject'=>0, 'status!=1'=>null));
$query =$this->db->get();
$Proposals_count = $query->num_rows();
$jobfeedback= $query->result();
//var_dump($value->id);var_dump($Proposals_count);die();
?>
                        <label>Proposals</label> <br /> <span>
                       <?=$Proposals_count;?>
                        </span>
                    </div>

                    <div class="col-md-4 text-center page-label">
 <?php 
$this->db->select('*');
$this->db->from('job_conversation');
$this->db->where('job_conversation.sender_id', $value->user_id);
$this->db->join('job_bids', 'job_bids.id=job_conversation.bid_id', 'inner');
$this->db->where('job_conversation.job_id', $value->id);
$this->db->where('job_bids.bid_reject', 0);
$this->db->group_by('bid_id'); 
$query=$this->db->get();
$interview_count = $query->num_rows();
?>
                        <label>Interviewing</label><br /> <span><?=$interview_count;?> </span>
                    </div>

                    <div class=" last-div col-md-4 text-center page-label">
<?php
$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->where('job_accepted.buser_id',$value->user_id);
$this->db->where('job_accepted.job_id',$value->id);
$this->db->where('job_bids.hired', '0' );
$this->db->where('job_bids.jobstatus', '0' );
$query=$this->db->get();
$hire_count = $query->num_rows();
?>
                        <label>Hired</label><br /> <span>
                            <?php echo $hire_count;?>
                        </span>
                    </div>

                </div> 
                    </div><?php /*?>
				<div class="">
					<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
						<div class="chat-details-topbar">
							<h3><?=$value->webuser_fname?>  <?=$value->webuser_lname?></h3>
							<h5><?=$value->title?></h5>
							<p></p>
						</div>
						<div class="chat-details form-group" style="margin:0;">
							<ul id="scroll-ul">
							<?php
							//$chat_details = array_reverse($chat_details);
							$group_time = false;
							$current_date = strtotime(date("d-m-Y"));
							$date ='';$temp_date ='';
							
							if(!empty($conversations)){
							foreach($conversations as $chat_data) {
							
							if(($chat_data->webuser_picture) == "") { 
								$src = site_url("assets/user.png");
							 } else { 
								$src = base_url().$chat_data->webuser_picture;
							 } 
							
							$temp_date = date("d-m-Y", strtotime($chat_data->created));
							if($date != strtotime($temp_date)){
								$date = strtotime($temp_date);
								$group_time = true;
							}
							else {
								$group_time = false;
							}
							
							if($group_time){
								
							?>
							<li><span class="group-date"><?php if($date == $current_date) { echo "Today";} else { echo date("l, F j, Y", $date);}?></span></li>
							
							<?php } ?>
								<li>							
									<span class="name"><img src="<?=$src?>"><?=$chat_data->webuser_fname?> <?=$chat_data->webuser_lname?></span> <span class="chat-date"><?=date("g:i a", strtotime($chat_data->created))?></span>
									<span id="scroll" class="details"><?=$chat_data->message_conversation?></span>
								</li>
							<?php } }?>

							</ul>
						</div>
						<div class="chat-bar">
							<form id="chat_form" action="">										
							<input type="hidden" id="bid_id" name="bid_id" value="<?=$bid_details->id?>">
							<input type="hidden" name="job_id" id="job_id" value="<?=$value->id?>">
							<input type="hidden" name="user_id" id="user_id" value="<?=$this->session->userdata('id')?>">
							<div style="width:80%;float: left;height: 100px;"><textarea name="chat-input" id="chat-input"></textarea></div>
							<div style="width:20%;float: left;height: 100px;"><a href="javascript:void(0);" id="submit">SEND</a></div>
							</form>
							<span id="error_span" style="color:red;padding: 0 0 0 15px;display:none;"></span>
							<span id="success_span" style="color:green;padding: 0 0 0 15px;display:none;"></span>
						</div>
						
					</div>
				</div>
            <?php */?>
                
            
            
            
                <div class="buttonsidethree">
                    <div class="row margin-top page-label">
                        <div class="col-md-6 col-sm-6">
                            <div class="buttonsidethreeleft">
                                <h2 style="margin-top: 5px; font-family: calibri;">Job History</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
										
                if(!empty($accepted_jobs)){ 
                foreach($accepted_jobs as $job_data){
                    
                    
$this->db->select('*');
$this->db->from('job_feedback');
$this->db->where('job_feedback.feedback_userid',$job_data->fuser_id);
$this->db->where('job_feedback.sender_id !=',$job_data->fuser_id);
$this->db->where('job_feedback.feedback_job_id',$job_data->job_id);
$query=$this->db->get();
$jobfeedback= $query->row();
                    
                    
                ?>
                <div class="buttonsidethree">
                    <div class="row  page-label">
                        <div class="col-md-8 col-sm-6">
                            <div class="buttonsidethreeleft">
                                 <p style="margin: 0px 0px -7px;margin-top: 10px;"><?=$job_data->hire_title?></p>
                                 <h3 style="margin-bottom: -15px;margin-top: 8px;"">
                                 <?php  
                                 
                                 echo date(' M j, Y ', strtotime($job_data->start_date)); ?> 
                                  
                                 <?php if($job_data->jobstatus == 1){  echo " - ". date(' M j, Y ', strtotime($job_data->end_date));  } ?>
                                 </h3>
                                 <p style="font-style: italic; font-size: 17.5px; font-weight: normal; color: rgb(73, 73, 73);margin-bottom: 40px;">
                                    <?php
										if($job_data->jobstatus == 1){
                                        if(!empty($jobfeedback)){
                                        echo $jobfeedback->feedback_comment;
									?>
								</p>
											 
											 <p style="color:#ddd;font-size:17.5px;font-style: italic;font-width:bold;">
											 <?php
                                            $rating_result = ($jobfeedback->feedback_score/5)*100;
                                        }
                                   }else{
                                         echo "Job in progress";
                                   }
                                    ?>
                              
                                 </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6  text-right pull-right">
                            <?php  if($job_data->jobstatus == 1){ ?>
                                    <div class="buttonsidethreeright "style="padding:0;margin: 0;">
                            <?php }else{ ?>
                            <div class="buttonsidethreeright pull-right " style="padding: 0px; margin: 0px;">
                            <?php } ?>
                        
                        <?php if($job_data->job_type == "fixed"){ 
                                 if($job_data->jobstatus == 1){ 
                                     if(!empty($jobfeedback)){ ?>
                                    
                                        <div title="Rated <?=$jobfeedback->feedback_score;?> out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                        <span style="width:<?=$rating_result;?>%">
                                            <strong itemprop="ratingValue"><?=$jobfeedback->feedback_score;?></strong> out of 5
                                        </span>
                                        </div>
                                        <span class="rate pull-right"><?=$jobfeedback->feedback_score;?></span>
                                    <?php }else{ ?>
                                        <div title="Rated 0 out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                        <span style="width:0%">
                                            <strong itemprop="ratingValue">0</strong> out of 5
                                        </span>
                                        </div>
                                        <span style="font-size: 20px; margin-bottom: -11px;" class="rate pull-right">0.00</span>
                                    <?php }  }?>
                                    
                                         <h3 style='margin-top: 7px; font-family: "Calibri"; font-size: 20px; font-weight: 800;'>Paid $<?=$job_data->fixedpay_amount?></h3>
                                         <h4></h4>
                                    
                        <?php } else { 
                             if($job_data->jobstatus == 1){
                                     if(!empty($jobfeedback)){ ?>
                                    <div title="Rated <?=$jobfeedback->feedback_score;?> out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                    <span style="width:<?=$rating_result;?>%">
                                        <strong itemprop="ratingValue"><?=$jobfeedback->feedback_score;?></strong> out of 5
                                    </span>
                                    </div>
                                    <span class="rate pull-right"><?=$jobfeedback->feedback_score;?></span>
                                <?php }else{ ?>
                                    <div title="Rated 0 out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                    <span style="width:0%">
                                        <strong itemprop="ratingValue">0</strong> out of 5
                                    </span>
                                    </div>
                                    <span class="rate pull-right">0.00</span>
                                <?php } }?>
                                    
                                     <h6 style="margin-top: 8px;">
                                     <?php
                                     $this->db->select('*');
                                    $this->db->from('job_workdairy');
                                    $this->db->where('fuser_id',$job_data->fuser_id);
                                    $this->db->where('jobid',$job_data->job_id);
                                    $query_done = $this->db->get();
                                    $job_done = $query_done->result();
                                      $total_work = 0;
                                        if(!empty($job_done)){
                                            foreach($job_done as $work){
                                                $total_work +=$work->total_hour;
                                            }
                                            echo $total_work." hours";
                                        }else{
                                            echo "0.00 hours";
                                        }
                                    ?>
                                     
                                     </h6>
                                     <h3 style="margin-top: -8px;margin-bottom: 20px;">
                                        <?php if($job_data->offer_bid_amount) {
        $amount = $job_data->offer_bid_amount;
        } else {$amount =  $job_data->bid_amount;} ?>
                                        <?php $total_price= $total_work *$amount;?>
                                        $<?=$total_price?> 
                                     </h3>

                        <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>

                <?php } } else { ?>	
                    
                <div class="margin-top page-label">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="buttonsidethreeleft">
                                Yet more Jobs to Go 
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>	
            
          
            </div>
            <?php
            //echo "<pre>";
            //print_r($bids_details);
            ?>   
            <div class="col-md-3" >
                <?php
                if ($this->session->userdata('type') == '2')
                {
                    if ($applied)
                    {
                        ?>
						
                       <div class="row">
                            <div class="col-md-10 col-md-offset-2">
                                <div class="alert alert-warning">
                                    <strong>You have already applied for this job.</strong>
                                    <?php /*
                                    if ($conversation_count)
                                    {
                                    ?>
                                    <button type="button" class="btn btn-primary form-btn" id="start_chat"  onclick="loadmessage(<?=$bid_details->id?>,<?=$value->user_id?>,<?=$value->id?>)">Message</button>
                                    <?php
                                    } */
                                    ?>
                                  
                                </div>
                            </div>
                        </div>
						
                    <?php  } else {  ?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-2">
								<?php if($ststus->isactive==0){ ?>
										<a style="padding-left: 38px;" href="javascript:void(0)"><button type="button" class="btn btn-primary">Proposal is in Hold</button></a>
									<?php }elseif ($proposals >= 30){ ?>
                                    <div class="alert alert-warning">
                                        <strong>Warning!</strong> You reach your monthly proposals limit.
                                    </div>
                                    <?php } else { ?>
                                    <a style="padding-left: 0;" href="<?php echo site_url("jobs/apply/" . url_title($value->title) . '/' . base64_encode($value->id)); ?>"><button style="margin: 20px 0 !important;width: 170px;height: 40px;font-size: 18px;background: #028FCC;color: #fff;" type="button" class="btn btn-primary custon_send_pro">Send a Proposal</button></a>
									<?php }?>
                               
								
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
                <div class="row client-activity">
                    <div style="padding: 0 30px 9px;" class="col-md-10 col-md-offset-2 right-section ">
                        <div class="row margin-top-2">
                            <div class="col-md-12">
                                
                                <?php
if ($value->isactive && $paymentSet) {
    ?>
										<i style="margin-top: -10px; margin-left: -4px; font-size: 25px; color: rgb(2, 143, 204);position: absolute;top: 8px;" class="fa fa-check-circle"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i style="margin-top: -10px; margin-left: -4px; font-size: 25px; color: rgb(187, 187, 187);position: absolute;top: 8px;" class="fa fa-minus-circle"></i>
                                        <?php
                                    }
                                    ?>
                                <label style="margin-left: 25px;"><?php echo ucfirst($value->webuser_fname) ?></label>
                                
                                
                            </div>
                        </div>
                        <div class="row margin-top-2 border-bottom">
                            <div style="font-family: Calibri;font-size: 18px;margin-left: 15px;margin-top: -15px;" class="">
								
								<i class="fa fa-map-marker"></i>
								
								<?php
                                $this->db->where('country_id', $value->webuser_country);
                                $q = $this->db->get('country');
                                $record = $q->row();
                                echo ucfirst($record->country_name);
                                ?>
                            </div>
                        </div>
                        <div style="margin-top: 10px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-8 ">
								<?php if($total_feedbackScore !=0 && $total_budget!=0){
                                $totalscore = ($total_feedbackScore / $total_budget);
                                $rating_feedback = ($totalscore/5)*100;
                               ?>
                                <button style="font-size: 10px;background:#F77D0E;padding: 2px 4px;border-radius: 2px;" id="buttonfirst"><?=number_format((float)$totalscore,1,'.','');?></button>
								<div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="right: -12%;margin-top: -4%;position: absolute;">
								<span style="width:<?=$rating_feedback;?>%">
									<strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
								</span>
								</div>
							<?php  }else{ ?>
                             <button style="font-size: 10px;background:#F77D0E;padding: 2px 4px;border-radius: 2px;"  id="buttonfirst">0.0</button>
								<div style="right: -12%;margin-top: -4%;position: absolute;" title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="right: -45%;margin-top: 2%;position: absolute;">
								<span style="width:0%">
									<strong itemprop="ratingValue">0</strong> out of 5
								</span>
								</div>
                          <?php   } ?>
                               
                            </div>
                        </div>
                        <div style="margin-top: 14px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 14px;margin-top: -29px;">
                                   <?php if(!empty($record_sidebar)){
                                        echo count($record_sidebar);
                                    }else{
                                        echo "0";
                                    } ?>
								Jobs Posted
								</label>
                            </div>
                        </div>
                        <div style="margin-top: 4px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 14px;margin-top: -29px;">
								<?=count($hire);?> 
								Hired
								</label>
                            </div>
                        </div>
                        <div style="margin-top: 2px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 14px;margin-top: -29px;">
								<?php $total_work = 0;
                                    if(!empty($workedhours)){
                                        foreach($workedhours as $work){
                                            $total_work +=$work->total_hour;
                                        }
                                        echo $total_work." Hours";
                                    }else{
                                        echo " 0 Hours Worked";
                                    }?> 
								Worked
								</label>
                            </div>
                        </div>

                        <div style="margin-top: 4px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 14px;margin-top: -29px;">
								$<?php echo round($total_spent,0);?>
								Spent
								</label>
                            </div>
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

<hr>

</div>

 

<script src="<?php echo base_url() ?>assets/js/dropzone.js"></script>
<script>

</script>

                      
<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup()">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div class="job_details">
            <h3><?php echo $value->webuser_fname;?> <?php echo $value->webuser_lname;?>
            <span class="job_create" style="font-size: 13px;"><?php  echo date(' F j, Y g:i A', strtotime($value->created)); ?></span></h3>
           <span><?php echo $value->title;?></span>
        </div>
        <hr>
       <div class="message_lists" ></div>
       <hr>
      
           
           <form name="message" action="" method="post" id="conversion_message">
             <textarea name="usermsg"  id="usermsg"></textarea>
               <input name="job_id" type="hidden" id="job_id"  value="<?php echo $value->id;?>" />
               <input name="bid_id" type="hidden" id="bid_id"  value="<?php echo $bid_details->id;?>"  />
               <input name="sender_id" type="hidden" id="sender_id"  value="<?php echo $this->session->userdata('id');?>"  />
               <input name="receiver_id" type="hidden" id="receiver_id"  value="<?php echo $value->user_id;?>"  />
             <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
         </form>
       </div>
    </div>
 </div>
</div>
            


 <script>
    $( document ).ready(function() {
        
    //	$("#submitmsg").on("click", function(e) {
    //       e.preventDefault();
    //       var usermsg = $("#usermsg").val();
    //       if( usermsg === ''){
    //            return false;
    //        }
    //        	var fd = new FormData(document.querySelector("form#conversion_message"));
    //         $.ajax({
    //            url: "<?php echo site_url('jobconvrsation/add_conversetion');?>",
    //            type: "POST",
    //            data: fd,
    //            processData: false, 
    //            contentType: false,   
    //            success     : function(data){
    //                $("#usermsg").val("");
    //                $.ajax({
    //                    url: "<?php echo site_url('jobconvrsation/current_conversetion?lastid=');?>"+data,
    //                    type: "POST",
    //                    processData: false, 
    //                    contentType: false,   
    //                        success     : function(result){
    //                            $("#chatbox").css('display','block');
    //                           $("#chatbox_details ul").append(result);
    //                           $('#mylist').animate({scrollTop: $('#mylist').prop("scrollHeight")}, 500);
    //                        }
    //                    });
    //            }
    //         });
    //        });

//var modal = document.getElementById('message_convertionModal');
//var btn = document.getElementById("start_chat");
//var span = document.getElementsByClassName("close")[0];
//btn.onclick = function() {
//    modal.style.display = "block";
//    $('#mylist').animate({scrollTop: $('#mylist').prop("scrollHeight")}, 500);
//}
//span.onclick = function() {
//    modal.style.display = "none";
//}
//
//window.onclick = function(event) {
//    if (event.target == modal) {
//        modal.style.display = "none";
//    }
//}
//            
//            
            
        });
    
    
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
		}, 'json');
    }
    
    function loadmessage_auto( b_id, u_id, j_id ){
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:b_id, user_id : u_id, job_id : j_id },  function(data) {
			$('.message_lists').html(data.html);
           
          //  $('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
		}, 'json');
    }
    
    function hidemessagepopup(){
        var modal = document.getElementById('message_convertionModal');
        modal.style.display = "none";
    }
    
    var auto_job_id = $('#job_id').val();
    var auto_bid_id = $('#bid_id').val();
    var auto_receiver_id = $('#receiver_id').val();
   
    if (auto_job_id) { auto_job_id = auto_job_id;}else{auto_job_id = 0}
    if (auto_bid_id) { auto_bid_id = auto_bid_id;}else{auto_bid_id = 0}
    if (auto_receiver_id) { auto_receiver_id = auto_receiver_id;}else{auto_receiver_id = 0}
    
    if (auto_job_id && auto_bid_id && auto_receiver_id) {
       setInterval('loadmessage_auto( '+auto_bid_id+', '+auto_receiver_id+', '+auto_job_id+' )', 5000);
    }
    
    
function Confirmremove(id) {

	var x = confirm("Are you sure you want to Remove the post?");
	
	if (x){
		$.post("<?php echo site_url('jobs/removepost');?>", { form : id },  function(data) {
			if(data.success){
				$('.result-msg').html('You have successfully Remove the Post');
					$(".result-msg").show().delay(5000).fadeOut();
					$('html, body').animate({    scrollTop: $(".result-msg").offset().top}, 2000);
					setTimeout(function(){ window.location = "<?php echo base_url();?>jobs-home"; }, 5000);
					
			} else{
					alert('Opps!! Something went wrong.');
			}
		   
		}, 'json');
	}
}     
    
    
  </script>
 
  <style>
/* #chatbox {  background: #fff none repeat scroll 0 0;  border: 1px solid #acd8f0;  height: 300px;  overflow: auto;  padding: 10px;  text-align: left;  width: 100%;}
#usermsg {  border: 1px solid #acd8f0;  width: 79%;}
input#submitmsg {  background: #2baad9 none repeat scroll 0 0;  border: medium none !important;  font-size: 21px;  padding: 8px 2px;  text-align: center;  width: 20%;}
.chat_details li {  display: block;  margin-bottom: 10px;}
.chat-identity {  display: block;  float: left;  width: 100%;}
.chat-identity img {  float: left;  margin-right: 20px;}
.chat-identity h4 {  display: block;  font-size: 17px !important;  margin-top: 7px;  vertical-align: middle;}
#mylist {    width: 100%;     height: 275px;    padding: 20px;    background-color: #eeeeee;    overflow-y: auto;}
.modal {    display: none;position: fixed;z-index: 1;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;    background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);}
.modal-content {    background-color: #fefefe;    margin: 5% auto;    padding: 20px;    border: 1px solid #888;    width: 100%; }
.close {    color: #000;    float: right;    font-size: 28px;    font-weight: bold;}
.close:hover,.close:focus {    color: black;    text-decoration: none;    cursor: pointer;}*/
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}
</style> 
<style>
	.row.chat-box { min-height: 400px; border: 1px solid; padding: 16px;}
	.chat-screen { border: 2px solid #2cabda; padding: 0; min-height: 430px; margin-top: 25px;}
	.chat-details-topbar { min-height: 100px; position: absolute; top: 0; background: #fff; width: 100%; z-index: 99; border-bottom: 2px solid #1ca7db;}
	.chat-details { width: 100%; z-index: 1; bottom: 0; min-height: 190px; height: 190px; position: absolute; background: #fff; overflow-x: hidden; overflow-y: scroll;top: 100px;}
	.chat-details ul li { list-style-type: none; padding: 10px 0;}
	.chat-details ul li span img { width: 50px; border-radius: 50%; margin: 0 15px 0 0;}
	.chat-details-topbar h3 { padding: 6px 10px; font-weight: bold;}
	.chat-details-topbar h5 { padding: 0 10px;}
	.chat-details-topbar p { padding: 24px 0 0px 10px; margin: 0;  color: #757575;}
	.chat-details ul li span.details { display: block; margin-left: 53px;  font-size: 14px;  color: #757474;}
	textarea#chat-input { width: 95%; height: 100px; margin: 0 0 0 15px;  border: 2px solid #1ca7db;}
	.active { border: 2px solid #1ca7db;  color: #1ca7db;}
	.chat-sidebar a { color: #000;}
	.chat-bar { width: 100%; z-index: 1; bottom: 0; min-height: 100px; height: 100px; position: absolute; background: #fff; top: 300px; }
	form#chat_form a {  display: inline-block; background: #1ca7db; color: #fff; text-align: center;  font-size: 25px;  padding: 11px 25px;  margin: 20px 0;    text-decoration: none;}
	span.chat-date { font-size: 13px; padding: 0 0 0 15px; color: #949494;}
	span.group-date { display: block; text-align: center; font-size: 16px; color: #7d7b7b;}
	span.name { text-transform: capitalize;}
	span.text1 {text-transform: capitalize;}
	.buttonsidethreeright.pull-left {  margin-left: 45%;}
	#buttonfirst {  background: #eba705 none repeat scroll 0 0;  border: medium none;  border-radius: 5px;  color: #fff;  float: left;  font-family: "Arial";  font-size: 17.5px;  margin-top: 2px;  padding: 5px 7px;}
	.star-rating {  height: 1.2em;}
.star-rating::before {  color: #b8b8ba; }
.custon_send_pro:hover{background:#286090;}
		</style>
 