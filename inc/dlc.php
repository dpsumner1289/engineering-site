<?php
	include '../../../../wp-load.php';
	$dlc_id = sanitize_text_field($_GET['dlc']);
	$file_id = get_post_meta($dlc_id, 'dlc_file', true);
	$file_url = wp_get_attachment_url($file_id);
	$path = get_attached_file($file_id);

    // Output CSV-specific headers
    header('Content-Encoding: UTF-8');
    header('Content-type: application/pdf; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');

    // Disable caching
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
    header("Pragma: no-cache"); // HTTP 1.0
    header("Expires: 0"); // Proxies
    readfile($file_url);    
?>