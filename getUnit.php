<?php 

require_once 'connect.php';

$tableName = $_GET['tableName'];  //ref_unit
$kode = $_GET['kode'];
switch ($tableName) {
	case "ref_unit":
        $kode_unit = "Kd_Unit";
		$nama_unit = "Nm_Unit";
		$condition = "";
        break;
    case "ref_sub_unit":
        $kode_unit = "Kd_Sub";
		$nama_unit = "Nm_Sub";
		$condition = " WHERE Kd_Sub LIKE '$kode.__' ";
        break;
    case "ref_upb":
        $kode_unit = "Kd_Upb";
		$nama_unit = "Nm_Upb";
		$condition = " WHERE Kd_Upb LIKE '$kode.___' ";
        break;
}


/*
SELECT Kd_Unit AS kode_unit, Nm_Unit AS nama_unit   FROM ref_unit                                               ORDER BY Kd_Unit;
SELECT Kd_Sub  AS kode_unit, Nm_Sub  AS nama_unit   FROM ref_sub_unit    WHERE Kd_Sub LIKE '24.04.04.01.__'     ORDER BY Kd_Sub;
SELECT Kd_Upb  AS kode_unit, Nm_Upb  AS nama_unit   FROM ref_upb         WHERE Kd_Upb LIKE '24.04.04.01.01.___' ORDER BY Kd_Upb;

*/
$query=" SELECT $kode_unit  AS kode_unit, $nama_unit  AS nama_unit FROM $tableName  $condition  ORDER BY $kode_unit ";
//echo $query;
$data=array();
$result = mysqli_query($conn, $query);
while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
$response=array(
            'status' => 1,
            'message' =>'Get Data Successfully.',
            'value' => $data
        );
header('Content-Type: application/json');
echo json_encode($response);

?>