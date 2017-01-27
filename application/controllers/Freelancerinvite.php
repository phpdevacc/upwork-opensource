<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancerinvite extends CI_Controller {
	
	  public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
      
    }
	

	public function index() {

            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
		if ($this->Adminlogincheck->checkx()){
              $postId = base64_decode($_GET['fmJob']);
			
			$id = $this->session->userdata('id');

            $this->db->select('webuser.*,jobs.*,jobs.created created');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('id' => $postId));
            $record = $query->row();
            $query = $this->db->get_where('job_bids', array('job_id' => $postId, 'user_id' => $id, 'status!=1' => null));
            $bids_details = $query->row();
            $is_applied  = $query->num_rows();
            
            
            //conversation
            $conversation_count = 0;
            $conversation = array();
            
            if( $is_applied ){     
                $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->where('job_conversation.receiver_id', $id);
                $this->db->where('job_conversation.job_id', $postId);
                $this->db->where('job_conversation.bid_id', $bids_details->id);
                
                $query=$this->db->get();// assign to a variable
                $conversation_count = $query->num_rows();// then use num rows
     
                
               
                if( $conversation_count ){
                
                    $this->db->select('job_conversation.*,webuser.*');
                    $this->db->from('job_conversation');
                    $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
                    $this->db->where('job_conversation.job_id', $postId);
                    $this->db->where('job_conversation.bid_id', $bids_details->id);
                    $this->db->order_by("job_conversation.id", "ASC");
                    $query_conversation=$this->db->get();
                    $conversation =  $query_conversation->result();
                }
            }
		
		
		$this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
		$this->db->from('job_accepted');
		$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
		$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
		$this->db->where('job_accepted.buser_id',$record->user_id);
		$query=$this->db->get();
		$accepted_jobs = $query->result();
		//echo $this->db->last_query();
		
		$this->db->select('*');
		$this->db->from('jobs');
		$this->db->where('user_id',$record->user_id);
		$query_sidebar=$this->db->get();
		$record_sidebar = $query_sidebar->result();
            
            $jobids = array();
            foreach($record_sidebar as $jobs){
                 $jobids[] = $jobs->id;
              }
             $jobids = implode(",",$jobids);
             
             
             $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where_in('job_id',$jobids);
            $this->db->where('hired',1);
            $query_hire=$this->db->get();
            $record_hire = $query_hire->result();
            
             $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where_in('cuser_id',$record->user_id);
            $queryhour=$this->db->get();
            $workedhours = $queryhour->result();
		
		
			   
            $data = array('value' => $record, 'applied' => $is_applied, 'conversations' => $conversation, 'conversation_count' => $conversation_count, 'bid_details'=>$bids_details,'js' => array('vendor/jquery.form.js', 'internal/job_withdraw.js'),'accepted_jobs'=>$accepted_jobs,'record_sidebar' => $record_sidebar,'hire'=>$record_hire,'workedhours'=>$workedhours);
            $this->Admintheme->webview("freelancerinvite", $data);
        }

	}
}