<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-baitapcanthiep-report
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );

require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_users");
$records = $obj->getRecordsForBaitapcanthiepReport();

?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../admin">A365 Admin</a>
            </div>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../admin-quan-ly-tai-khoan"><i class="fa fa-fw fa-table"></i> Quản lý tài khoản</a>
                    </li>
                    <li>
                        <a href="../admin-quan-ly-tre"><i class="fa fa-fw fa-table"></i> Quản lý trẻ</a>
                    </li>
                   <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Báo cáo <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                           <li>
                                <a href="../admin-bao-cao-nguoi-dung">Báo cáo danh sách người dùng</a>
                            </li>
                            <li>
                                <a href="../admin-bao-cao-tre">Báo cáo danh sách trẻ</a>
                            </li>
                            <li>
                                <a href="../admin-bao-cao-sang-loc">Báo cáo bài sàng lọc</a>
                            </li>
                            <li>
                                <a href="../admin-bai-tap-can-thiep">Báo cáo xem bài can thiệp</a>
                            </li>
                            <li>
                                <a href="../admin-theo-doi-can-thiep">Báo cáo theo dõi hiệu quả can thiệp</a>
                            </li>
                            <li>
                                <a href="../admin-bao-cao-danh-gia-tong-the">Báo cáo bài đánh giá tổng thể</a>
                            </li>
                            <li>
                                <a href="../admin-bao-cao-qol">Báo cáo bài khảo sát chất lượng cuộc sống cha mẹ</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
          
    <div><b>Lịch sử xem bài tập can thiệp</b></div> 
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Thời gian xem bài từ ngày:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Thời gian xem bài đến ngày:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
    <table id="a365_baitapcanthiep_report" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Tên bài</th>
                <th>Ngày xem</th>
                <th>Id người dùng</th>
                <th>Loại tài khoản</th>
                <th>Mã số tỉnh</th>
                <th>Email</th>
                <th>Họ và tên người dùng</th>
                <th>Giới tính người dùng</th>
                <th>Năm sinh người dùng</th>
                <th>Mối quan hệ với trẻ</th>
                <th>Trình độ học vấn</th>
                <th>Nghề nghiệp</th>
                <th>Điện thoại</th>
                <th>Địa chỉ chi tiết</th>
                <th>Nơi công tác</th>
                <th>Id trẻ</th>
                <th>Tên trẻ</th>
                <th>Giới tính trẻ</th>
                <th>Ngày sinh trẻ</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên bài</th>
                <th>Ngày xem</th>
                <th>Id người dùng</th>
                <th>Loại tài khoản</th>
                <th>Mã số tỉnh</th>
                <th>Email</th>
                <th>Họ và tên người dùng</th>
                <th>Giới tính người dùng</th>
                <th>Năm sinh người dùng</th>
                <th>Mối quan hệ với trẻ</th>
                <th>Trình độ học vấn</th>
                <th>Nghề nghiệp</th>
                <th>Điện thoại</th>
                <th>Địa chỉ chi tiết</th>
                <th>Nơi công tác</th>
                <th>Id trẻ</th>
                <th>Tên trẻ</th>
                <th>Giới tính trẻ</th>
                <th>Ngày sinh trẻ</th>
            </tr>
        </tfoot>       
    </table>
            </div>
        </div>

        <!-- /#page-wrapper -->

    </div>
    <script>
     // Set button class names 
     var savebutton = "ajaxSave";
     var deletebutton = "ajaxDelete";
     var editbutton = "ajaxEdit";
     var updatebutton = "ajaxUpdate";
     var cancelbutton = "cancel";
     var viewbutton = "ajaxView";
     var saveImage = "<?php echo get_template_directory_uri()."/images/save.png" ?>";
     var editImage = "<?php echo get_template_directory_uri()."/images/edit.png" ?>";
     var deleteImage = "<?php echo get_template_directory_uri()."/images/remove.png" ?>";
     var cancelImage = "<?php echo get_template_directory_uri()."/images/back.png" ?>";
     var updateImage = "<?php echo get_template_directory_uri()."/images/save.png" ?>";

     var saveAnimationDelay = 3000; 
     var deleteAnimationDelay = 1000;
      
     // 2 effects available available 1) slide 2) flash
     var effect = "flash"; 
  
  </script>
    <script>
    var intervention_table;
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#a365_baitapcanthiep_report tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        intervention_table = $('#a365_baitapcanthiep_report').DataTable({
            "ajax": "../baitapcanthiep-report.txt",
            "columns": [
                { 'data' : 'exercise_name' },
                { 'data' : 'view_at' },
                { 'data' : 'user_id' },
                { 'data' : 'user_type' },
                { 'data' : 'user_area_code' },
                { 'data' : 'user_email' },
                { 'data' : 'user_name' },
                { 'data' : 'user_sex' },
                { 'data' : 'user_birth' },
                { 'data' : 'user_child_relationship' },
                { 'data' : 'user_education_level' },
                { 'data' : 'user_occupation' },
                { 'data' : 'user_phone' },
                { 'data' : 'user_address' },
                { 'data' : 'user_work_place' },
                { 'data' : 'id' },
                { 'data' : 'name' },
                { 'data' : 'sex' },
                { 'data' : 'date_of_birth' }
            ],
            "bDeferRender": true,
            "scrollX": true,
            "scrollY": 300,
            dom: 'BCfrtlip',
            select: true,
            buttons: [
            
            {
                extend: 'collection',
                text: 'Xuất dữ liệu',
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_xem_bai_tap_can_thiep_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_xem_bai_tap_can_thiep_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_xem_bai_tap_can_thiep_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_xem_bai_tap_can_thiep_' + gettime(),
                    },
                ]
            }
            
        ]
    });
        
        // Apply the search
        intervention_table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

    
    } );

    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if ( settings.nTable.id === 'a365_baitapcanthiep_report' ) {
                var min = new Date($('#min').val()).getTime();
                var max = new Date($('#max').val()).getTime();
                var age = new Date( data[1].split(" ")[0] ).getTime(); // use data for the age column
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
            
        }
    );
     
    $(document).ready(function() {
        //var table = $('#a365_users').DataTable();
         
        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup( function() {
            intervention_table.draw();
        } );
    } );



    </script>
</body>
</html>