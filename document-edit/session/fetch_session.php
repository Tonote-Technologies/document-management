<?php require_once('../../private/initialize.php');

$document_id = $_GET['document_id'];
$path = 'upload/signature_files/';
$documents = DocumentImageDetails::find_by_document_ids($document_id);
$documentResource = DocumentResource::find_by_document_ids($document_id);

$totalPage = count($documents);
$added_tool = 0;
$converted_tool = 0;
	$output = '<div>';
	foreach($documentResource as  $savedTool){
		$signers = Signers::find_by_id($savedTool->toolUser);
		$signerName = $signers->full_name() ?? "Not Set";
		$signers_email = $signers->email;
		$signature = '';
		if($savedTool->tool_name == "Sign" || $savedTool->tool_name == "Initial"){

		
			if($signers_email == $loggedInAdmin->email){
				$tools = SignatureDetail::find_by_email(['user_email' => $signers_email, 'category' => 1 ]);
				// pre_r($tools);
				if(!empty($tools)){
					$signature = 'bg-fill';
				}else{
					$signature = '';
				}
			}
		}
		if($savedTool->tool_type == 1){
			if ($savedTool->tool_name == "Textarea") {
				$text_value = TextAreaDetails::find_by_tool_id($savedTool->tool_id)->text_value;
				if($text_value == ''){
					$visible = 'border-primary';
				}else{
					$visible = '';
				}
				// $output .= '<dl id="'.$savedTool->tool_id.'" class=" '.$signature.' '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-user="'.$savedTool->toolUser.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
											
				// 					<div class="text-wrapper">
				// 					<button type="button" class="btn-close removeItem"  data-id="'.$savedTool->tool_id.'" style="right:-110"></button>
										
				// 						<textarea class="textareaTool '.$visible.'" value="'.$text_value.'" data-id="'.$savedTool->tool_id.'">'.$text_value.'</textarea>
				// 					</div>
								
				// 		    </dl>';

				$output .= '
							
							<dl class=" '.$signature.' '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-user="'.$savedTool->toolUser.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
											
									<div class="text-wrapper">
									<button type="button" class="btn-close removeItem"  data-id="'.$savedTool->tool_id.'" style="right:-110"></button>
										<input aria-invalid="false" type="text"  class="textareaTool '.$visible.'" value="'.$text_value.'">
										
									</div>
								
						    </dl>
							';
			}else{
				$output .= '
					<dl class=" '.$signature .' '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-user="'.$savedTool->toolUser.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
						<div>
							<button type="button" class="btn-close deleteItem" data-id="'.$savedTool->tool_id.'"></button>
							<div class="element">'.$savedTool->tool_name.'</div>
							
						</div>
						<div class="name-style">'.$signerName.'</div>
					</dl>
				
				';	
			}
			$added_tool = $added_tool + 1;
		}else{
			$output .= '
			<div class=" '.$savedTool->tool_class.' title" 
				
				style="width: '.$savedTool->tool_width.'px; height: '.$savedTool->tool_height.'px; top: '.$savedTool->tool_pos_top.'; 
				left: '.$savedTool->tool_pos_left.';" data-id="'.$savedTool->tool_id.'" data-user="'.$savedTool->toolUser.'" data-name="'.$savedTool->tool_name.'" >
				<button type="button" class="btn-close removeItem"  data-id="'.$savedTool->tool_id.'"></button>
					
					<img src="'.$savedTool->file.'" class="img-fluid" />
					
				
			</div>
			';
			$converted_tool = $converted_tool + 1;
		}
		
	}
	
	foreach ($documents as $key => $value) {
		$pageNum = $key + 1; 
		$output .= '
			<div class="border">
				<img src="upload/document_file/'.$value->filename.'" 
				style=";"  class="img-fluid"> 
			</div>
			<div class="clearfix">
				<h6 class="float-end">Page '.$pageNum.' of '.$totalPage.'</h6>
			</div>
		</div>';
	}
	
	$data = array(
		'session_details'		=>	$output,
		'added_tool'			=>	$added_tool,
		'converted_tool'		=>	$converted_tool,
		// 'total_price'		=>	 number_format($total_price, 2),
		
	);	

	echo json_encode($data);