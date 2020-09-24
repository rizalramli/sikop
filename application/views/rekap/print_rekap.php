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
                        <td width="17%" rowspan="3"><img src="<?=base_url('assets/images/1.png') ?>" height="90"/></td>
                        <td style="font-size: 18;"><b>Koperasi Sukses Jaya</td>
                      </tr>
                      <tr>
                        <td style="font-size: 13;" width="15%">Jln HOS. Cokroaminoto 161 Lumajang - 67311</td>
                      </tr>
                      <tr>
                        <td style="font-size: 13;" width="48%">Phone/Fax : (0334) 8780440</td>
                        <td></td>
                      </tr>
                  </table>
				  <h6><center># Rekap Tanggal <?php echo TanggalIndo($tgl_awal) ?> Sampai <?php echo TanggalIndo($tgl_akhir) ?></center></h6>
				<table border="1" width="100%">
					<thead>
					  <tr>
					  	<th style="background-color:black; color: white;"><center>No</center></th>
					  	<th style="background-color:black; color: white;"><center>Nama</center></th>
					  	<th style="background-color:black; color: white;"><center>Tgl</center></th>
					  	<th style="background-color:black; color: white;"><center>Nominal</center></th>
					  	<th style="background-color:black; color: white;"><center>Keterangan</center></th>
					  </tr>
					</thead>
					<tbody>
					<?php foreach ($ambil as $data) {
				  	?>
					  <tr>
						<td><?php echo $data->id_rekap ?>.</td>
						<td><?php echo $data->nama ?></td>
						<td><?php echo TanggalIndo($data->tgl_rekap) ?></td>
						<td width="16%" style="text-align: right;"><?php echo format_ribuan($data->nominal) ?></td>
						<td><?php echo $data->ket ?></td>

					  </tr>
					 <?php 
					 }
					 ?>
					</tbody>
				  </table>