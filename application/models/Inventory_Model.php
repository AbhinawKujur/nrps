<?php

class Inventory_Model extends CI_model{

	public function getItemList($where=1)
	{
		$query = $this->db->query("SELECT *,(SELECT item_group_name FROM item_group_master WHERE item_group_id=im.Item_group_id)item_group_name,(SELECT CLASS_NM FROM classes WHERE Class_No=im.Class_Name)Class_Name,(SELECT Department_Name FROM department_master WHERE Department_ID=im.department_id)department FROM item_master im WHERE $where");
		return $query->result_array();
	}
  }