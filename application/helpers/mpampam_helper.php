<?php



function cmb_angkatan($id,$name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$id' class='form-control'>";
    $data = $ci->db->get($table)->result();
    if ($selected==null) {
      $cmb .="<option value=''>--pilih--</option>";
    }
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".$d->$field."&nbsp;(".$d->tahun_angkatan.")</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_dinamis($id,$name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$id' class='form-control'>";
    $data = $ci->db->get($table)->result();
    if ($selected==null) {
      $cmb .="<option value=''>--pilih--</option>";
    }
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".$d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}









 ?>
