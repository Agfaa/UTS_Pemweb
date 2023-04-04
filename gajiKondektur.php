<?php
    include('conn.php');
    $query = "SELECT * FROM kondektur";
    $result = mysqli_query(connection(),$query);
        if ($result) {
            $status = 'okay';
        } else {
            $status = 'error';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAJI KONDEKTUR</title>
</head>
<body>
<div>
      <div>
        <nav>
          <div>
            <ul style="margin-top:100px;">
              <li>
                <a href="UTS.php">Data Trans Bus UPN</a>
              </li>
              <li>
                <a href="driver.php">Data Driver</a>
              </li>
              <li>
                  <a href="bus.php">Data Bus</a>
              </li>
              <li>
                  <a href="kondektur.php">Data Kondektur</a>
              </li>
              <li>
                  <a href="tambahTrans.php">Tambah Data Trans UPN</a>
              </li>
              <li>
                  <a href="tambahKondektur.php">Tambah Data Kondektur</a>
              </li>
              <li>
                  <a href="tambahDriver.php">Tambah Data Driver</a>
              </li>
              <li>
                  <a href="tambahBus.php">Tambah Data BUS</a>
              </li>
              <li>
                  <a href="gaji.php">Hitung Gaji Driver</a>
              </li>
              <li>
                  <a href="gajiKondektur.php">Hitung Gaji Kondektur</a>
              </li>
            </ul>
          </div>
        </nav>
    <div>
        <main role="main">
        <h3>Pendapatan Driver</h3>
            <?php  
                if (isset($_GET['bulan'])) {
                    $moon_name = $_GET['bulan'];
                } else {
                    $moon_name = 'Semua';
                }
            ?>
            <h5>Bulan = <?= $moon_name ?></h5>
            <p>Filter</p>
            <form action="" method="get">
                <select name="bulan" id="bulan" required>
                    <option value="">Choose One!</option>
                    <option value="january">Januari</option>
                    <option value="february">Februari</option>
                    <option value="march">Maret</option>
                    <option value="april">April</option>
                    <option value="may">Mei</option>
                    <option value="june">June</option>
                    <option value="july">Juli</option>
                    <option value="august">Agustus</option>
                    <option value="september">September</option>
                    <option value="october">Oktober</option>
                    <option value="november">November</option>
                    <option value="december">Desember</option>
                </select>
                <button type="submit">Show All</button>
                <a href="gaji.php"><button type="button">Reset</button></a>
            </form>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Kondektur</th>
                        <th>NAMA</th>
                        <th>Total KM</th>
                        <th>Harga Per KM</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data = mysqli_fetch_array($result)): ?>
                    <tr>
                        <?php
                        $queryforKM = "SELECT SUM(jumlah_km) AS tot_km FROM trans_upn WHERE id_kondektur = $data[id_kondektur] GROUP BY id_kondektur";
                        $result_jarak = mysqli_query(connection(), $queryforKM);
                        $dataKondektur = mysqli_fetch_assoc($result_jarak);
                        if($dataKondektur === NULL) {
                            $tot_km = 0;
                        } else {
                            $tot_km = $dataKondektur['tot_km'];
                        }
                        $kondektur_salary_perKM = 1500;
                        $kondektur_salary = $tot_km * $kondektur_salary_perKM;
                        ?>
                        <td><?php echo $data['id_kondektur'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $tot_km; ?></td>
                        <td><?php echo $kondektur_salary_perKM; ?></td>
                        <td><?php echo "Rp. ", $kondektur_salary; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>