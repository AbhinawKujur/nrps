<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookTypeMaster extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['bookTypeData'] = $this->alam->selectA('book_type_master','*');
        $this->render_template('library/book_typeMaster',$data);
	}
	
	public function saveBook(){
		$book_type     = strtoupper($this->input->post('book_type'));
		
		$saveData = array(
			'book_type'        => $book_type,
		);
		
		$this->alam->insert('book_type_master',$saveData);
		$this->session->set_flashdata('success',"Data Inserted Successfully");
		redirect('library/BookTypeMaster');
	}
	
	public function edit(){
		$id   = $this->input->post('id');
		$book_type   = $this->input->post('book_type');
		?>
			<form action="<?php echo base_url('library/BookTypeMaster/update'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Type of Book:</label>
				<input type="text" value='<?php echo $book_type; ?>' class="form-control" name="book_type" style='text-transform: uppercase;' required>
			  </div>
			  <input type='hidden' name='book_type_id' value='<?php echo $id; ?>'>
			  <button type="submit" class="btn btn-warning">Update</button>
			</form>
		<?php
	}
	
	public function update(){
		$book_type   = strtoupper($this->input->post('book_type'));
		$book_type_id   = $this->input->post('book_type_id');
		
		$updData = array(
			'book_type' => $book_type,
		);
		
		$this->alam->update('book_type_master',$updData,"id='$book_type_id'");
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('library/BookTypeMaster');
	}
}