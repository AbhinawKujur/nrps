<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remarks extends MY_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		
		$class_data = $this->alam->select('classes','*');
		
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('class_data'=>$class_data,'t1'=>$t1,'t2'=>$t2);
		
		$this->render_template('marks_entry/remarks_term',$array);
	}
	
	public function remarks($trm){
		
		$class_data = $this->alam->select('classes','*');
		$remarks_data_mstr = $this->alam->select('student_remarks','distinct(Remarks)');
		
		$log_cls_no = login_details['Class_No'];
		
		$array = array('class_data'=>$class_data,'trm'=>$trm,'remarks_data_mstr'=>$remarks_data_mstr,'log_cls_no'=>$log_cls_no);
		
		$this->render_template('marks_entry/remarks',$array);
	}
	
	public function classess(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list(){
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$trm    = $this->input->post('trm');
		
		$remarks_data = $this->alam->remarks_data($classs,$sec,$trm);
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important; width:100px"><!--<input type="checkbox" name="chkall" onchange="checkAll()" disabled>--> Select</th>
			  <th style="background:#5785c3; color:#fff!important; width:100px">Adm No.</th>
			  <th style="background:#5785c3; color:#fff!important; width:100px">Name</th>
			  <th style="background:#5785c3; color:#fff!important; width:100px">Roll</th>
			  <th style="background:#5785c3; color:#fff!important; width:100%">Remarks</th>
		    </tr>
			<?php
			  if($remarks_data){
				  $i = 1;
				  foreach($remarks_data as $rmks_data){
					  ?>
					  <tr>
					    <td><input type="checkbox" name='adm_no[]' value="<?php echo $rmks_data->ADM_NO; ?>" id="admno_<?php echo $i; ?>" onclick="chk_one(this)" disabled></td>
					    <td><?php echo $rmks_data->ADM_NO; ?></td>
					    <td><?php echo $rmks_data->FIRST_NM; ?></td>
					    <td><?php echo $rmks_data->ROLL_NO; ?></td>
						<input type="hidden" value="<?php echo $rmks_data->remarks; ?>" id="hremarks_<?php echo $i; ?>">
					    <td><textarea class='form-control' name="rmrks[]" id="rmrks_<?php echo $i; ?>" rows='2' disabled><?php echo $rmks_data->remarks; ?></textarea></td>
					  </tr>	
					  <?php
					  $i++;
				  }
			  }
			?>
		  </table>
		<?php
	}
	
	public function save_upd(){
		$chk_sta = $this->input->post('chk_sta');
		if($chk_sta == 'chk'){
			$admno = $this->input->post('admno');
			$trm = $this->input->post('trm');
			$rmrks = $this->input->post('rmrks');
			$rmk_data = $this->alam->select('remarks','count(*)cnt',"ADM_NO='$admno' AND TERM='TERM-$trm'");
			$cnt = $rmk_data[0]->cnt;
			if($cnt == 1){
				$upd = array(
				'REMARKS' => $rmrks
				);
				
				$this->alam->update('remarks',$upd,"ADM_NO='$admno' AND TERM='TERM-$trm'");
			}else{
				$data = array(
				'ADM_NO' => $admno, 
				'TERM' => 'TERM-'.$trm,
                'REMARKS' => $rmrks
				);
				
				$this->alam->insert('remarks',$data);
			}
		}else{
			$admno = $this->input->post('admno');
			$trm = $this->input->post('trm');
			$rmrks = $this->input->post('hremarks');
			$rmk_data = $this->alam->select('remarks','count(*)cnt',"ADM_NO='$admno' AND TERM='TERM-$trm'");
			$cnt = $rmk_data[0]->cnt;
			if($cnt == 1){
				$upd = array(
				'REMARKS' => $rmrks
				);
				
				$this->alam->update('remarks',$upd,"ADM_NO='$admno' AND TERM='TERM-$trm'");
			}else{
				$data = array(
				'ADM_NO' => $admno, 
				'TERM' => 'TERM-'.$trm,
                'REMARKS' => $rmrks	
				);
				
				$this->alam->insert('remarks',$data);
			}
		}
	}
}