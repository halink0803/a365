<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-children-manager
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );
require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_children");
$records = $obj->getRecordsForChidrenManager();
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
            
    <div><b>Danh sách trẻ</b></div> 
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Thời gian tạo trẻ từ ngày:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Thời gian tạo trẻ đến ngày:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
   <table id="a365_children" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id trẻ</th>
                <th>Tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Ngày tạo</th>
                <th>Chẩn đoán</th>
                <th>Id người dùng</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id trẻ</th>
                <th>Tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Ngày tạo</th>
                <th>Chẩn đoán</th>
                <th>Id người dùng</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </tfoot>
        <tbody>
        <?php 
            if(count($records)){
            $i = 1;    
            foreach($records as $key=>$eachRecord){

        ?>
            <tr id="<?=$eachRecord['id'];?>">
                <td><?=$eachRecord['id'];?></td>
                <td class="name"><?=$eachRecord['name'];?></td>
                <td class="sex"><?=$eachRecord['sex'];?></td>
                <td class="date_of_birth"><?=formatDate($eachRecord['date_of_birth']);?></td>
                <td class="created_at"><?=formatDate($eachRecord['created_at']);?></td>
                <td class="child_status"><?=$eachRecord['child_status'];?></td>
                <td><?=$eachRecord['user_id'];?></td>
                <td class="email"><?=$eachRecord['email'];?></td>
                <td>
                    <a href="javascript:;" id="<?=$eachRecord['id'];?>" class="ajaxEdit"><img src="" class="eimage"></a>
                    <a href="javascript:;" id="<?=$eachRecord['id'];?>" class="ajaxDelete"><img src="" class="dimage"></a>
                    <a href="javascript:;" id="<?=$eachRecord['id'];?>" class="ajaxView"><img src="<?php echo get_template_directory_uri()."/images/view.png" ?>"></a>
                </td>
            </tr>
        <?php }
        }
        ?>
        </tbody>
    </table>
            </div>
        </div>

        <!-- /#page-wrapper -->

    </div>
    <script>
     // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
     var children_columns = new Array("name","sex");
     var children_placeholder = new Array("name","sex");
     var inputType = new Array("text","text");
     
     // Set button class names 
     var savebutton = "ajaxSave";
     var deletebutton = "ajaxDelete";
     var editbutton = "ajaxEdit";
     var updatebutton = "ajaxUpdate";
     var cancelbutton = "cancel";
     
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
    var child_table;
    $(document).ready(function() {

        $(document).on("click","."+viewbutton,function(){
            var child_id = $(this).parents('tr').attr('id');
            window.open("../admin-child-information?id="+child_id, '_blank');
        });
        // Setup - add a text input to each footer cell
        $('#a365_children tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        child_table = $('#a365_children').DataTable({
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
                        }
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        }
                    }
                ]
                //'copy', 'csv', 'excel', 'pdf']
            }
            
        ]
    });
        // Apply the search
        child_table.columns().every( function () {
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
            if ( settings.nTable.id === 'a365_children' ) {
                var min = new Date(formatDate($('#min').val())).getTime();
                var max = new Date(formatDate($('#max').val())).getTime();
                var age = new Date( formatDate(data[4].split(" ")[0] )).getTime(); // use data for the age column
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
            child_table.draw();
        } );
    } );

    </script>
</body>
</html>
