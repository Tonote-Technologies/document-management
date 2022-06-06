<?php  require_once('../../private/initialize.php');

$tool_id = $_POST['tool_id'];
$element = DocumentResource::find_by_tool_id($tool_id);
$args = [
     'tool_pos_top' => $_POST['tool_top_pos'],
     'tool_pos_left' => $_POST['tool_left_pos'],
];
$element->merge_attributes($args);
// pre_r($element);
$element->save();

?>