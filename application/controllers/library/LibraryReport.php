<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LibraryReport extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
		$this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){		
		$data['title']	='';
		if(isset($_POST['search']))
		{		
			$rpttyp				=$this->input->post('rpttyp');
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			// echo $rpttyp." ". $fromdt." ".$to_dt;die();
			$data['reportType']= $rpttyp;
			if($rpttyp==0){
				$data['title']	=' Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.adm_no) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.adm_no) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.adm_no) AS sec'," Issued='1' and IDate BETWEEN '$fromdt' AND '$to_dt'");
				// echo "<pre>";
				// print_r($data);die();

			}elseif($rpttyp==1){
				$data['title']	='All Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.adm_no) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.adm_no) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.adm_no) AS sec'," IDate BETWEEN '$fromdt' AND '$to_dt'");
			}else{
				$data['title']	='Defaulter Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.adm_no) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.adm_no) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.adm_no) AS sec',"RDate>Due_date AND IDate BETWEEN '$fromdt' AND '$to_dt'");
			}
		} 		
			// echo "<pre>";
			// 	print_r($data);
			// 	echo "<pre>";
		$this->render_template('library/book_issue_rpt',$data);		
	}
	public function book_report_emp(){		
		$data['title']	='';
		if(isset($_POST['search']))
		{		
			$rpttyp				=$this->input->post('rpttyp');
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			if($rpttyp==0){
				$data['title']	=' Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID'," Issued='1' and IDate BETWEEN '$fromdt' AND '$to_dt'");
			}elseif($rpttyp==1){
				$data['title']	='All Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID'," IDate BETWEEN '$fromdt' AND '$to_dt'");
			}else{
				$data['title']	='Defaulter Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID',"RDate>Due_date AND IDate BETWEEN '$fromdt' AND '$to_dt'");
			}
		} 		
		$this->render_template('library/book_issue_rpt_emp',$data);		
	}

	
	public function BookReturnRpt(){
		$data['title']='Book Return Report';
		if(isset($_POST['search']))
		{
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			$data['return_rpt']   	= $this->pawan->selectA('books_applied1','*'," return=1 and RDate BETWEEN '$fromdt' AND '$to_dt'");				
		}	
        $this->render_template('library/book_return_rpt',$data);		
	}
	public function BookReturnRpt_emp(){
		$data['title']='Book Return Report';
		if(isset($_POST['search']))
		{
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			$data['return_rpt']   	= $this->pawan->selectA('books_applied1','*'," return=1 and RDate BETWEEN '$fromdt' AND '$to_dt'");				
		}	
        $this->render_template('library/book_return_rpt_emp',$data);		
	}

	public function BookStockReg(){			
		$data['tockreg']   = $this->pawan->stock_reg();			
        $this->render_template('library/book_stock_rpt',$data);		
	}
		public function BookStockReg_bw(){			
		$data['tockreg']   = $this->pawan->stock_reg();	
	$data['tockreg']   = $this->pawan->selectA('bookmaster','*');
	$this->render_template('library/book_stock_rpt_bw',$data);		
	}
	public function BookStockReg_bw_lost(){			
		$data['tockreg']   = $this->pawan->stock_reg();	
	$data['tockreg']   = $this->pawan->selectA('bookmaster','*',"1='1' AND book_status !='--Sel'");
	$this->render_template('library/book_stock_rpt_bw_lost',$data);		
	}
	public function BookStockReg_sort(){
		$srt=$this->input->post('sort_by');
		//$data['tockreg']   = $this->pawan->stock_reg();	
		if($srt =="accno"){
			$srt="";
		}else{
			$srt="ORDER BY $srt ASC";
		}
	$data['tockreg']   = $this->alam->selectA("bookmaster","*","1='1' $srt");
	$this->load->view('library/book_stock_sort_view',$data);		
	}
	
	
	public function barcode(){			
		$data['tockreg']   = 'Barcode Print';
		$data['subjectname']   	= $this->pawan->selectA('library_call_master','*');
		if(isset($_POST['search']))
		{
			$subj_id			=$this->input->post('subj_id');
			$data['book_data']  = $this->pawan->selectA('bookmaster','BNAME,PurName,B_Code,accno',"SUB_ID='$subj_id'");
		}
		
			$filepath ="";
			$text = "123456";
			$size = "40";
			$orientation ="horizontal";
			$code_type = "code128";
			$print = true;
			$sizefactor ="1";
			
			for($i=1;$i<=100;$i++){
				
			$data['barcoder2']=$this->test->barcode( $filepath, $i, $size, $orientation, $code_type, $print, $sizefactor );
			
			
			//print_r($data['barcoder2']);
			}die;
        $this->render_template('library/barcode',$data);		
	}
	
	
	//new
		public function book_report_sts()
	{
			//die;
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
			//echo'helo';die;
		$this->render_template('library/book_issue_rpt_sts', $array);
		// $this->load->view('library/book_issue_rpt_sts', $data);
	}

	public function book_issued_classwise()
	{
		
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');

		// $data['title']	= ' Issued Report From ' . $fromdt . ' To ' . $to_dt;
		$data  = $this->pawan->selectA('books_applied', '*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.STUDENTID) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.STUDENTID) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.STUDENTID) AS sec,    (SELECT bookmaster.accno FROM bookmaster WHERE  books_applied.BookID = bookmaster.B_Code) AS Accno', " Issued='1' and class ='$classs' ");
		// echo '<pre>';
		// print_r($data);
		// die;
		?>
		<table class='table table-bordered' id='example'>
			<thead>
				<tr>
					<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">Class/Sec</th>
					<th style="background: #337ab7; color: white !important;">BOOK NAME</th>
					<th style="background: #337ab7; color: white !important;">Accession No</th>
					<th style="background: #337ab7; color: white !important;">Issued Date</th>
					<th style="background: #337ab7; color: white !important;">Due Date</th>
					<th style="background: #337ab7; color: white !important;">Status</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$c = 1;
				foreach ($data as $data_cnt) {
				?>
					<tr>
						<td><?php echo $c; ?></td>
						<td><?php echo $data_cnt['Admno']; ?></td>
						<td><?php echo $data_cnt['class'].'-'.$data_cnt['sec'];; ?></td>
						<td><?php echo $data_cnt['BName']; ?></td>
						<td><?php echo $data_cnt['Accno']; ?></td>
						<td><?php echo $data_cnt['IDate']; ?></td>
						<td><?php echo $data_cnt['Due_date']; ?></td>
						<td>
						<?php if($data_cnt['return']>0){
							echo 'return';
						}
						else
						{
							echo'pending';
							
						} ?></td>
					</tr>
				<?php
					$c++;
				}

				?>
			</tbody>



		</table></br>

		

		<script>
			$(document).ready(function() {
				var viewupto = $("#view_upto").val();
				var cls = $("#clssss").val();
				var sec = $("#sec").val();
				// alert(cls);
				$('#example').DataTable({
					'paging': false,
					'lengthChange': true,
					'searching': true,
					'ordering': false,
					'info': true,
					'autoWidth': true,
					'pageLength': 25,
					dom: 'Bfrtip',
					
				});
			});
		</script>

		<?php
	}
	
	public function book_sts_allclasswise()
	{
		// echo'hello';die;
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');

		// $data['title']	= ' Issued Report From ' . $fromdt . ' To ' . $to_dt;
		$data  = $this->pawan->selectA('books_applied', '*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.STUDENTID) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.STUDENTID) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.STUDENTID) AS sec,(SELECT bookmaster.accno FROM bookmaster WHERE  books_applied.BookID = bookmaster.B_Code) AS Accno', " Issued='1' ");
		// echo '<pre>';
		// print_r($data);
		// die;
		?>
		<table class='table table-bordered' id='example'>
			<thead>
				<tr>
					<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">Class/Sec</th>
					<th style="background: #337ab7; color: white !important;">BOOK NAME</th>
					<th style="background: #337ab7; color: white !important;">Accession No</th>
					<th style="background: #337ab7; color: white !important;">Issued Date</th>
					<th style="background: #337ab7; color: white !important;">Due Date</th>
					<th style="background: #337ab7; color: white !important;">Status</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$c = 1;
				foreach ($data as $data_cnt) {
				?>
					<tr>
						<td><?php echo $c; ?></td>
						<td><?php echo $data_cnt['Admno']; ?></td>
						<td><?php echo $data_cnt['class'].'-'.$data_cnt['sec'];; ?></td>
						<td><?php echo $data_cnt['BName']; ?></td>
						<td><?php echo $data_cnt['Accno']; ?></td>
						<td><?php echo $data_cnt['IDate']; ?></td>
						<td><?php echo $data_cnt['Due_date']; ?></td>
						<td>
						<?php if($data_cnt['return']>0){
							echo 'return';
						}
						else
						{
							echo'pending';
							
						} ?></td>
					</tr>
				<?php
					$c++;
				}

				?>
			</tbody>



		</table></br>

		<input type="hidden" name="view_upto" id="view_upto" value="<?php echo $viewupto; ?>">
		<input type="hidden" name="clssss" id="clssss" value="<?php echo $classs; ?>">
		<input type="hidden" name="sec" id="sec" value="<?php echo $sec; ?>">

		<script>
			$(document).ready(function() {
				var viewupto = $("#view_upto").val();
				var cls = $("#clssss").val();
				var sec = $("#sec").val();
				// alert(cls);
				$('#example').DataTable({
					'paging': false,
					'lengthChange': true,
					'searching': true,
					'ordering': false,
					'info': true,
					'autoWidth': true,
					'pageLength': 25,
					dom: 'Bfrtip',
					
				});
			});
		</script>

		<?php
	}

 
}