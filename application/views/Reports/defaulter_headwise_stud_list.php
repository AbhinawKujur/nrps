<?php
// echo"kjgkj";
// echo "<pre>";
// print_r($data);
?>
<?php
if ($feehead) {
    $head1 = $feehead[0]->SHNAME;
    $head2 = $feehead[1]->SHNAME;
    $head3 = $feehead[2]->SHNAME;
    $head4 = $feehead[3]->SHNAME;
    $head5 = $feehead[4]->SHNAME;
    $head6 = $feehead[5]->SHNAME;
    $head7 = $feehead[6]->SHNAME;
    $head8 = $feehead[7]->SHNAME;
    $head9 = $feehead[8]->SHNAME;
    $head10 = $feehead[9]->SHNAME;
    $head11 = $feehead[10]->SHNAME;
    $head12 = $feehead[11]->SHNAME;
    $head13 = $feehead[12]->SHNAME;
    $head14 = $feehead[13]->SHNAME;
    $head15 = $feehead[14]->SHNAME;
    $head16 = $feehead[15]->SHNAME;
    $head17 = $feehead[16]->SHNAME;
    $head18 = $feehead[17]->SHNAME;
    $head19 = $feehead[18]->SHNAME;
    $head20 = $feehead[19]->SHNAME;
    $head21 = $feehead[20]->SHNAME;
    $head22 = $feehead[21]->SHNAME;
    $head23 = $feehead[22]->SHNAME;
    $head24 = $feehead[23]->SHNAME;
    $head25 = $feehead[24]->SHNAME;
}

$view = $view;
$clss = $clss;
$secc = $secc;

?>

<table class="table table-stripped table-bordered" style='color: black' id="myTable1">
    <thead>
        <tr>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">SNO</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">NAME</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">ADM_NO</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">ROLL NO</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">Class/Sec</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">MONTH UPTO</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">PREVIOUS YEAR DUES</th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">CURRENT YEAR DUES</th>
			<?php if($text != 'partial'){ ?>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head1; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head2; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head3; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head4; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head5; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head6; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head7; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head8; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head9; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head10; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head11; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head12; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head13; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head14; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head15; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head16; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head17; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head18; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head19; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head20; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head21; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head22; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head23; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head24; ?></th>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">
                <?php if ($head25 == '-') {
                    echo "PREV DUES";
                } else {
                    echo $head25;
                } ?>
            </th>
			<?php } ?>
            <th style="background: #337ab7; color: white !important; font-size:14px !important">TOTAL AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <?php
		$grandtotprev = 0;
		$grandtotcurr = 0;
		$grandtotfee1 = 0;
		$grandtotfee2 = 0;
		$grandtotfee3 = 0;
		$grandtotfee4 = 0;
		$grandtotfee5 = 0;
		$grandtotfee6 = 0;
		$grandtotfee7 = 0;
		$grandtotfee8 = 0;
		$grandtotfee9 = 0;
		$grandtotfee10 = 0;
		$grandtotfee11 = 0;
		$grandtotfee12 = 0;
		$grandtotfee13 = 0;
		$grandtotfee14 = 0;
		$grandtotfee15 = 0;
		$grandtotfee16 = 0;
		$grandtotfee17 = 0;
		$grandtotfee18 = 0;
		$grandtotfee19 = 0;
		$grandtotfee20 = 0;
		$grandtotfee21 = 0;
		$grandtotfee22 = 0;
		$grandtotfee23 = 0;
		$grandtotfee24 = 0;
		$grandtotfee25 = 0;
		$grandtotamt = 0;
		
		foreach ($data as $key => $val) { ?>
            <tr>
                <td><?php echo $val[0]; ?></td>
                <td><?php echo $val[1]; ?></td>
                <td><?php echo $val[2]; ?></td>
                <td><?php echo $val[3]; ?></td>
                <td><?php echo $val[4]; ?></td>
                <td><?php echo $val[5]; ?></td>
                <td><?php $grandtotprev += $val[6]; echo $val[6]; ?></td>
                <td><?php $grandtotcurr += $val[7]; echo $val[7]; ?></td>
				<?php if($text != 'partial'){ ?>
                <td><?php $grandtotfee1 += $val[8]; echo $val[8]; ?></td>
                <td><?php $grandtotfee2 += $val[9]; echo $val[9]; ?></td>
                <td><?php $grandtotfee3 += $val[10]; echo $val[10]; ?></td>
                <td><?php $grandtotfee4 += $val[11]; echo $val[11]; ?></td>
                <td><?php $grandtotfee5 += $val[12]; echo $val[12]; ?></td>
                <td><?php $grandtotfee6 += $val[13]; echo $val[13]; ?></td>
                <td><?php $grandtotfee7 += $val[14]; echo $val[14]; ?></td>
                <td><?php $grandtotfee8 += $val[15]; echo $val[15]; ?></td>
                <td><?php $grandtotfee9 += $val[16]; echo $val[16]; ?></td>
                <td><?php $grandtotfee10 += $val[17]; echo $val[17]; ?></td>
                <td><?php $grandtotfee11 += $val[18]; echo $val[18]; ?></td>
                <td><?php $grandtotfee12 += $val[19]; echo $val[19]; ?></td>
                <td><?php $grandtotfee13 += $val[20]; echo $val[20]; ?></td>
                <td><?php $grandtotfee14 += $val[21]; echo $val[21]; ?></td>
                <td><?php $grandtotfee15 += $val[22]; echo $val[22]; ?></td>
                <td><?php $grandtotfee16 += $val[23]; echo $val[23]; ?></td>
                <td><?php $grandtotfee17 += $val[24]; echo $val[24]; ?></td>
                <td><?php $grandtotfee18 += $val[25]; echo $val[25]; ?></td>
                <td><?php $grandtotfee19 += $val[26]; echo $val[26]; ?></td>
                <td><?php $grandtotfee20 += $val[27]; echo $val[27]; ?></td>
                <td><?php $grandtotfee21 += $val[28]; echo $val[28]; ?></td>
                <td><?php $grandtotfee22 += $val[29]; echo $val[29]; ?></td>
                <td><?php $grandtotfee23 += $val[30]; echo $val[30]; ?></td>
                <td><?php $grandtotfee24 += $val[31]; echo $val[31]; ?></td>
                <td><?php $grandtotfee25 += $val[32]; echo $val[32]; ?></td>
				<?php } ?>
                <td><?php $grandtotamt += $val[33]; echo $val[33]; ?></td>
            </tr>
        <?php } ?>
    </tbody>
	<tfoot>
		<tr>
			<td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotprev; ?></b></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotcurr; ?></b></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee1; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee2; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee3; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee4; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee5; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee6; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee7; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee8; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee9; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee10; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee11; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee12; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee13; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee14; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee15; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee16; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee17; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee18; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee19; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee20; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee21; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee22; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee23; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee24; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotfee25; ?></b></td>
			<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grandtotamt; ?></b></td>
		</tr>
	</tfoot>
</table>

<script>
    $(document).ready(function() {
        $('#myTable1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'pageLength': 10,
            dom: 'Bfrtip',
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                },
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
                        title: 'Defaulter List',
                        className: 'btn btn-success',
                        extension: '.xlsx'
                    },
                    {
                        extend: 'pdf',
                        title: 'Defaulter List',
                        text: '<i class="fa fa-file-pdf-o"></i> PDF',
                        className: 'btn btn-primary',
                        action: function(e, dt, button, config) {
                            var query = dt.search();
                            window.open("<?php if(!empty($view && $clss && $secc)){ echo base_url('Defaulter_headwise_list/defaulter_classHeadWisePDF/'.$view.'/'.$clss.'/'.$secc);}else{
                                echo base_url('Defaulter_headwise_list/defaulter_classHeadWisePDF/'.$view);
                            } ?>");
                        }
                    }
                ]
            }
        });
    });
</script>