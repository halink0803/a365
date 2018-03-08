var $=jQuery.noConflict();
$(document).ready(function(){
  $( ".datepicker" ).datepicker( $.datepicker.regional[ "vi" ] );

  // window.onbeforeunload = function(){
  //   //Ajax request to update the database
  //   //console.log();
  //   $.ajax({
  //     action: "update_user_using_time",
  //     type: "post",
  //     url: a365_ajax.ajax_url,
  //     success: function(msg) {
  //     }
  //   })
  // }

  //handle click to choose a child
  $(".child-checkbox input:radio").click(function() {
    var current_child_id = $(this).closest("tr").attr("id");
    //console.log("current_child_id: "+current_child_id);
    $(".action-btn-group a").removeAttr("disabled");
    $(".edit-child").removeClass("hidden");
    $.ajax({
      //action: "get_current_child",
      type: "post",
      dataType: "json",
      url: a365_ajax.ajax_url,
      data: {"action": "get_current_child", "current_child_id" : current_child_id},
      success: function(response) {
        if (response.status != "Không tự kỷ" && response.status != "" && response.status != null) {
          //console.log(response.status);
          $(".tuky").removeClass("disabled");
        }
        else if (response.status == "Không tự kỷ") {
          //console.log(response.status);
          $(".tuky").addClass("disabled");
        }
        else if (response.status == null || response.status == ""){
          //console.log(response.status);
          $(".tuky").addClass("disabled");
        }
        else
          $(".tuky").addClass("disabled");

      }
    })
  });

  $("#childBirth").datepicker({dateFormat: "dd-mm-yy"});
  $("#mChatChildBirth").datepicker({dateFormat: "dd-mm-yy"});

  //Set dialog close as default
  $(".popup_reg_user").dialog({
    autoOpen: false,
    width: "auto",
  })


  // do mchat without login
  $(".mchatNoLogin").click(function(event) {
    var fullname = $("#fullname").val();
    var area = $("#area").val();
    var gender = $("input[name='child_gender']:checked").val();
    var dd = $("#dd").val();
    var mm = $("#mm").val();
    var yyyy = $("#yyyy").val();
    var birthweek = $("#birthweek").val();
    //check empty fields
    if (fullname == ""|| area == "" || gender == "" || dd == "" || mm == "" || yyyy == "" || birthweek == "") {
        $("#notice").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
    } else {
      $data = $("#NoLoginTestForm").serialize();
      //console.log( $data );
      //event.preventDefault();
      $("#notice").html("Vui lòng chờ trong giây lát ...");
      $(".mchatNoLogin").prop("disabled", true);
      $.ajax({
        type: "post",
        dataType: "json",
        url: a365_ajax.ajax_url,
        data: $data + "&action=create_nologin_mchatr",
        success: function(response) {
          //alert("gui thanh cong: "+response);
          window.location.href = response.page;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
        }
      });
    }
  });

  $(".tinhDiemMchatr").click(function(event) {
    var all_answered = true;
      $(".question-answer input:radio").each(function(){
        var name = $(this).attr("name");
        if($("input:radio[name="+name+"]:checked").length == 0)
        {
          all_answered = false;
        }
      });
      if( !all_answered ) {
          alert( "Bạn phải trả lời tất cả câu hỏi để xem kết quả!" );
      } else {
          $("#Modal_User_Info_Without_Login").modal({
            backdrop: "static",
            keyboard: true
          });

          $(".cancel").click(function(event) {
            $("#Modal_User_Info_Without_Login").modal("hide");
          });

          $(".get_result").click(function(event) {
              var age = $("#age").val();
              var role_user = $("#role_user").val();
              var gender = $("input[name='user_gender']:checked").val();
              var other_role = $("#UserJobAdd").val();
              var source = $("#source").val();
              var mobile = $("input[name='phone']").val();
              //check empty fields
              if (source=="" || mobile=="" || age == "" || role_user == "" || gender == "" || (role_user == "Khác" && other_role == "")) {
                $("#notice2").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
              } else {
                $user_info = $("#Get_Result").serialize();
                //console.log( $user_info );
                //event.preventDefault();
                $("#notice2").html("Vui lòng chờ trong giây lát ...");
                $(".get_result").prop("disabled", true);
                $.ajax({
                  type: "post",
                  dataType: "json",
                  url: a365_ajax.ajax_url,
                  data: $user_info + "&action=" + "update_no_login_user_info_mchatr",
                  success: function(response) {
                      $data = $("#TestingManagerBeginTestForm").serialize() + "&action=mchatr_save_result";
                      //console.log( $data );
                      event.preventDefault();
                      $.ajax({
                          type: "post",
                          dataType: "json",
                          url: a365_ajax.ajax_url,
                          data: $data,
                          success: function(response) {
                              window.location.href = response.page;
                          },
                          error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                          }
                      });
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                      alert(xhr.status);
                      alert(thrownError);
                  }
                });
              }
            });
          }
  });

  /**
   * Delete a child
   * @param  {[type]} event) {                                  $current_child [description]
   * @param  {[type]} error: function(xhrm, ajaxOptions, err) {                                 }    });  } [description]
   * @return {[type]}        [description]
   */
  $(".deleteChild").click(function(event) {
    $current_child = $("input[name=child]:checked").val();
    //console.log($current_child);
    var $data = {
        "action": "a365_delete_child",
        "current_child": $current_child
      };
    $.ajax({
      type: "post",
      dataType: "json",
      url: a365_ajax.ajax_url,
      data: $data,
      success: function($response) {
        window.location.reload(true);
      },
      error: function(xhrm, ajaxOptions, err) {

      }
    });
  });

  /**
   * delete test history
   * @param  {[type]} event) {                                  current_history [description]
   * @param  {[type]} error: function(xhrm, ajaxOptions, err) {                                  }    });  } [description]
   * @return {[type]}        [description]
   */
  $(".deleteHistory").click(function(event) {
    current_history = $("input[name=history]:checked").val();
    type = $("input[name=history]:checked").parents().eq(2).find(".child-test-type label").text();
    //console.log(type);
    var data = {
        "action": "a365_delete_history",
        "current_history": current_history,
        "type" : type
      };
    //console.log(data);
    $.ajax({
      type: "post",
      dataType: "json",
      url: a365_ajax.ajax_url,
      data: data,
      success: function($response) {
        window.location.reload(true);
      },
      error: function(xhrm, ajaxOptions, err) {

      }
    });
  });

  $(".diagnose-information input").on("change", function() {
    if( $(this).val() == 1) {
      $(".diagnose-result").removeClass("hidden");
      $(".diagnose-age").removeClass("hidden");
      $(".diagnose-place").removeClass("hidden");
      $(".diagnose-person").removeClass("hidden");
    } else {
      $(".diagnose-result").addClass("hidden");
      $(".diagnose-age").addClass("hidden");
      $(".diagnose-place").addClass("hidden");
      $(".diagnose-person").addClass("hidden");
    }
  });

  $("#number_per_page").change(function() {
    url = window.location.href;
    number = $("#number_per_page option:selected").val();
    url = updateQueryStringParameter(url, "amount", number);
    window.location.href = url;
  });

  // do test without login
  $(".noLogin").click(function(event) {
    $("#Modal_ASQ_Without_Login").modal("show");
  });

  // do ASQ without login
  $(".asqNoLogin").click(function(event) {
    var fullname = $("#fullname").val();
    var area = $("#area").val();
    var gender = $("input[name='child_gender']:checked").val();
    var dd = $("#dd").val();
    var mm = $("#mm").val();
    var yyyy = $("#yyyy").val();
    var birthweek = $("#birthweek").val();
    //check empty fields
    if (fullname == ""|| area == "" || gender == "" || dd == "" || mm == "" || yyyy == "" || birthweek == "") {
        $("#notice").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
    } else {
      $data = $("#NoLoginTestForm").serialize();
      //console.log( $data );
      //event.preventDefault();
      $("#notice").html("Vui lòng chờ trong giây lát ...");
      $(".asqNoLogin").prop("disabled", true);
      $.ajax({
        type: "post",
        dataType: "json",
        url: a365_ajax.ajax_url,
        data: $data + "&action=create_nologin_asq",
        success: function(response) {
          //alert("gui thanh cong: "+response);
          window.location.href = response.page;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
        }
      });
    }
  });

  $(".score-asq").click(function(event) {
    event.preventDefault();
    //console.log(validateForm());
    if(validateForm() == true) {
      console.log(login);
      if (login == 0){
        $("#Modal_User_Info_Without_Login").modal({
            backdrop: "static",
            keyboard: true
        });

        $(".cancel").click(function(event) {
            $("#Modal_User_Info_Without_Login").modal("hide");
        });

        $(".get_result").click(function(event) {
          var age = $("#child_age").val();
          var role_user = $("#role_user").val();
          var gender = $("input[name='user_gender']:checked").val();
          var other_role = $("#UserJobAdd").val();
          //check empty fields
          if (age == "" || role_user == "" || gender == "" || (role_user == "Khác" && other_role == "")) {
            $("#notice2").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
          } else {
            $user_info = $("#Get_Result").serialize();
            //console.log( $user_info );
            //event.preventDefault();
            $("#notice2").html("Vui lòng chờ trong giây lát ...");
            $(".get_result").prop("disabled", true);
            $.ajax({
              type: "post",
              dataType: "json",
              url: a365_ajax.ajax_url,
              data: $user_info + "&action=" + "update_no_login_user_info",
              success: function(response) {
                  $data = $("#TestingManagerBeginTestForm").serialize();
                  //console.log( $data );
                  //event.preventDefault();
                  $.ajax({
                    type: "post",
                    dataType: "json",
                    url: a365_ajax.ajax_url,
                    data: $data + "&action=" + "calculate_score",
                    success: function(response) {
                      //alert("gui thanh cong: "+response);
                      window.location.href = response.page;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                  });
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
              }
            });
          }
        });
      }
      else {
        $data = $("#TestingManagerBeginTestForm").serialize();
        //console.log( $data );
        //event.preventDefault();
        $("#notice2").html("Vui lòng chờ trong giây lát ...");
        $(".score-asq").prop("disabled", true);
        $.ajax({
          type: "post",
          dataType: "json",
          url: a365_ajax.ajax_url,
          data: $data + "&action=" + "calculate_score",
          success: function(response) {
            //alert("gui thanh cong: "+response);
            window.location.href = response.page;
          },
          error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
          }
        });

        }
      }
    }
  )

  $(".history").click(function(event) {
    var oTable = $("#test-table").dataTable();
    oTable.fnDestroy();
    table = $(".child-history .display tbody");
    table.empty();
    $.ajax({
      type: "post",
      dataType: "json",
      url: a365_ajax.ajax_url,
      data: {
        "action": "get_child_history"
      },
      success: function(response) {
        //console.log(response);
        if(response.length == 0) {
          ////console.log("Chưa");
          //table.append("<tr><td>Trẻ chưa làm bài sàng lọc nào.</td></tr>");
        } else {
          for(var index in response) {
            //check type
            if(response[index].type == "mchatr") {
              type = "M-CHAT R";
            } else if(response[index].type == "asq") {
              type = "ASQ";
            } else if(response[index].type == "qol") {
              type = "QOL";
            } else if(response[index].type == "atec") {
              type = "ATEC";
            } else if(response[index].type == "gumsue") {
              type = response[index].exercise_name;
            } else type = "M-CHAT R/F";
            //check status
            if(response[index].end_at != null) {
              status = "Đã hoàn thành";
            } else status = "Chưa hoàn thành";
            table.append('<tr>\
                  <td class="child-checkbox"><label class="row-data"><input type="radio" name="history" id="radio-'+ index +'" value="'+ response[index].id +'" test-type="'+ response[index].type +'"></label></td>\
                  <td class="child-test-date"><label class="row-data" for="radio-'+ index +'">' + response[index].begin_at + '</label></td>\
                  <td class="child-test-type"><label class="row-data test-type" for="radio-'+ index +'">' + type + '</label></td>\
                  <td class="child-test-status"><label class="row-data status" for="radio-'+ index +'">' + status + '</label></td>\
                </tr>')
          }
        }

        $("#test-table tfoot th.xxx").each( function () {
          var title = $(this).text();
          $(this).html( '<input style="border: 1px solid black;border-radius: 4px;" type="text" placeholder=" '+title+'" />' );
        } );

        test_table = $("#test-table").DataTable({
            // "scrollX": true,
            // "scrollY": true,
            dom: "BCrtlip",
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
            $( "input", this.footer() ).on( "keyup change", function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        $(".child-history").removeClass("hidden");
      }, error: function(xhr, ajaxOptions, err) {
        //console.log(err);
      }
    })
  })

  $(".child-history").on("click", "input:radio", function() {
    if( $(".history-action").hasClass("hidden") ) {
      $(".history-action").removeClass("hidden");
    }

    ////console.log($(this).closest("tr").find(".status").text());
    if( $(this).closest("tr").find(".status").text() == "Chưa hoàn thành") {
      $("#lamtiep").removeClass("disabled");
      $("#lamtiep").removeClass("hidden");
    }
    else{
      $("#lamtiep").addClass("disabled");
    }

    test_type = $(this).attr("test-type");
    test_id = $(this).val();
    link2 = "";
    //console.log(test_type+":"+test_id);
     data = {
      "action": "set_result_id",
      "test_type": test_type,
      "test_id": test_id
    }
    $.ajax({
      type: "post",
      dataType: "json",
      url: a365_ajax.ajax_url,
      data: data,
      success: function(msg) {
        // window.location.href="";
        if( test_type == "asq" ) {
          link = $(".asq-result-link").attr("link");
          link2 = $(".asq-continue-link").attr("link");
        }
        else if( test_type == "mchatr" ) {
          link = $(".mchatr-result-link").attr("link");
        }
        else if( test_type == "qol" ) {
          link = $(".qol-result-link").attr("link");
          link2 = $(".qol-continue-link").attr("link");
        }
        else if( test_type == "atec" ) {
          link = $(".atec-result-link").attr("link");
          link2 = $(".atec-continue-link").attr("link");
        }
        else if( test_type == "gumsue" ) {
          link = $(".gumsue-result-link").attr("link");
        }
        else {
          link = $(".mchatrf-result-link").attr("link");
        }
        $(".view-result").attr("href", link);
        $(".continue-test").attr("href", link2);
      }
    })
  })

  $(".next_question").click(function() {
    // question_id = $("");
    var all_answered = true;
    $("input:radio").each(function(){
      var name = $(this).attr("name");
      if($("input:radio[name="+name+"]:checked").length == 0)
      {
        all_answered = false;
      }
    });
    if( !all_answered ) {
        alert( "Bạn phải trả lời tất cả câu hỏi để xem kết quả!" );
    } else {
      question_number = $(".current_question").attr("current_question");
      follow_question = $(".follow-question-number").attr("question_number");
      answer = $("#follow_question").serialize();
      $.ajax({
        type: "post",
        dataType: "json",
        url: a365_ajax.ajax_url,
        data: answer + "&action=load_follow_up_question" + "&question_number=" + question_number + "&follow_question=" + follow_question,
        // {
        //   "action": "load_follow_up_question",
        //   "question_number": question_number,
        //   "follow_question": follow_question
        // },
        success: function(response) {
          if( response.content == "" ) {
            $.ajax({
              type: "post",
              dataType: "json",
              url: a365_ajax.ajax_url,
              data: {
                "action" : "a365_update_mchatrf_result"
              },
              success: function(response) {
                //console.log(response);
                url = $(".result-page").attr("result_url");
                window.location.href = url;
              }
            });
          } else {
            $(".follow-question-number").empty();
            // $(".follow-question-number").html(response.number);
            $(".follow-question-number").attr("question_number", response.number);
            $(".follow-question-content").html(response.content);
            $(".question_options table").empty();
            if( (response.question_number == "10" & response.number == 2) ||
                (response.question_number == "11" & response.number == 2) ||
                (response.question_number == "12" & response.number == 3) ||
                (response.question_number == "16" & response.number == 2) ||
                (response.question_number == "1" & response.number == 2)) {
              $(".question_options table").append("<tr>");
              for(var index in response.options) {
              $(".question_options table").append('\
                                        <th style="vertical-align: bottom; font-weight: normal;">\
                                            ' + response.options[index] + '<input style="display: block; margin-left: 50px;" type="radio" name="option-0" value="'+ (1 - index) +'">\
                                        </th>');
              }
              $(".question_options table").append("</tr>");
            }else if( (response.question_number == "2" & response.number == 3) ) {
              for(var index in response.options) {
              $(".question_options table").append('\
                                        <div style="font-weight: normal;">\
                                            <input type="radio" name="option-0" value="'+ index +'">'+ response.options[index] +'\
                                        </div>');
              }
            } else {
              for(var index in response.options) {
                $(".question_options table").append('<tr><th style="width: 80%; padding-right: 20px;">\
                                              <label for="follow_question" style="font-weight: normal;">'+ response.options[index] +'</label>\
                                          </th>\
                                          <th style="vertical-align: top; font-weight: normal;">\
                                              <input type="radio" name="option-'+ index +'" value="1"> Có\
                                          </th><th style="vertical-align: top; font-weight: normal;">\
                                              <input type="radio" name="option-'+ index +'" value="0"> Không\
                                          </th></tr>');
              }
              if(response.options.length == 0) {
                $(".question_options table").append('\
                                          <th style="font-weight: normal;">\
                                              <input type="radio" name="option-'+ 0 +'" value="1"> Có\
                                          </th><th style="font-weight: normal;">\
                                              <input type="radio" name="option-'+ 0 +'" value="0"> Không\
                                          </th>');
              }
            }
            $(".current_question").attr("current_question", response.question_number);
            $(".current_question").empty();
            $(".current_question").html("Câu " + response.question_number +":");
            $(".question-content").empty();
            $(".question-content").html(response.pre_question);
            if( response.pre_answer == "0" ) {
              answer = "Không";
            } else {
              answer = "Có";
            }
            $(".your-answer").empty().html("Câu trả lời của bạn: " + answer);
          }
        }, error: function(XMLHttpRequest, textStatus, errorThrown) {
            //console.log("Status: " + textStatus);
            //console.log("Error: " + errorThrown);
        }
      });
    }
  });

  $(".previous_question").click(function() {

  });
});

/**
 * Print result using browser options
 * @return null
 */
function printDiv() {
  var divToPrint = document.getElementById("siteContent");
  var popupWin = window.open("","_blank");
  popupWin.document.open();
  popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
  popupWin.document.close();
}

/**
 * Confirm close test window
 * @return {[type]} [description]
 */
function close_window() {
    if (confirm("Bạn có chắc chắn thoát trang này ?")) {
      window.location.href = "<?php echo home_url("/"); ?>";
   }
}

/**
 * Save test answer
 * @return null
 */
//handle click to save test
function save_all_click_out(name_of_test) {
  var action = "";
  switch(name_of_test) {
    case "asq":
        action = "asq_save_and_exit";
        break;
    case "mchat":
        action = "mchat_save_and_exit";
        break;
    case "qol":
        action = "qol_save_and_exit";
        break;
    case "atec":
        action = "atec_save_and_exit";
        break;
  }
  //console.log(action);
  $cache = $("#TestingManagerBeginTestForm").serialize();
  //console.log($("#TestingManagerBeginTestForm").serialize());
  $.ajax({
    //action: action,
    type: "POST",
    dataType: "json",
    url: a365_ajax.ajax_url,
    data: $cache + "&action=" + action,
    success: function (response) {
      if (confirm("Bạn có chắc chắn thoát trang này ?")) {
          window.location.href = "../quan-ly-tre";
      }
    }
  })
}

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf("?") !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, "$1" + key + "=" + value + "$2");
  }
  else {
    return uri + separator + key + "=" + value;
  }
}
