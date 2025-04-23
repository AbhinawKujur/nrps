<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RackMaster extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['rackMasterData'] = $this->alam->selectA('rack_master','*');
        $this->render_template('library/rack_master',$data);
	}
	
	public function saveRack(){
		$rack_nm     = strtoupper($this->input->post('rack_nm'));
		$rack_desc   = strtoupper($this->input->post('rack_desc'));
		$rack_from   = $this->input->post('rack_from');
		$rack_to     = $this->input->post('rack_to');
		$exist_data	 = $this->alam->selectA('rack_master','count(*)cnt',"rack_from='$rack_from' and rack_to='$rack_to'");
		$count=$exist_data[0]['cnt'];
		if($count==0){
			$saveData = array(
				'RackName'        => $rack_nm,
				'rack_from'       => $rack_from,
				'rack_to'         => $rack_to,
				'RackDiscription' => $rack_desc,
			);
			
			$this->alam->insert('rack_master',$saveData);
			$this->session->set_flashdata('success',"Data Inserted Successfully");
			redirect('library/RackMaster');
		}else{
			$this->session->set_flashdata('success',"Dublicate Data");
			redirect('library/RackMaster');
		}
	}
	
	public function edit(){
		$rack_id   = $this->input->post('rack_id');
		$rack_nm   = $this->input->post('rack_nm');
		$rack_from = $this->input->post('rack_from');
		$rack_to   = $this->input->post('rack_to');
		$rack_desc = $this->input->post('rack_desc');
		?>
			<form action="<?php echo base_url('library/RackMaster/rackUpdate'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Almirah Name:</label>
				<input type="text" class="form-control" value='<?php echo $rack_nm; ?>' name="rack_nm" style='text-transform: uppercase;' required>
			  </div>
			  
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack From:</label>
					<input type="number" value='<?php echo $rack_from; ?>' class="form-control" name="rack_from" style='text-transform: uppercase;' required>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack To:</label>
					<input type="number" value='<?php echo $rack_to; ?>' class="form-control" name="rack_to" style='text-transform: uppercase;' required>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label>Almirah Description:</label>
				<textarea class="form-control" name="rack_desc" style='text-transform: uppercase;'><?php echo $rack_desc; ?></textarea>
			  </div>
			  <input type='hidden' name='rack_id' value='<?php echo $rack_id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function rackUpdate(){
		$rack_nm   = strtoupper($this->input->post('rack_nm'));
		$rack_from = $this->input->post('rack_from');
		$rack_to   = $this->input->post('rack_to');
		$rack_desc = strtoupper($this->input->post('rack_desc'));
		$rack_id   = $this->input->post('rack_id');
		
		$updData = array(
			'RackName'        => $rack_nm,
			'rack_from'       => $rack_from,
			'rack_to'         => $rack_to,
			'RackDiscription' => $rack_desc,
		);
		
		$this->alam->update('rack_master',$updData,"RackNo='$rack_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('library/RackMaster');
	}

	public function newAlmirahMaster(){
		$data['rackMasterData'] = $this->alam->selectA('rack_master','*');
		$this->render_template('library/almirah_report',$data);
	}

	public function getRackData()
	{
		$data['rackMasterData'] = $this->alam->selectA('rack_master','*');

		$data['select_val'] = $rac_no = $this->input->post('rack_nm');
		// echo "Rack_no " . $rac_no . "<br>";
		$data['BookMasterData'] = $this->alam->selectA('bookmaster', '*', "racname='$rac_no'");
		$this->render_template('library/almirah_report', $data);
	}
}