<?php
function profile($field)
{
  $ci = get_instance();
  $query =  $ci->db->where(array("id_profile"=>1))->get('tb_profile')->row();
  return $query->$field;
}

function cek_service($id_trans_kendaraan,$id_service)
{
  $ci = get_instance();
  $query = $ci->db->get_where('trans_cs_service',array("id_trans_kendaraan"=>$id_trans_kendaraan,"id_service"=>$id_service));
  if ($query->num_rows()>0) {
    return true;
  }else {
    return false;
  }
}


function tgl(){
  return date("dmyhis");
}


function selisih_waktu($start_date,$end_date)
{

  $kini = strtotime($end_date);//mendapatkan waktu sekarang
  $kemarin = strtotime($start_date);//mendapatkan waktu kemarin
  $diff  = $kini - $kemarin;

  $jam   = floor($diff / (60 * 60));
  $menit = $diff - $jam * (60 * 60);

  return $jam ." jam ".floor( $menit / 60 ). " menit";
}

function selisih_bulan()
{
  $ci = get_instance();
  $value = $ci->session->userdata("tgl_registrasi");
  $date = date("Y-m-d");
  $timeStart = strtotime("$value");
  $timeEnd = strtotime("$date");
  // Menambah bulan ini + semua bulan pada tahun sebelumnya
  $numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
  // menghitung selisih bulan
  $numBulan += date("m",$timeEnd)-date("m",$timeStart);

  return $numBulan;
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

function get_cek_kilometer_cs($field)
{
  $ci = get_instance();
  $id_cs = $ci->session->userdata('id_trans_kendaraan');
  $query =  $ci->db->query('SELECT
                            trans_kendaraan.id_trans_kendaraan,
                            trans_kendaraan.aktif,
                            tb_kendaraan.id_kendaraan,
                            tb_kendaraan.kilometer
                            FROM
                            trans_kendaraan
                            INNER JOIN tb_kendaraan ON trans_kendaraan.id_kendaraan = tb_kendaraan.id_kendaraan
                            WHERE
                            trans_kendaraan.id_trans_kendaraan='.$id_cs.' AND trans_kendaraan.aktif="y"')->row();
  return $query->$field;
}

 ?>
