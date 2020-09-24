<?php
$data = $this->session->userdata("nama");
if (!isset($data))
{
    redirect('login');
}
?> 
Anda Sudah Pernah Menabung Di Simpanan Sukarela
<a href="<?php echo base_url('simpanan_sukarela') ?>">Silahkan Kembali</a>