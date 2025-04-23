<?php
echo $adm=$_GET['adm'];
?>
<iframe src="<?=base_url();?>assets/reportcard/<?=$adm;?>.pdf" width="1000" height="800"></iframe>