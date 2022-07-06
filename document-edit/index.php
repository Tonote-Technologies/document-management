<?php 
    require_once('../private/initialize.php');

$page = 'Document';
$page_title = 'Edit Document';
$req_type = $_GET['req_type'] ?? 1;
include(SHARED_PATH . '/header.php'); 

?>
<style type="text/css">
.upload-area {
    /*width: 70%;*/
    height: 200px;
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

#drag_upload_file #selectFile {
    display: none;
}

.avatar-sm {
    height: 3rem;
    width: 3rem;
}

.ps-0 {
    padding-left: 0 !important;
}

.image-area {
    position: relative;
    width: 20%;
    /* background: #333; */
}

.image-area img {
    max-width: 100%;
    height: auto;
}

.remove-image {
    display: none;
    position: absolute;
    top: -10px;
    right: -10px;
    border-radius: 10em;
    padding: 2px 6px 3px;
    text-decoration: none;
    font: 700 21px/20px sans-serif;
    background: #555;
    border: 3px solid #fff;
    color: #FFF;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    -webkit-transition: background 0.5s;
    transition: background 0.5s;
}

.remove-image:hover {
    background: #E54E4E;
    padding: 3px 7px 5px;
    top: -11px;
    right: -11px;
}

.remove-image:active {
    background: #E54E4E;
    top: -10px;
    right: -11px;
}
</style>
<input type="hidden" id="req_type" value="<?php echo $_GET['req_type'] ?>">
<section class="container-fluid ">
    <h3>
        <div class="email-header-left d-flex align-items-center mb-2">
            <a href="/document-management/dashboard/" class=""
                style="display:inline-block; width: 100px; border-right:2px solid #CCC; margin-right:6px">
                <span class="go-back me-1 float-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-left font-medium-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
                <span class="email-subject mb-0 float-start">Back</span>
            </a>
            <span><?php echo Document::REQUEST_TYPE[$req_type] ?></span>
        </div>
    </h3>



    <div class="card">


        <div class="card-body">
            <?php if($req_type == 1 || $req_type == 2): ?>


            <ul class="nav nav-pills bg-nav-pills nav-justified border-bottom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-bs-toggle="tab" href="#first" aria-controls="first"
                        role="tab" aria-selected="true">Upload your document</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="second-tab" data-bs-toggle="tab" href="#second" aria-controls="second"
                        role="tab" aria-selected="false">Get a custom template</a>
                </li>
            </ul>

            <?php endif; ?>

            <div class="tab-content">
                <div class="tab-pane active" id="first" aria-labelledby="first-tab" role="tabpanel">
                    <form method="post">
                        <div class=" ">
                            <div class="form-group mb-2">
                                <label>Please enter a document title</label>
                                <input type="text" name="title" class="form-control border-dark" required id="title"
                                    placeholder="Document title">
                            </div>
                            <div id="drop_file_zone" class="upload-area d-flex align-items-center "
                                ondrop="upload_file(event)" ondragover="return false">
                                <div id="drag_upload_file" class="dz-message">
                                    <!-- <div class="d-flex" id="preview"></div> -->

                                    <div>
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                        <h3 class="action-word">Drop files here to start uploading </h3>
                                        <div>or</div>
                                        <div>
                                            <input type="button" class="btn btn-primary" value="Select File(s)"
                                                onclick="file_explorer();" />
                                        </div>
                                        <div class="text-muted font-13 mt-1">PDF, PNG, JPG or JPEG only</div>
                                        <input type="file" id="selectFile" multiple accept="application/pdf" />
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="d-none" id="preview"></div>
                        <div class="card mb-2 p-2">
                            <div class="clearfix ">
                                <div class="btn btn-primary btn-sm float-end mr-2 disabled" style="cursor: pointer;"
                                    id="proceedBtn">
                                    <a href="" class="text-white" id="proceed">Proceed</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="tab-pane" id="second" aria-labelledby="second-tab" role="tabpanel">
                    <!-- second -->
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <label for="trans_type">Document type <sup class="text-danger">*</sup></label>
                                <input type="text" id="trans_type" class="form-control border-secondary " required=""
                                    name="trans_type">

                            </div>
                            <div class="col-md-12 my-2 ">
                                <label for="trans_type">Describe your document <sup class="text-danger">*</sup></label>
                                <textarea class="form-control border-secondary " placeholder="Description"
                                    style="min-height:200px"></textarea>
                            </div>

                            <div class="col-md-12 my-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" value="<?php echo url_for("document-edit/") ?>" id="baseURL">
<input type="hidden" value="<?php echo url_for("request-notary/") ?>" id="requestURL">

<?php   include(SHARED_PATH . '/footer.php'); ?>
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
    let title = $("#title").val()
    if (title != "") {
        ajax_file_upload(e.dataTransfer.files);

    } else {
        alert("Please enter Document title")
        $("#title").addClass("border-danger").focus();
    }

}

function file_explorer() {
    let title = $("#title").val()
    if (title != "") {
        document.getElementById('selectFile').click();
        document.getElementById('selectFile').onchange = function() {
            files = document.getElementById('selectFile').files;
            ajax_file_upload(files);

        };
    } else {
        document.getElementById('selectFile').click();
        document.getElementById('selectFile').onchange = function() {
            files = document.getElementById('selectFile').files;
            ajax_file_upload(files);
        };

    }


}
$(document).on('keyup', '#title', function() {
    $("#title").removeClass("border-danger").addClass("border-primary");
    files = document.getElementById('selectFile').files;
    if (files != undefined) {
        $("#proceedBtn").removeClass("disabled");
    }
})

function ajax_file_upload(files_obj) {
    if (files_obj != undefined) {
        // const baseURL = window.location.href;
        // console.log()
        let req_type = $("#req_type").val();
        $('#title').val(files_obj[0].name)
        const baseURL = $("#baseURL").val();
        const requestURL = $("#requestURL").val();
        var title = $('#title').val();
        var form_data = new FormData();
        for (i = 0; i < files_obj.length; i++) {
            form_data.append('file[]', files_obj[i]);
            form_data.append('title', title);
        }
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "inc/upload.php", true);
        xhttp.onload = function(event) {
            if (xhttp.status == 200) {

                addThumbnail(this.responseText);
                if (title != '') {
                    $("#proceedBtn").removeClass("disabled");
                }

                let filed = document.querySelector('.filed')
                let dataAttFileName = filed.getAttribute('data-name')
                let dataAttId = filed.getAttribute('data-id')
                if (req_type == 3) {
                    $("#proceed").attr('href', baseURL + 'prepare.php?document_id=' + dataAttId +
                        '&type=1')
                } else {
                    $("#proceed").attr('href', requestURL + 'index.php?document_id=' + dataAttId +
                        '&type=' + req_type)
                }
                // console.log(isFiled)
            } else {
                alert("Error " + xhttp.status + " occurred when trying to upload your file.");
            }
        }
        xhttp.send(form_data);
    }
}


function addThumbnail(data) {
    // $(".dz-message").addClass("d-flex justify-content-between")
    $("#preview").removeClass('d-none').append(data);
}

// function addThumbnail(data) {
//     $(".dz-message").remove();
//     var len = $("#uploadfile div.thumbnail").length;

//     var num = Number(len);
//     num = num + 1;

//     var name = data.name;
//     var size = convertSize(data.size);
//     var src = data.src;

//     // Creating an thumbnail
//     $("#uploadfile").append('<div id="thumbnail_' + num + '" class="thumbnail"></div>');
//     $("#thumbnail_" + num).append('<img src="' + src + '" width="100%" height="78%">');
//     $("#thumbnail_" + num).append('<span class="size">' + size + '<span>');

// }

$(document).on('click', '.ds-remove', function(e) {
    e.preventDefault();
    var filename = $(this).data('name');
    $(this).closest('.card').addClass('d-none');

    $.ajax({
        url: 'inc/remove_file.php',
        method: 'post',
        data: {
            filename: filename,
        },
        dataType: 'json',
        success: function(r) {
            if (r.success == true) {
                $(this).closest('.card').remove();
                $("#title").val("");
                $("#selectFile").val(null)
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