<?php
$data = $this->session->userdata("nama");
if (!isset($data))
{
    redirect('login');
}
?> 
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Tampil Pinjaman</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?= base_url() ?>assets/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="<?= base_url() ?>assets/js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<!-- tables -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/basictable.css" />
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="<?=base_url() ?>assets/css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
				<div class="profile_details w3l">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												<div class="user-name">
													<p><?php echo $this->session->userdata("nama"); ?></p>
													<span><?php echo $this->session->userdata("level"); ?></span>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>
										</a>
										<ul class="dropdown-menu drp-mnu">
										<?php 
										$password = $this->session->userdata("password");
										$id_user = $this->session->userdata("id_user");
										?>
											<li> <a href=""><i class="fa fa-cog"></i> Ubah Password</a> </li>
											<li> <a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>
				<!-- tables -->
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

				
				<table>
				<?php foreach ($details as $datas) {
				?>
					<tr>
						<td><b>Nama Peminjam</td>
						<td>:</td>
						<td><?php echo $datas->nama; ?></td>
						<td><b>Total Pinjaman</td>
						<td>:</td>
						<td><?php echo 'IDR '.format_ribuan($datas->total_pinjaman) ?></td>
					</tr>
					<tr>
						<td><b>Pinjaman</td>
						<td>:</td>
						<td><?php echo $datas->nama_pinjaman; ?></td>
						<td><b>Sisa Pinjaman</td>
						<td>:</td>
						<td><?php echo 'IDR '.format_ribuan($datas->sisa) ?></td>
					</tr>
					<tr>
						<td><b>Tanggal Pinjaman</td>
						<td>:</td>
						<td><?php echo TanggalIndo($datas->tgl_pinjaman); ?></td>
						<td><b>Tenor</td>
						<td>:</td>
						<td><?php echo $datas->tenor.' Bulan'; ?></td>
					</tr>
				<?php } ?>
				</table>

<div class="agile-grids">	
				<!-- tables -->
				 
				<div class="agile-tables">
				<div class="container">
				
				</div>
				  <table width="100%" id="example1" class="max-height">
					<thead>
					  <tr>
						<th width="5%"><center>ID</th>
						<th width="5%"><center>Tgl Pembayaran</th>
						<th width="3%"><center>Angsuran Ke</th>
						<th width="5%"><center>Besar Angsuran</th>
						<th width="8%"><center>Keterangan</th>
						<th width="10%"><center>Tgl Jatuh Tempo</th>
						<th width="1%"><center>Angsuran</th>
						<th width="1%"><center>Print</th>
					  </tr>
					</thead>
					<tbody>
					 <?php foreach ($detail as $data) {
					 	$total = $data->besar_angsuran + $data->besar_angsuran_bunga;
				  	?>
					  <tr>
					  	<?php if ($data->ket_angsuran=='Lunas') {
					  	?>
					  	<td><?php echo $data->id_angsuran ?></td>
					  	<td><?php echo TanggalIndo($data->tgl_pembayaran) ?></td>
					  	<td><?php echo $data->angsuran_ke; ?></td>
					  	<td><?php echo 'IDR '. format_ribuan($total) ?></td>
					  	<td><?php echo $data->ket_angsuran ?></td>
					  	<td><?php echo TanggalIndo($data->tgl_jatuh_tempo) ?></td>
					  	<td>
					  		<button style="width: 100px;" type="submit" class="btn btn-success"><i class="fa fa-dollar" style="color:white;"></i></button>
					  	</td>
					  	<td>
					  		<form target="_blank" method="post" action="<?php echo base_url().'pinjaman/print_angsuran'; ?>"><input type="hidden" name="angsuran"  value="<?php echo $data->id_angsuran ?>"><button  type="submit" class="btn btn-success" onclick="return confirm('Ingin Mengeprint? ?')"><i class="fa fa-print" style="color:white;"></i></button></form>
					  	</td>
					  	<?php } else { 
					  	?>
					  	<td><?php echo $data->id_angsuran ?></td>
					  	<td><?php echo $data->tgl_pembayaran ?></td>
					  	<td><?php echo $data->angsuran_ke; ?></td>
					  	<td><?php echo format_ribuan($total) ?></td>
					  	<td><?php echo $data->ket_angsuran ?></td>
					  	<td><?php echo TanggalIndo($data->tgl_jatuh_tempo) ?></td>
					  	<td>
					  		<form method="post" action="<?php echo base_url().'pinjaman/angsuran'; ?>"><input type="hidden" name="angsuran" value="<?php echo $data->id_angsuran ?>"><button style="width: 100px;" type="submit" class="btn btn-reset" onclick="return confirm('Ingin Mengangsur ?')"><i class="fa fa-dollar" style="color:white;"></i></button></form>
					  	</td>
					  	<td>
					  		<button type="submit" class="btn btn-reset"><i class="fa fa-print" style="color:white;"></i></button>
					  	</td>
					  	<?php } ?>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
				  

	

				</div>
				<!-- //tables 
			</div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2017 Little Dolphin . Sistem Informasi Koperasi | Project by  <a href="http://w3layouts.com/" target="_blank">Rizal Ramli</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
									<li><a href="<?php echo base_url('pinjaman') ?>"><i class="fa fa-pencil" aria-hidden="true"></i>  <span>Pinjaman</span><div class="clearfix"></div></a></li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-money" aria-hidden="true"></i><span> Simpanan</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('simpanan_pokok') ?>"">Simpanan Pokok</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('simpanan_wajib') ?>"">Simpanan Wajib</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('simpanan_sukarela') ?>"">Simpanan Sukarela</a></li>
										  </ul>
										</li>
									<li><a href="<?php echo base_url('anggota') ?>""><i class="fa fa-group" aria-hidden="true"></i>  <span>Anggota</span><div class="clearfix"></div></a></li>
									<?php if ($this->session->userdata("level")=='admin') {
										?>
									<li><a href="<?php echo base_url('kategori_pinjaman') ?>""><i class="fa fa-sitemap" aria-hidden="true"></i>  <span>Kategori Pinjaman</span><div class="clearfix"></div></a></li>
									<li><a href="<?php echo base_url('kategori_simpanan') ?>""><i class="fa fa-sitemap" aria-hidden="true"></i>  <span>Kategori Simpanan</span><div class="clearfix"></div></a></li>
									<?php } ?>
									<li><a href="<?php echo base_url('user') ?>""><i class="fa fa-user" aria-hidden="true"></i>  <span>Petugas</span><div class="clearfix"></div></a></li>
									<li><a href="<?php echo base_url('rekap') ?>""><i class="fa fa-print" aria-hidden="true"></i>  <span>Rekap</span><div class="clearfix"></div></a></li>
									<li><a href="<?php echo base_url('chart') ?>""><i class="fa fa-bar-chart" aria-hidden="true"></i>  <span>Chart</span><div class="clearfix"></div></a></li>

							       
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="<?=base_url() ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?=base_url() ?>assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="<?=base_url() ?>assets/js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

<script src="<?=base_url() ?>asset_datatable/jquery-1.7.2.min.js"></script>
<script src="<?=base_url() ?>asset_datatable/bootstrap.min.js"></script>
<script src="<?=base_url() ?>asset_datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url() ?>asset_datatable/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=base_url() ?>asset_datatable/datatables/dataTables.bootstrap.css">

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable();
  });
  </script>
</body>
</html>