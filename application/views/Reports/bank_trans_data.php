<ol class="breadcrumb">
    <li class="breadcrumb-item">Online Transaction Report<i class="fa fa-angle-right"></i></li>
</ol>
<style>
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        color: black;
    }

    .table thead tr th {
        background: #337ab7;
        color: #fff !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }

    .loader {
        margin: auto;
        width: 30%;
        padding: 50px;
    }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <table class="table table-stripped table-bordered" style='color: black' id="myTable">
        <thead>
            <tr>
                <th style="background: #337ab7; color: white !important;">Sl. No.</th>
                <th style="background: #337ab7; color: white !important;">Adm. No.</th>
                <th style="background: #337ab7; color: white !important;">Cheque No.</th>
                <th style="background: #337ab7; color: white !important;">Rect. No.</th>
                <th style="background: #337ab7; color: white !important;">Rect. Date</th>
                <th style="background: #337ab7; color: white !important;">Order Date Time</th>
                <th style="background: #337ab7; color: white !important;">Total Amount</th>
                <th style="background: #337ab7; color: white !important;">Order id</th>
            </tr>
        </thead>
        <tbody>
            <?php   $i=1; foreach ($data as $row) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->ADM_NO; ?></td>
                    <td><?php echo $row->CHQ_NO; ?></td>
                    <td><?php echo $row->RECT_NO; ?></td>
                    <td><?php echo $row->RECT_DATE; ?></td>
                    <td><?php echo $row->trans_date; ?></td>
                    <td><?php echo $row->TOTAL; ?></td>
                    <td><?php echo $row->order_id; ?></td>
                </tr>
            <?php $i++;  } ?>
        </tbody>
    </table>
</div>


</div><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "pageLength": 25,
            "lengthchange":false,
			 dom: 'Bfrtip',
        buttons: [{
							extend: 'excel',
							text: 'EXCEL',
							title: 'Settlement Report',
							className: 'btn btn-success',
							extension: '.xlsx'
						},
						{
							extend: 'pdf',
							title: 'Settlement Report',
							text: 'PDF',
							className: 'btn btn-primary'
						}
					]
        });
    });
</script>