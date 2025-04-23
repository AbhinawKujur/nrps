<div class="row"> 
  <div class="col-sm-7">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Admission No</th>
            <th>Student's Name</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($studentList as $key => $value) { ?> 
            <tr>
              <td><?php echo $value['admno']; ?></td>
              <td><?php echo $value['FIRST_NM'].' '.$value['MIDDLE_NM']; ?></td>
              <td>
                <?php if($value['homework_status'] =='Y'){ ?>
                  <label class="label label-success">Complete</label>
                <?php }else{ ?>
                  <label class="label label-danger">Incomplete</label>
                <?php } ?>
              </td>
              <td>
                <?php echo $value['teacher_remarks']; ?>
              </td>
              <td>
                <?php 
                if($value['homework_status'] ==' Y'){ 
                echo date('d-M-Y',strtotime($value['updated_at'])); } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div> 
  <div class="col-sm-5" style="background: #f4f4f4;">
    <table class="table">
      <tr>
        <th><i class="fa fa-calendar"></i> Homework Date</th>
        <td><?php echo date('d-M-Y',strtotime($homeworkDetails[0]['homework_date'])); ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-calendar"></i> Submission Date</th>
        <td><?php echo date('d-M-Y',strtotime($homeworkDetails[0]['submission_date'])); ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-user"></i> Created By</th>
        <td><?php echo $homeworkDetails[0]['EMP_FNAME'].' '.$homeworkDetails[0]['EMP_MNAME'].' '.$homeworkDetails[0]['EMP_LNAME']; ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-graduation-cap"></i> Class - Section</th>
        <td><?php echo $homeworkDetails[0]['class_name'].' - '.$homeworkDetails[0]['section_name']; ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-book"></i> Subject</th>
        <td><?php echo $homeworkDetails[0]['subject_name']; ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-sitemap"></i> Category</th>
        <td><?php echo $homeworkDetails[0]['category']; ?></td>
      </tr>
      <tr>
        <th><i class="fa fa-edit"></i> Remarks</th>
        <td><?php echo $homeworkDetails[0]['remarks']; ?></td>
      </tr>
    </table>
  </div>
</div>