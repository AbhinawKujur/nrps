<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookMaster extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
	}

	public function index()
	{
		$data['BookMasterData'] = $this->alam->selectA('bookmaster', '*');
		$cc = $this->alam->selectA('bookmaster', "count('id')cnt", "1='1' limit 10");
		$data['cnt'] = $cc[0]['cnt'];

		$this->render_template('library/book_master', $data);
	}

	public function pageination()
	{

		$cnt = $this->input->post('cnt');

		$size = $this->input->post('size');
		if ($cnt != 1) {
			$cnt = $cnt * $size;
			$cnt = ($cnt - $size);
		} else {
			$cnt = $cnt - 1;
		}
		$data['ReportData'] = $this->alam->selectA('bookmaster', '*', "1='1' limit $cnt, $size");
		$data['cnt_last'] = $cnt;
		$this->load->view('library/pageination_view', $data);
	}

	public function globsearch()
	{

		$data = $this->input->post('data');

		$accno = $this->input->post('accno');
		$BNAME = $this->input->post('BNAME');
		$PUBLISHER = $this->input->post('PUBLISHER');
		$EDITION = $this->input->post('EDITION');
		$AUTHOR = $this->input->post('AUTHOR');
		$Med = $this->input->post('Med');

		$al = "accno LIKE '%$accno%' && BNAME LIKE '%$BNAME%' && PUBLISHER LIKE '%$PUBLISHER%' && EDITION LIKE '%$EDITION%' && Med LIKE '%$Med%' && AUTHOR LIKE '%$AUTHOR%'";
		$data = $this->alam->selectA('bookmaster', '*', "1='1' && $al limit 10");
		$data = array("ReportData" => $data);
		$this->load->view('library/pageination_view', $data);
	}

	public function saveBookMaster()
	{
		$data['subjectsData']   = $this->alam->selectA('library_call_master', '*', "1='1' order by book_name ASC");
		$data['rackMasterData'] = $this->alam->selectA('rack_master', '*');
		$data['booktypeData']   = $this->alam->selectA('book_type_master', '*');
		$data['classesData']    = $this->alam->selectA('classes', '*');
		$this->render_template('library/book_master_form', $data);
	}

	public function loadRackNo()
	{
		$rack_id = $this->input->post('rack_id');
		$data    = $this->alam->selectA('rack_master', 'rack_from,rack_to', "RackNo='$rack_id'");
		$rack_from = $data[0]['rack_from'];
		$rack_to = $data[0]['rack_to'];
		?>
		<select class='form-control' name='rack_no' required>
			<option value=''>Select</option>
			<?php
			for ($i = $rack_from; $i <= $rack_to; $i++) {
			?>
				<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
			<?php
			}
			?>
		</select>
		<?php
	}

	public function countSubject()
	{
		$subject_id = $this->input->post('subject_id');
		$SubData    = $this->alam->countBook($subject_id);
		$Sub_Id   	= $SubData[0]['bookId'];
		$subjCnt    = $SubData[0]['subjCnt'] + 1;
		$SubCalNo   = $SubData[0]['call_no'];
		$refData    = $Sub_Id . '/' . $subjCnt;

		$accData    = $this->alam->selectA('bookmaster', 'max(accno)max');
		if (is_numeric($accData[0]['max']) == 1) {
			//$maxVal     = $accData[0]['max'] + 1;
			$maxVal     = "";
		} else {
			$maxVal     = "";
		}

		$array = array($refData, $maxVal, $SubCalNo);
		echo json_encode($array);
	}

	public function chkAccession_no()
	{
		$book_type_id = $this->input->post('book_type_id');
		$accno        = $this->input->post('accno');

		if ($book_type_id == 1 || $book_type_id == 2) {
			$chkDataa      = $this->alam->selectA('bookmaster', 'count(accno)cnt', "com = '$book_type_id'  AND accno = '$accno'");
			echo $cnt          = $chkDataa[0]['cnt'];
		} else {
			$chkData     = $this->alam->selectA('bookmaster', 'count(accno)cnt', "accno = '$accno'");
			echo $cnt          = $chkData[0]['cnt'];
		}
	}

	public function saveBook_old()
	{
		$accno     = $this->input->post('accno');
		$book_type = $this->input->post('book_type');
		$string = $this->input->post('wing');
		$save = $this->input->post('save');
		$string = substr($string, 0, 1);
		$set_of_no = $this->input->post('set_of_no');
		$size = $this->alam->selectA('bookmaster', 'accno', "accno='$accno' AND com=(select book_type from book_type_master where id='$book_type')");

		if (isset($_POST['save']))
		{
			if (sizeof($size) == 0) {
				$chkComplement = ($book_type == 2) ? 'C-' . $accno : $accno;
	
				for ($i = 1; $i <= $set_of_no; $i++) {
					$stringpart =  preg_replace('/[^A-Z-]/', '', $chkComplement);
					$numberpart = preg_replace('/[^0-9]/', '', $chkComplement);
					if ($i == 1) {
						$add        = $numberpart;
					}
					$saveData = array(
						'ID_NO'        	 => $this->input->post('ref_no'),
						'B_Code'       	 => $stringpart . $add,
						'BNAME'        	 => strtoupper($this->input->post('book_nm')),
						'AUTHOR'       	 => strtoupper($this->input->post('author')),
						'PUBLISHER'    	 => strtoupper($this->input->post('publisher')),
						'PURCHASED'    	 => strtoupper($this->input->post('PURCHASED')),
						'PRICE'        	 => $this->input->post('price_no'),
						'SUB_ID'       	 => $this->input->post('subj_nm'),
						'EDITION'      	 => $this->input->post('edition'),
						'CLASS'        	 => $this->input->post('class'),
						'TPage'        	 => $this->input->post('tot_page'),
						'Med'          	 => $this->input->post('language'),
						'classCode'    	 => $this->input->post('class'),
						'isbnno'       	 => $this->input->post('isbn'),
						'ODate'        	 => date('Y-m-d', strtotime($this->input->post('order_dt'))),
						'BillNo'       	 => $this->input->post('bill_no'),
						'LibName'      	 => strtoupper($this->input->post('library_nm')),
						'CallNo'       	 => $this->input->post('call_no'),
						'CollectionNo' 	 => $this->input->post('collection_no'),
						'Rackno'       	 => 0,
						'CD'           	 => $this->input->post('cd_exist'),
						'BOOKSET'      	 => $this->input->post('set_of_no'),
						'racnoto'      	 => $this->input->post('rack_no'),
						'racname'      	 => strtoupper($this->input->post('almirah_nm')),
						'accno'        	 => $add,
						'accession_date' => date('Y-m-d', strtotime($this->input->post('accession_dt'))),
						'bdate'          => date('Y-m-d', strtotime($this->input->post('bill_dt'))),
						'ser'            => $string . '-' . $stringpart . $add,
						'com'            => $this->input->post('wing'),
						'book_no'		 => $this->input->post('book_no'),
						'book_status'	 => $this->input->post('bookstatus'),
					);
					//print_r($saveData);exit;
					$add        = $numberpart + $i;
	
					$this->alam->insert('bookmaster', $saveData);
				}
				redirect('library/BookMaster');
			}
		}

		if (sizeof($size) == 0) {
			$chkComplement = ($book_type == 2) ? 'C-' . $accno : $accno;

			for ($i = 1; $i <= $set_of_no; $i++) {
				$stringpart =  preg_replace('/[^A-Z-]/', '', $chkComplement);
				$numberpart = preg_replace('/[^0-9]/', '', $chkComplement);
				if ($i == 1) {
					$add        = $numberpart;
				}
				$saveData = array(
					'ID_NO'        	 => $this->input->post('ref_no'),
					'B_Code'       	 => $stringpart . $add,
					'BNAME'        	 => strtoupper($this->input->post('book_nm')),
					'AUTHOR'       	 => strtoupper($this->input->post('author')),
					'PUBLISHER'    	 => strtoupper($this->input->post('publisher')),
					'PURCHASED'    	 => strtoupper($this->input->post('PURCHASED')),
					'PRICE'        	 => $this->input->post('price_no'),
					'SUB_ID'       	 => $this->input->post('subj_nm'),
					'EDITION'      	 => $this->input->post('edition'),
					'CLASS'        	 => $this->input->post('class'),
					'TPage'        	 => $this->input->post('tot_page'),
					'Med'          	 => $this->input->post('language'),
					'classCode'    	 => $this->input->post('class'),
					'isbnno'       	 => $this->input->post('isbn'),
					'ODate'        	 => date('Y-m-d', strtotime($this->input->post('order_dt'))),
					'BillNo'       	 => $this->input->post('bill_no'),
					'LibName'      	 => strtoupper($this->input->post('library_nm')),
					'CallNo'       	 => $this->input->post('call_no'),
					'CollectionNo' 	 => $this->input->post('collection_no'),
					'Rackno'       	 => 0,
					'CD'           	 => $this->input->post('cd_exist'),
					'BOOKSET'      	 => $this->input->post('set_of_no'),
					'racnoto'      	 => $this->input->post('rack_no'),
					'racname'      	 => strtoupper($this->input->post('almirah_nm')),
					'accno'        	 => $add,
					'accession_date' => date('Y-m-d', strtotime($this->input->post('accession_dt'))),
					'bdate'          => date('Y-m-d', strtotime($this->input->post('bill_dt'))),
					'ser'            => $string . '-' . $stringpart . $add,
					'com'            => $this->input->post('wing'),
					'book_no'		 => $this->input->post('book_no'),
					'book_status'	 => $this->input->post('bookstatus'),
				);
				//print_r($saveData);exit;
				$add        = $numberpart + $i;

				$this->alam->insert('bookmaster', $saveData);
			}
			redirect('library/BookMaster');
		}
		
		else {
			echo 1;
		}
	}
	
		public function saveBook()
	{
		$accno     = strtoupper($this->input->post('accno'));
		$book_type = $this->input->post('book_type');
		$string = $this->input->post('wing');
		$save = $this->input->post('save');
		$string = substr($string, 0, 1);
		$set_of_no = $this->input->post('set_of_no');

		$size = $this->alam->selectA('bookmaster', 'accno', "accno='$accno' AND com=(select book_type from book_type_master where id='$book_type')");


		if (sizeof($size) == 0) {
			$chkComplement = ($book_type == 2) ? 'C-' . $accno : $accno;

			for ($i = 1; $i <= $set_of_no; $i++) {
				
				$stringpart =  preg_replace('/[^A-Z-]/', '', $chkComplement);
				$numberpart = preg_replace('/[^0-9]/', '', $chkComplement);
				if ($i == 1) {
					$add = $numberpart;
				}

				$saveData = array(
					'ID_NO'        	 => $stringpart .'/'. $add,
					'B_Code'       	 => $stringpart .'/'. $add,
					// 'B_Code' => strtoupper($this->input->post('accno')),
					'BNAME'        	 => strtoupper($this->input->post('book_nm')),
					'AUTHOR'       	 => strtoupper($this->input->post('author')),
					'PUBLISHER'    	 => strtoupper($this->input->post('publisher')),
					'PURCHASED'    	 => strtoupper($this->input->post('PURCHASED')),
					'PRICE'        	 => $this->input->post('price_no'),
					'SUB_ID'       	 => $this->input->post('subj_nm'),
					'EDITION'      	 => $this->input->post('edition'),
					'CLASS'        	 => $this->input->post('class'),
					'TPage'        	 => $this->input->post('tot_page'),
					'Med'          	 => $this->input->post('language'),
					'classCode'    	 => $this->input->post('class'),
					'isbnno'       	 => $this->input->post('isbn'),
					'ODate'        	 => date('Y-m-d', strtotime($this->input->post('order_dt'))),
					'BillNo'       	 => $this->input->post('bill_no'),
					'LibName'      	 => strtoupper($this->input->post('library_nm')),
					'CallNo'       	 => $this->input->post('call_no'),
					'CollectionNo' 	 => $this->input->post('collection_no'),
					'Rackno'       	 => 0,
					'CD'           	 => $this->input->post('cd_exist'),
					'BOOKSET'      	 => $this->input->post('set_of_no'),
					'racnoto'      	 => $this->input->post('rack_no'),
					'racname'      	 => strtoupper($this->input->post('almirah_nm')),
					'accno'        	 => $stringpart .'/'. $add,
					'accession_date' => date('Y-m-d', strtotime($this->input->post('accession_dt'))),
					'bdate'          => date('Y-m-d', strtotime($this->input->post('bill_dt'))),
					'ser'            => $string . '-' . $stringpart . $add,
					'com'            => $this->input->post('wing'),
					'book_no'		 => $this->input->post('book_no'),
					'book_status'	 => $this->input->post('bookstatus'),
				);
				//print_r($saveData);exit;
				$add        = $numberpart + $i;

				$this->alam->insert('bookmaster', $saveData);
			}
			redirect('library/BookMaster');
		} else {
			echo 1;
		}
	}

	public function editBookMaster($editId)
	{
		$id = $editId;
		$data['subjectsData']      = $this->alam->selectA('library_call_master', '*', "1='1' order by book_name ASC");
		$data['rackMasterData']    = $this->alam->selectA('rack_master', '*');
		$data['booktypeData']      = $this->alam->selectA('book_type_master', '*');
		$data['classesData']       = $this->alam->selectA('classes', '*');
		$data['bMData']            = $this->alam->selectA('bookmaster', '*', "id='$id'");
		$this->render_template('library/book_master_edit', $data);
	}

	public function updatedata()
	{
		$id 			= $this->input->post('id');
		$accno     		= $this->input->post('accno');
		$book_type 		= $this->input->post('book_type');
		$string = $this->input->post('wing');
		$string = substr($string, 0, 1);
		$chkComplement	= ($book_type == 2) ? 'C-' . $accno : $accno;


		$updatdat = array(
			'ID_NO'        	 => $this->input->post('ref_no'),
			'BNAME'        	 => $this->input->post('book_nm'),
			'AUTHOR'       	 => $this->input->post('author'),
			'PUBLISHER'    	 => $this->input->post('publisher'),
			'PURCHASED'    	 => strtoupper($this->input->post('PURCHASED')),
			'PRICE'        	 => $this->input->post('price_no'),
			'SUB_ID'       	 => $this->input->post('subj_nm'),
			'EDITION'      	 => $this->input->post('edition'),
			'CLASS'        	 => $this->input->post('class'),
			'TPage'        	 => $this->input->post('tot_page'),
			'Med'          	 => $this->input->post('language'),
			'classCode'    	 => $this->input->post('class'),
			'isbnno'       	 => $this->input->post('isbn'),
			'ODate'        	 => date('Y-m-d', strtotime($this->input->post('order_dt'))),
			'BillNo'       	 => $this->input->post('bill_no'),
			'LibName'      	 => $this->input->post('library_nm'),
			'CallNo'       	 => $this->input->post('call_no'),
			'CollectionNo' 	 => $this->input->post('collection_no'),
			'Rackno'       	 => 0,
			'accno'       	 => strtoupper($this->input->post('accno')),
			'CD'           	 => $this->input->post('cd_exist'),
			'BOOKSET'      	 => $this->input->post('set_of_no'),
			'racnoto'      	 => $this->input->post('rack_no'),
			'racname'      	 => $this->input->post('almirah_nm'),
			'accession_date' => date('Y-m-d', strtotime($this->input->post('accession_dt'))),
			'bdate'          => date('Y-m-d', strtotime($this->input->post('bill_dt'))),
			'ser'            => $string . '-' . $stringpart . $add,
			'com'            => $this->input->post('wing'),
			'book_no'		 => $this->input->post('book_no'),
			'book_status'	 => $this->input->post('bookstatus'),
		);
		$this->alam->update('bookmaster', $updatdat, "id='$id'");
		redirect('library/BookMaster');
	}

}
