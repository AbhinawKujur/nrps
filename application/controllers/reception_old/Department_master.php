<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_master extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['dept_details'] = $this->farheen->select('department','*',"status='Y'");
		$this->render_template('reception/department_master',$data);
	}

	public function save_dept()
	{
		 $array = array(
			
			'dept' => strtoupper($this->input->post('dept'))
			
			);
			$this->farheen->insert('department',$array);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
		    redirect('reception/Department_master/index');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$dept   = $this->input->post('dept');
		?>
			<form action="<?php echo base_url('reception/Department_master/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Department Name:</label>
				<input type="text" value='<?php echo $dept; ?>' class="form-control" name="dept" id="dept" style='text-transform: uppercase;' required maxlength="20" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' onkeyup="dupval(this.value)">
				<label id='ss' style='color:red;'></label>
			  </div>
			  <input type='hidden' name='dept_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$dept   = strtoupper($this->input->post('dept'));
		$dept_id   = $this->input->post('dept_id');
		
		$updData = array(
			'dept' => $dept,
		);
		
		$this->farheen->update('department',$updData,"id='$dept_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('reception/Department_master');
	}
	public function dupval()
	{
		$dept = $this->input->post('dept');
        $data = $this->db->query("select * from department where dept='$dept' and status='Y'")->result();
		$dept_data = count($data);
        if($dept_data > 0)
		{
			$msg="S";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}
		else{
			$msg="E";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}		
	}
}	