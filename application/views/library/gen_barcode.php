<!DOCTYPE html>
<html lang="en">
<head>
  <title>Barcode</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
	@page { margin: 0px; }
  </style>
</head>
<body>

<table style='width:100%;' cellspacing='8'>
	<tr>
		<?php
			$tcon=3;
			$lineCounter = 0;
			foreach($book_data as $key => $val){
				if($key == $tcon){
					?>
						<tr><td></td></tr>
					<?php
					$tcon =$tcon+3;
				}
				?>
					<td style='border:1px solid #000;'>
						<center>
							<?php echo bar128(stripcslashes($val['accno'])); ?>
							<?php echo $val['BNAME']; ?><br /><?php echo $val['AUTHOR']; ?>
						</center>
					</td>&nbsp;&nbsp;&nbsp;
				<?php
				$lineCounter++;
				if($lineCounter % 21 == 0) {
					?>
						<tr><td><div><br /><br /><br /><br /><br /><br /><br /><br /></div></td></tr>
					<?php
				}
			}
		?>
	</tr>
</table>
</body>
</html>
