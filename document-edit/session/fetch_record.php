<?php require_once('../../private/initialize.php');

$document_id = $_POST['document_id'];
$path = 'upload/';
$documents = DocumentImage::find_by_document_id($document_id);
$documentResource = DocumentResource::find_by_document_ids($document_id);
$totalPage = count($documents);
	
$total_item = 0;

$output = '';
foreach($documentResource as  $savedTool){
    $output .= '<img src="'.$path.$savedTool->filename.'" data-name="'.$savedTool->tool_name.'" style="top: '.$savedTool->tool_pos_top.'; left: '.$savedTool->tool_pos_left.'; " class="box" />';
}

foreach ($documents as $key => $value) {
    $pageNum = $key + 1;
    
    $output .= '
        
        <div class="border">
            <img src="upload/document_file/'.$value->filename.'" style="min-width: 500px ;"  class="img-fluid"> 
        </div>
        <div class="clearfix">
            <h6 class="float-end">Page '.$pageNum.' of '.$totalPage.'</h6>
        </div>
    </div>';
}

$data = array(
    'session_details'		=>	$output,
    'total_item'		=>	$total_item,
    // 'total_price'		=>	 number_format($total_price, 2),
    
);	

echo json_encode($data);