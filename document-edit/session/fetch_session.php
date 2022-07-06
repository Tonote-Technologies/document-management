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
				if(!empty($tools)){
					$signature = 'bg-fill';
				}else{
					$signature = '';
				}
			}
		}
		if($savedTool->tool_type == 1){
			if ($savedTool->tool_name == "Textarea") {
				$text_value = TextAreaDetails::find_by_tool_id(['tool_id' => $savedTool->tool_id, 'tool_user' => $savedTool->toolUser])->text_value;
				if($text_value == ''){
					$visible = 'border-light';
				}else{
					$visible = '';
				}
				$output .= '
					<dl id="'.$savedTool->tool_id.'" class=" '.$signature.' '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-user="'.$savedTool->toolUser.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">		
							<div class="text-wrapper">
							<button type="button" class="btn-close removeItem"  data-id="'.$savedTool->tool_id.'" style="right:0"></button>
								
								<textarea class="textareaTool resize  '.$visible.'"  
								placeholder="Input text here" 
								style="
									width: '.$savedTool->tool_width.'px; 
									height: '.$savedTool->tool_height.'px;"
								data-id="'.$savedTool->tool_id.'">'.$text_value.'</textarea>
								
							</div>
							
					</dl>
					';
				
			}else if($savedTool->tool_name == "Photo"){
				if($savedTool->file == ""){
					$photo = url_for('document-edit/upload/noimage.jpg');
				}else{
					$photo = $savedTool->file;
				}
			
				$output .= '
							<div 
								class="image-area '.$savedTool->tool_class.'" 
								id="'.$savedTool->tool_id.'" 
								data-user="'.$savedTool->toolUser.'" 
								data-name="'.$savedTool->tool_name.'" 
								data-id="'.$savedTool->tool_id.'" 
								style="
									width: '.$savedTool->tool_width.'px; 
									height: '.$savedTool->tool_height.'px;
									top: '.$savedTool->tool_pos_top.'; 
									left:'.$savedTool->tool_pos_left.'">
								<div class="photo-layer">
									<span>Processing...</span>
								</div>
								
									<input type="file" id="imgupload" style="display:none" accept="image/*" data-id="'.$savedTool->tool_id.'" data-user="'.$savedTool->toolUser.'" / > 
									<img src="'.$photo.'" class="img-fluid" id="imagePreview"  alt="Preview">
								<button type="button" class="btn-close removePhoto" data-id="'.$savedTool->tool_id.'"></button>
							</div>
						';
			    
		}else{
				$output .= '
					<dl class=" '.$signature .' '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-user="'.$savedTool->toolUser.'"
						data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'"
						style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
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
				<div  
				class="sign '.$savedTool->tool_class.'" 
				data-user="'.$savedTool->toolUser.'"
				data-name="'.$savedTool->tool_name.'" 

				style="
					display:inline-block; 
					top: '.$savedTool->tool_pos_top.'; 
					left: '.$savedTool->tool_pos_left.';" 
				
				data-id="'.$savedTool->tool_id.'" >
					<button type="button" class="btn-close removeItem" data-id="'.$savedTool->tool_id.'"></button>
					<img class="resize"  
					style="
					width: '.$savedTool->tool_width.'px; 
					height: '.$savedTool->tool_height.'px; "
					data-id="'.$savedTool->tool_id.'"  src="'.$savedTool->file.'" />
				</div>
			';
			
			$converted_tool = $converted_tool + 1;
		}
}

foreach ($documents as $key => $value) {
		$pageNum = $key + 1;
		$output .= '
		<div class="border">
			<img src="upload/document_file/'.$value->filename.'" class="img-fluid">
		</div>
		<div class="clearfix">
			<h6 class="float-end">Page '.$pageNum.' of '.$totalPage.'</h6>
		</div>
		</div>';
}

$data = array(
'session_details' => $output,
'added_tool' => $added_tool,
'converted_tool' => $converted_tool,
);

echo json_encode($data);