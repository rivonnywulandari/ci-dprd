<?php
///////////////////////////////////////////////////////////////////////////
$conn = mysqli_connect('localhost', 'dprd_userdprd', '1qaz2wsx!@', 'dprd_mvc');
mysqli_set_charset($conn, 'utf8');
///////////////////////////////////////////////////////////////////////////


    $sql = "SELECT 
 
                            tanggal as tgl
                FROM 
                        tb_berita

                order by tanggal desc
                LIMIT 1

                        ";
        $data = array();
        $query = mysqli_query($conn,$sql);
        if ($query)
        {

            while ($row = mysqli_fetch_assoc($query)) 
            {
                $data[] = array('tgl' => $row['tgl'] );
            }
            echo json_encode($data);
        }
?>