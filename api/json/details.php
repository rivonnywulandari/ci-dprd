<?php
header('Content-Type: application/json');
///////////////////////////////////////////////////////////////////////////
$conn = mysqli_connect('localhost', 'root', '', 'dprd_mvc');
mysqli_set_charset($conn, 'utf8');
///////////////////////////////////////////////////////////////////////////

/*$jenis_informasi 	= $_GET['jenis_informasi'];
$id_instansi 		= $_GET['id_instansi'];
$tahun 				= $_GET['tahun'];
$judul 				= $_GET['judul'];
*/

$idcon = "$_GET[id]";




	$sql = "SELECT 
                    a.id,
                    a.judul,
                    a.subjudul,
                    a.isi,
                    a.tag,
                    a.tanggal,
                    a.hit,
                    
                    b.foto,
                    
                    c.nama_user as created_by
            FROM 
                    tb_berita a
                    LEFT JOIN tb_foto b ON (a.id=b.id_konten) 
                    LEFT JOIN _user c ON (a.entri=c.username) 
            WHERE
                    a.aktif='1'
            and 
                    a.id = '$idcon'

						";
		$data = array();
		$query = mysqli_query($conn,$sql);
		if ($query)
		{
            
			while ($row = mysqli_fetch_assoc($query)) 
			{
				$data['list_berita'][] = $row;
			}
			echo json_encode($data);
		}
		else
		{
			$data['list_berita'][] = array 
					(
						'status' => 'failed',
						'message' => 'Parameter tidak diketahui/data tidak tersedia'
					);
			echo json_encode($data);
		}
		
		$sql2 = "UPDATE tb_berita SET hit=hit+1 WHERE id='$idcon'";
        $query2 = mysqli_query($conn,$sql2);
		
        // if(mysqli_query($conn, $sql)){
        //   // echo "Records were updated successfully.";
        // } else {
        //     //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        // }
?>