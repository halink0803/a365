<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: ASQ result
 *
 * @package A356
 */

get_header('new');
$month_test = $_SESSION['asq_set'];
$point_array = $_SESSION['asq_scores_table'];
$com = $cut_o_m[''.$month_test.''];
$info = $_SESSION['current_child'];
//print_r($info);
$info_user = a365_get_current_user();
$wob;
if ( $info->week_of_birth >= 40  )
    $wob = 0;
else
    $wob =  40 - $info->week_of_birth;
?>

<div class="guideSurvey pt30 fz15" >
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/result.css" />
    <div class="content">
        <div class="wrapper" id="wrapper">
            <img width="100%" src="<?php echo get_template_directory_uri().'/images/banner_ASQtest1447039562.jpg'?>" title="asq-banner">
            <div class="inforGuideSurvey pd20">
                <h1 class="ResultTitle" style="color:#ca2535">
                    Bài ASQ® <?php echo $month_test ?> tháng tuổi
                </h1>
                <div class="ResultSurvey" >
                    <div class="" style="background-color: #eeecec">
                        <ul class="Ruserinfo">
                            <li>
                                <b class="ReLeft">• Tên của trẻ : </b>
                                <span><?php echo $info->name ?></span>
                            </li>
                            <li>
                                <b class="ReLeft">• Ngày sinh:</b>
                                <span><?php echo formatDate($info->date_of_birth) ?></span>
                            </li>
                            <li>
                                <b class="ReLeft">• Mã trẻ:</b>
                                <span><?php echo $info->id ?></span>
                            </li>
                        </ul>
                        <ul class="Ruserinfo2">
                            <li>
                                <b class="ReRight">• Người làm sàng lọc: </b>
                                <span>
                                    <?php
                                        echo $info_user->name;
                                    ?>
                                </span>
                            </li>
                            <li>
                                <b class="ReRight">• Ngày làm sàng lọc: </b>
                                <span>
                                   <?php echo date( 'd-m-Y') ?>
                                </span>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                    <div class="ReBlock ReBlock1" >
                        <p>
                            <h3 class="TxtBoldUp fz15" style="color:#ca2535">1. GIẢI THÍCH VỀ BẢNG HỎI ASQ® : </h3>
                            <p class="fz15">ASQ® là hệ thống câu hỏi dành cho cha mẹ/người chăm sóc trẻ tự điền nhằm sàng lọc và theo dõi sự phát triển toàn diện và phát hiện sớm các rối loạn phát triển ở trẻ. ASQ® sàng lọc và theo dõi 5 lĩnh vực phát triển: Giao tiếp, vận động thô, vận động tinh, giải quyết vấn đề, và cá nhân - xã hội. Mỗi lĩnh vực ở một độ tuổi nhất định có một ngưỡng giới hạn.</p>
                            <table class="gtkyhieu">
                                <tbody>
                                    <tr>
                                        <th><img src="<?php echo get_template_directory_uri()?>/images/score_kq.png" alt="" width="15" height="15" />
                                        </th>
                                        <td>Điểm của trẻ</td>
                                    </tr>
                                    <tr>
                                        <th><img src="<?php echo get_template_directory_uri()?>/images/Rectangle_blue.png" alt="" width="32" height="17" />
                                        </th>
                                        <td>Vùng điểm thể hiện trẻ đang gặp khó khăn</td>
                                    </tr>
                                    <tr>
                                        <th><img src="<?php echo get_template_directory_uri()?>/images/Rectangle_brown.png" alt="" width="32" height="17" />
                                        </th>
                                        <td>Vùng điểm thể hiện trẻ cần được theo dõi thêm và làm sàng lọc lại do một số kỹ năng chưa thành thục</td>
                                    </tr>
                                    <tr>
                                        <th><img src="<?php echo get_template_directory_uri()?>/images/Rectangle_white.png" alt="" width="32" height="17" />
                                        </th>
                                        <td>Vùng điểm thể hiện trẻ có sự phát triển bình thường</td>
                                    </tr>
                                </tbody>
                            </table>

                        </p>
                        <div class="Mt15"></div>
                        <h3 class="TxtBoldUp fz15" style="color:#ca2535">2. ĐIỂM CỦA TRẺ SAU KHI LÀM SÀNG LỌC NHƯ SAU:</h3>

                        <div style="overflow-x:visible">
                            <div class="qh-result-table-view fz14" style="min-width: 740px">
                                <div class="single-row single-row-head clearfix">
                                    <div class="col col-1st"><div class="text-view"><b>Lĩnh vực</b></div></div>
                                    <div class="col col-2nd"><div class="text-view"><b>Điểm ngưỡng giới hạn</b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b>Điểm của trẻ</b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-mark cleafix">
                                            <div class="single-mark">5</div>
                                            <div class="single-mark">10</div>
                                            <div class="single-mark">15</div>
                                            <div class="single-mark">20</div>
                                            <div class="single-mark">25</div>
                                            <div class="single-mark">30</div>
                                            <div class="single-mark">35</div>
                                            <div class="single-mark">40</div>
                                            <div class="single-mark">45</div>
                                            <div class="single-mark">50</div>
                                            <div class="single-mark">55</div>
                                            <div class="single-mark">60</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-row clearfix">
                                    <div class="col col-1st"><div class="text-view">Giao tiếp</div></div>
                                    <div class="col col-2nd"><div class="text-view"><b><?php echo $com[0][0] ?></b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b><?php echo $point_array[0] ?></b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-graph clearfix">
                                            <div class="point-box point-box-1st" style="width: <?php echo $com[0][0]/61.5*100?>%;"></div>
                                            <div class="point-box point-box-2nd" style="width: <?php echo $com[0][1]/61.5*100-$com[0][0]/61.5*100?>%"></div>
                                        </div>
                                        <div class="point-dot" style="width: <?php echo $point_array[0]/60*100?>%;"><img src="<?php echo get_template_directory_uri()."/images/score_kq.png" ?>"/></div>
                                    </div>
                                </div>
                                <div class="single-row clearfix">
                                    <div class="col col-1st"><div class="text-view">Vận động thô</div></div>
                                    <div class="col col-2nd"><div class="text-view"><b><?php echo $com[1][0] ?></b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b><?php echo $point_array[1] ?></b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-graph clearfix">
                                            <div class="point-box point-box-1st" style="width: <?php echo $com[1][0]/61.5*100?>%"></div>
                                            <div class="point-box point-box-2nd" style="width: <?php echo $com[1][1]/61.5*100-$com[1][0]/61.5*100?>%"></div>
                                        </div>
                                        <div class="point-dot" style="width: <?php echo $point_array[1]/60*100?>%;"><img src="<?php echo get_template_directory_uri()."/images/score_kq.png" ?>"/></div>
                                    </div>
                                </div>
                                <div class="single-row clearfix">
                                    <div class="col col-1st"><div class="text-view">Vận động tinh</div></div>
                                    <div class="col col-2nd"><div class="text-view"><b><?php echo $com[2][0] ?></b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b><?php echo $point_array[2] ?></b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-graph clearfix">
                                            <div class="point-box point-box-1st" style="width: <?php echo $com[2][0]/61.5*100?>%"></div>
                                            <div class="point-box point-box-2nd" style="width: <?php echo $com[2][1]/61.5*100-$com[2][0]/61.5*100?>%"></div>
                                        </div>
                                        <div class="point-dot" style="width: <?php echo $point_array[2]/60*100?>%;"><img src="<?php echo get_template_directory_uri()."/images/score_kq.png" ?>"/></div>
                                    </div>
                                </div>
                                <div class="single-row clearfix">
                                    <div class="col col-1st"><div class="text-view">Giải quyết vấn đề</div></div>
                                    <div class="col col-2nd"><div class="text-view"><b><?php echo $com[3][0] ?></b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b><?php echo $point_array[3] ?></b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-graph clearfix">
                                            <div class="point-box point-box-1st" style="width: <?php echo $com[3][0]/61.5*100?>%"></div>
                                            <div class="point-box point-box-2nd" style="width: <?php echo $com[3][1]/61.5*100-$com[3][0]/61.5*100?>%"></div>
                                        </div>
                                        <div class="point-dot" style="width: <?php echo $point_array[3]/60*100?>%;"><img src="<?php echo get_template_directory_uri()."/images/score_kq.png" ?>"/></div>
                                    </div>
                                </div>
                                <div class="single-row clearfix">
                                    <div class="col col-1st"><div class="text-view">Cá nhân xã hội</div></div>
                                    <div class="col col-2nd"><div class="text-view"><b><?php echo $com[4][0] ?></b></div></div>
                                    <div class="col col-3rd"><div class="text-view"><b><?php echo $point_array[4] ?></b></div></div>
                                    <div class="col col-4th">
                                        <div class="point-graph clearfix">
                                            <div class="point-box point-box-1st" style="width: <?php echo $com[4][0]/61.5*100?>%"></div>
                                            <div class="point-box point-box-2nd" style="width: <?php echo $com[4][1]/61.5*100-$com[4][0]/61.5*100?>%"></div>
                                        </div>
                                        <div class="point-dot" style="width: <?php echo $point_array[4]/60*100?>%;"><img src="<?php echo get_template_directory_uri()."/images/score_kq.png" ?>"/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ReBlock ReBlock4 fz15">
                        <h3 class="TxtBoldUp fz15" style="color:#ca2535">3. Nhận xét chung : </h3>
                        <p>Trẻ: <?=$info->name?></p>
                        <?php generate_general_results( $month_test, $point_array ); ?>
                        <h3 class="TxtBoldUp fz15" style="color:#ca2535">4. Gợi ý cho gia đình</h3>
                        <div style="margin: 0;">
                            <?php generate_suggestion_1($month_test, $point_array) ?>
                        </div>
                        <div align="JUSTIFY">
                            <span lang="vi-VN">
                                <?php generate_suggestion_2($month_test, $point_array);
                                        generate_suggestion_3();
                                ?>

                            </span>
                        </div>
                    </div>
                    <div style="margin-top: 15px">
                        <input type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase share_mail" value="Gửi email">
                        <button type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase print_result"><i class="fa fa-print" style="padding-right:5px"></i> In</button>
                        <?php
                            $pages = get_pages(array(
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'page-templates/child-information.php'
                            ));
                        ?>
                        <a href="<?php echo home_url($pages[0]->post_name); ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Chọn trẻ khác</a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="tab-footer">
                    <p>ASQ-3™ © 2009 and V-ASQ-3 © 2014 Brookes Publishing Co. With permission of the publisher.</p>
                    <p>Bảng hỏi về Độ tuổi và Giai đoạn phát triển của trẻ, Ấn bản lần thứ ba (ASQ-3™), được sử dụng với sự cho phép của NXB Brookes.</p>
                </div>
            </div>
            <div class="cl"></div>
            <div class="txt_thankyou fz15" style="color:#ca2535">
                Cảm ơn gia đình đã tin tưởng sử dụng A365
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('siteContent');
        var popupWin = window.open('','_blank');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

    function send() {

        var oEl = document.getElementById('siteContent');
        // Getting the outerHTML of an element:
        var sOuterHTML = oEl.outerHTML;
        var data = encodeURIComponent(sOuterHTML);
        //console.log(data);

        $.post("../send-email",
                {
                    'testname' : 'asq',
                    'source' : data,
                    'field': $('#send_mail_form').serialize()
                },
                function() {
                    //alert("Email đã được gửi thành công!");
                }).success(
                    function(response) {
                        //console.log("status:"+response);
                        if (response.includes('success')){
                            alert( "Email đã được gửi thành công!" );
                            $("#Modal_Send_Mail").modal('hide');
                        }
                        else{
                            alert( "Đã có lỗi xảy ra vui lòng thử lại!" );
                            $("#Modal_Send_Mail").modal('hide');
                        }
                    });
    }

    var $=jQuery.noConflict();
    $(document).ready(function(){

        var user_check = <?php
                            if(checkUserType()==true)
                                echo "true";
                            else
                                echo "false";
                        ?>;
        //console.log(user_check);

        if (user_check == true) {
            $("#Modal_Respondent").modal({
                backdrop: 'static',
                keyboard: true
            });

            $('.cancel').click(function(event) {
                window.location.href = '<?php echo home_url('/'); ?>';
            });

            $('.view_result').click(function(event) {
                //console.log("chạy vào đây rồi");
                var age = $("#age").val();
                var role_user = $("#relationship").val();
                var gender = $("input[name='gender']:checked").val();
                var other_role = $("#other_relationship").val();
                //console.log("age:"+age);
                //console.log("role_user:"+role_user);
                //console.log("gender:"+gender);
                //console.log("other_role:"+other_role);
                //check empty fields
                if (age == '' || role_user == '' || gender == '' || (role_user == 'Khác' && other_role == '')) {
                    //console.log("đã check rồi");
                    $("#notice3").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
                } else {
                    //console.log("đã gửi request rồi");
                    $user_info = $("#respondent").serialize();
                    //console.log( $user_info );
                    //event.preventDefault();
                    $.ajax({
                      type: 'post',
                      dataType: 'json',
                      url: a365_ajax.ajax_url,
                      data: $user_info + "&action=" + 'update_respondent_info',
                      success: function(response) {
                        $("#Modal_Respondent").modal('hide');
                      }

                    });
                }
            });
        }

    })

</script>
<?php get_footer('new'); ?>
