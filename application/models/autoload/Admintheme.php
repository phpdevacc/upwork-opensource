<?php



class Admintheme extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

     function loadview($page,$data){

             $text=$this->siteconfig->text();

    $data['text']=$text;

             $this->load->view('admin/layout/header.php',$data, false);
              $this->load->view('admin/layout/afterheader.php',$data, false);
               $this->load->view('admin/layout/menu.php',$data, false);
               $this->load->view('admin/'.$page,$data, false);
               $this->load->view('admin/layout/footer.php',$data, false);
               $this->load->view('admin/layout/afterfooter.php',$data, false);




     }
     function webview($page,$data){

             $text=$this->siteconfig->text();

    $data['text']=$text;

             $this->load->view('webview/layout/header.php',$data, false);
              $this->load->view('webview/layout/afterheader.php',$data, false);
               $this->load->view('webview/layout/menu.php',$data, false);
               $this->load->view('webview/'.$page,$data, false);
               $this->load->view('webview/layout/footer.php',$data, false);
               $this->load->view('webview/layout/afterfooter.php',$data, false);




     }
     function webview2($page,$data){

             $text=$this->siteconfig->text();

    $data['text']=$text;

             $this->load->view('webview/layout/header2.php',$data, false);
              $this->load->view('webview/layout/afterheader.php',$data, false);
               $this->load->view('webview/layout/menu.php',$data, false);
               $this->load->view('webview/'.$page,$data, false);
               $this->load->view('webview/layout/footer2.php',$data, false);
               $this->load->view('webview/layout/afterfooter.php',$data, false);




     }

    //added by Sergey start
    function webview3($page,$data){

        $text=$this->siteconfig->text();

        $data['text']=$text;

        $this->load->view('webview/layout/header3.php',$data, false);
        $this->load->view('webview/layout/afterheader.php',$data, false);
        $this->load->view('webview/layout/menu.php',$data, false);
        $this->load->view('webview/'.$page,$data, false);
        $this->load->view('webview/layout/footer.php',$data, false);
        $this->load->view('webview/layout/afterfooter.php',$data, false);
    }
    //added by Sergey end

     function webviewx($page,$data){

             $text=$this->siteconfig->text();

    $data['text']=$text;

             $this->load->view('webview/layout/header.php',$data, false);
              $this->load->view('webview/layout/afterheaderx.php',$data, false);
               $this->load->view('webview/layout/menu.php',$data, false);
               $this->load->view('webview/'.$page,$data, false);
               $this->load->view('webview/layout/footer.php',$data, false);
               $this->load->view('webview/layout/afterfooter.php',$data, false);




     }
	 
	 
      function loadviewwf($page,$data,$footer){

              $text=$this->siteconfig->text();

     $data['text']=$text;

              $this->load->view('admin/layout/header.php',$data, false);
               $this->load->view('admin/layout/afterheader.php',$data, false);
                $this->load->view('admin/layout/menu.php',$data, false);
                $this->load->view('admin/'.$page,$data, false);
                $this->load->view('admin/layout/footer.php',$data, false);
                $this->load->view('admin/'.$footer,$data, false);
                $this->load->view('admin/layout/afterfooter.php',$data, false);




      }


 function xx(){

   $this->load->view('admin/layout/h.php',$data, false);
   $this->load->view('admin/layout/ah.php');
   $this->load->view('admin/layout/m.php');
   $this->load->view('admin/layout/am.php');
   $this->load->view('admin/homepage/dashboard.php');
   $this->load->view('admin/layout/f.php');
   $this->load->view('admin/homepage/dashboardf.php');
   $this->load->view('admin/layout/e.php');
   //echo "<a href=\"".site_url("login/logout")."\">logout</a>";


 }


}

?>