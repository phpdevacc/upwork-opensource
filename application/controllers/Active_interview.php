<?phpdefined('BASEPATH') OR exit('No direct script access allowed');class Active_interview  extends Winjob_Controller{    private $process;        public function __construct()    {        parent::__construct();        $this->load_language();        $this->load->model(array('Category', 'Common_mod', 'Process'));        $this->process = new Process();    }        /**     * Load the appropriate language file     */    protected function load_language(){        parent::load_language();        $this->lang->load('job', $this->get_default_lang());    }        public function index()    {        $this->checkForFreelancer();                $user_id     = $this->session->userdata(USER_ID);        $interviews  = $this->process->get_active_interviews($user_id);        $archived_offers  = $this->process->get_archived_interviews($user_id);                $this->twig->display('webview/jobs/twig/my-interviews', compact('interviews'));    }        public function index_old() {                $this->checkForFreelancer();                        $user_id = $this->session->userdata('id');        $active_interviews = $this->process->get_active_interviews($user_id);              $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created');       $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');       $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');       $this->db->where('job_bids.user_id',$user_id);       $this->db->where('job_bids.hired','0');       // added by jahid start        $this->db->where('job_bids.job_progres_status','2');       // added by jahid end        $this->db->where('job_bids.status',0);       $this->db->order_by("jobs.id", "desc");       $query=$this->db->get('jobs');     //$this->db->last_query();       $record_offer = $query->result();       $user_id = $this->session->userdata('id');       $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');        $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');        $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');        $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');       $this->db->where('job_bids.user_id',$user_id);       $this->db->where('job_bids.status',1);         // added by jahid start         $this->db->where('job_bids.job_progres_status', 1);        $this->db->where(array('job_bids.withdrawn' => 1));        // added by jahid end        $this->db->group_by('jbid_id');        $this->db->order_by("jobs.id", "desc");       $query=$this->db->get('jobs');       $declined1 = $query->result();       $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');        $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');        $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');        $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');       $this->db->where('job_bids.user_id',$user_id);       $this->db->where('job_bids.bid_reject',1);         // added by jahid start         $this->db->where('job_bids.job_progres_status', 1);        $this->db->where(array('job_bids.withdrawn' => 1));         // added by jahid end        $this->db->group_by('jbid_id');        $this->db->order_by("jobs.id", "desc");       $query=$this->db->get('jobs');       $declined2 = $query->result();       $declined = array_merge($declined1, $declined2);       $offers = $this->process->get_total_offers($user_id);       $data = array(           'active_interview'     => $active_interviews['data'],           'nb_active_interview'  => $active_interviews['rows'],           'active_offer'=> $offers,            'offer_rows' => $offers['data'],            'declined' => $declined,            'title' => 'Active Interviews - Winjob',            'css' => array("","","","assets/css/pages/Active_interview.css")       );       $this->Admintheme->custom_webview("jobs/my-offers", $data);    }        public function declined_interview() {        if ($this->Adminlogincheck->checkx()){            if($this->session->userdata('type') != 2){                redirect(site_url("jobs-home"));            }            $user_id = $this->session->userdata('id');            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');             $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');             $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');             $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.status',1);              // added by jahid start              $this->db->where('job_bids.job_progres_status', 1);             $this->db->where(array('job_bids.withdrawn' => 1));             // added by jahid end             $this->db->group_by('jbid_id');             $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $record1 = $query->result();            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');             $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');             $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');             $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.bid_reject',1);              // added by jahid start              $this->db->where('job_bids.job_progres_status', 1);             $this->db->where(array('job_bids.withdrawn' => 1));              // added by jahid end             $this->db->group_by('jbid_id');             $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $record2 = $query->result();            $record= array_merge($record1,$record2);            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created');            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.hired','1');            $this->db->where('job_bids.status',0);            $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $record_offer = $query->result();            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');             $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');             $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');             $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.status','0');            $this->db->where('job_bids.bid_reject','0');             // added by jahid start              $this->db->where('job_bids.job_progres_status', '1');             $this->db->where(array('job_bids.withdrawn' => NULL));              // added by jahid end             $this->db->group_by('jbid_id');             $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $count_int = $query->num_rows();            $offers = $this->process->get_total_offers($user_id);            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');            $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.status',1);            $this->db->where('job_bids.job_progres_status', 1);            $this->db->where(array('job_bids.withdrawn' => 1));            $this->db->group_by('jbid_id');             $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $declined1 = $query->result();            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');            $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');            $this->db->where('job_bids.user_id',$user_id);            $this->db->where('job_bids.bid_reject',1);             $this->db->where('job_bids.job_progres_status', 1);            $this->db->where(array('job_bids.withdrawn' => 1));             $this->db->group_by('jbid_id');             $this->db->order_by("jobs.id", "desc");            $query=$this->db->get('jobs');            $declined2 = $query->result();            $declined = array_merge($declined1, $declined2);            $data = array('declined' => $declined, 'active_interview' => $record, 'active_offer'=> $offers['rows'], 'offer_rows' => $offers['data'], 'count_interview' => $count_int, 'css' => array("","","","assets/css/pages/declined_interview.css"));            $this->Admintheme->custom_webview("jobs/declined_interview", $data);        }    }}?>