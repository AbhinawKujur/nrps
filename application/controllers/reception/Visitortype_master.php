<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitortype_master extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['vistype'] = $this->farheen->select('visitor_type','*',"status='Y'");
		$this->render_template('reception/visitortype_master',$data);
	}
	
	public function add_vistype()
	{
		$this->render_template('reception/add_vistype');
	}
	public function save_vistype()
	{
		 $array = array(
			
			'vis_type' => strtoupper($this->input->post('vis_type'))
			
			);
			$this->farheen->insert('visitor_type',$array);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
		    redirect('reception/Visitortype_master/index');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$vis_type   = $this->input->post('vis_type');
		?>
			<form action="<?php echo base_url('reception/Visitortype_master/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Visitor Type:</label>
				<input type="text" value='<?php echo $vis_type; ?>' class="form-control" name="vis_type" id="vis_type" style='text-transform: uppercase;' required onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' maxlength="20" onkeyup="dupval(this.value)">
				<label id='ss' style='color:red;'></label>
			  </div>
			  <input type='hidden' name='vis_type_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$vis_type   = strtoupper($this->input->post('vis_type'));
		$vis_type_id   = $this->input->post('vis_type_id');
		
		$updData = array(
			'vis_type' => $vis_type,
		);
		
		$this->farheen->update('visitor_type',$updData,"id='$vis_type_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('reception/Visitortype_master');
	}
	
	public function dupval()
	{
		$vis_type = $this->input->post('vis_type');
        $data = $this->db->query("select * from visitor_type where vis_type='$vis_type' and status='Y'")->result();
		$vistype_data = count($data);
        if($vistype_data > 0)
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