<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Template Name: Homepage
 *
 **/

get_header();
    unset($_SESSION['asq_set']);
    unset($_SESSION['current_child']);
    unset($_SESSION['current_user']);
    unset($_SESSION['newest_asq_id']);
?>
    <script type="text/javascript">
    $(window).load(function() {

        $("#flexiselDemo3").flexisel({
            visibleItems: 4,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint:480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint:640,
                    visibleItems: 2
                },
                tablet: {
                    changePoint:768,
                    visibleItems: 3
                }
            }
        });
    });
    </script>
<div class="home">
    <div class="mimo_modal" id="popup1">
        <div class="page_login">
            <div class="login">
                <h2>
                    Đăng nhập
                </h2>
                <?php ?>
            </div>
        </div>
    </div>
    <div style="clear: both">
    </div>
    <div class="txt_signin">
        <div class="mimo_modal" id="default_modal" style="display:none">
            <h3 class="title_popup">
                Đăng ký tài khoản
            </h3>
            <div class="popup_dangky">
                <a class="dkchame" href="/dang-ky-tai-khoan-cha-me.html">
                    Cha mẹ/người chăm sóc
                    <em>
                        (Đăng ký vào đây nếu bạn là cha mẹ, ông bà, hoặc người chăm sóc cho trẻ)
                    </em>
                </a>
                <a class="dkcanbo" href="/dang-ky-tai-khoan-can-bo.html">
                    Cán bộ chuyên môn
                    <em>
                        (Đăng ký vào đây nếu bạn là cán bộ y tế hay giáo viên)
                    </em>
                </a>
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
    <div class="mimo_modal" id="popup4">
        <img alt""="" data-mimo-src="castle.jpg" title="">
            <div class="popup4" style="padding: 0 30px 20px 30px;">
                <div align="left" class="tit_popup">
                </div>
                <span class="txt_mid">
                    <p>
                        Bạn chưa làm bài khảo sát trước can thiệp
                    </p>
                </span>
                <a class="test_ct" href="/StartTestings/manager_wait_test_survey/560b820cbd5347b23034ef3e/TEST_INVENTION">
                    LÀM BÀI TẬP TRƯỚC CAN THIỆP
                </a>
            </div>
        </img>
    </div>
    <div class="mimo_modal" id="popup40">
        <img alt""="" data-mimo-src="castle.jpg" title="">
            <div class="popup40" style="padding: 0 30px 20px 30px;">
                <div align="left" class="tit_popup">
                    THÔNG BÁO
                </div>
                <span class="txt_mid">
                </span>
            </div>
        </img>
    </div>
    <!-- Content -->
    <div class="content">
        <div class="wrapper">
            <div class="video_home">
                <div class="form_video">
                    <a href="#" data-mimo="modal:popup_reg_child_anonimous" class="add-child-not-login" title="" style="display:block;">ASQ Test</a>
                    <?php
                        $pages = get_pages(array(
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'page-templates/M-ChatR.php'
                        ));
                    ?>
                    <a href="#" data-mimo="modal:popup_mchatr" class="add-child-not-login" title="" style="display:block;">M-Chat R Test</a>
                    <a href="../qol/" style="display:block;">QOL Test</a>
                    <a href="../atec/" style="display:block;">ATEC Test</a>
                </div>
                <div class="txt_video">
                    <p>
                        <span style="font-size: 12pt;">
                            <strong>
                                <span style="color: #800000;">
                                    A365, chúng tôi là ai?
                                </span>
                            </strong>
                        </span>
                    </p>
                    <p>
                        <span style="font-size: 12pt;">
                            A365 (viết tắt của Autism365) là ứng dụng bằng tiếng Việt hoàn toàn miễn phí, có thể sử dụng trên điện thoại thông minh, máy tính bảng, máy tính có kết nối internet nhằm hỗ trợ cha mẹ và cán bộ y tế:
                        </span>
                        <br/>
                        <span style="font-size: 12pt;">
                            • SÀNG LỌC CHẬM PHÁT TRIỂN VÀ TỰ KỶ Ở TRẺ
                        </span>
                        <br/>
                        <span style="font-size: 12pt;">
                            • CAN THIỆP SỚM CHO TRẺ TỰ KỶ TẠI NHÀ BẰNG A365
                        </span>
                        <br/>
                        <span style="font-size: 12pt;">
                            • CUNG CẤP CÁC KIẾN THỨC CƠ BẢN VỀ RỐI LOẠN TỰ KỶ
                        </span>
                        <br/>
                        <span style="font-size: 12pt;">
                            • THEO DÕI, ĐÁNH GIÁ SỰ TIẾN BỘ CỦA TRẺ TỰ KỶ TRONG QUÁ TRÌNH CAN THIỆP
                        </span>
                    </p>
                    <p>
                        <span style="font-size: 12pt;">
                            <a class="more" href="../../chi-tiet.html/5617855ebd5347bb588369ea" target="_blank">
                                Xem thêm...
                            </a>
                        </span>
                    </p>
                </div>
                <div class="clear">
                </div>
            </div>
            
            <div class="mimo_modal" id="popup4">
                <img alt""="" data-mimo-src="castle.jpg" title="">
                    <div class="popup4" style="padding: 0 30px 20px 30px;">
            <div class="button_home">
                <div class="link_sangloc">
                    <div class="bg_hover">
                        <a href="sang-loc-phat-trien-va-tu-ky.html">
                            SÀNG LỌC
                        </a>
                    </div>
                    <div class="icon_sangloc">
                        <img alt="" src="<?php echo get_template_directory_uri() ?>/images/sang_loc.png"/>
                        <div class="div_arrow">
                        </div>
                    </div>
                    <div class="text_sangloc">
                        <h3>
                            SÀNG LỌC
                        </h3>
                        <p>
                            Bạn có con nhỏ từ 9 đến 48 tháng tuổi và muốn kiểm tra sự phát triển của trẻ
                        </p>
                        <p>
                            Bạn là cán bộ chuyên môn muốn theo dõi sự phát triển của trẻ
                        </p>
                    </div>
                </div>
                <div class="link_canthiep">
                    <div class="bg_hover">
                        <a href="../../Interventions/intervention_action">
                            CAN THIỆP
                        </a>
                    </div>
                    <div class="icon_canthiep">
                        <img alt="" src="<?php echo get_template_directory_uri() ?>/images/can_thiep.png"/>
                        <div class="div_arrow">
                        </div>
                    </div>
                    <div class="text_canthiep">
                        <h3>
                            CAN THIỆP
                        </h3>
                        <p>
                            Bạn có con nhỏ hơn 7 tuổi đã được chẩn đoán tự kỷ.
                        </p>
                        <p>
                            Và bạn muốn can thiệp cho con.
                        </p>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
            <div class="mimo_modal" id="popup7">
                <img alt="" data-mimo-src="castle.jpg" title="">
                    <div style="padding: 0 30px 20px 30px;">
                        <div align="left" class="tit_popup">
                            <p>
                                ĐĂNG NHẬP TÀI KHOẢN
                            </p>
                        </div>
                        <span class="txt_mid">
                            <p>
                                Bạn chưa có tài khoản
                            </p>
                        </span>
                        <a>
                            <input class="btn_ct" name="dangky" type="button" value="ĐĂNG KÝ TÀI KHOẢN"/>
                        </a>
                        <a data-mimo="modal:popup9;">
                            <input class="btn_ct" name="dangnhap" type="button" value="ĐĂNG NHẬP TÀI KHOẢN"/>
                        </a>
                    </div>
                </img>
            </div>
            <div class="mimo_modal" id="popup9">
                <img alt="" data-mimo-src="castle.jpg" title="">
                    <div class="popup3" style="padding: 0 30px 20px 30px;">
                        <div class="tit_popup" style="text-align:left;">
                            <p>
                                ĐĂNG NHẬP TÀI KHOẢN
                            </p>
                        </div>
                        <form accept-charset="utf-8" action="/users/login" enctype="multipart/form-data" id="UserLoginForm" method="post">
                            <div style="display:none;">
                                <input name="_method" type="hidden" value="POST"/>
                                <input id="Token1641572498" name="data[_Token][key]" type="hidden" value="669ad54f232426ba14a84b2bf8839c7e5e1f856f"/>
                            </div>
                            <div class="loginTbl">
                                <div class="loginRow">
                                    <div class="loginCell">
                                        <input class="" id="UserUsername" name="" placeholder="Email đăng nhập" type="text"/>
                                        <p>
                                            <input class="" id="UserPassword" name="" placeholder="Mật khẩu" type="password"/>
                                        </p>
                                        <div style="display: block;">
                                            <input id="UserIsRemember" name="" type="hidden"/>
                                        </div>
                                    </div>
                                    <div class="loginCell">
                                        <input class="btnCell dkct" type="submit" value="Đăng nhập"/>
                                    </div>
                                </div>
                                <div class="loginRow">
                                    <div class="loginCell">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </img>
            </div>
            <div class="slider">
                <ul class="logoLink" id="flexiselDemo3">
                    <li>
                        <a href="http://www.uq.edu.au/" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/UQ1451382146.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.grandchallenges.ca/" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/41438855928.jpg"/>
                        </a>
                    </li>
                    <li>
                        <a href="http://magnusmode.com/" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/31438855654.jpg"/>
                        </a>
                    </li>
                    <li>
                        <a href="http://vietnamautism.com/" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/11438853672.jpg"/>
                        </a>
                    </li>
                    <li>
                        <a href="http://ccihp.org/" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/51438854315.jpg"/>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.clbrubic.com" target="blank">
                            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/21438854776.jpg"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- the end content  -->
    <!--  footer -->
    <div class="clear">
    </div>
    <div class="footer_new">
        <div class="wrapper">
            <div class="link_footer">
                <ul>
                    <li>
                        <a href="/News/list_detail/5617855ebd5347bb588369ea" target="">
                            Giới thiệu
                        </a>
                    </li>
                    <li>
                        <a href="/cau-hoi-thuong-gap.html" target="">
                            Câu hỏi thường gặp
                        </a>
                    </li>
                    <li>
                        <a href="/tin-tuc.html" target="">
                            Tin tức
                        </a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="/Supports/index/541fe7188621af7c12000001" target="">
                            Điều khoản / điều kiện sử dụng
                        </a>
                    </li>
                    <li>
                        <a href="../lien-he" target="">
                            Liên hệ
                        </a>
                    </li>
                    <li>
                        <a href="../lien-he" target="">
                            Chia sẻ - góp ý
                        </a>
                    </li>
                </ul>
            </div>
            <div class="address">
                <h3>
                    TRUNG TÂM SÁNG KIẾN SỨC KHỎE VÀ DÂN SỐ
                </h3>
                Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội
                <br>
                    Điện thoại: 0977643338 (hotline hỗ trợ) - support.a365@ccihp.org
                    <br>
                        Website:
                        <a href="http://ccihp.org" target="_blank">
                            ccihp.org
                        </a>
                    </br>
                </br>
            </div>
            <div class="clear">
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="wrapper">
            <div class="allright">
                Bản quyền ©2015 A365™. Tất cả bản quyền được bảo lưu
            </div>
            <div class="link_fb">
                <a href="https://www.facebook.com/a365.vn" target="_blank">
                    <img alt="" src="<?php echo get_template_directory_uri() ?>/images/fb.png"/>
                </a>
                <a href="https://www.youtube.com/channel/UC0UKPLLZhnhXBcTJuTcP50Q" target="_blank">
                    <img alt="" src="<?php echo get_template_directory_uri() ?>/images/youtube.png"/>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="mimo_modal" id="popup_reg_child_anonimous" style="">
    <div class="mimo_close">
        ✕
    </div>
    <div class="popup_reg_child">
        <form accept-charset="utf-8" action="" enctype="multipart/form-data" id="ChildManagerTestForm" method="post">             
            <div class="p_content">
                <h3 class="tit_res">
                    THÔNG TIN TRẺ
                </h3>
                <table class="table_contact">
                    <tbody>
                        <tr>
                            <td width="300px">
                                Tên đầy đủ<span class="required">(*)</span>
                            </td>
                            <td width="400px">
                                <input id="ChildFullname" maxlength="200" name="child_full_name" placeholder="Vui lòng đánh tiếng việt có dấu" type="text" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Ngày sinh<span class="required">(*)</span>
                            </td>
                            <td>
                                <input name="birthday" id="childBirth" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Giới tính<span class="required">(*)</span>
                            </td>
                            <td>
                                <input checked="checked" id="ChildSex1" name="child_gender" type="radio" value="Nam">
                                    <label for="ChildSex1">
                                        Nam
                                    </label>
                                <input id="ChildSex0" name="child_gender" type="radio" value="Nữ">
                                    <label for="ChildSex0">
                                        Nữ
                                    </label>                                    
                            </td>
                        </tr>
                        <tr>
                            <td width="300px">
                                Khu vực<span class="required">(*)</span>
                            </td>
                            <?php $areas =  a365_get_areas(); ?>
                            <td width="400px">
                                <select name="area" single>
                                    <?php foreach($areas as $area): ?>
                                    <option value="<?php echo $area->area_code ?>"><?php echo $area->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Trẻ sinh vào tuần thứ mấy của thai kỳ<span class="required">(*)</span>
                            </td>
                            <td>
                                <input class="numberOnly" id="ChildMiscarry" maxlength="200" name="child_born_age" type="text" required>
                                    (tuần tuổi)
                                </input>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="button_send">
                <button class="btn_lamtest" name="begin_asq_test" type="submit" value="Làm test cho con"></button>
            </div>
        </form>
    </div>
</div>
<div class="mimo_modal" id="popup_mchatr" style="">
    <div class="mimo_close">
        ✕
    </div>
    <div class="popup_reg_child">
        <form accept-charset="utf-8" action="" enctype="multipart/form-data" id="ChildManagerTestForm" method="post">             
            <div class="p_content">
                <h3 class="tit_res">
                    THÔNG TIN TRẺ
                </h3>
                <table class="table_contact">
                    <tbody>
                        <tr>
                            <td>
                                Tên đầy đủ<span class="required">(*)</span>
                            </td>
                            <td>
                                <input id="ChildFullname" maxlength="200" name="child_full_name" placeholder="Vui lòng đánh tiếng việt có dấu" type="text" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Ngày sinh<span class="required">(*)</span>
                            </td>
                            <td>
                                <input name="birthday" id="mChatChildBirth" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Giới tính<span class="required">(*)</span>
                            </td>
                            <td>
                                <input checked="checked" id="ChildSex1" name="child_gender" type="radio" value="Nam">
                                    <label for="ChildSex1">
                                        Nam
                                    </label>
                                <input id="ChildSex0" name="child_gender" type="radio" value="Nữ">
                                    <label for="ChildSex0">
                                        Nữ
                                    </label>                                    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Khu vực<span class="required">(*)</span>
                            </td>
                            <?php $areas =  a365_get_areas(); ?>
                            <td>
                                <select name="area" single required>
                                    <?php foreach($areas as $area): ?>
                                    <option value="<?php echo $area->area_code ?>"><?php echo $area->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Trẻ sinh vào tuần thứ mấy của thai kỳ<span class="required">(*)</span>
                            </td>
                            <td>
                                <input class="numberOnly" id="ChildMiscarry" maxlength="200" name="child_born_age" type="text" required>
                                    (tuần tuổi)
                                </input>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>            
            <div class="button_send">
                <button class="btn_lamtest" name="begin_mchatr_test" type="submit" value="Làm test cho con"></button>
            </div>
        </form>
    </div>
</div>
<script>
</script>
<?php get_footer(); ?>