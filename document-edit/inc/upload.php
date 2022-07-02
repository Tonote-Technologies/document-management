<?php require_once('../../private/initialize.php');


if (!file_exists('../inc/upload')) {
  mkdir('../inc/upload', 0777);
}

$title = $_POST['title'] ?? "Not Set";

$document_id = 'ToNote'. '_' .uniqid() ?? '';
if (!empty($_FILES['file']['name'])) {

  foreach ($_FILES['file']['name'] as $key => $val) {
    $filename = uniqid() . '_' . $_FILES['file']['name'][$key];
    $pathname = "../upload/raw_files/" . $filename;
    $filesize = $_FILES['file']['size'][$key];
    $filetype = $_FILES['file']['type'][$key];
    if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $pathname)) {
      $src = "default.png";
      if (is_array(getimagesize($pathname))) {
        $src = $pathname;
      }
      $args = [
        'filename' => $filename,
        'title' => $title,
        'document_id' => $document_id,
        'created_by' => $loggedInAdmin->id ?? 0,
        'created_at' => date('Y-m-d H:i:s'),
      ];
      $document = new Document($args);
      $result = $document->save();
?>


<div class="image-area">
    <img src="<?php echo $src ?>" alt="Preview">
    <a class="remove-image  ds-remove filed" href="#" style="display: inline;"
        data-id="<?php echo $document->document_id ?>" data-name="<?php echo $filename ?>">&#215;</a>
    <div class="text-truncate"><?php echo $filename ?></div>
</div>
<!-- <div class="d-none" id="preview"></div> -->

<!-- <div class="card mb-1 mb-0 shadow-none border">
    <div class="p-2">
        <div class="row align-items-center">

            <div class="col-auto" id="uploadfile"><img data-dz-thumbnail src="<?php //echo $src ?>"
                    class="avatar-sm rounded bg-light" alt=""> </div>

            <div class="col ps-0"> <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                <p class="mb-0" data-dz-size><?php //echo $filename ?></p>
            </div>

            <div class="col-auto"> <a href="" class="btn btn-sm btn-outline-primary ds-remove filed"
                    data-id="<?php //echo $document->document_id ?>" data-name="<?php //echo $filename ?>"> X </a>
            </div>

        </div>
    </div>
</div> -->
<?php } ?>
<?php } ?>

<?php } ?>