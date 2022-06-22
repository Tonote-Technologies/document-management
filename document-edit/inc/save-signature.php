<?php   require_once('../../private/initialize.php');

    if(isset($_POST['action'])){

        if($_POST['action'] == 'create'){
            $img_data = $_POST['img'];//getting post img data
            $filename = $_POST['imgType'].time().'img.png';//making file name
            $user_id =  Signers::find_by_email($loggedInAdmin->email)->id ?? 0;
            $email = $loggedInAdmin->email;
            $set_default = 1;
            $type = $_POST['etype'];
            $category = $_POST['category'];
            $file = $img_data;

            // $findSignature = SignatureDetail::find_by_user_id($user_id);
            $signature = SignatureDetail::find_by_element_record(['user_email' => $email, 'category' => $category, 'type' => $type ]);
            // pre_r($signature);
            if(empty($signature)){
                $save = SignatureDetail::createSignature(["user_id" => $user_id, "user_email" => $loggedInAdmin->email, "filename" => $filename, 'file'=>$file, "type" => $type, "category" => $category  ]);
                if($save == true){
                    exit(json_encode(['success' => true, 'msg' => 'Signature Created Successfully']));
                }
            }else{
                $data = [
                    'filename' => $filename,
                    'file' => $file,
                    'updated_at' => date('Y-m-d h:i:s'),
                ];
                foreach ($signature as $key => $value) {
                    $signature[$key]->merge_attributes($data);
                    $result = $signature[$key]->save();

                }
                if($result == true){
                     exit(json_encode(['success' => true,  'msg' => 'Signature Updated Successfully'])); 
                }
               
            }
        }

        // if($_POST['action'] == 'update'){
        //     $signature = SignatureDetail::find_by_category(['category' => $category, 'user_id' => $user_id]);
        //     $data = [
        //         'filename' => $filename,
        //         'updated_at' => date('Y-m-d h:i:s'),
        //     ];
        //     foreach ($signature as $key => $value) {
        //         unlink($path.$value->filename);
        //         $signature[$key]->merge_attributes($data);
        //         // $signature[$key]->save();
        //         // file_put_contents($path.$filename, base64_decode($img));
        //         pre_r($signature);
        //     }
            
        //     exit(json_encode(['success' => true]));  
        // }
    }

         
        
    ?>