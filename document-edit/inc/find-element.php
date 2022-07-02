<?php  require_once('../../private/initialize.php');
        
        if(isset($_POST['findUser'])){ 
            $signer_id = $_POST['signer_id'] ?? 0;
            $signers_email = Signers::find_by_id($signer_id)->email;
            // $tools = SignatureDetail::find_by_email(['user_email' => $signers_email, 'category' => 1 ]);
            if($signers_email == $loggedInAdmin->email){
                exit(json_encode(['success' => true]));
            }else{
                exit(json_encode(['success' => false])); 
            }
            
       }
       
       if(isset($_POST['hasSignature'])){
            $signer_id = $_POST['signer_id'] ?? 0;
            $signers_email = Signers::find_by_id($signer_id)->email;
            $tools = SignatureDetail::find_by_email(['user_email' => $signers_email, 'category' => 1 ]);
            if(!empty($tools)){
                exit(json_encode(['success' => true, 'msg' => 'You have a signature, click on the tool to append']));
            }else{
                exit(json_encode(['success' => false, 'msg' => 'Please create a signature'])); 
            }
       }

       


    //    Check if signer is the loggedIn User
       

       if(isset($_POST['findElement'])){
            $toolUser = $_POST['toolUser'] ?? 0;
            $signer = Signers::find_by_id($toolUser);
            if(!empty($signer)){
                if($signer->email == $loggedInAdmin->email){
                    $find = DocumentResource::find_by_tool_id($_POST["tool_id"]);
                    if(!empty($find)){
                        $name = $_POST["name"];
                        $user_id = $loggedInAdmin->id ?? 0;
                        $category = $_POST["category"];
                        $pos_top = $find->tool_pos_top;
                        $pos_left = $find->tool_pos_left;
                        $email = $loggedInAdmin->email;
                        $tools = SignatureDetail::find_by_email(['user_email' => $email, 'category' => $category ]);
                       
                        if(!empty($tools)){
                            $path = 'upload/signature_files/';
                            $output = '<table class="table table-bordered">';
                            $output .= '<tbody>';
                            
                            foreach($tools as $tool):
                                $output .= '<tr>';
                                $output .= '<td>
                                    <input type="radio" name="saveTool[tool_name]" 
                                    class="form-check-input tool_name" id="tool_name'.$tool->id.'" 
                                    data-filename="'.$tool->filename.'"
                                    data-file="'.$tool->file.'" value="'.$name.'">
                                    
                                    </td>';
                                $output .= '<td>
                                                <label class="form-check-label" for="tool_name'.$tool->id.'" id="signature-img'.$tool->id.'">
                                                   
                                                    <img class="img-fluid" height="30" src="'.$tool->file.'">
                                                    
                                                </label>
                                            </td>';
                                
                                $output .= '</tr>'; 
                            endforeach;
                                   
                                $output .= '</tbody>';
                                $output .= '</table>';
                            $data = array(
                                'details'		=>	$output,
                                'pos_top'		=>	$pos_top,
                                'pos_left'		=>	$pos_left,
                                'file'          => $tool->file,
                                'success'		=>	true,
                                'msg'		=>	'This tool belong to you., now you can proceed',
                                
                                
                            );	
                            echo json_encode($data);
                        }else{
                            exit(json_encode(["success" => false, "msg" => "Create Signature"]));
                        }
                    }else{
                        
                    }
                }else{
                    exit(json_encode(["success" => false, "msg" => "Sorry tool belong to a different user"]));
                }
            }else{
                exit(json_encode(["success" => false, "msg" => "Error no user's record found for this tool"]));
            }

       }






















       

    //    if(isset($_POST['findElement'])){
    //        $path = 'upload/';
    //        $output = '<table class="table table-bordered">';
    //        $output .= '<tbody>';
    //        foreach($_SESSION["docu_edit"] as $keys => $values)
    //         {
               
    //             if($values["tool_id"] == $_POST["tool_id"])
    //             {
    //                 $name = $_POST["name"];
    //                 $user_id = $loggedInAdmin->id ?? 0;
    //                 $category = $_POST["category"];
    //                 $pos_top = $values['tool_top_pos'];
    //                 $pos_left = $values['tool_left_pos'];
    //                 // if($name == 'Sign'){
    //                     $tools = SignatureDetail::find_by_element(['user_id' => $user_id, 'category' => $category ]);
    //                     // pre_r($tools);
    //                     foreach($tools as $tool){
    //                         // $_SESSION["docu_edit"][$keys]['filename'] = $tool->filename;
    //             $output .= '<tr>';
    //             $output .= '<td>
    //                 <input type="radio" name="saveTool[tool_name]" class="form-check-input tool_name" id="tool_name'.$keys.'" data-file="'.$tool->filename.'" value="'.$name.'">
                    
    //                 </td>';
    //             $output .= '<td><label class="form-check-label" for="tool_name'.$keys.'" id="signature-img'.$keys.'"><img class="" src="'.$path.$tool->filename.'"></label></td>';
    //             $output .= '</td>';
    //             $output .= '</tr>';
    //                     // }
                        
    //                     // exit(json_encode(['img' => ]));
    //                 }
                    
    //                 // pre_r($_SESSION["docu_edit"]);
    //                 // unset($_SESSION["docu_edit"][$keys]);
    //             }
                
    //         }
    //         $output .= '</tbody>';
    //         $output .= '</table>';

    //         $data = array(
    //             'details'		=>	$output,
    //             'pos_top'		=>	$pos_top,
    //             'pos_left'		=>	$pos_left,
    //             // 'filename'		=>	$filename,
    //             // 'total_price'		=>	 number_format($total_price, 2),
                
    //         );	

    //         echo json_encode($data);
    //    }
        
    ?>