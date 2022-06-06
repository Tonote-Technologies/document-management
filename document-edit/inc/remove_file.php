<?php require_once('../../private/initialize.php');


$filename = $_POST['filename'] ?? "";
$path = '../upload/raw_files/';

if (unlink($path.$filename)) {
	exit(json_encode(['success' => true, 'msg' => 'The file ' . $filename . ' was deleted successfully!']));
} else {
	exit(json_encode(['success' => false, 'msg' => 'There was a error deleting the file ' . $filename]));
}

?>