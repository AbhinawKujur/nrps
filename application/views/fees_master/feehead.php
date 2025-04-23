<?php 
if($fee_head1)
	{
		$act_code1 = $fee_head1[0]->ACT_CODE;
		$feehead1 = $fee_head1[0]->FEE_HEAD;
	}
	if($fee_head2)
	{
		$act_code2 = $fee_head2[0]->ACT_CODE;
		$feehead2 = $fee_head2[0]->FEE_HEAD;
	}
	if($fee_head3)
	{
		$act_code3 = $fee_head3[0]->ACT_CODE;
		$feehead3 = $fee_head3[0]->FEE_HEAD;
	}
	if($fee_head4)
	{
		$act_code4 = $fee_head4[0]->ACT_CODE;
		$feehead4 = $fee_head4[0]->FEE_HEAD;
	}
	if($fee_head5)
	{
		$act_code5 = $fee_head5[0]->ACT_CODE;
		$feehead5 = $fee_head5[0]->FEE_HEAD;
	}
	if($fee_head6)
	{
		$act_code6 = $fee_head6[0]->ACT_CODE;
		$feehead6 = $fee_head6[0]->FEE_HEAD;
	}
	if($fee_head7)
	{
		$act_code7 = $fee_head7[0]->ACT_CODE;
		$feehead7 = $fee_head7[0]->FEE_HEAD;
	}
	if($fee_head8)
	{
		$act_code8 = $fee_head8[0]->ACT_CODE;
		$feehead8 = $fee_head8[0]->FEE_HEAD;
	}
	if($fee_head9)
	{
		$act_code9 = $fee_head9[0]->ACT_CODE;
		$feehead9 = $fee_head9[0]->FEE_HEAD;
	}
	if($fee_head10)
	{
		$act_code10 = $fee_head10[0]->ACT_CODE;
		$feehead10 = $fee_head10[0]->FEE_HEAD;
	}
	if($fee_head11)
	{
		$act_code11 = $fee_head11[0]->ACT_CODE;
		$feehead11 = $fee_head11[0]->FEE_HEAD;
	}
	if($fee_head12)
	{
		$act_code12 = $fee_head12[0]->ACT_CODE;
		$feehead12 = $fee_head12[0]->FEE_HEAD;
	}
	if($fee_head13)
	{
		$act_code13 = $fee_head13[0]->ACT_CODE;
		$feehead13 = $fee_head13[0]->FEE_HEAD;
	}
	if($fee_head14)
	{
		$act_code14 = $fee_head14[0]->ACT_CODE;
		$feehead14 = $fee_head14[0]->FEE_HEAD;
	}
	if($fee_head15)
	{
		$act_code15 = $fee_head15[0]->ACT_CODE;
		$feehead15 = $fee_head15[0]->FEE_HEAD;
	}
	if($fee_head16)
	{
		$act_code16 = $fee_head16[0]->ACT_CODE;
		$feehead16 = $fee_head16[0]->FEE_HEAD;
	}
	if($fee_head17)
	{
		$act_code17 = $fee_head17[0]->ACT_CODE;
		$feehead17 = $fee_head17[0]->FEE_HEAD;
	}
	if($fee_head18)
	{
		$act_code18 = $fee_head18[0]->ACT_CODE;
		$feehead18 = $fee_head18[0]->FEE_HEAD;
	}
	if($fee_head19)
	{
		$act_code19 = $fee_head19[0]->ACT_CODE;
		$feehead19 = $fee_head19[0]->FEE_HEAD;
	}
	if($fee_head20)
	{
		$act_code20 = $fee_head20[0]->ACT_CODE;
		$feehead20 = $fee_head20[0]->FEE_HEAD;
	}
	if($fee_head21)
	{
		$act_code21 = $fee_head21[0]->ACT_CODE;
		$feehead21 = $fee_head21[0]->FEE_HEAD;
	}
	if($fee_head22)
	{
		$act_code22 = $fee_head22[0]->ACT_CODE;
		$feehead22 = $fee_head22[0]->FEE_HEAD;
	}
	if($fee_head23)
	{
		$act_code23 = $fee_head23[0]->ACT_CODE;
		$feehead23 = $fee_head23[0]->FEE_HEAD;
	}
	if($fee_head24)
	{
		$act_code24 = $fee_head24[0]->ACT_CODE;
		$feehead24 = $fee_head24[0]->FEE_HEAD;
	}
	if($fee_head25)
	{
		$act_code25 = $fee_head25[0]->ACT_CODE;
		$feehead25 = $fee_head25[0]->FEE_HEAD;
	}
?>
<style type="text/css">
	#over{
  height: 750px;
  width:100%;
  overflow-y: scroll;
}
tbody,tr,td
{
	cursor: pointer;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Fee Head</a> <i class="fa fa-angle-right"></i></li>
</ol>
	
	<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3;">
	<div class="row">
	<div class="col-md-3 col-sm-3 col-xl-3">
		<div id="over" style="border: 1px solid #5785c3;">
			<table class="table table-bordered" id="example">
			 <thead>
				<tr id="tr">
					<th style="text-align: center;" class="th" >S No</th>
					<th style="text-align: center;" class="th">Fee Head</th>
				</tr>
			 </thead>
			 <tbody style="padding: 0px;">
			 	
			 	 	 <tr>
			 	 	 	<td onclick="feehead1()"><?php echo $act_code1; ?><input type="hidden" value="<?php echo $act_code1; ?>" id="fee1" name="fee1"></td>
				       <td onclick="feehead1()"><?php echo $feehead1; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead2()"><?php echo $act_code2; ?><input type="hidden" value="<?php echo $act_code2; ?>" id="fee2"></td>
				       <td onclick="feehead2()"><?php echo $feehead2; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead3()"><?php echo $act_code3; ?><input type="hidden" value="<?php echo $act_code3; ?>" id="fee3"></td>
				       <td onclick="feehead3()"><?php echo $feehead3; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead4()"><?php echo $act_code4; ?><input type="hidden" value="<?php echo $act_code4; ?>" id="fee4"></td>
				       <td onclick="feehead4()"><?php echo $feehead4; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead5()"><?php echo $act_code5; ?><input type="hidden" value="<?php echo $act_code5; ?>" id="fee5"></td>
				       <td onclick="feehead5()"><?php echo $feehead5; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead6()"><?php echo $act_code6; ?><input type="hidden" id="fee6" value="<?php echo $act_code6; ?>"></td>
				       <td onclick="feehead6()"><?php echo $feehead6; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead7()"><?php echo $act_code7; ?><input type="hidden" value="<?php echo $act_code7; ?>" id="fee7"></td>
				       <td onclick="feehead7()"><?php echo $feehead7; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead8()"><input type="hidden" id="fee8" value="<?php echo $act_code8; ?>"><?php echo $act_code8; ?></td>
				       <td onclick="feehead8()"><?php echo $feehead8; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead9()"><input type="hidden" id="fee9" value="<?php echo $act_code9; ?>"><?php echo $act_code9; ?></td>
				       <td onclick="feehead9()"><?php echo $feehead9; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead10()"><input type="hidden" id="fee10" value="<?php echo $act_code10; ?>"><?php echo $act_code10; ?></td>
				       <td onclick="feehead10()"><?php echo $feehead10; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead11()"><input type="hidden" id="fee11" value="<?php echo $act_code11; ?>"><?php echo $act_code11; ?></td>
				       <td onclick="feehead11()"><?php echo $feehead11; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead12()"><input type="hidden" id="fee12" value="<?php echo $act_code12; ?>"><?php echo $act_code12; ?></td>
				       <td onclick="feehead12()"><?php echo $feehead12; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead13()"><input type="hidden" id="fee13" value="<?php echo $act_code13; ?>"><?php echo $act_code13; ?></td>
				       <td onclick="feehead13()"><?php echo $feehead13; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead14()"><input type="hidden" id="fee14" value="<?php echo $act_code14; ?>"><?php echo $act_code14; ?></td>
				       <td onclick="feehead14()"><?php echo $feehead14; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead15()"><input type="hidden" id="fee15" value="<?php echo $act_code15; ?>"><?php echo $act_code15; ?></td>
				       <td onclick="feehead15()"><?php echo $feehead15; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead16()"><input type="hidden" id="fee16" value="<?php echo $act_code16; ?>"><?php echo $act_code16; ?></td>
				       <td onclick="feehead16()"><?php echo $feehead16; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead17()"><input type="hidden" id="fee17" value="<?php echo $act_code17; ?>"><?php echo $act_code17; ?></td>
				       <td onclick="feehead17()"><?php echo $feehead17; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead18()"><input type="hidden" id="fee18" value="<?php echo $act_code18; ?>"><?php echo $act_code18; ?></td>
				       <td onclick="feehead18()"><?php echo $feehead18; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead19()"><input type="hidden" id="fee19" value="<?php echo $act_code19; ?>"><?php echo $act_code19; ?></td>
				       <td onclick="feehead19()"><?php echo $feehead19; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead20()"><input type="hidden" id="fee20" value="<?php echo $act_code20; ?>"><?php echo $act_code20; ?></td>
				       <td onclick="feehead20()"><?php echo $feehead20; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead21()"><input type="hidden" id="fee21" value="<?php echo $act_code21; ?>"><?php echo $act_code21; ?></td>
				       <td onclick="feehead21()"><?php echo $feehead21; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead22()"><input type="hidden" id="fee22" value="<?php echo $act_code22; ?>"><?php echo $act_code22; ?></td>
				       <td onclick="feehead22()"><?php echo $feehead22; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead23()"><input type="hidden" id="fee23" value="<?php echo $act_code23; ?>"><?php echo $act_code23; ?></td>
				       <td onclick="feehead23()"><?php echo $feehead23; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead24()"><input type="hidden" id="fee24" value="<?php echo $act_code24; ?>"><?php echo $act_code24; ?></td>
				       <td onclick="feehead24()"><?php echo $feehead24; ?></td>
			        </tr>
			 	 	 <tr>
			 	 	 	<td onclick="feehead25()"><input type="hidden" id="fee25" value="<?php echo $act_code25; ?>"><?php echo $act_code25; ?></td>
				       <td onclick="feehead25()"><?php echo $feehead25; ?></td>
			        </tr>
		</tbody>
		</table>
		</div>
	</div>
	<div class="col-xl-9 col-md-9 col-sm-9">
		<div id="loadfunction">
			<img src="<?php echo base_url('assets/preloader/preloader.gif'); ?>" style="width:100px; height:100px; position:absolute; top:60%; left:43%; display:none; z-index:9999;" id="loder">
		</div>
	</div>
</div>
</div>
<br /><br />

<div class="clearfix"></div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script type="text/javascript">
	function feehead1()
	{
		$("#loder").show();
		var id = $("#fee1").val();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});

	}
	function feehead2() {
		var id = $("#fee2").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead3()
	{
		var id = $("#fee3").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead4()
	{
		var id = $("#fee4").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead5()
	{
		var id = $("#fee5").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead6()
	{
		var id = $("#fee6").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead7()
	{
		var id = $("#fee7").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead8()
	{
		var id = $("#fee8").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead9()
	{
		var id = $("#fee9").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead10()
	{
		var id = $("#fee10").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead11()
	{
		var id = $("#fee11").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead12()
	{
		var id = $("#fee12").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead13()
	{
		var id = $("#fee13").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead14()
	{
		var id = $("#fee14").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead15()
	{
		var id = $("#fee15").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead16()
	{
		var id = $("#fee16").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead17()
	{
		var id = $("#fee17").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead18()
	{
		var id = $("#fee18").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead19()
	{
		var id = $("#fee19").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead20()
	{
		var id = $("#fee20").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead21()
	{
		var id = $("#fee21").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead22()
	{
		var id = $("#fee22").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead23()
	{
		var id = $("#fee23").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead24()
	{
		var id = $("#fee24").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
	function feehead25()
	{
		var id = $("#fee25").val();
		$("#loder").show();
		$.ajax({
			url:"<?php echo base_url('Fees_master/fee_one'); ?>",
			type:"POST",
			data:{id:id},
			success:function(data)
			 {
				$("#loadfunction").html(data);
				$("#loder").hide();
			 }
		});
	}
</script>