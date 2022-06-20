<?php require_once('../../private/initialize.php');


// if (!file_exists('../inc/upload')) {
//   mkdir('../inc/upload', 0777);
// }

// $title = $_POST['title'] ?? "Not Set";

// $document_id = 'ToNote'. '_' .uniqid() ?? '';
// if (!empty($_FILES['file']['name'])) {

//   foreach ($_FILES['file']['name'] as $key => $val) {
//     $filename = uniqid() . '_' . $_FILES['file']['name'][$key];
//     $pathname = "../upload/raw_files/" . $filename;
//     $filesize = $_FILES['file']['size'][$key];
//     $filetype = $_FILES['file']['type'][$key];
//     if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $pathname)) {
//       $src = "default.png";
//       if (is_array(getimagesize($pathname))) {
//         $src = $pathname;
//       }
//       $args = [
//         'filename' => $filename,
//         'title' => $title,
//         'document_id' => $document_id,
//         'created_by' => $loggedInAdmin->id ?? 0,
//         'created_at' => date('Y-m-d H:i:s'),
//       ];
//       $document = new Document($args);
//       $result = $document->save();
//     }
//  }
// }

    $img = $_POST['img'];//getting post img data
    $img = substr(explode(";",$img)[1], 7);//converting the data 
    $path = '../upload/signature_files/';
    $filename = $_POST['imgType'].time().'img.png';//making file name
    $user_id = $loggedInAdmin->id ?? 0;
    $set_default = 1;
    $type = $_POST['etype'];
    $category = $_POST['category'];

    $findSignature = SignatureDetail::find_by_user_id($user_id);
    $save = SignatureDetail::createSignature(["user_id" => $user_id, "filename" => $filename, "type" => $type, "category" => $category  ]);
    if($save == true){
        file_put_contents($path.$filename, base64_decode($img));//converting the $img with base64 and putting the image data in upload/$target file name  
        exit(json_encode(['success' => true]));
    }
?>