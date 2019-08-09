<?php


function home_grafik($date)
{
  $ci = get_instance();
  $querys = $ci->db->query("SELECT
                            trans_cs_service.id_trans_cs_service,
                            trans_cs_service.id_trans_kendaraan,
                            trans_cs_service.id_service,
                            trans_cs_service.keterangan,
                            trans_cs_service.waktu_service,
                            trans_cs_service.waktu_tempuh,
                            trans_cs_service.jarak_tempuh
                            FROM
                            trans_cs_service
                            WHERE
                            DATE_FORMAT(waktu_service,'%Y-%m') = '$date'");
  if ($querys->num_rows()>0) {
    return $querys->num_rows();
  }else {
    return 0;
  }

}

function profile($field)
{
  $ci = get_instance();
  $query =  $ci->db->where(array("id_profile"=>1))->get('tb_profile')->row();
  return $query->$field;
}

function cek_jenis_perbaikan($id_service,$id_perbaikan){
  $ci = get_instance();
  $query = $ci->db->where(array("id_service"=>$id_service,"id_perbaikan"=>$id_perbaikan))->get('trans_service');
  if ($query->num_rows()>0) {
      return true;
  }else {
      return false;
  }
}


function selisih_bulan($value)
{
  $date = date("Y-m-d");
  $timeStart = strtotime("$value");
  $timeEnd = strtotime("$date");
  // Menambah bulan ini + semua bulan pada tahun sebelumnya
  $numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
  // menghitung selisih bulan
  $numBulan += date("m",$timeEnd)-date("m",$timeStart);

  return $numBulan;
}

function select_service($id_service)
{
  $str = "";
  $ci = get_instance();
  $query = $ci->db->order_by('id_service','ASC')
                  ->get('tb_service');
  $str.='<div class="form-group">
          <label for="">Service </label>
          <select class="form-control" name="id_service" id="id_service">';
            foreach ($query->result() as $row) {
              $str .="<option value='".$row->id_service."'";
              $str .= $id_service==$row->id_service?"selected='selected' class='text-success'":'';
              $str .=">".$row->nama_service."</option>";
            }
  $str.='   </select>
          </div>';

  return $str;
}

function select_service_edit($id_service,$color)
{
  $str = "";
  $ci = get_instance();
  $query = $ci->db->order_by('id_service','ASC')
                  ->get('tb_service');
  $str.='<div class="form-group">
          <label for="">Service </label>
          <select class="form-control" name="id_service" id="id_service">';
            foreach ($query->result() as $row) {
              $str .="<option value='".$row->id_service."'";
              $str .= $color==$row->id_service?"selected='selected'":'';
              $str .= $id_service==$row->id_service?"class='text-success'":'';
              $str .=">".$row->nama_service."</option>";
            }
  $str.='   </select>
          </div>';

  return $str;
}

function detail_cs_cek_service($id_trans_kendaraan,$id_service)
{
  $ci = get_instance();
  $query = $ci->db->get_where('trans_cs_service',array("id_trans_kendaraan"=>$id_trans_kendaraan,"id_service"=>$id_service));
  if ($query->num_rows()>0) {
    return true;
  }else {
    return false;
  }
}

function j_perbaikan_cs($id_service)
{
  $ci = get_instance();
  $query = $ci->db->query("SELECT
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
                          );
    $str="";
    foreach ($query->result() as $row) {
      $str.='<div class="col-sm-4">';
      $str.='<div class="form-group">';
      $str.='<div class="form-check">';
      $str.='<label class="form-check-label">';
      $str.='<input class="form-check-input" type="checkbox" value="'.$row->id_trans_service.'" name="perbaikan[]" id="perbaikan[]">';
      $str.= $row->jenis_perbaikan.'</label>';
      $str.='</div>';
      $str.='</div>';
      $str.='</div>';
    }
  return $str;
}

function cek_j_perbaikan_edit($id_trans_service,$id_trans_cs_service)
{
  $ci = get_instance();
  $query = $ci->db->get_where("trans_cs_perbaikan",array('id_trans_cs_service'=>$id_trans_cs_service,'id_trans_service'=>$id_trans_service));
  if ($query->num_rows()>0) {
    return true;
  }else {
    return false;
  }
}

function j_perbaikan_cs_edit($id_service,$id_trans_cs_service)
{
  $ci = get_instance();
  $query = $ci->db->query("SELECT
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
                          );
    $str="";
    foreach ($query->result() as $row) {
      if (cek_j_perbaikan_edit($row->id_trans_service,$id_trans_cs_service)==true){
        $check = "checked";
      }else {
        $check = "";
      }
      $str.='<div class="col-sm-4">';
      $str.='<div class="form-group">';
      $str.='<div class="form-check">';
      $str.='<label class="form-check-label">';
      $str.='<input class="form-check-input" type="checkbox" value="'.$row->id_trans_service.'"';
      $str.='name="perbaikan[]" id="perbaikan[]" '.$check.'>';
      $str.= $row->jenis_perbaikan.'</label>';
      $str.='</div>';
      $str.='</div>';
      $str.='</div>';
    }
  return $str;
}


function cek_jenis_service($jarak,$bulan)
{
  $ci = get_instance();
  $value = '';
  $value .= '<div class="row">';
  $no = 0;
  $last_row_id =  $ci->db->query('SELECT id_service FROM tb_service ORDER BY id_service DESC LIMIT 1');
  $query =  $ci->db->get('tb_service');

  foreach ($query->result() as $now) {
          $value.='<div class="col-sm-3">';
      if ($now->id_service == $last_row_id->row()->id_service) {
          if ($jarak >=  $query->row($no)->jarak_tempuh) {
              $value .=  '<i class="text-danger">'.$now->nama_service.'</i>';
          }else {
              $value .=  '<i class="text-success">'.$now->nama_service.'</i>';
          }
      }else {
          if ($jarak >= $query->row($no)->jarak_tempuh AND $jarak < $query->row($no+1)->jarak_tempuh) {
            $value .=  '<i class="text-danger">'.$now->nama_service.'</i>';
        }else {
            $value .=  '<i class="text-success">'.$now->nama_service.'</i>';
          }
      }
      $value .='</div>';
      $no++;
  }

  $value .= '</div>';
  return $value;
}

function cek_jenis_contoh($jarak,$bulan)
{
  $ci = get_instance();
  $no = 0;
  $last_row_id =  $ci->db->query('SELECT id_service FROM tb_service ORDER BY id_service DESC LIMIT 1');
  $query =  $ci->db->get('tb_service');

  foreach ($query->result() as $now) {
      if ($now->id_service == $last_row_id->row()->id_service) {
          if ($jarak >=  $query->row($no)->jarak_tempuh) {
              $value = $now->id_service;
          }else {
              $value = false;
          }
      }else {
          if ($jarak >= $query->row($no)->jarak_tempuh AND $jarak < $query->row($no+1)->jarak_tempuh) {
            $value = $now->id_service;
        }else {
            $value = false;
          }
      }
      $no++;
  }


  return $value;
}


function cek_service($jarak,$waktu)
{
  $ci = get_instance();
  $str = '';
  $query = $ci->db->query("SELECT * FROM tb_service WHERE $jarak >= jarak_tempuh AND $jarak < s_jarak_tempuh OR $waktu >= waktu AND $waktu < s_waktu");
  if ($query->num_rows()>0) {
      $str = "Saat ini anda berada pada ".$query->row()->nama_service;
  }else {
    $str.="Gagal cek data service";
  }
  return $str;
}



function input_service($id_service)
{

  $ci = get_instance();
  $query = $ci->db->query("SELECT
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
                          );

  $str = "";
  $str .= "<div class='row' id='service_perbaikan'>";
  foreach ($query->result() as $row) {
    $str.='<div class="col-sm-4">
            <div class="form-check">
              <input class="form-check-input chk" type="checkbox" value="'.$row->id_trans_service.'" name="perbaikan[]" id="]perbaikan[]">
              <label class="form-check-label">
                '.$row->jenis_perbaikan.'
              </label>
              </div>
             </div>';
  }
  $str .= '<input type="text" name="check" id="chkd"></div>';
  return $str;
}


function cek_trans_service($id_trans_cs_service,$id_trans_service)
{
  $ci = get_instance();
  $query = $ci->db->get_where('trans_cs_perbaikan',array('id_trans_cs_service' => $id_trans_cs_service,'id_trans_service'=>$id_trans_service ));
  if ($query->num_rows()>0) {
      return true;
  }else {
    return false;
  }
}

 ?>
