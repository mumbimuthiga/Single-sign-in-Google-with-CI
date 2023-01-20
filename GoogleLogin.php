<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleLogin extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('m_rental');
 }

 function login()
 {
  include_once APPPATH . "libraries/vendor/autoload.php";

  $google_client = new Google_Client();

  $google_client->setClientId('590057370884-n02hto3in1nsghef4bkqf50p7ms4vaer.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  $google_client->setRedirectUri('http://localhost/hr/GoogleLogin/login'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $this->session->set_userdata('access_token', $token['access_token']);

    $google_service = new Google_Service_Oauth2($google_client);

    $data = $google_service->userinfo->get();

    $current_datetime = date('Y-m-d H:i:s');

    if($this->m_rental->Is_already_register($data['id']))
    {
     //update data
     $user_data = array(
      'first_name' => $data['given_name'],
      'last_name'  => $data['family_name'],
      'email_address' => $data['email'],
      'profile_picture'=> $data['picture'],
      'updated_at' => $current_datetime
     );

     $this->m_rental->Update_user_data($user_data, $data['id']);
    }
    else
    {
     //insert data
     $user_data = array(
      'login_oauth_uid' => $data['id'],
      'first_name'  => $data['given_name'],
      'last_name'   => $data['family_name'],
      'email_address'  => $data['email'],
      'profile_picture' => $data['picture'],
      'created_at'  => $current_datetime
     );

     $this->m_rental->Insert_user_data($user_data);
    }
    $this->session->set_userdata('user_data', $user_data);
   }
  }
  $login_button = '';
  if(!$this->session->userdata('access_token'))
  {
   $login_button = '<a href="'.$google_client->createAuthUrl().'">Signin With Gmail</a>';
   $data['login_button'] = $login_button;
   $this->load->view('admin/google_login', $data);
  }
  else
  {
   //$this->load->view('admin/google_login', $data);
   $this->load->view('admin/google_login');
   $userloggeddata=$this->session->userdata('user_data');
   //$test=implode(" ",$userloggeddata);
  // $log_id=$userloggeddata["login_oauth_uid"];
  $email=$userloggeddata['email_address'];
  //$user_emailaddress=$email;
  print_r($email);
   //print_r($userloggeddata["login_oauth_uid"]);
  // redirect('admin/leavescheduling/'.$email ,'refresh');
  
   //print_r($this->session->userdata('user_data'));
  }
 }

 function logout()
 {
  $this->session->unset_userdata('access_token');

  $this->session->unset_userdata('user_data');

  redirect('googlelogin/login');
 }
}
?>
