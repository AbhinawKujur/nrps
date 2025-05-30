<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$role_id    = login_details['ROLE_ID'];		
		$user_id    = login_details['user_id'];	
		$Class_No   = login_details['Class_No'];		
		$Section_No = login_details['Section_No'];
		$tDate      = date('Y-m-d');
		
		$data['chatData']   = $this->alam->selectA('chat_msg','sender_id,(SELECT FIRST_NM from student WHERE ADM_NO=chat_msg.sender_id)firstnm,count(id)cnt,sender_date',"receiver_id = '$user_id' AND read_status = 'N' AND sender_user = 'P' GROUP BY sender_id,firstnm,sender_date order by sender_date DESC");
		
		$data['replyData'] = $this->alam->selectA('chat_msg as cm','cm.sender_id,cm.sender_date,cm.sms_text,(select FIRST_NM from student where ADM_NO=cm.sender_id)firstnm,(SELECT sender_id FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_id,(select EMP_FNAME from employee where EMPID=Rsender_id)empnm,(SELECT sms_text FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsms_text,(SELECT sender_date FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_date',"cm.read_status = 'Y' order by cm.id desc");
		
		$data['MyMsgReply'] = $this->alam->selectA('chat_msg as cm','cm.sender_id,cm.sender_date,cm.sms_text,(select EMP_FNAME from employee where EMPID=cm.sender_id)firstnm,(SELECT sender_id FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_id,(select FIRST_NM from student where ADM_NO=Rsender_id)empnm,(SELECT sms_text FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsms_text,(SELECT sender_date FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_date',"cm.read_status = 'Y' AND sender_id = '$user_id' order by cm.id desc");
		$this->render_template('sms/inbox',$data);
	}
	
	public function loadModalData(){
		$id          = $this->input->post('id');
		$sender_id   = $this->input->post('sender_id');
		$cls         = $this->input->post('cls');
		$sec         = $this->input->post('sec');
		$receiver_id = $this->input->post('receiver_id');
		$sms_text    = $this->input->post('sms_text');
		
		?>
			<form action='<?php echo base_url('sms/Inbox/saveReply'); ?>' method='POST' id='replyForm'>
			    <input type='hidden' name='id' id='id' value='<?php echo $id; ?>'>
			    <input type='hidden' name='sender_id' id='sender_id' value='<?php echo $sender_id; ?>'>
			    <input type='hidden' name='cls' id='cls' value='<?php echo $cls; ?>'>
			    <input type='hidden' name='sec' id='sec' value='<?php echo $sec; ?>'>
			    <input type='hidden' name='receiver_id' id='receiver_id' value='<?php echo $receiver_id; ?>'>
				
				<textarea class='form-control' disabled><?php echo $sms_text; ?></textarea>
				<textarea required class='form-control' name='sms_text' id='sms_text' rows='5'></textarea>
			</form>
		<?php
	}
	
	public function saveReply(){
		$id          = $this->input->post('id');
		$sender_id   = $this->input->post('sender_id');
		$cls         = $this->input->post('cls');
		$sec         = $this->input->post('sec');
		$receiver_id = $this->input->post('receiver_id');
		$sms_text    = $this->input->post('sms_text');
		
		$saveData = array(
			'sender_id'         => $receiver_id,
			'sender_user'       => 'E',
			'receiver_user'     => 'P',
			'class'             => $cls,
			'sec'               => $sec,
			'sms_text'          => $sms_text,
			'receiver_role_id'  => 0,
			'receiver_id'       => $sender_id,
			'read_status'       => 'N',
			'reply_sms_chat_id' => $id
		);
		
		$this->alam->insert('chat_msg',$saveData);
		
		$updData = array(
			'read_status' => 'Y'
		);
		
		$this->alam->update('chat_msg',$updData,"id='$id'");
		$this->session->set_flashdata('sms',"Sent Successfully");
		redirect('sms/Inbox');
	}
}
