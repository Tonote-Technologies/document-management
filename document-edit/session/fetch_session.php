<?php require_once('../../private/initialize.php');


$document_id = $_POST['document_id'];
$path = 'upload/signature_files/';
$documents = DocumentImageDetails::find_by_document_ids($document_id);
$documentResource = DocumentResource::find_by_document_ids($document_id);

$totalPage = count($documents);
$added_tool = 0;
$converted_tool = 0;
	
	$output = '<div>';
	
	foreach($documentResource as  $savedTool){
		if($savedTool->tool_type == 1){
			if ($savedTool->tool_name == "Textarea") {
				$output .= '<dl class=" '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
								<button type="button" class="btn-close deleteItem"  data-id="'.$savedTool->tool_id.'"></button>
								<div style="position:relative">
									
									<div class="element"><input aria-invalid="false" type="text"  class="textareaTool" value=""></div>
								</div>
						    </dl>';
			}else{
				$output .= '
					<dl class=" '.$savedTool->tool_class.' '.$savedTool->tool_name.'" data-name="'.$savedTool->tool_name.'" data-id="'.$savedTool->tool_id.'" style="top: '.$savedTool->tool_pos_top.'; left:'.$savedTool->tool_pos_left.'">
						<div>
							<button type="button" class="btn-close deleteItem" data-id="'.$savedTool->tool_id.'"></button>
							<div class="element">'.$savedTool->tool_name.'</div>
							
						</div>
					</dl>
				';	
			}
			$added_tool = $added_tool + 1;
		}else{
			$output .= '
			<div class="tool-box main-element title" 
				style="top: '.$savedTool->tool_pos_top.'; 
				left: '.$savedTool->tool_pos_left.';" data-id="'.$savedTool->tool_id.'" data-name="'.$savedTool->tool_name.'" >
				<button type="button" class="btn-close removeItem"  data-id="'.$savedTool->tool_id.'"></button>
					<img src="'.$path.$savedTool->filename.'" class="" />
				
			</div>';
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

	// print_r($data);

?>