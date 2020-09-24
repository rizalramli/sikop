<?php
$data = $this->session->userdata("nama");
if (!isset($data))
{
    redirect('login');
}
?> 

<?php
          function format_ribuan ($nilai){      
            $n = number_format ($nilai, 0, ',', ',');
$m = "".$n.".00";
return $m;
          }
          function TanggalIndo($date){
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
           
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
           
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   
            return($result);
          }
          ?>

                  <table width="100%">
                  

                      <tr>
                        <td width="16%" rowspan="3"><img src="<?=base_url('assets/images/1.png') ?>" height="90"/></td>
                        <td style="font-size: 14;"><b>Koperasi Sukses Jaya</td>
                        <td width="12%" style="font-size: 12;">No. Transaksi</td>
                        <td style="font-size: 12;">: <?php echo $idpinjam; ?></td>
                      </tr>
                      <tr>
                        <td style="font-size: 12;" width="15%">Jln HOS. Cokroaminoto 161 Lumajang - 67311</td>
                        <td width="12%" style="font-size: 12;">Tanggal</td>
                        <td style="font-size: 12;">: <?php echo TanggalIndo($tgl_pinjaman); ?> </td>
                      </tr>
                      <tr>
                        <td style="font-size: 12;" width="48%">Phone/Fax : (0334) 8780440</td>
                        <td></td>
                      </tr>
                  </table>
                  <center><h3 style="margin-left:190px;">Bukti Transaksi Peminjaman</h3></center>
                  <hr style="color:black; margin-bottom: -4px; margin-top: 10px;"></hr>
                  <hr style="color:black;"></hr><br>
                  <table>
                    <tr>
                      <td style="font-size: 12;"><b>Jenis Transaksi</td>
                      <td>:</td>
                      <td style="font-size: 12;" >Peminjaman Uang</td>
                    </tr>
                    <tr>
                      <td style="font-size: 12;" ><b>Nama Peminjam</td>
                      <td>:</td>
                      <td style="font-size: 12;" ><?php echo $nama ?></td>
                    </tr>
                    <tr>
                      <td style="font-size: 12;" ><b>Besar Pinjaman</td>
                      <td>:</td>
                      <td style="font-size: 12;" ><?php echo 'IDR '. format_ribuan($besar_pinjaman) ?></td>
                    </tr>
                    <?php 
                    $bunga = $total_pinjaman - $besar_pinjaman;
                    ?>
                    <tr>
                      <td style="font-size: 12;" ><b>Bunga Pinjaman</td>
                      <td>:</td>
                      <td style="font-size: 12;" ><?php echo 'IDR '. format_ribuan($bunga); ?></td>
                    </tr>
                    <tr>
                      <td style="font-size: 12;" ><b>Total Pinjaman</td>
                      <td>:</td>
                      <td style="font-size: 12;" ><?php echo 'IDR '. format_ribuan($total_pinjaman); ?></td>
                    </tr>
                    <tr>
                      <td style="font-size: 12;" ><b>Tenor</td>
                      <td>:</td>
                      <td style="font-size: 12;" ><?php echo $tenor ?>&nbsp;Bulan</td>
                    </tr>
                    
                  </table>
                  <table width="100%">
                  <tr>
                    <td width="75%"></td>
                    <td style="font-size: 12;" width="25%">Mengetahui,</td>
                  </tr>
                  <tr>
                    <td width="75%"></td>
                    <td style="font-size: 12;" width="25%"><center><?php echo $this->session->userdata("level"); ?></td>
                  </tr>
                  <tr>
                    <td height="80px;"></td>
                  </tr>
                  <tr>
                    <td width="75%"></td>
                    <td style="font-size: 12;" width="25%"><center><?php echo $this->session->userdata("nama"); ?></td>
                  </tr>
                  </table>
