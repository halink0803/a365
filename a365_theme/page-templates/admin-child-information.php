<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Template Name: Admin Child Information
 */

get_header('new');
// $children = a365_get_children();
$user = a365_get_current_user();
a365_get_child_by_id($_GET['id']);
?>

<div id="siteContent">
	<div class="container">
		<div id="child-history-rows" class="child-history row hidden">
			<div class="col-md-9 col-lg-10">
				<div class="children-list-table">
					<div>
						<table class="display" id="test-table" cellspacing="0" width="100%">
						 	<thead>
						 		<tr>
						 			<th>Chọn</th> 
							 		<th>Ngày làm bài</th> 
							 		<th>Bài sàng lọc</th> 
							 		<th>Trạng thái</th> 
						 		</tr>
						 	</thead>
						 	<tfoot>
						 		<tr>
							 		<th>Tìm</th> 
								 	<th class="xxx">Ngày làm bài</th> 
								 	<th class="xxx">Bài sàng lọc</th> 
								 	<th class="xxx">Trạng thái</th> 
						 		</tr>
						 	</tfoot>
						 	<tbody>
								<!-- History Content -->
						 	</tbody>
						</table>
					</div>

				</div>
			</div>
			<div class="col-md-3 col-lg-2">
				<div class="history-action child-action-wrap hidden">
					<div class="hidden">
						<!-- ASQ -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-asq-result.php'
						    ));
						?>
						<div class="asq-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>

						<!--  MCHAT R -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/M-ChatR-Result.php'
						    ));
						?>
						<div class="mchatr-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/m-chat-rf-result.php'
						    ));
						?>
						<div class="mchatrf-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<!-- QOL -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-qol-result.php'
						    ));
						?>
						<div class="qol-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						
						<!-- ATEC -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-atec-result.php'
						    ));
						?>
						<div class="atec-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>

						<!-- GUMSUE -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-gumsue-result.php'
						    ));
						?>
						<div class="gumsue-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
					</div>					
					<!-- <div class="single-action"><a href="#"><i class="fa fa-file-text-o c-blue"></i> Xem bài làm</a></div> -->
					<div class="single-action"><a href="#" class="view-result"><i class="fa fa-calendar-check-o c-blue"></i> Xem kết quả</a></div>
					<div class="single-action delete"><a href="#"><i class="fa fa-close c-red"></i> Xóa</a></div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    var saveImage = "<?php echo get_template_directory_uri()."/images/save.png" ?>";
    var editImage = "<?php echo get_template_directory_uri()."/images/edit.png" ?>";
     var deleteImage = "<?php echo get_template_directory_uri()."/images/remove.png" ?>";
     var cancelImage = "<?php echo get_template_directory_uri()."/images/back.png" ?>";
     var updateImage = "<?php echo get_template_directory_uri()."/images/save.png" ?>";
var $=jQuery.noConflict();
$(document).ready(function(){

    var oTable = $('#test-table').dataTable();
    oTable.fnDestroy();
    table = $('.child-history .display tbody');
    table.empty();
    $.ajax({
      type: "post",
      dataType: 'json',
      url: a365_ajax.ajax_url,
      data: {
        'action': 'get_child_history'
      },
      success: function(response) {
        //console.log(response);
        if(response.length == 0) {
          ////console.log("Chưa");
          //table.append('<tr><td>Trẻ chưa làm bài sàng lọc nào.</td></tr>');
        } else {
          for(var index in response) {
            //check type
            if(response[index].type == 'mchatr') {
              type = 'M-CHAT R';
            } else if(response[index].type == 'asq') {
              type = 'ASQ';
            } else if(response[index].type == 'qol') {
              type = 'QOL';
            } else if(response[index].type == 'atec') {
              type = 'ATEC';
            } else if(response[index].type == 'gumsue') {
              type = response[index].exercise_name;
            } else type = 'M-CHAT R/F';
            //check status
            if(response[index].end_at != null) {
              status = 'Đã hoàn thành';
            } else status = 'Chưa hoàn thành';
            table.append('<tr>\
                  <td class="child-checkbox"><label class="row-data"><input type="radio" name="history" id="radio-'+ index +'" value="'+ response[index].id +'" test-type="'+ response[index].type +'"></label></td>\
                  <td class="child-test-date"><label class="row-data" for="radio-'+ index +'">' + response[index].begin_at + '</label></td>\
                  <td class="child-test-type"><label class="row-data test-type" for="radio-'+ index +'">' + type + '</label></td>\
                  <td class="child-test-status"><label class="row-data status" for="radio-'+ index +'">' + status + '</label></td>\
                </tr>')
          }
        }

        $('#test-table tfoot th.xxx').each( function () {
          var title = $(this).text();
          $(this).html( '<input style="border: 1px solid black;border-radius: 4px;" type="text" placeholder=" '+title+'" />' );
        } );

        test_table = $('#test-table').DataTable({
            // "scrollX": true,
            // "scrollY": true,
            dom: 'BCrtlip',
            "language": {
                "emptyTable":     "Không có lịch sử để hiển thị cho trẻ hiện tại.",
                "info":           "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                "infoEmpty":      "Hiển thị 0 đến 0 của 0 bản ghi",
                "infoFiltered":   "(Tìm kiếm từ _MAX_ bản ghi)",
                "lengthMenu":     "Hiển thị _MENU_ kết quả/trang",
                "loadingRecords": "Đang tải ...",
                "processing":     "Đang xử lý...",
                "search":         "TÌm kiếm:",
                "zeroRecords":    "Không có bản ghi nào phù hợp",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Trang tiếp",
                    "previous":   "Trang trước"
                }
              }
        });

        // Apply the search
        test_table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        $('.child-history').removeClass('hidden');        
      }, error: function(xhr, ajaxOptions, err) {
        //console.log(err);
      }
    });


  $('.child-history').on('click', 'input:radio', function() {
    if( $('.history-action').hasClass('hidden') ) {
      $('.history-action').removeClass('hidden');
    }

    test_type = $(this).attr('test-type');
    test_id = $(this).val();
    //console.log(test_type+":"+test_id);
     data = {
      'action': 'set_result_id',
      'test_type': test_type,
      'test_id': test_id
    }
    $.ajax({      
      type: 'post',
      dataType: 'json',
      url: a365_ajax.ajax_url,
      data: data,
      success: function(msg) {
        // window.location.href='';
        if( test_type == 'asq' ) {
          link = $('.asq-result-link').attr('link');
        } 
        else if( test_type == 'mchatr' ) {
          link = $('.mchatr-result-link').attr('link');
        } 
        else if( test_type == 'qol' ) {
          link = $('.qol-result-link').attr('link');
        } 
        else if( test_type == 'atec' ) {
          link = $('.atec-result-link').attr('link');
        }
        else if( test_type == 'gumsue' ) {
          link = $('.gumsue-result-link').attr('link');
        }
        else {
          link = $('.mchatrf-result-link').attr('link');
        }
        $('.view-result').attr('href', link);
      }
    })
  })

  $('.delete').click(function(event) {
    current_history = $('input[name=history]:checked').val();
    type = $('input[name=history]:checked').parents().eq(2).find('.child-test-type label').text();
    //console.log(type);
    var data = {
        'action': 'a365_delete_history',
        'current_history': current_history,
        'type' : type
      };
    //console.log(data);
    if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
	    $.ajax({
	      type: 'post',
	      dataType: 'json',
	      url: a365_ajax.ajax_url,
	      data: data,
	      success: function($response) {
	        window.location.reload(true);
	      },
	      error: function(xhrm, ajaxOptions, err) {

	      }
	    });
	}
  });
 })
</script>
</body>
</html>