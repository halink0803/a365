<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: admin-atec-report
 * @package A356
 */
get_header('admin');
error_reporting(E_COMPILE_ERROR );

require_once( "db-interaction.php" );
//a365_users
$obj = new ajax_table("a365_users");
$records = $obj->getRecordsForAdminAtecReport();

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
          
    <div><b>Báo cáo bài đánh giá tổng thể ATEC</b></div> 
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
    <table id="a365_atec_report" class="display" cellspacing="0" width="100%">
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
                <th>Tổng điểm 1</th>               
                <th>Tổng điểm 2</th>
                <th>Tổng điểm 3</th>
                <th>Tổng điểm 4</th>
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
                <th>Câu 29</th>
                <th>Câu 30</th>
                <th>Câu 31</th>
                <th>Câu 32</th>
                <th>Câu 33</th>
                <th>Câu 34</th>
                <th>Câu 35</th>
                <th>Câu 36</th>
                <th>Câu 37</th>
                <th>Câu 38</th>
                <th>Câu 39</th>
                <th>Câu 40</th>
                <th>Câu 41</th>
                <th>Câu 42</th>
                <th>Câu 43</th>
                <th>Câu 44</th>
                <th>Câu 45</th>
                <th>Câu 46</th>
                <th>Câu 47</th>
                <th>Câu 48</th>
                <th>Câu 49</th>
                <th>Câu 50</th>
                <th>Câu 51</th>
                <th>Câu 52</th>
                <th>Câu 53</th>
                <th>Câu 54</th>
                <th>Câu 55</th>
                <th>Câu 56</th>
                <th>Câu 57</th>
                <th>Câu 58</th>
                <th>Câu 59</th>
                <th>Câu 60</th>
                <th>Câu 61</th>
                <th>Câu 62</th>
                <th>Câu 63</th>
                <th>Câu 64</th>
                <th>Câu 65</th>
                <th>Câu 66</th>
                <th>Câu 67</th>
                <th>Câu 68</th>
                <th>Câu 69</th>
                <th>Câu 70</th>
                <th>Câu 71</th>
                <th>Câu 72</th>
                <th>Câu 73</th>
                <th>Câu 74</th>
                <th>Câu 75</th>
                <th>Câu 76</th>
                <th>Câu 77</th>
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
                <th>Tổng điểm 1</th>               
                <th>Tổng điểm 2</th>
                <th>Tổng điểm 3</th>
                <th>Tổng điểm 4</th>
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
                <th>Câu 29</th>
                <th>Câu 30</th>
                <th>Câu 31</th>
                <th>Câu 32</th>
                <th>Câu 33</th>
                <th>Câu 34</th>
                <th>Câu 35</th>
                <th>Câu 36</th>
                <th>Câu 37</th>
                <th>Câu 38</th>
                <th>Câu 39</th>
                <th>Câu 40</th>
                <th>Câu 41</th>
                <th>Câu 42</th>
                <th>Câu 43</th>
                <th>Câu 44</th>
                <th>Câu 45</th>
                <th>Câu 46</th>
                <th>Câu 47</th>
                <th>Câu 48</th>
                <th>Câu 49</th>
                <th>Câu 50</th>
                <th>Câu 51</th>
                <th>Câu 52</th>
                <th>Câu 53</th>
                <th>Câu 54</th>
                <th>Câu 55</th>
                <th>Câu 56</th>
                <th>Câu 57</th>
                <th>Câu 58</th>
                <th>Câu 59</th>
                <th>Câu 60</th>
                <th>Câu 61</th>
                <th>Câu 62</th>
                <th>Câu 63</th>
                <th>Câu 64</th>
                <th>Câu 65</th>
                <th>Câu 66</th>
                <th>Câu 67</th>
                <th>Câu 68</th>
                <th>Câu 69</th>
                <th>Câu 70</th>
                <th>Câu 71</th>
                <th>Câu 72</th>
                <th>Câu 73</th>
                <th>Câu 74</th>
                <th>Câu 75</th>
                <th>Câu 76</th>
                <th>Câu 77</th>
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
    var atec_table;
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#a365_atec_report tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        atec_table = $('#a365_atec_report').DataTable({
            "ajax": "../atec-report.txt",
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
                { "data" : "cate_1_point"},
                { "data" : "cate_2_point"},
                { "data" : "cate_3_point"},
                { "data" : "cate_4_point"},
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
                { "data" : "answer_29"},
                { "data" : "answer_30"},
                { "data" : "answer_31"},
                { "data" : "answer_32"},
                { "data" : "answer_33"},
                { "data" : "answer_34"},
                { "data" : "answer_35"},
                { "data" : "answer_36"},
                { "data" : "answer_37"},
                { "data" : "answer_38"},
                { "data" : "answer_39"},
                { "data" : "answer_40"},
                { "data" : "answer_41"},
                { "data" : "answer_42"},
                { "data" : "answer_43"},
                { "data" : "answer_44"},
                { "data" : "answer_45"},
                { "data" : "answer_46"},
                { "data" : "answer_47"},
                { "data" : "answer_48"},
                { "data" : "answer_49"},
                { "data" : "answer_50"},
                { "data" : "answer_51"},
                { "data" : "answer_52"},
                { "data" : "answer_53"},
                { "data" : "answer_54"},
                { "data" : "answer_55"},
                { "data" : "answer_56"},
                { "data" : "answer_57"},
                { "data" : "answer_58"},
                { "data" : "answer_59"},
                { "data" : "answer_60"},
                { "data" : "answer_61"},
                { "data" : "answer_62"},
                { "data" : "answer_63"},
                { "data" : "answer_64"},
                { "data" : "answer_65"},
                { "data" : "answer_66"},
                { "data" : "answer_67"},
                { "data" : "answer_68"},
                { "data" : "answer_69"},
                { "data" : "answer_70"},
                { "data" : "answer_71"},
                { "data" : "answer_72"},
                { "data" : "answer_73"},
                { "data" : "answer_74"},
                { "data" : "answer_75"},
                { "data" : "answer_76"},
                { "data" : "answer_77"}                   
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
                        filename: 'bao_cao_ATEC_' + gettime(),
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ATEC_' + gettime(),
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ATEC_' + gettime(),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            //rows: ':visible'
                        },
                        filename: 'bao_cao_ATEC_' + gettime(),
                    },
                ]
            }
            
        ]
    });
        
        // Apply the search
        atec_table.columns().every( function () {
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
            if ( settings.nTable.id === 'a365_atec_report' ) {
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
            atec_table.draw();
        } );
    } );



    </script>
</body>
</html>