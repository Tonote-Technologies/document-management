<?php   require_once('../../private/initialize.php');

    if (isset($_POST['document'])) {
        $args = $_POST;
        $args['created_by'] = $loggedInAdmin->id ?? 0;
        $document = new DocumentImage($args);
        $result = $document->save();
        // $result = true;
        if($result == true){
            exit(json_encode(['success' => true]));
        }
    }
    
    if (isset($_POST['documentFiles'])) {
        $img = $_POST['img'];//getting post img data
        $img = substr(explode(";",$img)[1], 7);//converting the data 
        $filename = uniqid().'img.png';//making file name
        $document_id = $_POST['document_id'];
        if(file_put_contents('../upload/document_file/'.$filename, base64_decode($img))){
            $args = [
                'filename' => $filename,
                'document_id' => $document_id,
                'created_by' => $loggedInAdmin->id ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $document = new DocumentImageDetails($args);
            $result = $document->save();
            exit(json_encode(['document_id' => $document_id, 'filename' => $filename]));
        };//converting the $img with base64 and putting the image data in upload/$filename file name 
    } 
    
   
?>