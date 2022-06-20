<?php require_once('../../private/initialize.php');

if(isset($_POST['action'])){
    if($_POST["action"] == "addTool"){
        $args = [
            'document_id' => $_POST['document_id'], 
            'tool_id' => $_POST['tool_id'],
            'toolUser' => $_POST['toolUser'],
            'tool_class' => $_POST['tool_class'],
            'tool_type' => $_POST['tool_type'],
            'tool_name' => $_POST['tool_text'], 
            'tool_pos_top' => $_POST['tool_top_pos'], 
            'tool_pos_left' => $_POST['tool_left_pos'], 
        ];
        $addResource = New DocumentResource($args);
        $result = $addResource->save();
        if($result == true){
         exit(json_encode(['success' => true]));
        }
    }

    if($_POST["action"] == "remove"){
       $element = DocumentResource::find_by_tool_id($_POST["tool_id"]);
       if(!empty($element)){
           $result = DocumentResource::removeTool($element->id);
           if($result == true){
               exit(json_encode(['success' => true]));
           } 
       }
    }
}


if(isset($_POST['editTool'])){
    $args = $_POST['editTool'];
    $tool_id = $_POST['editTool']['tool_id'];
    $find = DocumentResource::find_by_tool_id($tool_id);
    $args['tool_type'] = 2;
    $args['updated_at'] = date('Y-m-d H:i:s');
    $find->merge_attributes($args);
    // pre_r($find);
    $result = $find->save();
    if($result == true){
        exit(json_encode(['success' => true]));
    }
}




?>