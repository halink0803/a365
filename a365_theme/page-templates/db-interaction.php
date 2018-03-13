<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$table_name = "";

class ajax_table {

  public function __construct($table){
	$this->dbconnect();
	global $table_name;
	$table_name = $table;
  }

  private function dbconnect() {
    $conn = mysql_connect('localhost', 'root', 'Matkh@u123')
      or die ("<div style='color:red;'><h3>Could not connect to MySQL server</h3></div>");
   	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);
    mysql_select_db('wordpress',$conn)
      or die ("<div style='color:red;'><h3>Could not select the indicated database</h3></div>");

    return $conn;
  }

  function getRecords(){
  	global $table_name;
	$this->res = mysql_query("select * from $table_name");

	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForChidrenManager(){
	$this->res = mysql_query("select a365_children.*, a365_diagnostic_statuses.child_status, a365_users.id as user_id, a365_users.email from a365_children JOIN a365_users ON a365_children.creator_id = a365_users.id  JOIN a365_diagnostic_statuses ON a365_diagnostic_statuses.child_id = a365_children.id");

	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

   function getRecordsForChidrenManagerById($id){
	$this->res = mysql_query("select a365_children.*, a365_diagnostic_statuses.child_status, a365_users.id as user_id, a365_users.email from a365_children LEFT JOIN a365_users ON a365_children.creator_id = a365_users.id LEFT JOIN a365_diagnostic_statuses ON a365_diagnostic_statuses.child_id = a365_children.id where a365_users.id = '$id'");

	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForChidrenReport(){
	$this->res = mysql_query("select a365_children.*, a365_diagnostic_statuses.child_status, a365_diagnostic_statuses.age_at_diagnose, a365_diagnostic_statuses.diagnosed_at, a365_diagnostic_statuses.diagnose_by, a365_diagnostic_statuses.diagnosed_on, a365_users.id as user_id, a365_users.email from a365_children INNER JOIN a365_users ON a365_children.creator_id = a365_users.id LEFT JOIN a365_diagnostic_statuses ON a365_diagnostic_statuses.child_id = a365_children.id");

	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

   function getRecordsForBaitapcanthiepReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_intervention_exercise.exercise_name, a365_intervention_exercise.view_at, a365_children.*, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_intervention_exercise, a365_users, a365_children
		where a365_intervention_exercise.user_id = a365_users.id
		and a365_intervention_exercise.child_id = a365_children.id");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("baitapcanthiep-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForTheodoicanthiepReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_intervention_gumsue.exercise_name, a365_intervention_gumsue.begin_at, a365_intervention_gumsue.end_at, a365_intervention_gumsue.result, a365_children.*, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_intervention_gumsue, a365_users, a365_children
		where a365_intervention_gumsue.user_id = a365_users.id
		and a365_intervention_gumsue.child_id = a365_children.id");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("theodoicanthiep-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

//Thống kê bài tập can thiệp theo cặp
  function getRecordsForBaitapcanthiepTheocapReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_intervention_exercise.exercise_name, a365_intervention_exercise.view_at, a365_children.*, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place, COUNT(*) AS total_view
		from a365_intervention_exercise
		JOIN a365_users ON a365_intervention_exercise.user_id = a365_users.id
		JOIN a365_children ON a365_intervention_exercise.child_id = a365_children.id
		GROUP BY a365_intervention_exercise.exercise_name, a365_children.id");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("thongketheocap-baitapcanthiep-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

   function getRecordsForAdminAsqReport(){

  	global $table_name;
	$this->res = mysql_query("select
		a365_asq_results.*,
		a365_children.id as chil_id,
		a365_children.creator_id as chil_creator_id,
		a365_children.name as chil_name,
		a365_children.sex as chil_sex,
		a365_children.date_of_birth as chil_date_of_birth,
		a365_children.week_of_birth as chil_week_of_birth,
		a365_users.email as user_email,
		a365_users.name as user_name,
		a365_users.sex as user_sex,
		a365_users.type as user_type,
		a365_users.area_code as user_area_code,
		a365_users.year_of_birth as user_birth,
		a365_users.child_relationship as user_child_relationship,
		a365_users.educational_level as user_education_level,
		a365_users.occupation as user_occupation,
		a365_users.phone as user_phone,
		a365_users.address as user_address,
		a365_users.work_place as user_work_place
		from a365_asq_results, a365_users, a365_children
		where a365_asq_results.creator_id = a365_users.id
		and a365_asq_results.child_id = a365_children.id
		and a365_asq_results.end_at IS NOT NULL");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		//echo json_encode($this->records);
		$myfile = fopen("asq-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForAdminMchatrReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_mchatr_results.*, a365_children.id as chil_id, a365_children.name as chil_name, a365_children.sex as chil_sex, a365_children.date_of_birth as chil_date_of_birth, a365_children.week_of_birth as chil_week_of_birth, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_mchatr_results
		left join a365_users on a365_mchatr_results.creator_id = a365_users.id
		left join a365_children on a365_mchatr_results.child_id = a365_children.id
		where a365_mchatr_results.end_at IS NOT NULL");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("mchatr-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForAdminMchatrfReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_mchatrf_results.*, a365_children.id as chil_id, a365_children.creator_id as chil_creator_id, a365_children.name as chil_name, a365_children.sex as chil_sex, a365_children.date_of_birth as chil_date_of_birth, a365_children.week_of_birth as chil_week_of_birth, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_mchatrf_results
		left join a365_users on a365_mchatrf_results.creator_id = a365_users.id
		left join a365_children on a365_mchatrf_results.child_id = a365_children.id
		where a365_mchatrf_results.end_at IS NOT NULL");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("mchatrf-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForAdminAtecReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_atec_results.*, a365_children.id as chil_id, a365_children.creator_id as chil_creator_id, a365_children.name as chil_name, a365_children.sex as chil_sex, a365_children.date_of_birth as chil_date_of_birth, a365_children.week_of_birth as chil_week_of_birth, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_atec_results
		left join a365_users on a365_atec_results.creator_id = a365_users.id
		left join a365_children on a365_atec_results.child_id = a365_children.id
		where a365_atec_results.end_at IS NOT NULL");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("atec-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForAdminQolReport(){

  	global $table_name;
	$this->res = mysql_query("select a365_qol_results.*, a365_children.id as chil_id, a365_children.creator_id as chil_creator_id, a365_children.name as chil_name, a365_children.sex as chil_sex, a365_children.date_of_birth as chil_date_of_birth, a365_children.week_of_birth as chil_week_of_birth, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
		from a365_qol_results
		left join a365_users on a365_qol_results.creator_id = a365_users.id
		left join a365_children on a365_qol_results.child_id = a365_children.id
		where a365_qol_results.end_at IS NOT NULL");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		$myfile = fopen("qol-report.txt", "w+") or die("Unable to open file: ");
		fwrite($myfile, '{"data":'.json_encode($this->records).'}');
		fclose($myfile);
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForSangloc($table,$id){
  	//$id = "A0100007860001";
	$this->res = mysql_query("select * from $table join a365_users on $table.creator_id = a365_users.id where child_id = '$id'");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsForAdminAsqReportById($id){

  	global $table_name;
	$this->res = mysql_query("select a365_asq_results.*, a365_children.name, a365_children.date_of_birth, a365_children.week_of_birth, a365_users.email, a365_users.name as user_name from a365_asq_results LEFT JOIN a365_users
		ON a365_asq_results.creator_id = a365_users.id LEFT JOIN a365_children
		ON a365_asq_results.child_id = a365_children.id
		WHERE a365_asq_results.id = $id");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

  function getRecordsByCreator_Id($id){
  	global $table_name;
	$this->res = mysql_query("select * from $table_name where creator_id = '$id'");

	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
	//else echo "No records found";
  }

  function save($data){
	if(count($data)){
		$values = implode("','", array_values($data));
		global $table_name;
		mysql_query("insert into $table_name (".implode(",",array_keys($data)).") values ('".$values."')");

		if(mysql_insert_id()) return mysql_insert_id();
		return 0;
	}
	else return 0;
  }

  function delete_record($id){
	 if($id){
	 	global $table_name;
		mysql_query("delete from $table_name where id = '$id'");
		return mysql_affected_rows();
	 }
  }

  function update_record($data){
	if(count($data)){
		global $table_name;
		$id = $data['rid'];
		unset($data['rid']);
		$values = implode("','", array_values($data));
		$str = "";
		foreach($data as $key=>$val){
			$str .= $key."='".$val."',";
		}
		$str = str_replace("fname","name",substr($str,0,-1));
		$sql = "update $table_name set $str where id = '$id'";

		$res = mysql_query($sql);

		if(mysql_affected_rows()) return $id;
		return 0;
	}
	else return 0;
  }

  function update_column($data){
	if(count($data)){
		global $table_name;
		$id = $data['rid'];
		unset($data['rid']);
		$sql = "update $table_name set ".key($data)."='".$data[key($data)]."' where id = '$id'";
		$res = mysql_query($sql);
		if(mysql_affected_rows()) return $id;
		return 0;

	}
  }

  function error($act){
	return json_encode(array("success" => "0","action" => $act));
  }

  function countAsq(){
	$this->res = mysql_query("select count(*) as count from a365_asq_results");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
  }

  function countMchatr(){
	$this->res = mysql_query("select count(*) as count from a365_mchatr_results");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
  }

  function countMchatrf(){
	$this->res = mysql_query("select count(*) as count from a365_mchatrf_results");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
  }

  function countAtec(){
	$this->res = mysql_query("select count(*) as count from a365_atec_results");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
  }

  function getRecordsAsqQuestions(){
	$this->res = mysql_query("select * from a365_asq_questions");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record;
		}
		return $this->records;
	}
  }

}
?>