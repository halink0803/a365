<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Register Officer
 *
 * @package A356
 */
get_header('new');
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>

	function validateForm() {
   // sleep
    ajaxindicatorstart('Bạn vui lòng đợi');
    if (document.getElementById("UserSignupForm")) {
        setTimeout("submitForm()", 5000); // set timout 
       
    }
  }
  $( document ).ready(function() {
      if($("#job").val()==''){
        $('#UserJobAdd').hide();
      }
      $("#job").change(function(){
        if($("#job").val()=='another'){
          $('#UserJobAdd').show(100);
        }else{
          $('#UserJobAdd').hide(100);
        }
      });
      
      
  });

</script>
<div class="content container">
   <div class="wrapper">
      <div class="title">
         <div class="qh-page-header">
            Đăng ký tài khoản            
         </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <?php
            if(isset($_POST['reg_officer_submit'])){ 
              if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                if(isset($_POST['reg_officer_password']) && isset($_POST['reg_officer_password']) && $_POST['reg_officer_password'] != $_POST['reg_officer_password_check']){
                  echo '<div id="flashMessage" class="error_log">Xác nhận mật khẩu không trùng khớp</div>';
                }
              }else{
                echo '<div id="flashMessage" class="c-red error_log">Bạn chưa tích vào xác nhận</div>';
              }
            }
          ?>
         <form class="qh-form" action="" onsubmit="return validateForm()" id="UserSignupCbForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
         <div class="qh-form-title">THÔNG TIN TÀI KHOẢN</div>
         <div class="qh-form-input-wrap">
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Email (*)</span></label>
                  <div class="input-wrap">
                     <input name="reg_officer_email" class="input_contact qh-form-control" required="required" type="email" id="UserEmail"/>                    
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Mật khẩu (*)</span></label>
                  <div class="input-wrap">
                     <input name="reg_officer_password" class="input_contact qh-form-control" required="required" type="password" id="User0Password"/>                    
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Xác nhận mật khẩu (*)</span></label>
                  <div class="input-wrap">
                     <input name="reg_officer_password_check" required="required" class="input_contact qh-form-control"   type="password" id="User1Password"/>                    
                  </div>
               </div>
               
         <div class="qh-form-title">Thông tin cá nhân</div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Họ và tên (*)</span>  </label>
                  <div class="input-wrap">
                     <input name="reg_officer_name" class="input_contact qh-form-control" required="required" type="text" id="UserName"/>                    
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Năm sinh (*)</span>
                      
                  </label>
                  <div class="input-wrap">
                        <select name="reg_officer_birth_year" class="select_contact qh-form-control" id="UserYearYear" required="required" />
                           <option value="">--Chọn--</option>
                           <option value="1998">1998</option>
                           <option value="1997">1997</option>
                           <option value="1996">1996</option>
                           <option value="1995">1995</option>
                           <option value="1994">1994</option>
                           <option value="1993">1993</option>
                           <option value="1992">1992</option>
                           <option value="1991">1991</option>
                           <option value="1990">1990</option>
                           <option value="1989">1989</option>
                           <option value="1988">1988</option>
                           <option value="1987">1987</option>
                           <option value="1986">1986</option>
                           <option value="1985">1985</option>
                           <option value="1984">1984</option>
                           <option value="1983">1983</option>
                           <option value="1982">1982</option>
                           <option value="1981">1981</option>
                           <option value="1980">1980</option>
                           <option value="1979">1979</option>
                           <option value="1978">1978</option>
                           <option value="1977">1977</option>
                           <option value="1976">1976</option>
                           <option value="1975">1975</option>
                           <option value="1974">1974</option>
                           <option value="1973">1973</option>
                           <option value="1972">1972</option>
                           <option value="1971">1971</option>
                           <option value="1970">1970</option>
                           <option value="1969">1969</option>
                           <option value="1968">1968</option>
                           <option value="1967">1967</option>
                           <option value="1966">1966</option>
                           <option value="1965">1965</option>
                           <option value="1964">1964</option>
                           <option value="1963">1963</option>
                           <option value="1962">1962</option>
                           <option value="1961">1961</option>
                           <option value="1960">1960</option>
                           <option value="1959">1959</option>
                           <option value="1958">1958</option>
                           <option value="1957">1957</option>
                           <option value="1956">1956</option>
                           <option value="1955">1955</option>
                           <option value="1954">1954</option>
                           <option value="1953">1953</option>
                           <option value="1952">1952</option>
                           <option value="1951">1951</option>
                           <option value="1950">1950</option>
                           <option value="1949">1949</option>
                           <option value="1948">1948</option>
                           <option value="1947">1947</option>
                           <option value="1946">1946</option>
                        </select>
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Giới tính (*)</span>  </label>
                  <div class="input-wrap">
                    <label class="radio-inline">
                     <input type="radio" name="reg_officer_gender" id="UserGender1" value="Nam" class="radio-inline" required="required"  checked />Nam</label>
                     <label class="radio-inline"><input type="radio" name="reg_officer_gender" id="UserGender0" value="Nữ" class="radio-inline" required="required"/>Nữ</label>
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Khu vực (*)</span></label>
                  <div class="input-wrap">
                     <select name="reg_officer_city" class="select_contact qh-form-control" required="required" id="UserCity">
                      <option value="">--Chọn--</option>
                      <?php $areas =  a365_get_areas(); ?>

                      <?php foreach($areas as $area): ?>
                          <option value="<?php echo $area->area_code ?>"><?php echo $area->name ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                     <span class="align"></span>
                     <span class="text">Nghề nghiệp (*)</span>   
                  </label>
                  <div class="input-wrap">
                     <select name="reg_officer_job" rel="/Users/get_hospital" id="job" class="select_contact qh-form-control" required="required">
                        <option value="">--Chọn nghề--</option>
                        <option value="Bác sĩ chuyên khoa nhi">Bác sĩ chuyên khoa nhi</option>
                        <option value="Bác sĩ đa khoa">Bác sĩ đa khoa</option>
                        <option value="Bác sĩ chuyên ngành khác">Bác sĩ chuyên ngành khác</option>
                        <option value="Y tá/điều dưỡng">Y tá/điều dưỡng</option>
                        <option value="Giáo viên mầm non">Giáo viên mầm non</option>
                        <option value="Giáo viên giáo dục đặc biệt">Giáo viên giáo dục đặc biệt</option>
                        <option value="Cán bộ tâm lý">Cán bộ tâm lý</option>
                        <option value="Nghiên cứu viên">Nghiên cứu viên</option>
                        <option value="another">Khác</option>
                     </select>
                     <input name="reg_officer_job_add" placeholder="Điền rõ nghề nghiệp" class="input_contact qh-form-control" type="text" id="UserJobAdd" >
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                    <span class="align"></span>
                    <span class="text">Nơi công tác</span>  
                  </label>
                  <div class="input-wrap">
                     <select name="reg_officer_working_place" rel="/Users/get_hospital_level" id="job_next" class="select_contact qh-form-control">
                        <option value="">--Chọn nơi công tác--</option>
                        <option value="Trạm y tế">Trạm y tế</option>
                        <option value="Trung tâm y tế huyện/ Bệnh viện huyện">Trung tâm y tế huyện/ Bệnh viện huyện </option>
                        <option value="Bệnh viện tỉnh/thành phố">Bệnh viện tỉnh/thành phố</option>
                        <option value="Bệnh viện Nhi Trung ương">Bệnh viện Nhi Trung ương</option>
                        <option value="Bệnh Viện Nhi đồng 1/ Bệnh viện nhi đồng 2">Bệnh Viện Nhi đồng 1/ Bệnh viện nhi đồng 2</option>
                        <option value="Khoa nhi bệnh viện các trường đại học Y">Khoa nhi bệnh viện các trường đại học Y</option>
                        <option value="Phòng khám tư nhân">Phòng khám tư nhân</option>
                        <option value="Trường mầm non">Trường mầm non</option>
                        <option value="Trung tâm can thiệp sớm">Trung tâm can thiệp sớm</option>
                        <option value="Các trường đại học/cơ quan nghiên cứu">Các trường đại học/cơ quan nghiên cứu</option>
                        <option value="Khác">Khác</option>
                     </select>
                  </div>
               </div>
               <div class="qh-form-row">
                  <label class="qh-label">
                      <span class="align"></span>
                      <span class="text">Xác nhận (*)</span></label>
                    <div class="input-wrap">
                      <div class="g-recaptcha" data-sitekey="6Lem_g4UAAAAAJ0DZDu7ArZqjOs_9gMC3NqCIoE4"></div>
                    </div>
                </div>
            </tbody>
         </table>
         <div class="note">
            Bạn cần điền đầy đủ các thông tin được đánh dấu (*)
         </div>
         <div>
          Chúng tôi thu thập một số thông tin cá nhân nhằm mục đích nghiên cứu để phục vụ tốt hơn người dùng. Xem thêm: <a href="/dieu-khoan-va-dieu-kien-su-dung/">Điều khoản/điều lệ</a>
         </div>
         <hr>
         <div class="dkdk qh-form-row">
               <input name='reg_officer_check' type="checkbox" data-size="xl"/><label>&nbsp;Tôi đồng ý các <a href="<?php echo get_site_url().'/dieu-khoan-va-dieu-kien-su-dung' ?>">điều khoản, điều kiện</a> của tổ chức về quy định đăng ký tài khoản</label>
         </div>
         <div class="input-wrap">
            <input name='reg_officer_submit' type='submit' class="btn_tieptuc qh-btn qh-btn-lg qh-btn-blue text-uppercase" value="Tiếp tục">
            <div class="clear"></div>
         </div>
         </form>
      </div>
   </div>
   </div>
</div>
<?php get_footer('new') ?>
<script type="text/javascript">
  $(document).ready(function() {
    var msg="";
    var elements_1 = document.getElementsByTagName("INPUT");

    for (var i = 0; i < elements_1.length; i++) {
       elements_1[i].oninvalid =function(e) {
            if (!e.target.validity.valid) {
              e.target.setCustomValidity("Vui lòng điền thông tin");
           }
        };
        elements_1[i].oninput = function(e) {
            e.target.setCustomValidity(msg);
        };
    }

    var elements_2 = document.getElementsByTagName("SELECT");
    for (var i = 0; i < elements_2.length; i++) {
       elements_2[i].oninvalid =function(e) {
            if (!e.target.validity.valid) {
              e.target.setCustomValidity("Vui lòng điền thông tin");
           }
        };
        elements_2[i].oninput = function(e) {
            e.target.setCustomValidity(msg);
        };
    } 
  });
</script>