<?php   require_once('../../private/initialize.php'); ?>

<?php  
// echo $loggedInAdmin->id;
$id = $_POST['user_id'] ?? $loggedInAdmin->id;
$user = Admin::find_by_id($id);
$fullName = $user->full_name() ?? "Not Set";

$words = explode(" ", $fullName);
$initial = "";

foreach ($words as $w) {
  $initial .= $w[0];
}


$signature = SignatureDetail::find_by_user_id($id);
$signature_id = $signature[0]->signature_id ?? '';
                
// pre_r($signature);



?>