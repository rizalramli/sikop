<?php
$data = $this->session->userdata("nama");
if (!isset($data))
{
    redirect('login');
}
?> 

<?php
				  function format_ribuan ($nilai){
				  return number_format ($nilai, 0, ',', '.');
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
          <style>
        .center-cropped {
  width: 75px;
  height: 75px;
  background-position: center center;
  background-repeat: no-repeat;
}
    </style>

                  <table style="margin-left: 125px;" width="100%">
                  <?php foreach ($ambil as $data) {
			
				   ?>

                       <tr>
                        <td width="16%" rowspan="3"><img src="<?=base_url('assets/images/1.png') ?>" height="90"/></td>
                        <td style="font-size: 18;"><b>Koperasi Sukses Jaya</b></td>
                      </tr>
                      <tr>
                        <td width="55%" style="font-size: 10;">Badan Hukum No : 78 /BH/518/ DISKOP.UKM/XI /2002</td>
                      </tr>
                      <tr>
                        <td style="font-size: 10;" width="38%">Jln HOS. Cokroaminoto 161 Lumajang - 67311</td>
                      </tr>
                 
                  	
                  </table>
                  <hr style="color:black; height:4px; width: 410px;" ></hr>
                  <table style="margin-left: 180px;" width="100%">
                  <tr>
                    <td width="17%" rowspan="5"><center><img class="center-cropped" src="uploads/<?php echo $data->foto; ?>"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Nama &nbsp;&nbsp; : <?php echo $data->nama ?></td>
                  </tr>
                  <tr>
                    <td>TTL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data->tempat_lahir ?>,<?php echo TanggalIndo($data->tgl_lahir); ?></td>
                  </tr>
                  <tr>
                    <td>Alamat &nbsp;: <?php echo $data->alamat; ?></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  </table>

                  <?php } ?>