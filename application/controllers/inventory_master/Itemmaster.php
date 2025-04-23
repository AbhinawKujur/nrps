<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemmaster extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['itemList'] = $this->inventory_model->getItemList();
		if(isset($_POST['search']))
		{
			$department_search = $this->input->post('department_search');
			$item_group_search = $this->input->post('item_group_search');
			if($department_search != '' && $item_group_search == '')
			{
				$data['itemList'] = $this->inventory_model->getItemList("department_id='$department_search'");
			}elseif($department_search == '' && $item_group_search != '')
			{
				$data['itemList'] = $this->inventory_model->getItemList("Item_group_id='$item_group_search'");
			}
			elseif($department_search != '' && $item_group_search != '')
			{
				$data['itemList'] = $this->inventory_model->getItemList("Item_group_id='$item_group_search' AND department_id='$department_search'");
			}
		}
		$data['itemGroupList'] =$this->sumit->fetchAllData('*','item_group_master',array());
		$data['classList'] =$this->sumit->fetchAllData('*','classes',array());
		$data['departmentList'] =$this->sumit->fetchAllData('*','department_master',array());
		$this->render_template('inventory_master/createItemMaster',$data);
	}

	public function create()
	{
		$item_group = trim($this->input->post('item_group'));
		$itemname = strtoupper($this->input->post('itemname'));
		$department = trim($this->input->post('department'));
		$class_id = trim($this->input->post('class_id'));
		$unit_of_measure = strtoupper($this->input->post('unit_of_measure'));
		$opening_stock = trim($this->input->post('opening_stock'));
		$price = trim($this->input->post('price'));

		$class_id = ($class_id == '')?0:$class_id;

		$data = array(
			'Item_group_id'	=> $item_group,
			'item_name'		=> $itemname,
			'department_id'	=> $department,
			'Class_Name'	=> $class_id,
			'measure'		=> $unit_of_measure,
			'Opening_Stock'	=> $opening_stock,
			'item_price'	=> $price,
		);

		$insert = $this->sumit->createData('item_master',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('inventory_master/itemmaster');
	}

	public function update()
	{
		$id = trim($this->input->post('id'));
		$item_group = trim($this->input->post('item_group'));
		$itemname = strtoupper($this->input->post('itemname'));
		$department = trim($this->input->post('department'));
		$class_id = trim($this->input->post('class_id'));
		$unit_of_measure = strtoupper($this->input->post('unit_of_measure'));
		$opening_stock = trim($this->input->post('opening_stock'));
		$price = trim($this->input->post('price'));

		$class_id = ($class_id == '')?0:$class_id;

		$data = array(
			'Item_group_id'	=> $item_group,
			'item_name'		=> $itemname,
			'department_id'	=> $department,
			'Class_Name'	=> $class_id,
			'measure'		=> $unit_of_measure,
			'Opening_Stock'	=> $opening_stock,
			'item_price'	=> $price,
		);

		$insert = $this->sumit->update('item_master',$data,array('Stock_ID'=>$id));
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('inventory_master/itemmaster');
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','item_master',array('Stock_ID'=>$id));
		echo json_encode($data);
	}
}
