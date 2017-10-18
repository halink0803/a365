<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: manager_test
 *
 * @package A356
 */
if(!empty($_POST['giao_tiep'])){
	echo "đã chạy";
}
save_test($_POST['giao_tiep'], $_POST['van_dong_tho'], $_POST['van_dong_tinh'], $_POST['giai_quyet'], $_POST['ca_nhan'], $_POST['tong_ket'], $_POST['tong_ket_text']);
?>