<?php
$data = $this->session->userdata("nama");
if (!isset($data))
{
    redirect('login');
}
?> 
Anda Salah Memasukan Password
<?php
$id_user = $this->session->userdata("id_user");

?>
<a href="ubah_password/<?php echo $id_user ?>">Silahkan Kembali</a>