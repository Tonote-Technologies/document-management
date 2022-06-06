<?php  require_once('../../private/initialize.php');

       if(isset($_POST['findSignature'])){
            $user_id = $loggedInAdmin->id ?? 0;
            $findSignature = SignatureDetail::find_by_user_ids($user_id);
            
            if(empty($findSignature)){
                exit(json_encode(['success' => true]));
            }else{
                exit(json_encode(['success' => false])); 
            }
       }


       if(isset($_POST['findElement'])){
            $path = 'upload/signature_files/';
            $output = '<table class="table table-bordered">';
            $output .= '<tbody>';

            $find = DocumentResource::find_by_tool_id($_POST["tool_id"]);
            if(!empty($find)){
                $name = $_POST["name"];
                $user_id = $loggedInAdmin->id ?? 0;
                $category = $_POST["category"];
                $pos_top = $find->tool_pos_top;
                $pos_left = $find->tool_pos_left;
                
                $tools = SignatureDetail::find_by_element(['user_id' => $user_id, 'category' => $category ]);
                foreach($tools as $tool):
                
                    $output .= '<tr>';
                    $output .= '<td>
                        <input type="radio" name="saveTool[tool_name]" class="form-check-input tool_name" id="tool_name'.$tool->id.'" data-file="'.$tool->filename.'" value="'.$name.'">
                        
                        </td>';
                    $output .= '<td><label class="form-check-label" for="tool_name'.$tool->id.'" id="signature-img'.$tool->id.'"><img class="" src="'.$path.$tool->filename.'"></label></td>';
                    $output .= '</td>';
                    $output .= '</tr>';     
                    
                
                    $output .= '</tbody>';
                    $output .= '</table>';
                endforeach;
                
                $data = array(
                    'details'		=>	$output,
                    'pos_top'		=>	$pos_top,
                    'pos_left'		=>	$pos_left,
                    
                );	
                echo json_encode($data);
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