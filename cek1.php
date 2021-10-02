<?php
    session_start();
    $koneksi = new mysqli("localhost", "root", "", "responsifspb");

     if ($koneksi->connect_errno) {
        die("Failed to connect to MySQL: " . $koneksi->connect_error);
    }

    if(isset($_POST['btnnext']) || isset($_POST['btnprev']) || isset($_POST['btnsubmit'])) {
            
        // if(!isset($_SESSION['jawaban'])){
        //     $_SESSION['jawaban'] = array(null, null, null, null, null, null, null, null, null, null);
        // }
        
        // Dapetin halamannya berapa (misal 1)
        
        $halaman_simpan = (isset($_POST['page'])) ? $_POST['page'] : 1;
        
        // buat array X isinya $_SESSION['jawaban']
        $arrJawaban = $_SESSION['jawaban'];

        // isi nilai array X di index ke (halaman -1 & halaman1)
        $index = ($halaman_simpan - 1)*2;
        
        for($i = $index; $i <= $index + 1; $i++){
            // $arrJawaban[$i] = $_POST['rad'.($i+1)];
            $arrJawaban[$i] = $_POST["rad".($i+1)];
        }
        
        // Isi Session jawaban dengan nilai array X
        $_SESSION['jawaban'] = $arrJawaban;

        if (isset($_POST['btnsubmit'])) {
        	header("location:kesimpulan.php");
        }

        if (isset($_POST['btnprev'])) {
        	header("location:index.php?datapage=2&page=".($halaman_simpan-1));
        }

        if (isset($_POST['btnnext'])) {
        	header("location:index.php?datapage=2&page=".($halaman_simpan+1));
        }
    }

    $koneksi -> close();
?>