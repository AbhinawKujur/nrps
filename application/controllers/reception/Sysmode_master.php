<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sysmode_master extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['modetype'] = $this->farheen->select('mode_type','*',"status='Y'");
		$this->render_template('reception/sysmode_master',$data);
	}
	
	public function save_modetype()
	{
		 $array = array(
			
			'mode_type' => strtoupper($this->input->post('mode_type'))
			
			);
			$this->farheen->insert('mode_type',$array);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
		    redirect('reception/Sysmode_master/index');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$mode_type   = $this->input->post('mode_type');
		?>
			<form action="<?php echo base_url('reception/Sysmode_master/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Entry Mode:</label>
				<input type="text" value='<?php echo $mode_type; ?>' class="form-control" name="mode_type" id="mode_type" style='text-transform: uppercase;' required onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' maxlength="20" onkeyup="dupval(this.value)">
				<label id='ss' style='color:red;'></label>
			  </div>
			  <input type='hidden' name='mode_type_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$mode_type   = strtoupper($this->input->post('mode_type'));
		$mode_type_id   = $this->input->post('mode_type_id');
		
		$updData = array(
			'mode_type' => $mode_type,
		);
		
		$this->farheen->update('mode_type',$updData,"id='$mode_type_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('reception/Sysmode_master');
	}
	public function dupval()
	{
		$mode_type = $this->input->post('mode_type');
        $data = $this->db->query("select * from mode_type where mode_type='$mode_type' and status='Y'")->result();
		$modetype_data = count($data);
        if($modetype_data > 0)
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