<?php require_once('../../private/initialize.php');

if(isset($_POST['action'])){
    if($_POST["action"] == "addTool"){
        $tool_id = $_POST['tool_id'].'-'.uniqid();
        $args = [
            'document_id' => $_POST['document_id'], 
            'tool_id' => $tool_id,
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
            if($_POST['tool_text'] == "Textarea"){
                $data = [
                    'tool_id' => $tool_id,
                    'text_value' => $_POST['text_value'],
                    'tool_user' => $_POST['toolUser'],
                    'created_by' => $loggedInAdmin->id,
                ];
                $textArea = New TextAreaDetails($data);
                $result = $textArea->save();
            }
            exit(json_encode(['success' => true]));
        }
    }

    if($_POST["action"] == "remove"){
       $element = DocumentResource::find_by_tool_id($_POST["tool_id"]);
       if(!empty($element)){
           $result = DocumentResource::removeTool($element->id);
           if($result == true){
               if($_POST['tool_text'] == "Textarea"){
                   TextAreaDetails::removeTool($_POST["tool_id"]);
               }
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
    $result = $find->save();
    if($result == true){
        exit(json_encode(['success' => true]));
    }
}

if(isset($_POST['uploadPhoto'])){

    // $tool_id = $_POST['tool_id'];
    // $find = DocumentResource::find_by_tool_id($tool_id);
    // $args = [
    //     'tool_class' => "main-element photo-style resize",
    //     'resizable' => 1,
    //     'file' => $_POST['file'],
    //     'updated_at' => date('Y-m-d H:i:s'),
    // ];
    // $find->merge_attributes($args);
    // $result = $find->save();
    // if($result == true){
    //     exit(json_encode(['success' => true]));
    // }else{
    //     exit(json_encode(['success' => false]));
    // }


    // pre_r($_FILES['file']);

    

    // File upload path 
    $uploadPath = "../upload/raw_files/"; 
    
    // If file upload form is submitted 
    $status = $statusMsg = ''; 
    
    $status = 'error'; 
    if(!empty($_FILES["file"]["name"])) { 
        // File info 
        $newName = uniqid().$_FILES["file"]["name"];
        
        $fileName = basename($newName); 
        // pre_r($fileName);
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
        
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["file"]["tmp_name"]; 
           
            
            // Compress size and upload image 
            $compressedImage = DocumentResource::compressImage($imageTemp, $imageUploadPath, 40); 
            // pre_r($compressedImage);
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully.";

                $path = $compressedImage;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                // pre_r($path);
               
               
                $tool_id = $_POST['tool_id'];
                $find = DocumentResource::find_by_tool_id($tool_id);
                $args = [
                    'tool_class' => "main-element photo-style resize",
                    'resizable' => 1,
                    'file' => $base64,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $find->merge_attributes($args);
                $result = $find->save();
                if($result == true){
                     unlink($path);
                    exit(json_encode(['success' => true]));
                    // unlink($compressedImage);
                }else{
                    exit(json_encode(['success' => false]));
                }
                
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
  
    
    // Display status message 
    echo $statusMsg; 

    

}




?>