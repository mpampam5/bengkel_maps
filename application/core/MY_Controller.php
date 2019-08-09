<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    // $this->load->library(array("Layouts"));
    // $this->load->helper(array('menus','mpampam'));
  }

  function error_404()
  {
    $this->load->library(array("Layouts"));
    $this->layouts->set_title('Error 404 Not Found');
    $this->layouts->view(config_item($this->session->userdata('panel')).'/404');
  }

  function _security_admin($sess)
  {
    if ($this->session->userdata('login')=="" OR $this->session->userdata('login')!=true) {
      $this->session->sess_destroy();
      redirect($sess.'/login');
    }
  }


  function _security_public()
  {
    if ($this->session->userdata('login')=="" OR $this->session->userdata('login')!=true) {
      $this->session->sess_destroy();
      redirect('login');
    }
  }

  // function _security_anggota()
  // {
  //   if ($this->session->userdata('login')=="" OR $this->session->userdata('login')!=true) {
  //     $this->session->sess_destroy();
  //     redirect('backend/login');
  //   }
  // }

  public function _cekfile($str,$name)
  {
    $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
    $mime = get_mime_by_extension($_FILES['userfile']['name']);
    if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
        if(in_array($mime, $allowed_mime_type_arr)){
          if ($_FILES['userfile']['size']>1000000) {
            $this->form_validation->set_message('_cekfile', "Ukuran File Maximal 1mb ");
            return FALSE;
          }else {
            $config['upload_path']   = 'file/uploads/member/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']      = 1024;
            $config['overwrite']     = TRUE;
            $config['file_name']     = $name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $this->form_validation->set_message('_cekfile', "Ukuran File maximal 1mb dan format file jpg/png");
                return FALSE;
            }else {
                $data_upload = $this->upload->data();
                $config2['image_library']   = 'gd2';
                $config2['source_image']    = 'file/uploads/member/'.$data_upload['file_name'];
                $config2['new_image']       =  'file/uploads/member/thumbs/'.$data_upload['file_name'];
                $config2['maintain_ratio']  = true;
                $config2['create_thumb']    = false;
                $config2['quality']         = 50;
                $config2['width']           = 300;
                $config2['height']          = 300;
                $this->load->library('image_lib', $config2);
               if(!$this->image_lib->resize())
              {
                $this->form_validation->set_message('_cekfile', 'Terjadi Kesalahan.');
                return false;
              }else {
                return true;
              }

            }
          }
        }else{
            $this->form_validation->set_message('_cekfile', 'format file harus jpg/png.');
            return false;
        }
    }else{
        return true;
    }
 }

 function _cekfileimage($str,$name)
 {
   $allowed_mime_type_arr = array('image/jpeg');
   $mime = get_mime_by_extension($_FILES['userfile']['name']);
   if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
       if(in_array($mime, $allowed_mime_type_arr)){
         if ($_FILES['userfile']['size']>2000000) {
           $this->form_validation->set_message('_cekfileimage', "Ukuran File Maximal 2mb ");
           return FALSE;
         }else {
           $config['upload_path']   = 'file/uploads/member/';
           $config['allowed_types'] = 'jpg|png';
           $config['max_size']      = 2024;
           $config['overwrite']     = TRUE;
           $config['file_name']     = $name;
           $this->load->library('upload', $config);
           if (!$this->upload->do_upload('userfile')) {
               $this->form_validation->set_message('_cekfileimage', "Ukuran File maximal 2mb dan format file jpg");
               return FALSE;
           }else {
               $data_upload = $this->upload->data();
               $config2['image_library']   = 'gd2';
               $config2['source_image']    = 'file/uploads/member/'.$data_upload['file_name'];
               $config2['new_image']       =  'file/uploads/member/thumbs/'.$data_upload['file_name'];
               $config2['maintain_ratio']  = true;
               $config2['create_thumb']    = false;
               $config2['quality']         = 50;
               $config2['width']           = 300;
               $config2['height']          = 300;
               $this->load->library('image_lib', $config2);
              if(!$this->image_lib->resize())
             {
               $this->form_validation->set_message('_cekfileimage', 'Terjadi Kesalahan.');
               return false;
             }else {
               return true;
             }

           }
         }
       }else{
           $this->form_validation->set_message('_cekfileimage', 'format file harus jpg.');
           return false;
       }
   }else{
     $this->form_validation->set_message('_cekfileimage', '%s Tidak Boleh Kosong');
     return false;
   }
}

function _cekfileimage_edit($str,$name)
{
  $allowed_mime_type_arr = array('image/jpeg');
  $mime = get_mime_by_extension($_FILES['userfile']['name']);
  if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
      if(in_array($mime, $allowed_mime_type_arr)){
        if ($_FILES['userfile']['size']>2000000) {
          $this->form_validation->set_message('_cekfileimage_edit', "Ukuran File Maximal 2mb ");
          return FALSE;
        }else {
          $config['upload_path']   = 'file/uploads/member/';
          $config['allowed_types'] = 'jpg|png';
          $config['max_size']      = 2024;
          $config['overwrite']     = TRUE;
          $config['file_name']     = $name;
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('userfile')) {
              $this->form_validation->set_message('_cekfileimage_edit', "Ukuran File maximal 2mb dan format file jpg");
              return FALSE;
          }else {
              $data_upload = $this->upload->data();
              $config2['image_library']   = 'gd2';
              $config2['source_image']    = 'file/uploads/member/'.$data_upload['file_name'];
              $config2['new_image']       =  'file/uploads/member/thumbs/'.$data_upload['file_name'];
              $config2['maintain_ratio']  = true;
              $config2['create_thumb']    = false;
              $config2['quality']         = 50;
              $config2['width']           = 300;
              $config2['height']          = 300;
              $this->load->library('image_lib', $config2);
             if(!$this->image_lib->resize())
            {
              $this->form_validation->set_message('_cekfileimage_edit', 'Terjadi Kesalahan.');
              return false;
            }else {
              return true;
            }

          }
        }
      }else{
          $this->form_validation->set_message('_cekfileimage_edit', 'format file harus jpg.');
          return false;
      }
  }else{
    // $this->form_validation->set_message('_cekfileimage_edit', '%s Tidak Boleh Kosong');
    return true;
  }
}

 public function _cekfiles($str,$names)
 {
   $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   $mime = get_mime_by_extension($_FILES['file']['name']);
   if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
       if(in_array($mime, $allowed_mime_type_arr)){
         if ($_FILES['file']['size']>2000000) {
           $this->form_validation->set_message('cekfiles', "Ukuran File Maximal 2mb ");
           return FALSE;
         }else {
           $config['upload_path']   = 'file/uploads/member/';
           $config['allowed_types'] = 'jpg|png|docx|pdf';
           $config['max_size']      = 2024;
           $config['overwrite']     = TRUE;
           $config['file_name']     = $names;
           $this->load->library('upload', $config);
           if (!$this->upload->do_upload('file')) {
               $this->form_validation->set_message('cekfiles', "Ukuran File maximal 2mb dan format file jpg/png/pdf/dosc");
               return FALSE;
           }else {
               return TRUE;
           }
         }
       }else{
           $this->form_validation->set_message('cekfiles', 'format file harus jpg/png/pdf/doc.');
           return false;
       }
   }else{
       return true;
   }
}


function _send_email($email_to,$subject,$content)
{
  $this->load->library('email');
    $config = array();
    $config['charset'] = 'utf-8';
    $config['useragent'] = 'Codeigniter';
    $config['protocol']= "smtp";
    $config['mailtype']= "html";
    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
    $config['smtp_port']= "465";
    $config['smtp_timeout']= "400";
    $config['smtp_user']= "adnanbatih95@gmail.com"; // isi dengan email kamu
    $config['smtp_pass']= "adnanbatih95"; // isi dengan password kamu
    $config['crlf']="\r\n";
    $config['newline']="\r\n";
    $config['wordwrap'] = TRUE;
    //memanggil library email dan set konfigurasi untuk pengiriman email

        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user'],'Diafragma');
        $this->email->to($email_to);
        $this->email->subject($subject);
        $this->email->message($content);
    if ($this->email->send()) {
        return true;
    }else {
        echo "gagal";
    }
}


}
