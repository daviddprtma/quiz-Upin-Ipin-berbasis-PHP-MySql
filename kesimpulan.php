<?php 
	session_start();
    $koneksi = new mysqli("localhost", "root", "", "responsifspb");

    if ($koneksi->connect_errno) {
        die("Failed to connect to MySQL: " . $koneksi->connect_error);
    }

    //print_r($_SESSION['jawaban']);

    // Ambil semua soal
    $sql = "SELECT * FROM soal AS s 
    INNER JOIN jawaban AS j 
    ON s.idsoal = j.idsoal WHERE benarkah = 1";
    $hasil = $koneksi->query($sql);
        
    // Loop Session Jawaban, Masing" nilai cocokin database
    $i = 0;
    $skor = 0;
    while ($row = $hasil->fetch_assoc()){
        if ($row['isi_jawaban'] == $_SESSION['jawaban'][$i]) {
            $skor+=10;
        }

        $i++;
    }
    // print($skor);

 ?>
<!DOCTYPE html>
 <html>
 <head>
    <title>Kesimpulan</title>
 </head>
 <style type="text/css">
    body {
        background-color: #B5EAD7;
    }
    .playagain {
        background-color: #FFB7B2;
        color: white;
        padding: 15px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    table{
    border-collapse:collapse;
    font:normal normal 12px Verdana,Arial,Sans-Serif;
    color:#333333;
    margin-left: auto;
    margin-right: auto;
    width: 70%;
    height: 100%;
    vertical-align: top;
    }
    table th {
    background:#00BFFF;
    color: black;
    font-weight:bold;
    font-size:14px;
    }
    div{
        text-align: center;
        float : center;
    }
    table th,
    table td {
    vertical-align:top;
    padding:5px 10px;
    border:1px solid #696969;
    
    }
    /* .title {

    } */
    table tr {
    background:#F5FFFA;
    height: 50px;
    }

    table tr:nth-child(even) {
    background:#F0F8FF;
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
        
    </style>
 <body>
    <div>
        <table>
        <caption class='title'><h1> END QUIZ </h1></caption>
        <tr>
        <th>Nomor</th>
        <th>Pertanyaan</th>
        <th>Jawaban </th>
        </tr>
        <?php
        $sql1 = "SELECT * FROM soal";
        $res = $koneksi->query($sql1);
        while($row = $res->fetch_assoc()){
        echo "<tr>";
        $idSoal = $row['idsoal'];
        echo "<td>".$row["nomor"]."</td>";
        echo "<td>".$row["pertanyaan"]."</td>";
        echo "<td>".$_SESSION['jawaban'][$idSoal-1];
        echo "</tr>";
        }
        ?>
        </table>
        <br>
    </div>
    <div>
        <br>
        <h2>Skor Akhir : <?php echo $skor; ?></h2>
        <br>
        <form action="index.php" method="post">
            <input type="submit" name="back" class='playagain' value="PLAY AGAIN">
        </form>
    </div>
 </body>
 </html>
 <?php
 	session_unset();
 	session_destroy();

    $koneksi -> close();
 ?>