<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamMaster extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$data['examMasterData'] = $this->alam->selectA('online_exam_master','*');
		$this->render_template('onlineexam/teacher/exam_master/examMaster',$data);
	}
	
	public function examMasterSave(){
		$user_id = login_details['user_id'];
		$exam_name = trim($this->input->post('exam_name'));
		
		$data = $this->alam->selectA('online_exam_master','count(*)cnt',"exam_name='$exam_name'");
		$cnt = $data[0]['cnt']; 
		
		$save = array(
			'exam_name' => strtoupper($this->input->post('exam_name')),
			'created_by' => $user_id
		);
		
		if($cnt == 0){
			$this->alam->insert('online_exam_master',$save);
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	public function examMasterEdit(){
		$examMasterId = $this->input->post('id');
		$examMasterData = $this->alam->selectA('online_exam_master','*',"id='$examMasterId'");
		$exam_name = $examMasterData[0]['exam_name'];
		?>
			<form class="form-inline" id="exam_master_upd">
			  <label class="mr-sm-2">Exam Name</label>
			  <input type="text" name='exam_name' class="form-control mb-2 mr-sm-2" value="<?php echo $exam_name; ?>" required autocomplete='off' style='text-transform:uppercase'>
			  <input type='hidden' name='id' value='<?php echo $examMasterId; ?>'>
			  <button type="submit" class="btn btn-warning mb-2">Update</button>
			</form>
			<script>
				$("#exam_master_upd").on("submit", function (event) {
				event.preventDefault();
				$.ajax({
					url: "<?php echo base_url('onlineexam/teacher/exam_master/ExamMaster/examMasterUpdate'); ?>",
					type: "POST",
					data: $("#exam_master_upd").serialize(),
					success: function(data){
						if(data == 1){
							$.toast({
								heading: 'Success',
								text: 'Update Successfully..!',
								showHideTransition: 'slide',
								icon: 'success',
								position: 'top-right',
							});
							setTimeout(function(){ 
								location.reload();
							}, 3000);
						}else{
							$.toast({
								heading: 'Error',
								text: 'Already Exist..!',
								showHideTransition: 'slide',
								icon: 'error',
								position: 'top-right',
							});
						}
					}
				});
			 });
			</script>
		<?php
	}
	
	public function examMasterUpdate(){
		$id = $this->input->post('id');
		
		$exam_name = trim($this->input->post('exam_name'));
		
		$data = $this->alam->selectA('online_exam_master','count(*)cnt',"exam_name='$exam_name'");
		$cnt = $data[0]['cnt']; 
		
		$save = array(
			'exam_name' => strtoupper($this->input->post('exam_name')),
		);
		
		if($cnt == 0){
			$this->alam->update('online_exam_master',$save,"id='$id'");
			echo 1;
		}else{
			echo 0;
		}
	}
}