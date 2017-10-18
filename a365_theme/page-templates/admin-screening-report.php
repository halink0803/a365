<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-screening-report
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );

require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_asq_results");
$records = $obj->getRecordsForAdminAsqReport();

$obj2 = new ajax_table("a365_mchatr_results");
$records2 = $obj2->getRecordsForAdminMchatrReport();

$obj3 = new ajax_table("a365_mchatrf_results");
$records3 = $obj3->getRecordsForAdminMchatrfReport();

// $obj4 = new ajax_table("a365_atec_results");
// $records4 = $obj4->getRecordsForAdminAtecReport();
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
            
    <ul class="tabs">
        <li><a href="#view1">ASQ</a></li>
        <li><a href="#view2">MCHAT R</a></li>
        <li><a href="#view3">MCHAT R/F</a></li>
    </ul>
    <div class="tabcontents">
        <div id="view1">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Thời gian làm test từ ngày:</td>
                        <td><input type="text" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Thời gian làm test đến ngày:</td>
                        <td><input type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="a365_asq_results" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Bài sàng lọc</th>
                        <th>Nơi làm bài sàng lọc</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Người trả lời phiếu</th>
                        <th>Giới tính người trả lời</th>
                        <th>Khu vực</th>
                        <th>Địa chỉ người trả lời</th>
                        <th>Năm sinh người trả lời</th>
                        <th>Điểm phần giao tiếp</th>
                        <th>Tổng điểm phần giao tiếp</th>
                        <th>Kết luận phần giao tiếp</th>
                        <th>Điểm phần vận động thô</th>
                        <th>Tổng điểm phần vận động thô</th>
                        <th>Kết luận phần vận động thô</th>
                        <th>Điểm phần vận động tinh</th>
                        <th>Tổng điểm phần vận động tinh</th>
                        <th>Kết luận phần vận động tinh</th>
                        <th>Điểm phần giải quyết vấn đề</th>
                        <th>Tổng điểm lĩnh giải quyết vấn đề</th>
                        <th>Kết luận phần giải quyết vấn đề</th>
                        <th>Điểm phần cá nhân xã hội</th>
                        <th>Tổng điểm phần cá nhân xã hội</th>
                        <th>Kết luận phần cá nhân xã hội</th>
                        <th>Kết quả phần tổng kết</th>
                        <th>Chuyển gửi đánh giá chuyên sâu</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Bài sàng lọc</th>
                        <th>Nơi làm bài sàng lọc</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Người trả lời phiếu</th>
                        <th>Giới tính người trả lời</th>
                        <th>Khu vực</th>
                        <th>Địa chỉ người trả lời</th>
                        <th>Năm sinh người trả lời</th>
                        <th>Điểm phần giao tiếp</th>
                        <th>Tổng điểm phần giao tiếp</th>
                        <th>Kết luận phần giao tiếp</th>
                        <th>Điểm phần vận động thô</th>
                        <th>Tổng điểm phần vận động thô</th>
                        <th>Kết luận phần vận động thô</th>
                        <th>Điểm phần vận động tinh</th>
                        <th>Tổng điểm phần vận động tinh</th>
                        <th>Kết luận phần vận động tinh</th>
                        <th>Điểm phần giải quyết vấn đề</th>
                        <th>Tổng điểm lĩnh giải quyết vấn đề</th>
                        <th>Kết luận phần giải quyết vấn đề</th>
                        <th>Điểm phần cá nhân xã hội</th>
                        <th>Tổng điểm phần cá nhân xã hội</th>
                        <th>Kết luận phần cá nhân xã hội</th>
                        <th>Kết quả phần tổng kết</th>
                        <th>Chuyển gửi đánh giá chuyên sâu</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="view2">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Thời gian làm test từ ngày:</td>
                        <td><input type="text" id="min2" name="min"></td>
                    </tr>
                    <tr>
                        <td>Thời gian làm test đến ngày:</td>
                        <td><input type="text" id="max2" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="a365_mchatr_results" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Nơi làm bài sàng lọc</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Người trả lời phiếu</th>
                        <th>Giới tính người trả lời</th>
                        <th>Khu vực</th>
                        <th>Địa chỉ người trả lời</th>
                        <th>Năm sinh người trả lời</th>
                        <th>Tổng điểm</th>
                        <th>Tổng kết</th>
                        <th>Câu 1</th>
                        <th>Câu 2</th>
                        <th>Câu 3</th>
                        <th>Câu 4</th>
                        <th>Câu 5</th>
                        <th>Câu 6</th>
                        <th>Câu 7</th>
                        <th>Câu 8</th>
                        <th>Câu 9</th>
                        <th>Câu 10</th>
                        <th>Câu 11</th>
                        <th>Câu 12</th>
                        <th>Câu 13</th>
                        <th>Câu 14</th>
                        <th>Câu 15</th>
                        <th>Câu 16</th>
                        <th>Câu 17</th>
                        <th>Câu 18</th>
                        <th>Câu 19</th>
                        <th>Câu 20</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Nơi làm bài sàng lọc</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Người trả lời phiếu</th>
                        <th>Giới tính người trả lời</th>
                        <th>Khu vực</th>
                        <th>Địa chỉ người trả lời</th>
                        <th>Năm sinh người trả lời</th>
                        <th>Tổng điểm</th>
                        <th>Tổng kết</th>
                        <th>Câu 1</th>
                        <th>Câu 2</th>
                        <th>Câu 3</th>
                        <th>Câu 4</th>
                        <th>Câu 5</th>
                        <th>Câu 6</th>
                        <th>Câu 7</th>
                        <th>Câu 8</th>
                        <th>Câu 9</th>
                        <th>Câu 10</th>
                        <th>Câu 11</th>
                        <th>Câu 12</th>
                        <th>Câu 13</th>
                        <th>Câu 14</th>
                        <th>Câu 15</th>
                        <th>Câu 16</th>
                        <th>Câu 17</th>
                        <th>Câu 18</th>
                        <th>Câu 19</th>
                        <th>Câu 20</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="view3">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Thời gian làm test từ ngày:</td>
                        <td><input type="text" id="min3" name="min"></td>
                    </tr>
                    <tr>
                        <td>Thời gian làm test đến ngày:</td>
                        <td><input type="text" id="max3" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="a365_mchatrf_results" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Tổng điểm</th>
                        <th>Tổng kết</th>
                        <th>Câu 1</th>
                        <th>Câu 2</th>
                        <th>Câu 3</th>
                        <th>Câu 4</th>
                        <th>Câu 5</th>
                        <th>Câu 6</th>
                        <th>Câu 7</th>
                        <th>Câu 8</th>
                        <th>Câu 9</th>
                        <th>Câu 10</th>
                        <th>Câu 11</th>
                        <th>Câu 12</th>
                        <th>Câu 13</th>
                        <th>Câu 14</th>
                        <th>Câu 15</th>
                        <th>Câu 16</th>
                        <th>Câu 17</th>
                        <th>Câu 18</th>
                        <th>Câu 19</th>
                        <th>Câu 20</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
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
                        <th>Tuần sinh</th>
                        <th>Tuổi thật của trẻ</th>
                        <th>Ngày làm bài</th>
                        <th>Ngày hoàn thành</th>
                        <th>Tổng điểm</th>
                        <th>Tổng kết</th>
                        <th>Câu 1</th>
                        <th>Câu 2</th>
                        <th>Câu 3</th>
                        <th>Câu 4</th>
                        <th>Câu 5</th>
                        <th>Câu 6</th>
                        <th>Câu 7</th>
                        <th>Câu 8</th>
                        <th>Câu 9</th>
                        <th>Câu 10</th>
                        <th>Câu 11</th>
                        <th>Câu 12</th>
                        <th>Câu 13</th>
                        <th>Câu 14</th>
                        <th>Câu 15</th>
                        <th>Câu 16</th>
                        <th>Câu 17</th>
                        <th>Câu 18</th>
                        <th>Câu 19</th>
                        <th>Câu 20</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>  
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

     // Set highlight animation delay (higher the value longer will be the animation)
     var saveAnimationDelay = 3000; 
     var deleteAnimationDelay = 1000;
      
     // 2 effects available available 1) slide 2) flash
     var effect = "flash"; 
  
  </script>
<script>
    var asq_table;
    var mchatr_table;
    var mchatrf_table;
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#a365_asq_results tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        asq_table = $('#a365_asq_results').DataTable({
        "ajax": "../asq-report.txt",
        "columns": [
            { "data" : "creator_id" },
            { "data" : "user_type" },
            { "data" : "user_area_code" },
            { "data" : "user_email" },
            { "data" : "user_name" },
            { "data" : "user_sex" },
            { "data" : "user_birth" },
            { "data" : "user_child_relationship" },
            { "data" : "user_education_level" },
            { "data" : "user_occupation" },
            { "data" : "user_phone" },
            { "data" : "user_address" },
            { "data" : "user_work_place" },
            { "data" : "chil_id" },
            { "data" : "chil_name" },
            { "data" : "chil_sex" },
            { "data" : "chil_date_of_birth" },
            { "data" : "chil_week_of_birth" },
            { "data" : "adjusted_birth" },
            { "data" : "asq_set" },
            { "data" : "did_at" },
            { "data" : "begin_at" },
            { "data" : "end_at" },
            { "data" : "who_did" },
            { "data" : "gender" },
            { "data" : "area" },
            { "data" : "address" },
            { "data" : "year" },
            { "data" : "cate_1_answers" },
            { "data" : "cate_1_point" },
            { "data" : "cate_1_conclusion" },
            { "data" : "cate_2_answers" },
            { "data" : "cate_2_point" },
            { "data" : "cate_2_conclusion" },
            { "data" : "cate_3_answers" },
            { "data" : "cate_3_point" },
            { "data" : "cate_3_conclusion" },
            { "data" : "cate_4_answers" },
            { "data" : "cate_4_point" },
            { "data" : "cate_4_conclusion" },
            { "data" : "cate_5_answers" },
            { "data" : "cate_5_point" },
            { "data" : "cate_5_conclusion" },
            { "data" : "cate_6_answers" },
            { "data" : "send_to_expert" }
        ],
        "bDeferRender": true,
        "scrollX": true,
        "scrollY": 200,
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
                        filename: 'bao_cao_ASQ_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ASQ_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ASQ_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ASQ_' + gettime(),
                    },
                ]
                //'copy', 'csv', 'excel', 'pdf']
            }
            
        ]
    });

        // Apply the search
        asq_table.columns().every( function () {
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

        //mchatr
        $('#a365_mchatr_results tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        mchatr_table = $('#a365_mchatr_results').DataTable({
            "ajax": "../mchatr-report.txt",
            "columns": [
            { "data" : "creator_id" },
            { "data" : "user_type" },
            { "data" : "user_area_code" },
            { "data" : "user_email" },
            { "data" : "user_name" },
            { "data" : "user_sex" },
            { "data" : "user_birth" },
            { "data" : "user_child_relationship" },
            { "data" : "user_education_level" },
            { "data" : "user_occupation" },
            { "data" : "user_phone" },
            { "data" : "user_address" },
            { "data" : "user_work_place" },
            { "data" : "chil_id" },
            { "data" : "chil_name" },
            { "data" : "chil_sex" },
            { "data" : "chil_date_of_birth" },
            { "data" : "chil_week_of_birth" },
            { "data" : "adjusted_birth" },
            { "data" : "dit_at" },
            { "data" : "begin_at" },
            { "data" : "end_at" },
            { "data" : "who_did" },
            { "data" : "gender" },
            { "data" : "area" },
            { "data" : "address" },
            { "data" : "year" },
            { "data" : "point" },
            { "data" : "conclusion" },
            { "data" : "answer_1" },
            { "data" : "answer_2" },
            { "data" : "answer_3" },
            { "data" : "answer_4" },
            { "data" : "answer_5" },
            { "data" : "answer_6" },
            { "data" : "answer_7" },
            { "data" : "answer_8" },
            { "data" : "answer_9" },
            { "data" : "answer_10" },
            { "data" : "answer_11" },
            { "data" : "answer_12" },
            { "data" : "answer_13" },
            { "data" : "answer_14" },
            { "data" : "answer_15" },
            { "data" : "answer_16" },
            { "data" : "answer_17" },
            { "data" : "answer_18" },
            { "data" : "answer_19" },
            { "data" : "answer_20" }
        ],
        "bDeferRender": true,
        "scrollX": true,
        "scrollY": 200,
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
                        filename: 'bao_cao_MCHATR_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATR_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATR_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATR_' + gettime(),
                    },
                ]
                //'copy', 'csv', 'excel', 'pdf']
            }
            
        ]
    });
        // Apply the search
        mchatr_table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
 

    //mchatrf
    $('#a365_mchatrf_results tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        mchatrf_table = $('#a365_mchatrf_results').DataTable({
        "ajax": "../mchatrf-report.txt",
        "columns": [
            { "data" : "creator_id" },
            { "data" : "user_type" },
            { "data" : "user_area_code" },
            { "data" : "user_email" },
            { "data" : "user_name" },
            { "data" : "user_sex" },
            { "data" : "user_birth" },
            { "data" : "user_child_relationship" },
            { "data" : "user_education_level" },
            { "data" : "user_occupation" },
            { "data" : "user_phone" },
            { "data" : "user_address" },
            { "data" : "user_work_place" },
            { "data" : "chil_id" },
            { "data" : "chil_name" },
            { "data" : "chil_sex" },
            { "data" : "chil_date_of_birth" },
            { "data" : "chil_week_of_birth" },
            { "data" : "adjusted_birth" },
            { "data" : "begin_at" },
            { "data" : "end_at" },
            { "data" : "point" },
            { "data" : "conclusion" },
            { "data" : "answer_1" },
            { "data" : "answer_2" },
            { "data" : "answer_3" },
            { "data" : "answer_4" },
            { "data" : "answer_5" },
            { "data" : "answer_6" },
            { "data" : "answer_7" },
            { "data" : "answer_8" },
            { "data" : "answer_9" },
            { "data" : "answer_10" },
            { "data" : "answer_11" },
            { "data" : "answer_12" },
            { "data" : "answer_13" },
            { "data" : "answer_14" },
            { "data" : "answer_15" },
            { "data" : "answer_16" },
            { "data" : "answer_17" },
            { "data" : "answer_18" },
            { "data" : "answer_19" },
            { "data" : "answer_20" }
        ],
        "bDeferRender": true,
        "scrollX": true,
        "scrollY": 200,
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
                        filename: 'bao_cao_MCHATRF_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATRF_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATRF_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_MCHATRF_' + gettime(),
                    },
                ]
                //'copy', 'csv', 'excel', 'pdf']
            }
            
        ]
    });


        // Apply the search
        mchatrf_table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
   

    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if ( settings.nTable.id == 'a365_asq_results' ) {
                var min = new Date(formatDate($('#min').val())).getTime();
                var max = new Date(formatDate($('#max').val())).getTime();
                var age = new Date( data[21].split(" ")[0] ).getTime(); // use data for the age column
                // //console.log("min: "+min);
                // //console.log("max: "+max);
                // //console.log("age: "+age);
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }

            if ( settings.nTable.id === 'a365_mchatr_results' ) {
                var min = new Date(formatDate($('#min2').val())).getTime();
                var max = new Date(formatDate($('#max2').val())).getTime();
                var age = new Date( data[21].split(" ")[0] ).getTime(); // use data for the age column
                // //console.log("min: "+min);
                // //console.log("max: "+max);
                // //console.log("age: "+age);
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }

            if ( settings.nTable.id === 'a365_mchatrf_results' ) {
                var min = new Date(formatDate($('#min3').val())).getTime();
                var max = new Date(formatDate($('#max3').val())).getTime();
                var age = new Date( data[20].split(" ")[0] ).getTime(); // use data for the age column
                // //console.log("min: "+min);
                // //console.log("max: "+max);
                // //console.log("age: "+age);
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
            asq_table.draw();
        } );
        $('#min2, #max2').keyup( function() {
            mchatr_table.draw();
        } );
        $('#min3, #max3').keyup( function() {
            mchatrf_table.draw();
        } );
    } );

    </script>
</body>
</html>
