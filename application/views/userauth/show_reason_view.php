<div class="container-fluid">
     <input type="hidden" name="stu_no" id="stu_no" value="<?php echo $adm_no;?>">
      
        <label>Why do you want to delete this student?</label>
		  <textarea placeholder='Enter your reason...' class='form-control' name='reason' id='reason' style='width:100%;height:130px' ></textarea>
  
      
       <button type="button" class="btn btn-danger" onclick="deletestudent()"><i class="fa fa-trash" ></i> Delete</button> 
       <button type="button" class="btn btn-info" onclick="goback()" ><i class="fa fa-close" ></i> Cancel</button>
      
    </div>

    <script type="text/javascript">

    	// function deletestudent(){ 
		// 	var id = $('#stu_no').val();
		// 	alert(id);
		// 	var reason= $('#reason').val();
		
		// 	if(reason!=''){
		// 	var r = confirm("Are You Sure Want To Delete This Student");
		// 				  if (r == true) { 
						
		// 					  $.post("<?php echo base_url('Student_details/delete_student_details'); ?>",
		// 					  {'id':id},
							  
		// 					  function(data){
		// 					  window.location="<?php echo base_url('Student_details/Student_master'); ?>";
		// 					  });
		// 				  } else {
							  
		// 				  }
		// 	}else{
		// 	alert('Please enter your reason!');
		// 	}
		// }

		function deletestudent(){
			var id = $('#stu_no').val();
			var r = confirm("Are You Sure Want To Delete This Student");
						  if (r == true) {
							window.location="<?php echo base_url('Student_details/delete_student_details'); ?>"+"/"+id;
						  } else {
							  
						  }
		}
		function goback(){
 			window.location="<?php echo base_url('Student_details/Student_master'); ?>";

		}


    </script>