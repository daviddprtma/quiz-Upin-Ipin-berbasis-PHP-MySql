<?php 
    $koneksi = new mysqli("localhost", "root", "", "responsifspb");

    if ($koneksi->connect_errno) {
        die("Failed to connect to MySQL: " . $koneksi->connect_error);
    }

    session_start();

    if(!isset($_SESSION['jawaban'])){
        $_SESSION['jawaban'] = array(null, null, null, null, null, null, null, null, null, null);
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Responsi FSP B</title>
    <style type="text/css">
        div.card {
            text-align: left;
            float: center;  
            width: 1100px;
            border: 1px solid black;
            font-size: 20px;
            margin-left: 50px;
            padding-left: 50px;
            padding-bottom: 50px;
            background-color: white;
        }
        div.card-footer {
            text-align: center;
            font-size: 20px;
        }
        div.title {
            text-align: center;
        }
        .submit {
            background-color: MediumSeaGreen;
            color: white;
            padding: 15px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        a:link, a:visited {
          padding: 15px 25px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
        }
        table, td, th{
            border: 1px solid black;
        }
        .warna-merah{
            color: red;
        }
        ul{
            list-style-type: none;
        }
        li{
            display: inline-block;
            padding: 6px 9px;
            border: 1px solid #dedfe1;
        }
        li:hover{
            background-color: #e3e4e8;
        }

        li.active{
            background-color: #367afd;
            color: white;

        }

        li.a{
            text-decoration: none;
            color:  #367afd;
        }

        li:first-child{
            border-radius: 5px 0px 0px 5px;
        }

        li:last-child{
            border-radius: 0px 5px 5px 0px;
        }
        .pref, .next {
            padding: 15px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        body{
            background-color: #E2F0CB;
        }
    </style>
</head>
<body>
    <?php

    echo "<div class='title'>
         <h1 class='text-center text-white font-weight-bold text-uppercase bg-dark' >  WELCOME TO UPIN & IPIN QUIZ </h1><br>";

    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $sql = "SELECT * FROM soal";
    $hasil = $koneksi->query($sql);
    // menghitung jumlah data menggunakan num_rows 
    
    $jumdata = $hasil ->num_rows;
    $perpage = (isset($_GET['datapage'])) ? $_GET['datapage'] : 2;
    ?>
     <form method="get" action="">
        Page: <input type="text" name="page" value="" /> | 
        
        <input type="submit" name="submit" value="Search">
    </form>
    <!-- <br> -->
    
    <?php

    $p = (isset($_GET['page'])) ? $_GET['page'] : 1; // halaman saat ini
    $jumpage = ceil($jumdata / $perpage);
    
    //echo "$perpage $jumdata $jumpage";
    echo "<ul>";

    $prev = $p - 1;
    $next = $p + 1;    
    ?>
    <br>
    <?php

    $awal = ($p-1) * $perpage;

    $sql2 = "SELECT * FROM soal  WHERE  halaman_ke = '$page'";
    $res = $koneksi->query($sql2);

    while($row = $res->fetch_assoc()){
        echo "<tr>";
        $idSoal = $row['idsoal'];
        $nomor = $row['nomor'];
        $soal = $row["pertanyaan"];
        echo "<div class='card'>
            <br>
            <p class='card-header'>".
                $nomor.". ".$soal."
            </p>";
        
        $sql3 = "SELECT * FROM jawaban as J
        INNER JOIN soal as S on J.idsoal=S.idsoal
        WHERE J.idsoal =?
        ORDER BY rand()";
        $stmt = $koneksi -> prepare($sql3);
        $stmt -> bind_param("i",$idSoal);
        $stmt -> execute();
        $hasil2 = $stmt->get_result();
    
        // Tampilkan radio (ada 4)
        while($baris = $hasil2 -> fetch_assoc()){
            $jawaban = $baris['isi_jawaban'];

            ?>
            <form action="cek1.php" method="post">
                <input type="hidden" name="page" value=<?php echo $p ?>>
                <div class='card-block answer'>
                    <input type='radio' name='rad<?php echo $idSoal ?>' value='<?php echo $jawaban; ?>' 
                        <?php
                            if ($jawaban == $_SESSION['jawaban'][$idSoal-1]) {
                                echo 'checked';
                            }
                        ?>
                    > 
                    <?=$jawaban?>
                    <br>
                </div>
                <br>
            <?php   
        }
        // }
        echo "</div><br>";
    }
    echo "<br>";
    echo "<div class='card-footer'>";
    if ($p > 1) {
        // echo "<li><input type='submit' name='prev' class='pref'><a href='?datapage=$perpage&p=$prev' >Previous</a></li>";
        echo "<li><input type='submit' name='btnprev' class='pref' value='Prev'></li>";
    }

    if ($p < $jumpage) {
        
        echo "<li><input type='submit' name='btnnext' class='next' value='Next'></li>";
    }
    if ($p >= 5) {
        echo "<li><input type='submit' name='btnsubmit' class='submit' value='Submit'></li>";
    }
    echo "</form>";
    echo "</div>";
    echo "</ul>";
    $koneksi->close();
    ?>
</body>
</html>