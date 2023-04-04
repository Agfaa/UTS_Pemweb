<?php 
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UTS PEMWEB</title>
    <style>
        .status_aktif {
            background-color: green;
            color: white;
        }
        .status_warning {
            background-color: yellow;
        }
        .status_rusak {
            background-color: red;
        }
    </style>
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
        <main role="main">
          <?php 
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='okay') {
                echo '<br><br><div>ID BUS berhasil di update</div>';
              }
              else if ($status=='error'){
                echo '<br><br><div role="alert">ID BUS gagal di update</div>';
              }

            }
           ?>
          <h2 style="margin: 35px 0 35px 0;">Tabel BUS Trans UPN</h2>
          <div>
            <table border="1">
              <thead>
                <tr>
                  <th>ID BUS</th>
                  <th>PLAT</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  
                  $query = "SELECT * FROM bus";
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?php echo $data['id_bus'];  ?></td>
                    <td><?php echo $data['plat'];  ?></td>
                    <td class="status_<?php if ($data['status'] == 1){ echo 'aktif';} elseif ($data['status'] == 2) { echo 'warning';} elseif ($data['status'] == 0){ echo 'rusak';} ?>">
                    <?php echo $data['status'];  ?></td>
                    <td>
                      <a href="<?php echo "updateBus.php?id=".$data['id_bus']; ?>"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "deleteBus.php?id=".$data['id_bus']; ?>"> Delete</a>
                    </td>
                  </tr>
                 <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

  </body>
</html>