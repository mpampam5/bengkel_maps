<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



/* Cs_service.php */
/* HARVIACODE CRUD GENERATOR MVC/HMVC AJAX CRUD */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* Location: ./application/controllers/Cs_service.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-07 23:56:24 */
/* http://harviacode.com */

 class Cs_service extends MY_Controller{
  function __construct(){
      parent::__construct();
      $this->_security_admin("backend");
      $this->load->library(array("Layouts"));
      $this->load->model('Cs_service_model','model');
      $this->load->helper('backend');
  }


 function index(){
    $this->layouts->set_title('Perbaikan Dan Perawatan');
    $this->layouts->view(config_item("cpanel").'content/cs_service/index');
  }

function json() {
    header('Content-Type: application/json');
    echo $this->model->json();
}




 function detail($id){
    if($row=$this->model->get_where_join($id)){
      $this->layouts->set_title('Perbaikan Dan Perawatan');
        $data=array('layout_title' => 'Perbaikan Dan Perawatan',
										'id_trans_cs_service' => $row->id_trans_cs_service,
										'id_trans_kendaraan' => $row->id_trans_kendaraan,
										'id_service' => $row->id_service,
										'keterangan' => $row->keterangan,
										'waktu_service' => $row->waktu_service,
                    'nama_pemilik'=>$row->nama_pemilik,
                    'no_registrasi'=>$row->no_registrasi,
                    'jarak_tempuh'=>$row->jarak_tempuh,
                    'waktu_tempuh'=>$row->waktu_tempuh,
                    'nama_service'=>$row->nama_service
									);
				 $this->layouts->view(config_item("cpanel").'content/cs_service/detail',array(),$data);
//MODAL DETAIL
//$this->layouts->view(config_item("cpanel").'content/cs_service/detail',array(),$data,false);
    }else {
        $this->error_404();
    }
  }

  function pilih_cs(){
     $this->layouts->set_title('Pilih Customer');
     $this->layouts->view(config_item("cpanel").'content/cs_service/data_cs');
   }

 function tambah($id,$status=''){
    if ($status=='aksi') {
        $json = array('success'=>false ,'alert'=>array());
        if ($this->input->is_ajax_request()) {
              $this->form_validation->set_rules('id_service', 'id service', 'trim|xss_clean|required|callback__cek_service['.$id.']');
              $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|xss_clean');
              $this->form_validation->set_rules('waktu_service', 'waktu service', 'trim|xss_clean|required');
              $this->form_validation->set_rules('waktu_tempuh', 'waktu tempuh', 'trim|xss_clean|required');
              $this->form_validation->set_rules('jarak_tempuh', 'jarak tempuh', 'trim|xss_clean|required');
              $this->form_validation->set_rules('check', 'Jenis Perbaikan', 'trim|xss_clean|required');
              $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            if ($this->form_validation->run()) {
                $insert = array(
																'id_trans_kendaraan' => $id,
																'id_service' => $this->input->post('id_service',TRUE),
																'keterangan' => $this->input->post('keterangan',TRUE),
                                'waktu_tempuh' => $this->input->post('waktu_tempuh',TRUE),
                                'jarak_tempuh' => $this->input->post('jarak_tempuh',TRUE),
																'waktu_service' => date('Y-m-d',strtotime($this->input->post('waktu_service',TRUE))),
															);
                $this->model->get_insert("trans_cs_service",$insert);
                $last_id_trans_cs_service = $this->db->insert_id();

                $j_perbaikan = $this->input->post('perbaikan');
                foreach ($j_perbaikan as $jp) {
                      $insert_trans_cs_perbaikan = array('id_trans_cs_service' => $last_id_trans_cs_service,
                                                          'id_trans_service'=> $jp
                                                          );
                      $this->model->get_insert('trans_cs_perbaikan',$insert_trans_cs_perbaikan);
                }

                $json['alert']   = 'Berhasil Menyimpan!';
                $json['success'] = true;
            }else{
                foreach ($_POST as $key => $value) {
                  $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }
    }else{
      if ($row = $this->model->get_join_cs($id)) {
        $this->layouts->set_title('Perbaikan Dan Perawatan');
        $data = array('layout_title' => 'Perbaikan Dan Perawatan',
                        'button'=>'tambah',
                        'aksi' =>site_url(config_item("cpanel").'cs_service/tambah/'.$id.'/aksi'),
                        'no_registrasi' =>$row->no_registrasi,
                        'nama_pemilik'  =>$row->nama_pemilik,
                        'no_kendaraan'  =>$row->no_kendaraan,
                        'merek'         =>$row->merek_kendaraan,
                        'waktu_tempuh' => selisih_bulan($row->tgl_registrasi),
                        'jarak_tempuh'  => $row->kilometer_skrg - $row->kilometer,
  											'id_trans_cs_service' => set_value('id_trans_cs_service'),
  											'id_trans_kendaraan' => set_value('id_trans_kendaraan'),
  											'id_service' => set_value('id_service'),
  											'keterangan' => set_value('keterangan'),
  											'waktu_service' => set_value('waktu_service',date('Y-m-d')),
  											);
  			 $this->layouts->view(config_item("cpanel").'content/cs_service/form',array(),$data);
      }
      else {
            $this->error_404();
        }
     }
  }

 function edit($id,$status=''){
      if ($status=='aksi') {
          $json = array('success'=>false ,'alert'=>array());
          $values = $this->input->post('id_service2',TRUE).",".$this->input->post('id_trans_kendaraan',TRUE);
          if ($this->input->is_ajax_request()) {
              $this->form_validation->set_rules('id_service', 'id service', 'trim|xss_clean|required|callback__cek_service_edit['.$values.']');
              $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|xss_clean');
              $this->form_validation->set_rules('id_trans_kendaraan', 'id_trans_kendaraan', 'trim|xss_clean|required');
              $this->form_validation->set_rules('waktu_service', 'waktu service', 'trim|xss_clean|required');
              $this->form_validation->set_rules('waktu_tempuh', 'waktu tempuh', 'trim|xss_clean|required');
              $this->form_validation->set_rules('jarak_tempuh', 'jarak tempuh', 'trim|xss_clean|required');
              $this->form_validation->set_rules('check', 'Jenis Perbaikan', 'trim|xss_clean|required');
              $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
              if ($this->form_validation->run()) {
                  $update = array(
                                'id_service' => $this->input->post('id_service',TRUE),
                                'keterangan' => $this->input->post('keterangan',TRUE),
                                // 'waktu_tempuh' => $this->input->post('waktu_tempuh',TRUE),
                                // 'jarak_tempuh' => $this->input->post('jarak_tempuh',TRUE),
                                'waktu_service' => date('Y-m-d',strtotime($this->input->post('waktu_service',TRUE))),
															);

                $updates = $this->db->update("trans_cs_service",$update,array("id_trans_cs_service"=>$id));
                // $this->model->get_update("trans_cs_service",array("id_trans_service"=>$id),$update);
                if (!$updates) {
                  $json['alert']   = 'gagal Mengedit!';
                }else {
                  $this->db->where('id_trans_cs_service',$id)
                            ->delete("trans_cs_perbaikan");

                  $j_perbaikan = $this->input->post('check');
                  $exp_perbaikan = explode(',',$j_perbaikan);

                    for ($i=0; $i < count($exp_perbaikan); $i++) {
                            $insert_trans_cs_perbaikan = array('id_trans_cs_service' => $id,
                                                                'id_trans_service'=> $exp_perbaikan[$i]
                                                                );
                            $this->model->get_insert('trans_cs_perbaikan',$insert_trans_cs_perbaikan);
                    }

                  $json['alert']   = 'Berhasil Mengedit!';
                }




                $json['success'] = true;
            }else{
                foreach ($_POST as $key => $value) {
                  $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }
    }else{
      if($row=$this->model->get_join_cs_edit($id)){
        $this->layouts->set_title('Perbaikan Dan Perawatan');
        $data = array('layout_title' => 'Perbaikan Dan Perawatan',
                      'button'=>'edit',
                      'aksi' =>site_url(config_item("cpanel").'cs_service/edit/'.$id.'/aksi'),
											'id_trans_cs_service' => $row->id_trans_cs_service,
                      'id_trans_kendaraan' => $row->id_trans_kendaraan,
                      'no_registrasi' =>$row->no_registrasi,
                      'nama_pemilik'  =>$row->nama_pemilik,
                      'no_kendaraan'  =>$row->no_kendaraan,
                      'merek'         =>$row->merek_kendaraan,
                      'waktu_tempuh' => $row->wkt_tempuh,
                      'jarak_tempuh'  => $row->jrk_tempuh,
											'waktu_service' => set_value('waktu_service', $row->waktu_service),
                      'id_service' => set_value('id_service',$row->id_service),
                      'keterangan' => set_value('keterangan',$row->keterangan),
                      'waktu_service' => set_value('waktu_service',$row->waktu_service),
											);
			 $this->layouts->view(config_item("cpanel").'content/cs_service/form_edit',array(),$data);
  //MODAL EDIT
  //$this->layouts->view(config_item("cpanel").'content/cs_service/form',array(),$data,false);
			}else{
      $this->error_404();
    }
  }
}

 function hapus($id){
  if ($this->input->is_ajax_request()) {
      $this->model->get_delete($id);
      $data['alert'] = 'Berhasil menghapus!';
      echo json_encode($data);
    }
}

function service_perbaikan()
{
  if ($this->input->is_ajax_request()) {
    $id_service = $this->input->post('id');
    $query = $this->db->query("SELECT
                              trans_service.id_trans_service,
                              trans_service.id_service,
                              trans_service.id_perbaikan,
                              tb_service.nama_service,
                              tb_jenis_perbaikan.jenis_perbaikan
                              FROM
                              trans_service
                              INNER JOIN tb_service ON trans_service.id_service = tb_service.id_service
                              INNER JOIN tb_jenis_perbaikan ON trans_service.id_perbaikan = tb_jenis_perbaikan.id_jenis_perbaikan
                              WHERE
                              trans_service.id_service=$id_service"
                            )->result();

                            $str="";
                            foreach ($query as $row) {
                              $str.='<div class="col-sm-4">';
                              $str.='<div class="form-group">';
                              $str.='<div class="form-check">';
                              $str.='<label class="form-check-label">';
                              $str.='<input class="form-check-input" type="checkbox" value="'.$row->id_trans_service.'" name="perbaikan[]" id="perbaikan[]">';
                              $str.='<i class="input-helper"></i>';
                              $str.= $row->jenis_perbaikan.'</label>';
                              $str.='</div>';
                              $str.='</div>';
                              $str.='</div>';
                            }
    $json = array('data' =>$str);
    echo json_encode($json);
  }
}

function service_perbaikan_edit($id_trans_cs_service,$id_service)
{
  if ($this->input->is_ajax_request()) {
    $id_service = $this->input->post('id');
    $query = $this->db->query("SELECT
                              trans_service.id_trans_service,
                              trans_service.id_service,
                              trans_service.id_perbaikan,
                              tb_service.nama_service,
                              tb_jenis_perbaikan.jenis_perbaikan
                              FROM
                              trans_service
                              INNER JOIN tb_service ON trans_service.id_service = tb_service.id_service
                              INNER JOIN tb_jenis_perbaikan ON trans_service.id_perbaikan = tb_jenis_perbaikan.id_jenis_perbaikan
                              WHERE
                              trans_service.id_service=$id_service"
                            )->result();

                            $str="";
                            foreach ($query as $row) {
                              if (cek_j_perbaikan_edit($row->id_trans_service,$id_trans_cs_service)==true){
                                $check = "checked";
                              }else {
                                $check = "";
                              }

                              $str.='<div class="col-sm-4">';
                              $str.='<div class="form-group">';
                              $str.='<div class="form-check">';
                              $str.='<label class="form-check-label">';
                              $str.='<input class="form-check-input" '.$check.' type="checkbox" value="'.$row->id_trans_service.'" name="perbaikan[]" id="perbaikan[]">';
                              $str.='<i class="input-helper"></i>';
                              $str.= $row->jenis_perbaikan.'</label>';
                              $str.='</div>';
                              $str.='</div>';
                              $str.='</div>';
                            }
  $cek = $this->db->get_where("trans_cs_service",array('id_trans_cs_service'=>$id_trans_cs_service,'id_service'=>$id_service));
  if ($cek->num_rows()>0) {
    $a = $this->db->get_where('trans_cs_perbaikan',array('id_trans_cs_service'=>$id_trans_cs_service));
    $val ="";
    foreach ($a->result() as $b) {
      $val .= $b->id_trans_service.",";
    }
  }else {
    $val = "";
  }
    $json = array('data' =>$str,'id_srv'=>$val);
    echo json_encode($json);
  }
}


function _cek_service($id_service,$id_trans_kendaraan)
{
  $query = $this->db->get_where("trans_cs_service",array("id_trans_kendaraan"=>$id_trans_kendaraan,"id_service"=>$id_service));
  if ($query->num_rows()>0) {
      $this->form_validation->set_message('_cek_service', 'Customer sudah melakukan service pada tahap ini.');
      return false;
  }else {
      return true;
  }
}


function _cek_service_edit($id_service,$values)
{
  $explode = explode(",",$values);
      $id_service2 = $explode[0];
      $id_trans_kendaraan = $explode[1];
  if ($id_service==$id_service2) {
      return true;
  }else {
    $query = $this->db->get_where("trans_cs_service",array("id_trans_kendaraan"=>$id_trans_kendaraan,"id_service"=>$id_service));
    if ($query->num_rows()>0) {
        $this->form_validation->set_message('_cek_service_edit', 'Customer sudah melakukan service pada tahap ini.');
        return false;
    }else {
        return true;
    }
  }
}



}
/* End Controller */
