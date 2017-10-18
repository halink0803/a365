<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: export db to excel
 *
 * @package A356
 */

/***** EDIT BELOW LINES *****/
$DB_Server = "localhost"; // MySQL Server
$DB_Username = "root"; // MySQL Username
$DB_Password = "Gladiolus"; // MySQL Password
$DB_DBName = "wordpress"; // MySQL Database Name
$DB_TBLName = "a365_atec_questions"; // MySQL Table Name
$xls_filename = 'export_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
/***** DO NOT EDIT BELOW LINES *****/
// Create MySQL connection
$sql = "select a365_asq_results.*, a365_children.id as chil_id, a365_children.creator_id as chil_creator_id, a365_children.name as chil_name, a365_children.sex as chil_sex, a365_children.date_of_birth as chil_date_of_birth, a365_children.week_of_birth as chil_week_of_birth, a365_users.id as user_id, a365_users.email as user_email, a365_users.name as user_name, a365_users.sex as user_sex, a365_users.type as user_type, a365_users.area_code as user_area_code, a365_users.year_of_birth as user_birth, a365_users.child_relationship as user_child_relationship, a365_users.educational_level as user_education_level, a365_users.occupation as user_occupation, a365_users.phone as user_phone, a365_users.address as user_address, a365_users.work_place as user_work_place
    from a365_asq_results
    LEFT JOIN a365_users ON a365_asq_results.creator_id = a365_users.id 
    LEFT JOIN a365_children ON a365_asq_results.child_id = a365_children.id";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
// Select database
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $Connect);

$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
// Execute query
$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());

$fields = array();
for ($i = 0; $i<mysql_num_fields($result); $i++) {
  array_push($fields, mysql_field_name($result, $i));
}
$csv = join("\t", $fields)."\r\n";
  while($row = mysql_fetch_row($result))
{
  $schema_insert = array();
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      array_push($schema_insert, 'NULL');
    }
    elseif ($row[$j] != "") {
      array_push($schema_insert, $row[$j]);
    }
    else {
       array_push($schema_insert, "");
    }

  }
  
    $csv .= join("\t",$schema_insert)."\r\n";
  // fputcsv($fp, array("Cars", "mẹ", "chú"), ",");
  // fputcsv($fp, array("12", "2", "6"), ",");
  // fputcsv($fp, array("23", "3", "5"), ",");
  // fputcsv($fp, array("31", "5", "8"), ",");
}
 $csv = chr(255).chr(254).mb_convert_encoding($csv, "UTF-16LE", "UTF-8");
  header("Content-type: application/x-msdownload");
  header("Content-disposition: csv; filename=" . date("Y-m-d") .
  "_order_list.csv; size=".strlen($csv));
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $csv;
  exit();

?>
