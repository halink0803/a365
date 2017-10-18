<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-qol-report
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );

require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_users");
$records = $obj->getRecordsForAdminQolReport();

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
          
    <div><b>Báo cáo bài khảo sát chất lượng cuộc sống cha mẹ QOL</b></div> 
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
    <table id="a365_qol_report" class="display" cellspacing="0" width="100%">
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
                <th>Ngày làm bài</th>
                <th>Ngày hoàn thành</th>
                <th>Tổng điểm</th>               
                <th>Điểm trung bình</th>
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
                <th>Câu 21</th>
                <th>Câu 22</th>
                <th>Câu 23</th>
                <th>Câu 24</th>
                <th>Câu 25</th>
                <th>Câu 26</th>
                <th>Câu 27</th>
                <th>Câu 28</th>
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
                <th>Ngày làm bài</th>
                <th>Ngày hoàn thành</th>
                <th>Tổng điểm</th>               
                <th>Điểm trung bình</th>
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
                <th>Câu 21</th>
                <th>Câu 22</th>
                <th>Câu 23</th>
                <th>Câu 24</th>
                <th>Câu 25</th>
                <th>Câu 26</th>
                <th>Câu 27</th>
                <th>Câu 28</th>
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
    var qol_table;
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#a365_qol_report tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        qol_table = $('#a365_qol_report').DataTable({
            "ajax": "../qol-report.txt",
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
                { "data" : "begin_at" },
                { "data" : "end_at" },
                { "data" : "sum_point"},
                { "data" : "avg_point"},
                { "data" : "answer_1"},
                { "data" : "answer_2"},
                { "data" : "answer_3"},
                { "data" : "answer_4"},
                { "data" : "answer_5"},
                { "data" : "answer_6"},
                { "data" : "answer_7"},
                { "data" : "answer_8"},
                { "data" : "answer_9"},
                { "data" : "answer_10"},
                { "data" : "answer_11"},
                { "data" : "answer_12"},
                { "data" : "answer_13"},
                { "data" : "answer_14"},
                { "data" : "answer_15"},
                { "data" : "answer_16"},
                { "data" : "answer_17"},
                { "data" : "answer_18"},
                { "data" : "answer_19"},
                { "data" : "answer_20"},
                { "data" : "answer_21"},
                { "data" : "answer_22"},
                { "data" : "answer_23"},
                { "data" : "answer_24"},
                { "data" : "answer_25"},
                { "data" : "answer_26"},
                { "data" : "answer_27"},
                { "data" : "answer_28"},              
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
                        filename: 'bao_cao_QOL_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_QOL_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_QOL_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_QOL_' + gettime(),
                    },
                ]
            }
            
        ]
    });
        
        // Apply the search
        qol_table.columns().every( function () {
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
            if ( settings.nTable.id === 'a365_qol_report' ) {
                var min = new Date($('#min').val()).getTime();
                var max = new Date($('#max').val()).getTime();
                var age = new Date( data[18].split(" ")[0] ).getTime(); // use data for the age column
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
            qol_table.draw();
        } );
    } );



    </script>
</body>
</html>