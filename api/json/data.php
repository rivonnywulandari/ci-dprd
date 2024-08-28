<?php
header('Content-Type: application/json');
///////////////////////////////////////////////////////////////////////////
$conn = mysqli_connect('localhost', 'root', '', 'dprd_mvc');
mysqli_set_charset($conn, 'utf8');


$idcont = isset($_GET['id_content']) ? $_GET['id_content'] : 0;

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
            
            order by a.tanggal desc
            LIMIT $idcont,20

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
?>