<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fee_Paid_list extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Farheen', 'farheen');
	}

	public function fee_paid_classwise()
	{
		 $viewupto = $this->input->post('viewupto');//APR
		 $classs = $this->input->post('classs');//10 VII
		 $sec = $this->input->post('sec');//1 A
        
		$student = $this->db->query("SELECT daycoll.ADM_NO,daycoll.STU_NAME,daycoll.ROLL_NO ,daycoll.APR_FEE,student.C_MOBILE FROM `DAYCOLL` 
        INNER JOIN student on student.ADM_NO = daycoll.ADM_NO
        WHERE daycoll.CLASS='$classs' AND daycoll.SEC='$sec' AND daycoll.PERIOD ='$viewupto'")->result();
        // echo $this->db->last_query();die;
		// echo "<pre>";print_r($student);die;
		$student_cnt = count($student);

        ?>
		<table class='table table-bordered' id='example'>
			<thead>
				<tr>
				<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">NAME</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">ROLL NO</th>
					<th style="background: #337ab7; color: white !important;">MONTH</th>
					<th style="background: #337ab7; color: white !important;">CONTACT</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$c=1;
				for ($i = 0; $i < $student_cnt; $i++) {
				        ?>
						<tr>
							<td><?php echo $c; ?></td>
							<td><?php echo $student[$i]->STU_NAME; ?></td>
							<td><?php echo $student[$i]->ADM_NO; ?></td>
							<td><?php echo $student[$i]->ROLL_NO; ?></td>
							<td><?php echo $viewupto; ?></td>
							<td><?php echo $student[$i]->C_MOBILE ; ?></td>
						</tr>
				        <?php
						$c++;
                    }
				?>
			</tbody>
		</table></br>
		<input type="hidden" name="view_upto" id="view_upto" value="<?php echo $viewupto; ?>">
		<input type="hidden" name="clssss" id="clssss" value="<?php echo $classs; ?>">
		<input type="hidden" name="sec" id="sec" value="<?php echo $sec; ?>">

		<script>
			$(document).ready(function() {
				var viewupto = $("#view_upto").val();
				var cls = $("#clssss").val();
				var sec = $("#sec").val();
				// alert(cls);
				$('#example').DataTable({
					'paging': false,
					'lengthChange': true,
					'searching': true,
					'ordering': false,
					'info': true,
					'autoWidth': true,
					'pageLength': 25,
					dom: 'Bfrtip',
					buttons: {
						dom: {
							button: {
								tag: 'button',
								className: ''
							}
						},
						buttons: [{
								extend: 'excel',
								text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
								title: 'Class wise Defaulter Reports',
								className: 'btn btn-success',
								extension: '.xlsx'
							},
							{
								extend: 'pdf',
								title: 'Class wise Defaulter Reports',
								text: '<i class="fa fa-file-pdf-o"></i> PDF',
								className: 'btn btn-primary',
								action: function(e, dt, button, config) {
									var query = dt.search();
									window.open("<?php echo base_url('Defaulter_list/defaulter_classwise_PDF/' . $viewupto . '/' . $classs . '/' . $sec); ?>");
									// $.post("<?php //echo base_url('Defaulter_list/defaulter_classwise_PDF'); 
												?>", {
									// 	view_upto: viewupto,
									// 	classs: cls,
									// 	sec: sec
									// });
								}
							}
						]
					},
					footer: true,
				});
			});
		</script>
	<?php
	}
    
    public function fee_paid_allclasswise()
    {
        $viewupto = $this->input->post('viewupto');//APR
        $classs = $this->input->post('classs');//10 VII
        $sec = $this->input->post('sec');//1 A
       
       $student = $this->db->query("SELECT daycoll.ADM_NO,daycoll.STU_NAME,daycoll.ROLL_NO ,daycoll.APR_FEE,student.C_MOBILE FROM `DAYCOLL` 
       INNER JOIN student on student.ADM_NO = daycoll.ADM_NO
       WHERE  daycoll.PERIOD ='$viewupto'")->result();
       // echo $this->db->last_query();die;
       // echo "<pre>";print_r($student);die;
       $student_cnt = count($student);

       ?>
       <table class='table table-bordered' id='example'>
           <thead>
               <tr>
               <th style="background: #337ab7; color: white !important;">SNO</th>
                   <th style="background: #337ab7; color: white !important;">NAME</th>
                   <th style="background: #337ab7; color: white !important;">ADM_NO</th>
                   <th style="background: #337ab7; color: white !important;">ROLL NO</th>
                   <th style="background: #337ab7; color: white !important;">MONTH</th>
                   <th style="background: #337ab7; color: white !important;">CONTACT</th>
               </tr>
           </thead>
           <tbody>

               <?php
               $c=1;
               for ($i = 0; $i < $student_cnt; $i++) {
                       ?>
                       <tr>
                           <td><?php echo $c; ?></td>
                           <td><?php echo $student[$i]->STU_NAME; ?></td>
                           <td><?php echo $student[$i]->ADM_NO; ?></td>
                           <td><?php echo $student[$i]->ROLL_NO; ?></td>
                           <td><?php echo $viewupto; ?></td>
                           <td><?php echo $student[$i]->C_MOBILE ; ?></td>
                       </tr>
                       <?php
                       $c++;
                   }
               ?>
           </tbody>
       </table></br>
       <input type="hidden" name="view_upto" id="view_upto" value="<?php echo $viewupto; ?>">
       <input type="hidden" name="clssss" id="clssss" value="<?php echo $classs; ?>">
       <input type="hidden" name="sec" id="sec" value="<?php echo $sec; ?>">

       <script>
           $(document).ready(function() {
               var viewupto = $("#view_upto").val();
               var cls = $("#clssss").val();
               var sec = $("#sec").val();
               // alert(cls);
               $('#example').DataTable({
                   'paging': false,
                   'lengthChange': true,
                   'searching': true,
                   'ordering': false,
                   'info': true,
                   'autoWidth': true,
                   'pageLength': 25,
                   dom: 'Bfrtip',
                   buttons: {
                       dom: {
                           button: {
                               tag: 'button',
                               className: ''
                           }
                       },
                       buttons: [{
                               extend: 'excel',
                               text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
                               title: 'Class wise Defaulter Reports',
                               className: 'btn btn-success',
                               extension: '.xlsx'
                           },
                           {
                               extend: 'pdf',
                               title: 'Class wise Defaulter Reports',
                               text: '<i class="fa fa-file-pdf-o"></i> PDF',
                               className: 'btn btn-primary',
                               action: function(e, dt, button, config) {
                                   var query = dt.search();
                                   window.open("<?php echo base_url('Defaulter_list/defaulter_classwise_PDF/' . $viewupto . '/' . $classs . '/' . $sec); ?>");
                                   // $.post("<?php //echo base_url('Defaulter_list/defaulter_classwise_PDF'); 
                                               ?>", {
                                   // 	view_upto: viewupto,
                                   // 	classs: cls,
                                   // 	sec: sec
                                   // });
                               }
                           }
                       ]
                   },
                   footer: true,
               });
           });
       </script>
   <?php
   }

}
