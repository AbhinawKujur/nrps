<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitorpurpose_master extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['vispurpose'] = $this->farheen->select('visitor_purpose','*',"status='Y'");
		$this->render_template('reception/visitorpurpose_master',$data);
	}

	public function save_vispurpose()
	{
		 $array = array(
			
			'vis_purpose' => strtoupper($this->input->post('vis_purpose'))
			
			);
			$this->farheen->insert('visitor_purpose',$array);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
		    redirect('reception/Visitorpurpose_master/index');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$vis_purpose   = $this->input->post('vis_purpose');
		?>
			<form action="<?php echo base_url('reception/Visitorpurpose_master/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Visitor Type:</label>
				<input type="text" value='<?php echo $vis_purpose; ?>' class="form-control" name="vis_purpose" id="vis_purpose" style='text-transform: uppercase;' required maxlength="20" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' onkeyup="dupval(this.value)">
				<label id='ss' style='color:red;'></label>
			  </div>
			  <input type='hidden' name='vis_purpose_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$vis_purpose   = strtoupper($this->input->post('vis_purpose'));
		$vis_purpose_id   = $this->input->post('vis_purpose_id');
		
		$updData = array(
			'vis_purpose' => $vis_purpose,
		);
		
		$this->farheen->update('visitor_purpose',$updData,"id='$vis_purpose_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('reception/Visitorpurpose_master');
	}
	public function dupval()
	{
		$vis_purpose = $this->input->post('vis_purpose');
        $data = $this->db->query("select * from visitor_purpose where vis_purpose='$vis_purpose' and status='Y'")->result();
		$vispur_data = count($data);
        if($vispur_data > 0)
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