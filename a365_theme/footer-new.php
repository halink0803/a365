<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A365
 */

?>

	</div><!-- #content -->

	<footer id="siteFooter">
		<div class="container">
			<hr class="footer-border">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="footer-link-col">
						<div class="col-title text-uppercase"><a style="color: #ca2535" href="<?php echo get_site_url() . '/tin-tuc'; ?>">Tin tức</a></div>
						<div class="col-body">
							<ul class="list-news-update list-unstyled">
								<?php
									$args = array(
										'numberposts' => -1,
										'offset' => 0,
										'category' => 0,
										'orderby' => 'post_date',
										'order' => 'ASC',
										'include' => '',
										'exclude' => '',
										'meta_key' => '',
										'meta_value' =>'',
										'post_type' => 'news',
										'post_status' => 'draft, publish, future, pending, private',
										'suppress_filters' => true
									);

								$posts = wp_get_recent_posts( $args );
								$recent_posts = [];
								foreach( $posts as $post ){
									array_unshift($recent_posts, $post);
								}
								$i=0;
								foreach ($recent_posts as $recent) {
									echo '<li><div class="news-link"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></div><div class="news-meta">'.get_the_date( 'd/m/Y', $recent["ID"] ).'</div></li> ';
									$i++;
									if($i==2){
										break;
									}
								}
								wp_reset_query();
								?>

							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="footer-link-col">
						<div class="col-title text-uppercase">Về A365.vn</div>
						<div class="col-body">
							<?php dynamic_sidebar( 'footer-top' ); ?>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5">
					<div class="footer-link-col text-right">
						<div class="col-title">Trung tâm Sáng kiến Sức khỏe và Dân số (CCIHP)</div>

						<div class="col-body">
							<div class="info-text">
								<?php dynamic_sidebar( 'contact-information' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php dynamic_sidebar( 'footer' ); ?>


		<div class="copyright-text">
			<?php
			echo '<div class="container">Bản quyền  ©'.get_the_time('Y').' A365™. Tất cả bản quyền được bảo lưu. Vui lòng liên hệ khi muốn sử dụng nội dung trên trang.</div>';
			?>
		</div>
	</footer>
	<!-- Modal Sign In-->
    <div class="modal fade" id="modalSignIn" tabindex="-1">
      <div class="modal-dialog modal-sm" role="document">
        <div class="qh-modal-content">
          <div class="qh-modal-header text-uppercase text-center">Đăng nhập</div>
          <div class="qh-modal-body">
            <form class="qh-form qh-sign-in-form" name="loginform" id="loginform" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
              <div class="qh-form-row">
              	<input type="hidden" name="testcookie" value="1" />
              	<input type="text" name="log" id="user_login" class="qh-input-control" placeholder="Email đăng nhập"/>
              </div>
              <div class="qh-form-row">
              	<input type="password" name="pwd" id="user_pass" class="qh-input-control" placeholder="Mật khẩu"/>
              </div>
              <div class="qh-form-row">
                <div class="pull-left">
	                <div class="checkbox">
	                	<label><input type="checkbox" name="rememberme" type="checkbox" id="rememberme" value=""> Nhớ đăng nhập</label>
	                </div>
                </div>
                <div class="pull-right mg-t5">
                <a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword" class="fz14">Quên mật khẩu?</a>
                </div>
              </div>
              <div class="qh-form-row text-center mg-t15">
              	<input type="submit" name="wp-submit" id="wp-submit" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase" value="Đăng nhập" tabindex="100" />
              		<?php
						$pages = get_pages(array(
					        'meta_key' => '_wp_page_template',
					        'meta_value' => 'page-templates/child-information.php'
					    ));
					?>
              	<input type="hidden" name="redirect_to" value="<?php echo home_url($pages[0]->post_name) ?>" />
              	<input type="hidden" name="testcookie" value="1" />
              </div>
              <div class="text-center mg-t10"><a href="<?php echo get_option('home'); ?>">Huỷ đăng nhập</a></div>
              <div class="text-center mg-t10">Bạn chưa có tài khoản? <a id="register-link" href="#" data-toggle="modal" data-target="#modalSignUp2">Đăng ký</a></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Sign Up-->
    <div class="modal fade" id="modalSignUp2" tabindex="-1">
      <div class="modal-dialog modal-sm" role="document">
        <div class="qh-modal-content">
          <div class="qh-modal-header text-uppercase text-center">Đăng ký</div>
          <div class="qh-modal-body">
            <div  class="qh-form qh-sign-in-form" >
              <div class="qh-form-row">
                <label class="c-red">Bạn là</label>
                <ul  name="register_type" style="padding: 0; list-style: none;">
                <?php
                	$pages_parent = get_pages(array(
			          'meta_key' => '_wp_page_template',
			          'meta_value' => 'page-templates/register-parent.php'
			     	 ));
			     	 $pages_officer = get_pages(array(
			          'meta_key' => '_wp_page_template',
			          'meta_value' => 'page-templates/register-officer.php'
			     	 ));
                ?>
                  <li><a href="<?php echo home_url($pages_parent[0]->post_name) ?>" class="qh-btn qh-btn-cblue full-width">Cha mẹ/Thành viên khác trong gia đình</a></li>
                  <br/>
                  <li><a href="<?php echo home_url($pages_officer[0]->post_name) ?>" class="qh-btn qh-btn-cblue full-width">Cán bộ y tế/Cán bộ chuyên môn khác</a></li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</div><!-- #page -->

<!-- Modal TEST Without Login-->
 <div class="modal fade" id="Modal_ASQ_Without_Login" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 15pt;"><strong>
						Thông tin trẻ
					</strong></span></p>
					<p style="text-align: center;" class="qh-help-text c-red mg-b20"><span style="font-size: 12pt;"><strong>
						Vui lòng điền chính xác thông tin để nhận được bài sàng lọc phù hợp!
					</strong></span></p>
				</div>
            </div>
          <div class="modal-body">
          		<?php
					$pages = get_pages(array(
					    'meta_key' => '_wp_page_template',
					    'meta_value' => 'page-templates/asq.php'
					));
				?>
           	<form accept-charset="utf-8" class="qh-form" id="NoLoginTestForm">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Họ và tên trẻ (*)</span></label>
							<div class="input-wrap">
								<input name="fullname" id="fullname" type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row" style="margin: 0">
							<label class="qh-label"><span class="align"></span><span class="text"></span></label>

							<div class="input-wrap">
								<p style="margin: 0"><i>Nếu trẻ này không có thật, vui lòng đặt tên trẻ là test</i></p>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Ngày sinh (*)</span></label>
							<div class="input-wrap">
							 	<select name="dd" id="dd" class="select_contact qh-form-control iblock">
							 		<option value="" style="width:auto">Ngày</option>
					               	<option value="1">1</option>
				                    <option value="2">2</option>
				                    <option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
				            	</select>
								<select name="mm" id="mm" class="select_contact qh-form-control iblock">
									<option value="" style="width:auto">Tháng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
								<select name="yyyy" id="yyyy" class="select_contact qh-form-control iblock">
									<option value="" style="width:auto">Năm</option>
									<?php
										for ($i = 2000; $i <= date("Y"); $i++) { ?>
											<option value="<?php echo $i;?>"><?php echo $i;?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="child_gender" value="Nam">Nam</label>
								<label class="radio-inline"><input type="radio" name="child_gender" value="Nữ">Nữ</label>
								<label class="radio-inline" style="display: none"><input type="radio" name="child_gender" value="" checked=""></label>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Sinh vào tuần thứ (*)</span></label>
							<div class="input-wrap">
								<select name="birthweek" id="birthweek" class="select_contact qh-form-control iblock">
									<option value="" style="width:auto">Chọn</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
									<option value="32">32</option>
									<option value="33">33</option>
									<option value="34">34</option>
									<option value="35">35</option>
									<option value="36">36</option>
									<option value="37">37</option>
									<option value="38">38</option>
									<option value="39">39</option>
									<option value="40">40</option>
									<option value="41">41</option>
									<option value="42">42</option>
									<option value="43">43</option>
									<option value="44">44</option>
									<option value="45">45</option>
								</select> của thai kỳ
							</div>
						</div>

					<div class="qh-form-row">
			            <label class="qh-label">
			            	<span class="align"></span>
			            	<span class="text">Khu vực (*)</span></label>
			            <div class="input-wrap">

				            <select name="area" id="area" class="select_contact qh-form-control">
				               	<option value="" style="width:auto">Chọn khu vực</option>
				               	<?php $areas =  a365_get_areas(); ?>

				                <?php foreach($areas as $area): ?>
			                    <option value="<?php echo $area->area_code ?>"><?php echo $area->name ?></option>
			                    <?php endforeach; ?>
				            </select>

	            		</div>
	        		 </div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20"><b><i id="notice"></i></b></div>
							<input type="button" name="asqNoLogin" value="Làm ASQ®" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase asqNoLogin"/>
							<input type="button" name="mchatNoLogin" value="Làm MCHAT R" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase mchatNoLogin"/>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
					</div>
				</form>
         	 </div>
          </div>
        </div>
    </div>


<!-- Modal get user info -->
<div class="modal fade" id="Modal_User_Info_Without_Login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 15pt;"><strong>Vui lòng điền thông tin người trả lời để xem kết quả</strong></span></p>
				</div>
            </div>
          <div class="modal-body">
           	<form accept-charset="utf-8" class="qh-form" id="Get_Result" style="padding-bottom: 0">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Năm sinh (*)</span></label>
							<div class="input-wrap">
								<input name="age" id="age" type="number" min="1900" value="1989" class="qh-form-control iblock" style="width: 75px;">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="user_gender" value="Nam">Nam</label>
								<label class="radio-inline"><input type="radio" name="user_gender" value="Nữ">Nữ</label>
								<label class="radio-inline" style="display: none"><input type="radio" name="user_gender" value="" checked=""></label>
							</div>
						</div>
						<div class="qh-form-row">
				            <label class="qh-label">
				               <span class="align"></span><span class="text">Mối quan hệ với trẻ (*)</span>
				            </label>
				            <div class="input-wrap">
				               <select name="relationship" id="role_user" class="select_contact qh-form-control" onchange="add_option()">
				                  <option value="" style="width:auto">Chọn quan hệ</option>
				                  <option value="Cha / Mẹ">Cha / Mẹ</option>
				                  <option value="Ông / Bà">Ông / Bà</option>
				                  <option value="Cô / Chú">Cô / Chú</option>
				                  <option value="Khác">Người chăm sóc khác (ghi rõ)</option>
				               </select>
				               <input name="other_relationship" placeholder="Nhập mối quan hệ với trẻ" class="input_contact qh-form-control" type="text" id="UserJobAdd" style="display: none">
				            </div>
				        </div>
				        <div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Địa chỉ chi tiết</span></label>
							<div class="input-wrap">
								<input name="address" type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Nơi làm sàng lọc (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="did_at" value="Nhà" checked>Nhà</label>
								<label class="radio-inline"><input type="radio" name="did_at" value="Cơ sở y tế">Cơ sở y tế</label>
								<label class="radio-inline"><input type="radio" name="did_at" value="Khác">Khác</label>
							</div>
						</div>
                        <div class="qh-form-row">
                            <label class="qh-label">
                               <span class="align"></span><span class="text">Anh/chị biết đến A365 từ nguồn nào? (*)</span>
                            </label>
                            <div class="input-wrap">
                               <select name="source" id="source" class="select_contact qh-form-control" onchange="add_option()">
                                  <option value="" style="width:auto">Chọn nguồn</option>
                                  <option value="social networks">Mạng xã hội (facebook)</option>
                                  <option value="internet">Trên internet (tìm kiếm trên Google, đọc báo mạng, ...)</option>
                                  <option value="newspaper">Báo, đài, ti vi, tờ rơi, áp phích</option>
                                  <option value="introduced">Được người khác giới thiệu</option>
                                  <option value="Khác">Khác</option>
                               </select>
                               <!-- <input name="other_relationship" placeholder="Nhập mối quan hệ với trẻ" class="input_contact qh-form-control" type="text" id="UserJobAdd" style="display: none"> -->
                            </div>
                        </div>

					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20"><b><i id="notice2"></i></b></div>
							<input type="button" name="get_result" value="Nhận kết quả" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase get_result"/>
							<input type="button" name="cancel" value="Hủy bỏ" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase cancel"/>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
					</div>
				</form>
         	 </div>
          </div>
        </div>
    </div>
</div>

<!-- Modal get thông tin người trả lời sàng lọc trong trường hợp tài khoản là cán bộ y tế -->
<div class="modal fade" id="Modal_Respondent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 15pt;"><strong>Người cung cấp thông tin về trẻ</strong></span></p>
				</div>
            </div>
          	<div class="modal-body">
           		<form accept-charset="utf-8" class="qh-form" id="respondent" style="padding-bottom: 0">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Năm sinh (*)</span></label>
							<div class="input-wrap">
								<input name="age" id="age" type="number" min="1900" value="1989" class="qh-form-control iblock" style="width: 75px;" required>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="gender" value="Nam">Nam</label>
								<label class="radio-inline"><input type="radio" name="gender" value="Nữ">Nữ</label>
								<label class="radio-inline" style="display: none"><input type="radio" name="gender" value="" checked></label>
							</div>
						</div>
						<div class="qh-form-row">
				            <label class="qh-label">
				               <span class="align"></span><span class="text">Mối quan hệ với trẻ (*)</span>
				            </label>
				            <div class="input-wrap">
				               <select name="relationship" id="relationship" class="select_contact qh-form-control" onchange="add_option_2()">
				                  <option value="" style="width:auto">Chọn quan hệ</option>
				                  <option value="Cha / Mẹ">Cha / Mẹ</option>
				                  <option value="Ông / Bà">Ông / Bà</option>
				                  <option value="Cô / Chú">Cô / Chú</option>
				                  <option value="Khác">Người chăm sóc khác (ghi rõ)</option>
				               </select>
				               <input name="other_relationship" placeholder="Nhập tên người chăm sóc khác" class="input_contact qh-form-control" type="text" id="other_relationship" >
				            </div>
				        </div>
				        <div class="qh-form-row">
				            <label class="qh-label">
				            	<span class="align"></span>
				            	<span class="text">Khu vực (*)</span></label>
				            <div class="input-wrap">

					            <select name="area" id="area" class="select_contact qh-form-control" required>
					               	<option value="" style="width:auto">Chọn khu vực</option>
					               	<?php $areas =  a365_get_areas(); ?>

					                <?php foreach($areas as $area): ?>
				                    <option value="<?php echo $area->area_code ?>"><?php echo $area->name ?></option>
				                    <?php endforeach; ?>
					            </select>

	            			</div>
	        		 	</div>
				        <div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Địa chỉ chi tiết</span></label>
							<div class="input-wrap">
								<input name="address" type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Nơi làm sàng lọc (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="did_at" value="Nhà" checked>Nhà</label>
								<label class="radio-inline"><input type="radio" name="did_at" value="Cơ sở y tế">Cơ sở y tế</label>
								<label class="radio-inline"><input type="radio" name="did_at" value="Khác">Khác</label>
							</div>
						</div>

						<div class="qh-form-row">
							<div class="input-wrap">
								<div class="qh-help-text c-red mg-b20"><b><i id="notice3"></i></b></div>
								<input type="button" name="view_result" value="Xem kết quả" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase view_result"/>
								<input type="button" name="cancel" value="Hủy bỏ" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase cancel"/>
								<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
							</div>
						</div>
					</div>
				</form>
         	 </div>
         </div>
    </div>
</div>

<!-- Modal send email -->
<div class="modal fade" id="Modal_Send_Mail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 15pt;"><strong>Chia sẻ kết quả qua email</strong></span></p>
				</div>
            </div>
          	<div class="modal-body">
           		<form accept-charset="utf-8" class="qh-form" method="post" id="send_mail_form">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Nhập email bạn muốn chia sẻ(*)</span></label>
							<div class="input-wrap">
								<input name="email" id='email' type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Nhập nội dung bạn muốn chia sẻ</span></label>
							<div class="input-wrap">
								<textarea name="content" id='content' class="qh-form-control"></textarea>
							</div>
						</div>

						<div class="qh-form-row">
							<div class="input-wrap">
								<div class="qh-help-text c-red mg-b20"><b><i id="notice-mail"></i></b></div>
								<input type="button" name="send_mail_button" value="Gửi chia sẻ" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase send_mail"/>
								<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
							</div>
						</div>
					</div>
				</form>
         	 </div>
          </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Modal_Change_Default_Password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 15pt;"><strong>Thay đổi mật khẩu</strong></span></p>
				</div>
            </div>
          	<div class="modal-body">
          		<p>
          			  Chào bạn,<br/>
					  A365.vn đã được nâng cấp để cung cấp dịch vụ tốt hơn cho người dùng. Để tiếp tục sử dụng các chức năng trên A365.vn, bạn vui lòng đổi mật khẩu mới cho tài khoản và sau đó đăng nhập lại.
          		</p>
          		<form class="qh-form" id="change_default_pass_form">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Mật khẩu mới  (*)</span></label>
							<div class="input-wrap">
								<input name="new-pass" id="new-pass" type="password" required="required" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Xác nhận mật khẩu mới  (*)</span></label>
							<div class="input-wrap">
								<input name="new-pass-confirm" id="new-pass-confirm" type="password" required="required" class="qh-form-control">
							</div>
						</div>
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20"><b><i id="notice4"></i></b></div>
							<input type="button" name="changePassword" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase" id="changepass" value="Lưu thay đổi">
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
					<p>
						Nếu có thắc mắc hoặc gặp khó khăn, vui lòng liên hệ với chúng tôi theo Đường dây hỗ trợ: 0985 220 391 hoặc Email: support.a365@ccihp.org.
					<br/>
					Chúng tôi xin lỗi vì sự bất tiện này. Cảm ơn bạn đã tin tưởng sử dụng A365.vn để chăm sóc cho trẻ.
					</p>
				</form>
         	 </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/bootstrap.min.js" ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/owl.carousel.min.js" ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/main.js" ?>"></script>
<script type="text/javascript">
	var $=jQuery.noConflict();

  	$(document).ready(function(){
    	$(".share_mail").click(function(){
	      	$("#Modal_Send_Mail").modal('show');
	    });
	    $(".send_mail").click(function(){
	    	var email = $("#email").val();
         	 //check empty fields
          	if (email == '') {
              $("#notice-mail").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
          	} else {
          		$('#notice-mail').html("Email đang được gửi đi vui lòng chờ trong giây lát ...");
	      		send();
	      	}
	    });
	    $(".print_result").click(function(){
	      	printDiv();
	    });
  	})

  	function add_option() {
	    $('#UserJobAdd').removeAttr('style');
   		//your code here
   		var option = $('#role_user option:selected').val();
   		//.log(option);
   		// if (option == 'Khác') {
   		// 	$('#UserJobAdd').removeClass('hidden');
   		// }
   		// else
   		// 	$('#UserJobAdd').addClass('hidden');
	};

	function add_option_2() {
	    $('#other_relationship').removeAttr('style');
   		//your code here
   		var option = $('#relationship option:selected').val();
   		//.log(option);
   		if (option == 'Khác') {
   			$('#other_relationship').removeClass('hidden');
   		}
   		else
   			$('#other_relationship').addClass('hidden');

	};

	var $=jQuery.noConflict();
	$(document).ready(function(){
		// check login
		var user_id = "<?=a365_get_current_user_id() ?>";
		////console.log(user_id);
  	})

	var $=jQuery.noConflict();
    $(document).ready(function(){

        var user_check = <?php
                            if(isset($_SESSION['reset']) && $_SESSION['reset'] == 1)
                                echo "true";
                            else
                                echo "false";
                        ?>;
        //console.log(user_check);

        if (user_check == true) {
            $("#Modal_Change_Default_Password").modal({
                backdrop: 'static',
                keyboard: true
            });

            $('#changepass').click(function(event) {
                //console.log("chạy vào đây rồi");
                var password = $("#new-pass").val();
                var confirm_password = $("#new-pass-confirm").val();
                // //console.log("age:"+age);
                //check empty fields
                if (password == '' || confirm_password == '') {
                    //console.log("đã check rồi");
                    $("#notice4").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
                }
                else if( password != confirm_password ) {
                	$("#notice4").html("Mật khẩu mới không trùng khớp, vui lòng kiểm tra lại.");
                }
                else {
                    //console.log("đã gửi request rồi");
                    $pass_info = $("#change_default_pass_form").serialize();
                    //console.log( $pass_info );
                    //event.preventDefault();
                    $.ajax({
                      type: 'post',
                      dataType: 'json',
                      url: a365_ajax.ajax_url,
                      data: $pass_info + "&action=" + 'add_new_password',
                      success: function(response) {
                      	if(response['message'] == 'successful') {
                      		window.location.href = '<?php echo home_url('/'); ?>';
                      	} else {
                      		$("#notice4").html("Thay đổi mật khẩu thất bại!");
                      	}
                      }

                    });
                }
            });
        }
    })
</script>
<?php wp_footer(); ?>
</body>
</html>