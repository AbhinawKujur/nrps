<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsMagazineMAster extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
		$this->load->model('Gautam', 'gautam');
	}

	public function index()
	{
		$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_master', '*');
		$this->render_template('library/newsmagazine_master', $data);
	}

	public function Journal_Entry()
	{


		$data['newsMagazineMasterData'] = $this->gautam->Journal_Entry_data();

		//$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_master','*');
		$this->render_template('library/Journal_Entry', $data);
	}
	public function Journal_Entry_change()
	{

		$date = $this->input->post('date');
		$data['newsMagazineMasterData'] = $this->gautam->Journal_Entry_data_change($date);
		$data['ddt'] = $date;
		//$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_master','*');
		$this->load->view('library/Journal_Entry_change', $data);
	}
	public function report_journal_entry()
	{
		$date_from = $this->input->post('from_date');
		$date_from = date_create("$date_from");
		$date_from = date_format($date_from, "Y-m-d");
		$date_to = $this->input->post('to_date');
		$date_to = date_create("$date_to");
		$date_to = date_format($date_to, "Y-m-d");
		$news_type = $this->input->post('news_type');

		if ($news_type != 'All') {
			$news_type = "ItemType='$news_type'";
		} else {

			$news_type = "1='1'";
		}

		$data['newsMagazineMasterData'] = $this->alam->selectA(
			'newspaper_journal_entry',
			'ItemName,ItemType,day_price,Day,DATE(daydate) AS daydate, qnt,total,ItemID,id,SUM(total) AS ttl, SUM(qnt) AS sum_qnt',
			"$news_type AND daydate BETWEEN '$date_from' AND '$date_to' GROUP BY ItemID, ItemName, ItemType, day_price, Day, id HAVING SUM(total) > 0"
		);

		// Reorganize the data and group by ItemID
		$groupedData = array();
		foreach ($data['newsMagazineMasterData'] as $val) {
			$itemID = $val['ItemID'];
			if (!isset($groupedData[$itemID])) {
				$groupedData[$itemID] = array(
					'ItemName' => $val['ItemName'],
					'ItemType' => $val['ItemType'],
					'day_price' => $val['day_price'],
					'sum_qnt' => $val['sum_qnt'],
					'ttl' => $val['ttl'],
					'dates' => array()
				);
			}
			$groupedData[$itemID]['dates'][] = array(
				'daydate' => $val['daydate'],
				'Day' => $val['Day'],
				'qnt' => $val['qnt'],
				'total' => $val['total']
			);
		}
?>

		<!-- Your HTML table -->
		<table class='table table-striped' id='example2'>
			<thead>
				<!-- ... (your existing header row) ... -->
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>SNo.</th>
					<th style='background:#337ab7; color:#fff !important;'>Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Duration Data</th>
					<th style='background:#337ab7; color:#fff !important;'>Total Quantity</th>
					<th style='background:#337ab7; color:#fff !important;'>Total Amount</th>
				</tr>
			</thead>


			<tbody>
				<?php
				$ii = 1;
				foreach ($groupedData as $itemID => $itemData) {
				?>
					<tr>
						<td><br /><br /><?php echo $ii; ?></td>
						<td><br /><br /><?php echo $itemData['ItemName']; ?></td>
						<td><br /><br /><?php echo $itemData['ItemType']; ?></td>
						<td>
							<table>
								<tr>
									<?php foreach ($itemData['dates'] as $dateData) {
										$ddt = date_create($dateData['daydate']);
										$day = date_format($ddt, "D");
									?>
										<td>
											<span style="background-color:#cccc00;padding:3px"><?php echo $dateData['daydate'] ?></span>
											<span style="background-color:#b38f00;color:white;padding:3px"><?php echo $dateData['Day']; ?></span>
											<br />(Rs: <?php echo $itemData['day_price'] ?>) X (Qty:<?php echo $dateData['qnt'] ?>) <br /><b>Total:</b> <?php echo $dateData['total'] ?>
										</td>
									<?php } ?>
								</tr>
							</table>
						</td>
						<td><br /><br /><?php echo number_format($itemData['sum_qnt']); ?></td>
						<td><br /><br /><b>Rs </b><?php echo number_format($itemData['ttl']); ?></td>
					</tr>
				<?php
					$ii++;
				}
				?>
			</tbody>
		</table>

		<script>
			$('#example2').DataTable({
				dom: 'Bfrtip',
				buttons: [
					/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
					{
						extend: 'excelHtml5',
						title: 'Daily Collection Reports',

					},
					/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
					{
						extend: 'pdfHtml5',
						title: 'Daily Collection Reports',

					},
				]
			});
		</script>
	<?php
	}

	public function report_journal_entry_OLD()
	{
		$date_from = $this->input->post('from_date');
		$date_from = date_create("$date_from");
		$date_from = date_format($date_from, "Y-m-d");
		$date_to = $this->input->post('to_date');
		$date_to = date_create("$date_to");
		$date_to = date_format($date_to, "Y-m-d");
		$news_type = $this->input->post('news_type');
		if ($news_type != 'All') {
			$news_type = "ItemType='$news_type'";
		} else {

			$news_type = "1='1'";
		}
		$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_journal_entry', 'ItemName,ItemType,day_price,	Day,daydate,qnt,total,ItemID,id,sum(total)as ttl,sum(qnt)as sum_qnt', "$news_type AND daydate BETWEEN '$date_from' AND '$date_to' group by ItemID,ItemName,ItemType,day_price,Day,daydate,qnt,total,id having sum(total)>0");

	?>


		<?php
		echo "	<table class='table table-striped' id='example2'> <thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>SNo.</th>
					<th style='background:#337ab7; color:#fff !important;'>Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Duration Data</th>
					<th style='background:#337ab7; color:#fff !important;'>Total Quantity</th>
					<th style='background:#337ab7; color:#fff !important;'>Total Amount</th>
				</tr>
			</thead><tbody>";
		$ii = 1;
		foreach ($data['newsMagazineMasterData'] as $val) {

		?>
			<tr>

				<td><br /><br /><?php echo $ii; ?></td>
				<td><br /><br /><?php echo $val['ItemName']; ?></td>
				<td><br /><br /><?php echo $val['ItemType']; ?></td>

				<td>
					<table>
						<tr>
							<?php
							$itemId = $val['ItemID'];
							$sub_data = $this->alam->selectA('newspaper_journal_entry', '*', " ItemID='$itemId' AND (total !='' && total !='0') AND daydate BETWEEN '$date_from' AND '$date_to'");
							foreach ($sub_data as $vall) {
								$ddt = date_create($vall['daydate']);
								$day = date_format($ddt, "D");
							?>
								<td><span style="background-color:#cccc00;padding:3px"><?php echo $vall['daydate'] ?></span><span style="background-color:#b38f00;color:white;padding:3px"><?php echo $day; ?></span>
									<br />(Rs: <?php echo $vall['day_price'] ?>) X (Qty:<?php echo $vall['qnt'] ?>) <br /><b>Total:</b> <?php echo $vall['total'] ?>

								</td>
							<?php } ?>
						</tr>
					</table>
				</td>
				<td><br /><br /><?php echo number_format($val['sum_qnt']); ?></td>
				</td>
				<td><br /><br /><b>Rs </b><?php echo number_format($val['ttl']); ?></td>
			</tr>
		<?php
			$ii++;
		}

		?>
		</tbody>
		</table>
		<script>
			$('#example2').DataTable({
				dom: 'Bfrtip',
				buttons: [
					/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
					{
						extend: 'excelHtml5',
						title: 'Daily Collection Reports',

					},
					/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
					{
						extend: 'pdfHtml5',
						title: 'Daily Collection Reports',

					},
				]
			});
		</script>
	<?php
		//$this->render_template('library/newspaper_report',$data);
	}

	public function newspaper_report()
	{


		$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_master', '*');;
		//$data['newsMagazineMasterData'] = $this->alam->selectA('newspaper_master','*');
		$this->render_template('library/newspaper_report', $data);
	}

	public function save()
	{
		$saveData = array(
			'ItemName'        => $this->input->post('nm'),
			'ItemType'        => $this->input->post('type'),
			'Price_mon'       => $this->input->post('mon_price'),
			'Price_tue'       => $this->input->post('tue_price'),
			'Price_wed'       => $this->input->post('wed_price'),
			'Price_thu'       => $this->input->post('thu_price'),
			'Price_fri'       => $this->input->post('fri_price'),
			'Price_sat'       => $this->input->post('sat_price'),
			'Price_sun'       => $this->input->post('sun_price'),
			'ItemDiscription' => $this->input->post('descdesc'),
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year'),
			'part' => $this->input->post('part'),
			'amount' => $this->input->post('amount'),
		);

		// echo '<pre>';
		// print_r($saveData);
		// die;

		$this->alam->insert('newspaper_master', $saveData);
		// echo $this->db->last_query();
		// die;
		$this->session->set_flashdata('success', "Data Inserted Successfully");
		redirect('library/NewsMagazineMaster');
	}
	public function save_journal_entry_change()
	{

		$size = sizeof($this->input->post('nm'));
		$ItemName        = $this->input->post('nm');
		$ItemType        = $this->input->post('type');
		$day_price       = $this->input->post('day_price');
		$Day       = $this->input->post('day');
		//$date       = date('d-m-y');
		$qnt       = $this->input->post('qnt');
		$total      = $this->input->post('total');
		$ItemID      = $this->input->post('itemid');
		$update_id      = $this->input->post('update_id');

		$size = $size - 1;
		$i = 0;

		while ($i <= $size) {

			$saveData = array(
				'ItemName'        => $ItemName[$i],
				'ItemID'        => $ItemID[$i],
				'ItemType'        => $ItemType[$i],
				'day_price'       => $day_price[$i],
				'Day'       => $Day,
				'daydate'       => $this->input->post('dateday'),
				'qnt'       => $qnt[$i],
				'total'       => $total[$i]

			);
			if ($update_id[$i] != "") {
				$iid = $update_id[$i];
				$this->alam->update('newspaper_journal_entry', $saveData, "id=$iid");
			} else {

				$this->alam->insert('newspaper_journal_entry', $saveData);
			}
			$i++;
		}
		//$this->session->set_flashdata('success',"Data Inserted Successfully");
		//redirect('library/NewsMagazineMaster');
	}

	public function save_journal_entry()
	{

		$size = sizeof($this->input->post('nm'));
		$ItemName        = $this->input->post('nm');
		$ItemType        = $this->input->post('type');
		$day_price       = $this->input->post('day_price');
		$Day       = $this->input->post('day');
		//$date       = date('d-m-y');
		$qnt       = $this->input->post('qnt');
		$total      = $this->input->post('total');
		$ItemID      = $this->input->post('itemid');
		$update_id      = $this->input->post('update_id');

		$size = $size - 1;
		$i = 0;

		while ($i <= $size) {

			$saveData = array(
				'ItemName'        => $ItemName[$i],
				'ItemID'        => $ItemID[$i],
				'ItemType'        => $ItemType[$i],
				'day_price'       => $day_price[$i],
				'Day'       => $Day,
				'daydate'       => date("Y-m-d"),
				'qnt'       => $qnt[$i],
				'total'       => $total[$i]

			);
			if ($update_id[$i] != "") {
				$iid = $update_id[$i];
				$this->alam->update('newspaper_journal_entry', $saveData, "id=$iid");
			} else {

				$this->alam->insert('newspaper_journal_entry', $saveData);
			}
			$i++;
		}
		//$this->session->set_flashdata('success',"Data Inserted Successfully");
		//redirect('library/NewsMagazineMaster');
	}
	public function edit()
	{
		$ItemID = $this->input->post('ItemID');
		$newsmagazineData = $this->alam->selectA('newspaper_master', '*', "ItemID='$ItemID'");

		$nm        = $newsmagazineData[0]['ItemName'];
		$type      = $newsmagazineData[0]['ItemType'];
		$mon_price = $newsmagazineData[0]['Price_mon'];
		$tue_price = $newsmagazineData[0]['Price_tue'];
		$wed_price = $newsmagazineData[0]['Price_wed'];
		$thu_price = $newsmagazineData[0]['Price_thu'];
		$fri_price = $newsmagazineData[0]['Price_fri'];
		$sat_price = $newsmagazineData[0]['Price_sat'];
		$sun_price = $newsmagazineData[0]['Price_sun'];
		$desc      = $newsmagazineData[0]['ItemDiscription'];
		$month      = $newsmagazineData[0]['month'];
		$year      = $newsmagazineData[0]['year'];
		$part      = $newsmagazineData[0]['part'];
		$amount      = $newsmagazineData[0]['amount'];
	?>
		<form action="<?php echo base_url('library/NewsMagazineMaster/update'); ?>" method='post' autocomplete='off'>
			<input type='hidden' value='<?php echo $ItemID; ?>' name='ItemID'>

			<div class="form-group">
				<label>Name:</label>
				<input type="text" value='<?php echo $nm; ?>' class="form-control" name="nm" style='text-transform: uppercase;' required>
			</div>

			<div class="form-group">
				<label>Type:</label>
				<select class='form-control' name='type' id="typeSelect" required>
					<option value=''>Select</option>
					<option value='NewsPaper' <?php if ($type == 'NewsPaper') {
																			echo "selected";
																		} ?>>NewsPaper</option>
					<option value='Magazine' <?php if ($type == 'Magazine') {
																			echo "selected";
																		} ?>>Magazine</option>
					<option value='General' <?php if ($type == 'General') {
																		echo "selected";
																	} ?>>General</option>
					<option value='Journal' <?php if ($type == 'Journal') {
																		echo "selected";
																	} ?>>Journal</option>
				</select>
			</div>

			<div class="form-group">
				<label>Description:</label>
				<input type='text' value='<?php echo $desc; ?>' class="form-control" name="desc" style='text-transform: uppercase;'>
			</div>

			<!-- Days Fields (Hidden if Magazine is selected) -->
			<div id="daysFields" style="display: <?php echo ($type != 'Magazine') ? 'block' : 'none'; ?>;">
				<!-- MON to SUN fields -->
				<div class='row'>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>MON</label>
							<input type='number' value='<?php echo $mon_price; ?>' placeholder='0.00' class='form-control' name='mon_price'>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>TUE</label>
							<input type='number' value='<?php echo $tue_price; ?>' placeholder='0.00' class='form-control' name='tue_price'>
						</div>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>WED</label>
							<input type='number' value='<?php echo $wed_price; ?>' placeholder='0.00' class='form-control' name='wed_price'>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>THU</label>
							<input type='number' value='<?php echo $thu_price; ?>' placeholder='0.00' class='form-control' name='thu_price'>
						</div>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>FRI</label>
							<input type='number' value='<?php echo $fri_price; ?>' placeholder='0.00' class='form-control' name='fri_price'>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>SAT</label>
							<input type='number' value='<?php echo $sat_price; ?>' placeholder='0.00' class='form-control' name='sat_price'>
						</div>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>SUN</label>
							<input type='number' value='<?php echo $sun_price; ?>' placeholder='0.00' class='form-control' name='sun_price'>
						</div>
					</div>
				</div>
				<!-- Repeat for other days (WED, THU, FRI, SAT, SUN) -->
			</div>

			<!-- Month/Part Fields (Hidden if not Magazine) -->
			<div id="monthPartFields" style="display: <?php echo ($type == 'Magazine') ? 'block' : 'none'; ?>;">
				<div class="form-group">
					<label>Month:</label>
					<select class="form-control" name="month">
						<option value="">Select Month</option>
						<option value="January" <?php if ($month == 'January') echo 'selected'; ?>>January</option>
						<option value="February" <?php if ($month == 'February') echo 'selected'; ?>>February</option>
						<option value="March" <?php if ($month == 'March') echo 'selected'; ?>>March</option>
						<option value="April" <?php if ($month == 'April') echo 'selected'; ?>>April</option>
						<option value="May" <?php if ($month == 'May') echo 'selected'; ?>>May</option>
						<option value="June" <?php if ($month == 'June') echo 'selected'; ?>>June</option>
						<option value="July" <?php if ($month == 'July') echo 'selected'; ?>>July</option>
						<option value="August" <?php if ($month == 'August') echo 'selected'; ?>>August</option>
						<option value="September" <?php if ($month == 'September') echo 'selected'; ?>>September</option>
						<option value="October" <?php if ($month == 'October') echo 'selected'; ?>>October</option>
						<option value="November" <?php if ($month == 'November') echo 'selected'; ?>>November</option>
						<option value="December" <?php if ($month == 'December') echo 'selected'; ?>>December</option>
					</select>
				</div>

				<div class="form-group">
					<label>Year:</label>
					<select class="form-control" name="year">
						<option value="">Select Year</option>
						<?php
						for ($i = 2015; $i <= 2025; $i++) {
							$selected = ($year == $i) ? 'selected' : '';
							echo "<option value='$i' $selected>$i</option>";
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label>Part:</label>
					<select class="form-control" name="part">
						<option value="">Select Part</option>
						<option value="Part 1" <?php if ($part == 'Part 1') echo 'selected'; ?>>Part 1</option>
						<option value="Part 2" <?php if ($part == 'Part 2') echo 'selected'; ?>>Part 2</option>
						<option value="weekly" <?php if ($part == 'weekly') echo 'selected'; ?>>Weekly</option>
						<option value="monthly" <?php if ($part == 'monthly') echo 'selected'; ?>>Monthly</option>
						
						
					</select>
				</div>
				<div class="form-group">
					<label>Amount:</label><br>
					<input type="text" name="amount" id="amount" value="<?php echo $amount; ?>">
				</div>

			</div>
			</div>

			<button type="submit" class="btn btn-warning">Update</button>
		</form>

		<script>
			document.getElementById('typeSelect').addEventListener('change', function() {
				var type = this.value;

				if (type === 'Magazine') {
					// Show month/part fields and hide days fields
					document.getElementById('daysFields').style.display = 'none';
					document.getElementById('monthPartFields').style.display = 'block';
				} else {
					// Show days fields and hide month/part fields
					document.getElementById('daysFields').style.display = 'block';
					document.getElementById('monthPartFields').style.display = 'none';
				}
			});

			// Ensure correct display on page load if 'Magazine' is already selected
			document.addEventListener('DOMContentLoaded', function() {
				var type = document.getElementById('typeSelect').value;

				if (type === 'Magazine') {
					document.getElementById('daysFields').style.display = 'none';
					document.getElementById('monthPartFields').style.display = 'block';
				}
			});
		</script>
<?php
	}

	public function update()
	{
		$ItemID = $this->input->post('ItemID');
		$saveData = array(
			'ItemName'        => $this->input->post('nm'),
			'ItemType'        => $this->input->post('type'),
			'Price_mon'       => $this->input->post('mon_price'),
			'Price_tue'       => $this->input->post('tue_price'),
			'Price_wed'       => $this->input->post('wed_price'),
			'Price_thu'       => $this->input->post('thu_price'),
			'Price_fri'       => $this->input->post('fri_price'),
			'Price_sat'       => $this->input->post('sat_price'),
			'Price_sun'       => $this->input->post('sun_price'),
			'ItemDiscription' => $this->input->post('descdesc'),
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year'),
			'part' => $this->input->post('part'),
			'amount' => $this->input->post('amount'),
		);

		$this->alam->update('newspaper_master', $saveData, "ItemID='$ItemID'");
		$this->session->set_flashdata('success', "Data Updated Successfully");
		redirect('library/NewsMagazineMaster');
	}
}
