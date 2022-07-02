<?php require_once('../private/initialize.php');

$page = 'Manage';
$page_title = 'Upload Page';

$rand = rand(0, 10);
$number = rand(0, 100).$rand;
$_SESSION['document_id'] = 'Tonote-'.$number;
include(SHARED_PATH . '/header.php');
?>
<style type="text/css">
.upload-area {
    /*width: 70%;*/
    height: 300px;
    border: 2px dashed #999;
    border-radius: 3px;
    margin: 0 auto;
    text-align: center;
    overflow: auto;
}

.dz-message {
    text-align: center;
    font-weight: normal;
    font-family: sans-serif;
    /*line-height: 50px;*/
    color: darkslategray;
    font-size: 1rem;
    color: #999;
}

#drag_upload_file {
    width: 50%;
    margin: 0 auto;
}

#drag_upload_file p {
    text-align: center;
}

#drag_upload_file #selectfile {
    display: none;
}

.avatar-sm {
    height: 3rem;
    width: 3rem;
}

.ps-0 {
    padding-left: 0 !important;
}
</style>

<section class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
            <div id="drop_file_zone" class="upload-area d-flex align-items-center justify-content-center"
                ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file" class="dz-message">
                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                    <h3 class="action-word">Drop files here to start uploading </h3>
                    <div>or</div>
                    <div>
                        <input type="button" class="btn btn-primary" value="Select File(s)"
                            onclick="file_explorer();" />
                    </div>
                    <div class="text-muted font-13 mt-3">PDF, PNG, JPG or JPEG only</div>
                    <input type="file" id="selectfile" multiple />
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-2 p-2">
        <div class="clearfix ">
            <div class="btn btn-primary btn-sm float-end mr-2 disabled" style="cursor: pointer;" id="proceedbtn">Proceed
            </div>
        </div>
    </div>
    <div class="d-none" id="preview"></div>
</section>



<?php   //include(SHARED_PATH . '/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$('#drop_file_zone').on('dragenter', function(e) {
    e.stopPropagation();
    e.preventDefault();
    $("#action-word").text("Drop here");
});

// Drag over
$('#drop_file_zone').on('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
    $("#action-word").text("Drop here");
});


function upload_file(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files);
}

function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        files = document.getElementById('selectfile').files;
        ajax_file_upload(files);
    };
}

function ajax_file_upload(files_obj) {
    if (files_obj != undefined) {
        var form_data = new FormData();
        for (i = 0; i < files_obj.length; i++) {
            form_data.append('file[]', files_obj[i]);
        }
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "inc/upload.php", true);
        xhttp.onload = function(event) {
            if (xhttp.status == 200) {
                // const response = JSON.parse(this.responseText);
                // addThumbnail(response);
                addThumbnail(this.responseText);
                $("#proceedbtn").removeClass("disabled");
            } else {
                alert("Error " + xhttp.status + " occurred when trying to upload your file.");
            }
        }
        xhttp.send(form_data);
    }
}


function addThumbnail(data) {
    $("#preview").removeClass('d-none').append(data);
}

$(document).on('click', '.ds-remove', function(e) {
    e.preventDefault();
    var filename = $(this).data('name');
    $(this).closest('.card').addClass('d-none');

    $.ajax({
        url: 'remove_file.php',
        method: 'post',
        data: {
            filename: filename,
        },
        dataType: 'json',
        success: function(r) {
            if (r.success == true) {
                $(this).closest('.card').addClass('d-none');
            } else {
                console.log(r.msg)
            }
        }
    });
})

function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
</script>