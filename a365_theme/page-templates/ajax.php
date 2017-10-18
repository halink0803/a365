<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: ajax
 * @package A356
 */
get_header('admin');
?>
<?php
	require_once( "db-interaction.php" );
	
	if($_GET['table']=="a365_children"){
		$obj2 = new ajax_table("a365_children");
    	$records2 = $obj2->getRecordsForChidrenManagerById($_GET['q']);

    	echo '<table id="a365_children" class="display" cellspacing="0" width="100%">
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
        ';
       	if(count($records2)){
            $i = 1;    
            foreach($records2 as $key=>$eachRecord){
               
       
            echo    '<tr id="'.$eachRecord['id'].'">';
            echo    '<td>'.$eachRecord['id'].'</td>';
            echo    '<td class="name">'.$eachRecord['name'].'</td>';
            echo    '<td class="sex">'.$eachRecord['sex'].'</td>';
            echo    '<td class="date_of_birth">'.formatDate($eachRecord['date_of_birth']).'</td>';
            echo    '<td class="created_at">'.formatDate($eachRecord['created_at']).'</td>';
            echo    '<td class="child_status">'.$eachRecord['child_status'].'</td>';
            echo    '<td>'.$eachRecord['user_id'].'</td>';
            echo    '<td class="email">'.$eachRecord['email'].'</td>';
            echo    '<td>
                    <a href="javascript:;" id="'.$eachRecord['id'].'" class="ajaxEdit"><img src="http://localhost/wordpress/wp-content/themes/a365_theme/images/edit.png" class="eimage"></a>
                    <a href="javascript:;" id="'.$eachRecord['id'].'" class="ajaxDelete"><img src="http://localhost/wordpress/wp-content/themes/a365_theme/images/remove.png" class="dimage"></a>
                </td>
            </tr>';
        	}
        }
    	echo '</tbody></table>';
	}

	if($_GET['table']=="a365_children_report"){
		$obj2 = new ajax_table("a365_children");
    	$records2 = $obj2->getRecordsForChidrenManagerById($_GET['q']);

    	echo '<table id="a365_children_report" class="display" cellspacing="0" width="100%">
        <thead>
             <tr>
                <th>Id trẻ</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Ngày tạo</th>
                <th>Chẩn đoán</th>
                <th>Id người dùng</th>
                <th>Email</th>
            </tr>
        </thead>
        <tfoot>
             <tr>
                <th>Id trẻ</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Ngày tạo</th>
                <th>Chẩn đoán</th>
                <th>Id người dùng</th>
                <th>Email</th>
            </tr>
        </tfoot>
        <tbody>
        ';
       	if(count($records2)){
            $i = 1;    
            foreach($records2 as $key=>$eachRecord){
       
            echo    '<tr id="'.$eachRecord['id'].'">';
            echo    '<td>'.$eachRecord['id'].'</td>';
            echo    '<td class="name">'.$eachRecord['name'].'</td>';
            echo    '<td class="date_of_birth">'.formatDate($eachRecord['date_of_birth']).'</td>';
            echo    '<td class="sex">'.$eachRecord['sex'].'</td>';
            echo    '<td class="created_at">'.formatDate($eachRecord['created_at']).'</td>';
            echo    '<td class="child_status">'.$eachRecord['child_status'].'</td>';
            echo    '<td>'.$eachRecord['user_id'].'</td>';
            echo    '<td class="email">'.$eachRecord['email'].'</td>';
        	}
        }
    	echo '</tbody></table>';
	}

    if($_GET['table']=="a365_sangloc"){
        $obj3 = new ajax_table("a365_sangloc");
        $records3 = $obj3->getRecordsForSangloc("a365_asq_results", $_GET['q']);
        $obj4 = new ajax_table("");
        $records4 = $obj4->getRecordsForSangloc("a365_mchatr_results", $_GET['q']);
        $obj5 = new ajax_table("");
        $records5 = $obj5->getRecordsForSangloc("a365_mchatrf_results", $_GET['q']);
        $obj6 = new ajax_table("");
        $records6 = $obj6->getRecordsForSangloc("a365_atec_results", $_GET['q']);

        echo '<table id="a365_sangloc" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id người dùng</th>
                <th>Tên người dùng</th>
                <th>Bài sàng lọc</th>
                <th>Ngày làm bài</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id người dùng</th>
                <th>Tên người dùng</th>
                <th>Bài sàng lọc</th>
                <th>Ngày làm bài</th>
                <th>Trạng thái</th>
            </tr>
        </tfoot>
        <tbody>
        ';
        if(count($records3)){
            $i = 1;    
            foreach($records3 as $key=>$eachRecord){
       
            echo '<tr id="'.$eachRecord['creator_id'].'">';
            echo    '<td>'.$eachRecord['creator_id'].'</td>';
            echo    '<td class="creator_id">'.$eachRecord['name'].'</td>';
            echo    '<td class="created_order"> ASQ '.$eachRecord['asq_set'].' tháng</td>';
            echo    '<td class="name">'.$eachRecord['begin_at'].'</td>';
            if($eachRecord['end_at']!= NULL)
                echo "<td>Đã hoàn thành</td>";
            else
                echo "<td>Chưa hoàn thành</td>";

            echo    '</tr>';
            }
        }
        if(count($records4)){
            $i = 1;    
            foreach($records4 as $key=>$eachRecord){
       
            echo '<tr id="'.$eachRecord['creator_id'].'">';
            echo    '<td>'.$eachRecord['creator_id'].'</td>';
            echo    '<td class="creator_id">'.$eachRecord['name'].'</td>';
            echo    '<td class="created_order">MCHATR</td>';
            echo    '<td class="name">'.$eachRecord['begin_at'].'</td>';
            if($eachRecord['end_at']!= NULL)
                echo "<td>Đã hoàn thành</td>";
            else
                echo "<td>Chưa hoàn thành</td>";

            echo    '</tr>';
            }
        }
        if(count($records5)){
            $i = 1;    
            foreach($records5 as $key=>$eachRecord){
       
            echo '<tr id="'.$eachRecord['creator_id'].'">';
            echo    '<td>'.$eachRecord['creator_id'].'</td>';
            echo    '<td class="creator_id">'.$eachRecord['name'].'</td>';
            echo    '<td class="created_order">MCHAT R/F</td>';
            echo    '<td class="name">'.$eachRecord['begin_at'].'</td>';
            if($eachRecord['end_at']!= NULL)
                echo "<td>Đã hoàn thành</td>";
            else
                echo "<td>Chưa hoàn thành</td>";

            echo    '</tr>';
            }
        }
        if(count($records6)){
            $i = 1;    
            foreach($records6 as $key=>$eachRecord){
       
            echo '<tr id="'.$eachRecord['creator_id'].'">';
            echo    '<td>'.$eachRecord['creator_id'].'</td>';
            echo    '<td class="creator_id">'.$eachRecord['name'].'</td>';
            echo    '<td class="created_order">MCHAT R/F</td>';
            echo    '<td class="name">'.$eachRecord['begin_at'].'</td>';
            if($eachRecord['end_at']!= NULL)
                echo "<td>Đã hoàn thành</td>";
            else
                echo "<td>Chưa hoàn thành</td>";

            echo    '</tr>';
            }
        }
        echo '</tbody></table>';
    }
    


	if(isset($_POST) && count($_POST)){
		
		// whats the action ??

		$action = $_POST['action'];
		unset($_POST['action']);

		// whats the table ??

		$table_name = $_POST['table'];
		unset($_POST['table']);

		$obj = new ajax_table($table_name);

		if($action == "save"){		
			// remove 'action' key from array, we no longer need it

			// Never ever believe on end user, he could be a evil minded
			$escapedPost = array_map('mysql_real_escape_string', $_POST);
			$escapedPost = array_map('htmlentities', $escapedPost);
				
			$res = $obj->save($escapedPost);
			
			if($res){
				$escapedPost["success"] = "1";
				$escapedPost["id"] = $res;
				echo json_encode($escapedPost);
			}
			else
				echo $obj->error("save");
		}else if($action == "del"){
			$id = $_POST['rid'];
			$res = $obj->delete_record($id);
			if($res)
				echo json_encode(array("success" => "1","id" => $id));	
			else
				echo $obj->error("delete");
		}
		else if($action == "update"){
			
			$escapedPost = array_map('mysql_real_escape_string', $_POST);
			$escapedPost = array_map('htmlentities', $escapedPost);

			$id = $obj->update_record($escapedPost);
			if($id)
				echo json_encode(array_merge(array("success" => "1","id" => $id),$escapedPost));	
			else
				echo $obj->error("update");
		}
		else if($action == "updatetd"){
			
			$escapedPost = array_map('mysql_real_escape_string', $_POST);
			$escapedPost = array_map('htmlentities', $escapedPost);

			$id = $obj->update_column($escapedPost);
			if($id)
				echo json_encode(array_merge(array("success" => "1","id" => $id),$escapedPost));	
			else
				echo $obj->error("updatetd");
		}
	}
?>