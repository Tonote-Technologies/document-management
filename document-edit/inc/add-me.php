<?php   require_once('../../private/initialize.php'); 

    if(isset($_POST['addMe'])):
            $document_id = $_POST['document_id'];
            
            
            $thisSigner = Signers::find_by_email_and_doc_ids($document_id, $loggedInAdmin->email);
            
            if($_POST['action'] == 1):
                if(empty($thisSigner)){
                    $args = [
                        'first_name' => $loggedInAdmin->first_name,
                        'last_name' => $loggedInAdmin->last_name,
                        'email' => $loggedInAdmin->email,
                        'document_id' => $document_id,
                        'created_by' => $loggedInAdmin->id,
                    ];
                    $signer = new Signers($args);
                    $result = $signer->save();
                    // pre_r($signer );
                    // $result = true;
                    $result == true ? 
                        exit(json_encode(['success' => true, 'msg' => 'Added successful', 'signer_id' => $signer->id])) : 
                        exit(json_encode(['success' => false, 'msg' => 'Failed']));    
                }else{
                    exit(json_encode(['success' => false, 'msg' => 'You are already a signer to this document']));
                }   
            endif;
            
            
            if($_POST['action'] == 0):
                $user_id = $_POST['signer_id'];
                $email = Signers::find_by_id($_POST['signer_id'])->email;
                
                // if(!empty($thisSigner)):
                    $result = Signers::removeSigner($document_id, $email);
                    $result = true;
                    if($result == true) { 
                        
                        $userTool= DocumentResource::find_by_user_tool($document_id, $user_id); 
                        if(!empty($userTool)){
                            $removeSignerTool = DocumentResource::removeSignerTool($document_id, $user_id);
                        }
                        exit(json_encode(['success' => true, 'msg' => 'Removed successful']));
                        
                    }else{
                        exit(json_encode(['success' => false, 'msg' => 'Failed'])); 
                    }
                // endif;
            endif;
    endif;

?>