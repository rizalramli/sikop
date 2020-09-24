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
<title>Chart</title>
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
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
											<li> <a href="user/ubah_password/<?php echo $id_user ?>"><i class="fa fa-cog"></i> Ubah Password</a> </li>
											<li> <a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>

<div class="agile-grids">	
				<!-- tables -->
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
				
				<div class="agile-tables">
				<style>
					.statistik{
						width: 250px;
						height: auto;
					}
				</style>
<h4>Keuangan</h4>
		<?php
		$total = $pemasukan + $pengeluaran;
		$persen_pemasukan = $pemasukan / $total * '100';
		$persen_pengeluaran = $pengeluaran / $total * '100';
		 ?>	
		Pemasukan &nbsp <?php echo format_ribuan($pemasukan,'0','','.') ?><br>
		Pengeluaran &nbsp<?php echo format_ribuan($pengeluaran,'0','','.') ?>

        <table width="100%">
          <tr style="border-bottom: 1px solid #666;height:100px;overflow:hidden;">
          <td></td>
          <td></td>
            <td valign="bottom" style="overflow:hidden; "><div class="statistik" style="background-color:green; solid #ddd; height:<?php echo number_format($persen_pemasukan,'0','','.') ?>px;">&nbsp</div></td>
            <td valign="bottom" style="overflow:hidden;"><div class="statistik" style="background-color:red; height:<?php echo number_format($persen_pengeluaran,'0','','.') ?>px;">&nbsp</div></td>
            <td width="33%">&nbsp</td>
          </tr>
          <tr>
          	<td></td>
          	<td></td>
            <td><center><?php echo number_format($persen_pemasukan,'0','','.') ?>%</center></td>
            <td><center><?php echo number_format($persen_pengeluaran,'0','','.') ?>%</center></td>
          </tr>
          <tr>
            <td style="background-color: white;" colspan="5">
              <hr>
              <h5>Ket :</h5></td>
          </tr>
          <tr>
            <td colspan="3"><span class="statistik" style="background-color:green; border:1px solid #ddd; height:40px;width:100px;">&nbsp</span> Pemasukan<br><br>
            <span class="statistik" style="background-color:red; height:40px;width:100px;">&nbsp</span> Pengeluaran<br></td>
          </tr>
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
									<li><a href="pinjaman"><i class="fa fa-pencil" aria-hidden="true"></i>  <span>Pinjaman</span><div class="clearfix"></div></a></li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-money" aria-hidden="true"></i><span> Simpanan</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="simpanan_pokok">Simpanan Pokok</a></li>
											<li id="menu-academico-avaliacoes" ><a href="simpanan_wajib">Simpanan Wajib</a></li>
											<li id="menu-academico-avaliacoes" ><a href="simpanan_sukarela">Simpanan Sukarela</a></li>
										  </ul>
										</li>
									<li><a href="anggota"><i class="fa fa-group" aria-hidden="true"></i>  <span>Anggota</span><div class="clearfix"></div></a></li>
									<?php if ($this->session->userdata("level")=='admin') {
										?>
									
									<li><a href="kategori_pinjaman"><i class="fa fa-sitemap" aria-hidden="true"></i>  <span>Kategori Pinjaman</span><div class="clearfix"></div></a></li>
									<li><a href="kategori_simpanan"><i class="fa fa-sitemap" aria-hidden="true"></i>  <span>Kategori Simpanan</span><div class="clearfix"></div></a></li>

									<?php } ?>
									<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i>  <span>Petugas</span><div class="clearfix"></div></a></li>
									<li><a href="rekap"><i class="fa fa-print" aria-hidden="true"></i>  <span>Rekap</span><div class="clearfix"></div></a></li>
									<li><a href="chart"><i class="fa fa-bar-chart" aria-hidden="true"></i>  <span>Chart</span><div class="clearfix"></div></a></li>

							       
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