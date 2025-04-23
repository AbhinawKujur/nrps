<form method="post" id="form" >
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th style="background-color:#5785c3">Sl No.</th>
                    <th style="background-color:#5785c3">Student Name</th>
                    <th style="background-color:#5785c3">Admission No.</th>
                    <th style="background-color:#5785c3">Roll No.</th>
                    <th style="background-color:#5785c3">Upload/Change Img</th>
                    <th style="background-color:#5785c3">Image</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data as $value) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->FIRST_NM; ?></td>
                        <td><?php echo $value->ADM_NO; ?><input type="hidden" name="adm_no" id="adm_no" value="<?php echo $value->ADM_NO; ?>"></td>
                        <td><?php echo $value->ROLL_NO; ?></td>
                        <td>
                            <input type="file" name="stu_img" class="stu-img-input" data-student-id="<?php echo $value->ADM_NO; ?>">
                        </td>
                        <td>
                            <img class="preview-img" src="<?php echo base_url($value->student_image); ?>" style="height:50px; width:50px;">
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

   
</form>
<script>
    $(document).ready(function() {
        $('.stu-img-input').change(function() {
            var fileInput = $(this);
            var studentId = fileInput.data('student-id');
            var formData = new FormData();
            formData.append('stu_img', fileInput.prop('files')[0]);
            formData.append('student_id', studentId);

            $.ajax({
                url: 'Student_img/upload', // Replace with your actual upload endpoint
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        // Update the preview image source
                        fileInput.closest('tr').find('.preview-img').attr('src', URL.createObjectURL(fileInput.prop('files')[0]));
                    } else {
                        alert('Failed to upload image: ' + jsonResponse.message);
                    }
                },
                error: function() {
                    alert('Error uploading image');
                }
            });
        });
    });
</script>