<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-users-report
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );

require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_users");
$records = $obj->getRecords();
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
            <div class="loading" style="text-align: center; display: none;">
                <img src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAADxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBDYW4ndCBjb25uZWN0IHRvIGxvY2FsIE15U1FMIHNlcnZlciB0aHJvdWdoIHNvY2tldCAnL3Zhci9ydW4vbXlzcWxkL215c3FsZC5zb2NrJyAoMikgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQSBsaW5rIHRvIHRoZSBzZXJ2ZXIgY291bGQgbm90IGJlIGVzdGFibGlzaGVkIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IENhbid0IGNvbm5lY3QgdG8gbG9jYWwgTXlTUUwgc2VydmVyIHRocm91Z2ggc29ja2V0ICcvdmFyL3J1bi9teXNxbGQvbXlzcWxkLnNvY2snICgyKSBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBBIGxpbmsgdG8gdGhlIHNlcnZlciBjb3VsZCBub3QgYmUgZXN0YWJsaXNoZWQgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQ2FuJ3QgY29ubmVjdCB0byBsb2NhbCBNeVNRTCBzZXJ2ZXIgdGhyb3VnaCBzb2NrZXQgJy92YXIvcnVuL215c3FsZC9teXNxbGQuc29jaycgKDIpIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IEEgbGluayB0byB0aGUgc2VydmVyIGNvdWxkIG5vdCBiZSBlc3RhYmxpc2hlZCBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+Cg==" alt="Loading...">
            </div>
    <div><b>Danh sách người dùng</b></div>
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Thời gian tạo tài khoản từ ngày:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Thời gian tạo tài khoản đến ngày:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
    <table id="a365_users_report" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Mã số tỉnh</th>
                <th>Email</th>
                <th>Tên</th>
                <th>Loại tài khoản</th>
                <th>Giới tính</th>
                <th>Năm sinh</th>
                <th>Mối quan hệ với trẻ</th>
                <th>Trình độ học vấn</th>
                <th>Nơi công tác</th>
                <th>Nghề nghiệp</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thời gian sử dụng</th>
                <th>Số lần đăng nhập</th>
                <th>Biết đến từ</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Mã số tỉnh</th>
                <th>Email</th>
                <th>Tên</th>
                <th>Loại tài khoản</th>
                <th>Giới tính</th>
                <th>Năm sinh</th>
                <th>Mối quan hệ với trẻ</th>
                <th>Trình độ học vấn</th>
                <th>Nơi công tác</th>
                <th>Nghề nghiệp</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thời gian sử dụng</th>
                <th>Số lần đăng nhập</th>
                <th>Biết đến từ</th>
                <th>Ngày tạo</th>
            </tr>
        </tfoot>

        <?php
        if(count($records)){
            $i = 1;
            foreach($records as $key=>$eachRecord){
        ?>
            <tr id="<?=$eachRecord['id'];?>">
                <td><?=$eachRecord['id'];?></td>
                <td><?=$eachRecord['area_code'];?></td>
                <td><?=$eachRecord['email'];?></td>
                <td><?=$eachRecord['name'];?></td>
                <td><?=$eachRecord['type'];?></td>
                <td><?=$eachRecord['sex'];?></td>
                <td><?=$eachRecord['year_of_birth'];?></td>
                <td><?=$eachRecord['child_relationship'];?></td>
                <td><?=$eachRecord['educational_level'];?></td>
                <td><?=$eachRecord['work_place'];?></td>
                <td><?=$eachRecord['occupation'];?></td>
                <td><?=$eachRecord['phone'];?></td>
                <td><?=$eachRecord['address'];?></td>
                <td><?=$eachRecord['using_time'];?></td>
                <td><?=$eachRecord['number_of_login'];?></td>
                <td><?=$eachRecord['known_from'];?></td>
                <td><?=formatDate($eachRecord['created_at'])?></td>
            </tr>
        <?php }
        }
        ?>
        </tbody>
    </table>
    <div><b>Danh sách trẻ quản lý</b></div>
    <div id="txtHint"></div>
            </div>
        </div>

        <!-- /#page-wrapper -->

    </div>
    <script>
     // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
    var user_columns = new Array("email","name","type","sex","address","phone", "created_at","using_time");
    var user_placeholder = new Array("email","name","type","sex","address","phone", "created_at","using_time");
    var children_columns = new Array("name","date_of_birth","sex","created_at");
    var children_placeholder = new Array("name","date_of_birth","sex","created_at");
    var inputType = new Array("text","text","text","text","text","text","textarea");
    var table = "tableDemo";

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
        var pri_table;
        $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#a365_users_report tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        // DataTable
        pri_table = $('#a365_users_report').DataTable({
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
                        filename: 'bao_cao_nguoi_dung_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_nguoi_dung_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_nguoi_dung_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_nguoi_dung_' + gettime(),
                    },
                ]
            }

        ]
    });
        // Apply the search
        pri_table.columns().every( function () {
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
            if ( settings.nTable.id === 'a365_users_report' ) {
                var min = new Date(formatDate($('#min').val())).getTime();
                var max = new Date(formatDate($('#max').val())).getTime();
                var age = new Date( formatDate(data[15].split(" ")[0] )).getTime(); // use data for the age column
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

            if ( settings.nTable.id == 'a365_children_report' ) {
                return true;
            }

        }
    );

    $(document).ready(function() {
        //var table = $('#a365_users').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup( function() {
            pri_table.draw();
        } );
    } );

    </script>
</body>
</html>