<?php   require_once('../../private/initialize.php');

        if($_POST['action'] == 'create'){
            
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
        }

        if($_POST['action'] == 'update'){
            $signature = SignatureDetail::find_by_category(['category' => $category, 'user_id' => $user_id]);
            $data = [
                'filename' => $filename,
                'updated_at' => date('Y-m-d h:i:s'),
            ];
            foreach ($signature as $key => $value) {
                unlink($path.$value->filename);
                $signature[$key]->merge_attributes($data);
                $signature[$key]->save();
                file_put_contents($path.$filename, base64_decode($img));
            }
            exit(json_encode(['success' => true]));  
        }
        
       
            
        
        

        
        
    ?>