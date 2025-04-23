<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit_master extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['visit'] = $this->farheen->select('visit','*,(select dept from department where id=dept_id)dept,(select vis_purpose from visitor_purpose where id=vis_purpose_id)vis_purpose,(select vis_type from visitor_type where id=vis_type_id)vis_type',"status='Y'");
		$data['deptt'] = $this->farheen->select('department','*',"status='Y'");
		$data['vis_purpose'] = $this->farheen->select('visitor_purpose','*',"status='Y'");
		$data['vis_type'] = $this->farheen->select('visitor_type','*',"status='Y'");
		$this->render_template('reception/visit_master',$data);
	}
	
	public function save_visit()
	{
		 $array = array(
			
			'dept_id' => $this->input->post('dept_id'),
			'vis_purpose_id' => $this->input->post('vis_pur_id'),
			'vis_type_id' => $this->input->post('vis_type_id'),
			'visit_count' => $this->input->post('visit_count'),
			'f_date' => $this->input->post('f_date')
			);
			$this->farheen->insert('visit',$array);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
		    redirect('reception/Visit_master/index');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$dept   = $this->input->post('dept');
		$vis_purpose   = $this->input->post('vis_purpose');
		$vis_type   = $this->input->post('vis_type');
		$visit_count   = $this->input->post('visit_count');
		$f_date   = $this->input->post('f_date');
		$dept_details = $this->farheen->select('visit','*',"status='Y' and id='$id'");
		$dept_id = $dept_details[0]->dept_id;
		$vis_pur_id = $dept_details[0]->vis_purpose_id;
		$vis_type_id = $dept_details[0]->vis_type_id;
		$deptt = $this->farheen->select('department','*',"status='Y'");
		$vis_pur = $this->farheen->select('visitor_purpose','*',"status='Y'");
		$vis_type = $this->farheen->select('visitor_type','*',"status='Y'");
		
		?>
			<form action="<?php echo base_url('reception/Visit_master/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Department:</label>
				<select class='form-control' id='dept_id' name='dept_id' required>
					<option value=''>select</option>
					<?php
						foreach($deptt as $key => $val){
							?>
								<option value="<?php echo $val->id; ?>" <?php if($dept_id == $val->id){ echo "selected"; } ?>><?php echo $val->dept; ?></option>
							<?php
						}
					?>
				</select>
				
			  </div>
			  <div class="form-group">
				<label>Visitor Purpose:</label>
				<select class='form-control' id='vis_pur_id' name='vis_pur_id' required>
					<option value=''>select</option>
					<?php
						foreach($vis_pur as $key => $val){
							?>
								<option value="<?php echo $val->id; ?>" <?php if($vis_pur_id == $val->id){ echo "selected"; } ?>><?php echo $val->vis_purpose; ?></option>
							<?php
						}
					?>
				</select>
			  </div>
			  <div class="form-group">
				<label>Visitor Type:</label>
				<select class='form-control' id='vis_type_id' name='vis_type_id' required>
					<option value=''>select</option>
					<?php
						foreach($vis_type as $key => $val){
							?>
								<option value="<?php echo $val->id; ?>" <?php if($vis_type_id == $val->id){ echo "selected"; } ?>><?php echo $val->vis_type; ?></option>
							<?php
						}
					?>
				</select>
			  </div>
			  <div class="form-group">
				<label>Visitor Count(/day):</label>
				<input type="text" class="form-control" value='<?php echo $visit_count; ?>' name="visit_count" id="visit_count" style='text-transform: uppercase;' maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
			  </div>
			  <div class="form-group">
				<label>Date:</label>
				<input type="date" class="form-control" value='<?php echo $f_date; ?>' name="f_date" id="f_date" >
			  </div>
			  
			  <input type='hidden' name='visit_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$visit_id   = $this->input->post('visit_id');
		
		$updData = array(
			'dept_id' => $this->input->post('dept_id'),
			'vis_purpose_id' => $this->input->post('vis_pur_id'),
			'vis_type_id' => $this->input->post('vis_type_id'),
			'visit_count' => $this->input->post('visit_count'),
			'f_date' => $this->input->post('f_date'),
		);
		
		$this->farheen->update('visit',$updData,"id='$visit_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('reception/Visit_master');
	}
	public function dupval()
	{
		$vis_type = $this->input->post('vis_type');
		$dept_id = $this->input->post('dept_id');
		$vis_pur_id = $this->input->post('vis_pur_id');
		$f_date = $this->input->post('f_date');
        $data = $this->db->query("select * from visit where vis_type_id='$vis_type' and vis_purpose_id='$vis_pur_id' and dept_id='$dept_id' and f_date='$f_date' and status='Y'")->result();
		
		$visit_data = count($data);
        if($visit_data > 0)
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