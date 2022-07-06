<?php require_once('../private/initialize.php');

$page = 'Prepare';
$page_title = 'Edit Document';
include(SHARED_PATH . '/header.php');
$mydocument = DocumentImage::find_by_document_id($_GET['document_id']);
if(!empty($mydocument)){
    $id = $_POST['user_id'] ?? $loggedInAdmin->id;
    $user = Admin::find_by_id($id);
    $fullName = $user->full_name() ?? "Not Set";

    $words = explode(" ", $fullName);
    $initial = "";

    foreach ($words as $w) {
    $initial .= $w[0];
    }
    
}else{
    redirect_to(url_for('document-edit/'));
}
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<!-- Font End -->
<link rel="stylesheet" type="text/css" href="css/doc-edit.css">
<link rel="stylesheet" type="text/css" href="css/signature-design.css">
<link rel="stylesheet" type="text/css" href="css/pdf2img.css">



<input type="hidden" id="document_id" value="<?php echo $_GET['document_id'] ?>">
<input type="hidden" id="storage">
<input type="hidden" id="currentId">
<input type="hidden" id="toolName">
<input type="hidden" id="toolUser">
<input type="hidden" id="UserEmail">
<input type="hidden" id="top">
<input type="hidden" id="left">
<input type="hidden" id="selectedSignature">
<input type="hidden" id="watch">
<input type="hidden" class="url" value="upload/certificate.pdf">
<input type="hidden" class="url" value="upload/EmployeeHandbook.pdf">

<div class="container-fluid">
    <div class="row mb-2 ">
        <div class="col-12 px-2">
            <div class=" float-end">
                <button class="btn btn-sm btn-outline-primary" onclick="Convert_HTML_To_PDF();">Download</button>
                <a href="<?php echo url_for('request-notary/index.php?document_id='.$_GET['document_id']) ?>"
                    class="btn btn-sm btn-outline-primary">Request a
                    Notary</a>
                <button class="btn btn-sm btn-primary" id="finish">Share document</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 d-none d-lg-block">
            <div class="d-flex justify-content-center">
                <div class="sidebar-nav card px-2 pt-2" style="width: 200px;">
                    <div style="height: 100vh">
                        <div>Edit Tools
                            <hr>
                        </div>
                        <div class="form-check form-check-primary form-switch" id="list-yourself">
                        </div>

                        <hr>
                        <div class="border-bottom mb-1 pb-1">
                            <div class="d-grid col-lg-12 col-md-12 mb-1 mb-lg-0">
                                <button type="button"
                                    class="btn btn-relief-primary waves-effect waves-float waves-light"
                                    id="addSignerBtn">
                                    <i data-feather='plus'></i>
                                    <span> Add Signer</span>
                                </button>
                            </div>
                        </div>

                        <div class="signer-list"></div>
                        <div class="signer-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body" id="mainWrapper" style="overflow-x:scroll;"> </div>
            </div>
        </div>
        <div class="col-lg-2 d-sm-none d-lg-block">
            <div class="d-flex justify-content-center">
                <div class="sidebar-nav card px-2 pt-2" style="width: 172px;">
                    <div style="height: 100vh">
                        <div style="font-size:12px">Tool Management
                            <hr>
                        </div>
                        <button class="btn btn-sm btn-outline-dark" id="updateSignature">Update Signature</button>
                        <hr>
                        <div>
                            <div class="btn-group mt-1">
                                <div class="btn  btn-sm">Added Tool</div>
                                <div class="btn  btn-sm" id="shopping_cart">0</div>
                            </div>
                        </div>
                        <div class="border-bottom mb-1">Signers</div>

                        <div id="list-signers"></div>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="tool-box  textTool" id="textTool">
                <input aria-invalid="false" type="text" class="v-textareaTool" value="">
            </div>

        </div>

        <div class="tool-box  tool-style signTool" id="signTool">
            <div class="element"> Sign <i data-feather='arrow-down-right'></i></div>

        </div>

        <div class="tool-box  tool-style initialTool" id="initialTool">
            <div class="element"> Initial <i data-feather='arrow-down-right'></i></div>

        </div>

        <div class="tool-box  tool-style stampTool" id="stampTool">
            <div class="element">Stamp <i data-feather='arrow-down-right'></i></div>
        </div>
        <div class="tool-box  tool-style sealTool" id="sealTool">
            <div class="element">Seal <i data-feather='arrow-down-right'></i></div>
        </div>

        <div class="tool-box dateTool" id="dateTool">
            <div class="element">Date <i data-feather='arrow-down-right'></i></div>
        </div>
        <div class="tool-box photoTool" id="photoTool">
            <div class="element border" style="width: 200px; height:200px">
                <img src="<?php echo url_for('document-edit/upload/noimage.jpg') ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>


    <div class="modal fade text-start" id="createSignatureModal">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17"><span id="actionWord">Create</span> a signature
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <!-- <div id="signatureFile"></div> -->
                        <input type="hidden" name="action" id="signatureAction" value="create">


                        <div>
                            <div class="">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="first-tab" data-bs-toggle="tab"
                                            aria-controls="first" href="#first" role="tab"
                                            aria-selected="true">Select</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="second-tab" data-bs-toggle="tab" aria-controls="second"
                                            href="#second" role="tab" aria-selected="false">Draw</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="third-tab" data-bs-toggle="tab" aria-controls="third"
                                            href="#third" role="tab" aria-selected="false">Upload
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane border-left active" id="first" role="tabpanel"
                                        aria-labelledby="first-tab">

                                        <div class="row  mb-1">
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3 col-md-3">
                                                        <label class="col-form-label" for="fullName">Full
                                                            Name</label>
                                                    </div>
                                                    <div class="col-sm-9 col-md-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" id="fullName" class="form-control"
                                                                name="fullName" value="<?php //echo $fullName?>"
                                                                placeholder="Full name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-5">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3 col-md-3">
                                                        <label class="col-form-label" for="initials">Initials</label>
                                                    </div>
                                                    <div class="col-sm-9 col-md-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" id="initials" class="form-control"
                                                                name="initials" value="<?php //echo $initial;?>"
                                                                placeholder="Initial">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="container p-2">
                                            <div class="row ">
                                                <?php 
                                                // $sn = 1; 
                                                // $fontFamily = ['Alex Brush', 'Arizonia', 'Great Vibes', 'Creattion Demo', 'Scriptina Regular','Montserrat', 'Oleo Script Swash Caps', 'The Nautigal', 'Poppins', 'Roboto'];
                                                $fontFamily = ['Great Vibes', 'Montserrat',];
                                                foreach ($fontFamily as $key => $value)  { 
                                                $key = $key + 1;

                                            ?>
                                                <div class="border row mb-2 d-flex align-items-center"
                                                    style="border-radius: 1.49rem;">
                                                    <div class="col-6">
                                                        <div class="form-check p-1 d-flex align-items-center">

                                                            <div class="pr-2">
                                                                <input type="hidden" name="signature_id"
                                                                    value="<?php echo $key ?>">
                                                                <input type="radio" name="sign"
                                                                    class="form-check-input choose"
                                                                    id="customCheck<?php echo $key ?>"
                                                                    data-id="<?php echo $key ?>"
                                                                    <?php //echo $signature_id==$key ? 'checked' : '' ?>>
                                                            </div>

                                                            <label class="form-check-label"
                                                                for="customCheck<?php echo $key ?>">
                                                                <div class="css-pl8xw2">
                                                                    <div class="css-fv3lde">
                                                                        <span class="css-4x8v88 fullName"
                                                                            id="signature-wrap<?php echo $key ?>"
                                                                            style="font-family: <?php echo $value?>;">
                                                                            <?php echo $fullName ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-check-label"
                                                            for="customCheck<?php echo $key ?>">
                                                            <div class="css-pl8xw2">
                                                                <!-- Signed on ToNote by: -->
                                                                <div class="css-fv3lde">
                                                                    <span class="css-4x8v88 initials"
                                                                        id="initial-wrap<?php echo $key ?>"
                                                                        style="font-family: <?php echo $value?>;">
                                                                        <?php echo $initial;?>
                                                                    </span>
                                                                </div>
                                                                <!-- <span
                                                    class="css-1j983t3 signatureID">6D80C6DF365242545678</span> -->
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>

                                        <div class=" text-center">
                                            <table class=" " id="cloneWrap">
                                                <tr class="">
                                                    <td class=""><span id="selected-signature"></span></td>
                                                    <td class=""><span id="selected-initial"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane border-left" id="second" role="tabpanel"
                                        aria-labelledby="second-tab">
                                        <p>
                                        <div class="row">
                                            <div class="col-lg-8 border-right">
                                                <div class="text-center">Draw your signature in the tool box </div>
                                                <div id="canvas" class="d-flex justify-content-center">
                                                    <canvas class="roundCorners" id="newSignature"
                                                        style="position: relative; margin: 0; padding: 0; border: 1px solid #CCC; width: 474px; height: 313px;"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 pt-3">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                                        autocomplete="off" checked="">
                                                    <label class="btn btn-outline-primary waves-effect saveSign"
                                                        for="btnradio1" onclick="signatureSave()">Generate</label>
                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                                        autocomplete="off">
                                                    <label class="btn btn-outline-primary waves-effect" for="btnradio2"
                                                        onclick="signatureClear()">Clear</label>
                                                </div>
                                                <div class="mt-1">
                                                    <input type="hidden" id="drawnSignature">
                                                    <img id="saveSignature" alt="Saved image png"
                                                        src="<?php echo url_for('assets/images/empty.png') ?>"
                                                        width="150" height="150" />
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                    <div class="tab-pane border-left" id="third" role="tabpanel"
                                        aria-labelledby="third-tab">
                                        <p>
                                        <form action="#" class="dropzone dropzone-area dz-clickable ">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-lg-12 col-md-12 mb-1 mb-sm-0">
                                                    <div class="file-upload-wrapper">
                                                        <form>
                                                            <input type="hidden" id="uploadSignature">
                                                            <label class="custom-file-upload">
                                                                <div>
                                                                    <img id="image-preview"
                                                                        src="<?php echo url_for('assets/images/download.png') ?>"
                                                                        alt="" width="100">
                                                                </div>
                                                                <div>
                                                                    <input type="file" id="file-input" />
                                                                    <span id="file-input-text">Click here to Upload
                                                                        your
                                                                        signature</span>
                                                                </div>
                                                            </label>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="p-2 ">
                    <div class="pb-1">
                        <!-- By signing this document with my electronic signature. -->
                        By clicking Create,I agree that the signature and initials is as valid as my hand writen
                        signature to the extent allowed by law

                        <!-- By clicking Create, I agree that the signature and initials will be the electronic
                        representation of my signature and initials for all purposes when I (or my representative) uses
                        them
                        on document through this platform, including legally binding contracts - just the same as a
                        pen-and-paper signature or initial. -->
                    </div>
                    <section class="d-flex justify-content-between">
                        <div class="table-responsive ">
                        </div>
                        <div>

                            <button type="button"
                                class="btn btn-primary waves-effect waves-float waves-light btn-choose disabled"
                                id="choose">Create</button>
                        </div>


                    </section>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="addSignerModal" style="">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Signer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form action="#" id="addSignerForm" method="post">
                    <div id="addSignerErrorMsg" class="text-center text-danger"></div>
                    <div class="modal-body">
                        <table class="">
                            <tbody>

                                <tr class="mtable">
                                    <td colspan="2">

                                        <table class="table table-bordered" id="expense-item-table">
                                            <th>SN</th>
                                            <th>Full Name <sup style="color:red">*<sup></th>
                                            <th>Email <sup style="color:red">*<sup></th>
                                            <th>Phone</th>
                                            <th rowspan="1"></th>

                                            <tr class="mtable">
                                                <td><span id="sr_no">1</span></td>
                                                <td><input type="text" name="full_name[]" id="full_name1" data-srno="1"
                                                        placeholder="Full name"
                                                        class="form-control form-control-sm number_only full_name"
                                                        required>
                                                </td>
                                                <td><input type="email" name="email[]" id="email1" data-srno="1"
                                                        placeholder="Email"
                                                        class="form-control form-control-sm number_only email" required>
                                                </td>
                                                <td><input type="text" name="phone[]" id="phone1" data-srno="1"
                                                        placeholder="Phone Number"
                                                        class="form-control form-control-sm number_only phone"></td>

                                                <td><button type="button" name="add_row" id="add_row"
                                                        class="btn btn-outline-success btn-sm ">+</button></td>
                                            </tr>

                                            <table class="">
                                                <tr>
                                                    <td colspan="4" align="left">
                                                        <input type="hidden" name="total_item" class="form-control "
                                                            id="total_item" value="1">

                                                    </td>
                                                </tr>
                                            </table>

                                        </table>

                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal">Accept</button> -->
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                            id="addSigner">Add
                            Signer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="selectSignatureModal" style="">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pick a resource to append</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="editToolForms">
                    <div class="modal-body">

                        <input type="hidden" id="" name="saveTool[document_id]"
                            value="<?php echo $_GET['document_id']?> ">
                        <input type="hidden" id="tool_id" name="editTool[tool_id]" placeholder="tool_id">
                        <input type="hidden" id="tool_name" name="editTool[tool_name]" placeholder="tool_name">
                        <input type="hidden" id="pos_top" name="editTool[tool_pos_top]">
                        <input type="hidden" id="pos_left" name="editTool[tool_pos_left]">
                        <input type="hidden" id="filename" name="editTool[filename]" placeholder="filename">
                        <input type="hidden" id="sign_type" name="editTool[sign_type]" placeholder="sign_type">
                        <input type="hidden" id="file" name="editTool[file]" placeholder="filename">



                        <div id="showElement"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                            id="append">Append</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="editSignerModal" style="">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Signers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="editSignerForm">
                    <div id="editSignerErrorMsg" class="text-center text-danger"></div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="signer-table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Full Name <sup style="color:red">*<sup></sup></sup></th>
                                    <th>Email <sup style="color:red">*<sup></sup></sup></th>
                                    <th>Phone</th>
                                    <th rowspan="1"></th>
                                </tr>
                            </thead>
                            <tbody id="showSigners"></tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                            id="editSigner">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="finishModal" style="">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <p>This document will be sent to the list below</p>

                        <form action="" id="shareDocumentForm">
                            <table class="">
                                <tbody>

                                    <tr class="mtable">
                                        <td colspan="2">
                                            <table class="table table-bordered" id="add_receiver">
                                                <th>Full Name <sup style="color:red">*<sup></th>
                                                <th>Email <sup style="color:red">*<sup></th>
                                                <th>Phone</th>
                                                <th rowspan="1"></th>
                                                <tbody id="all_signers">

                                                </tbody>
                                            </table>

                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            <div class="clearfix">
                                <button class="btn btn-primary float-end" id="sendNow">Send now</button>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php   include(SHARED_PATH . '/footer.php'); ?>

    <script src="js/draw-signature.js"></script>
    <script type="text/javascript" src="js/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- <script src="http://code.jquery.com/ui/1.8.17/jquery-ui.min.js"></script> -->
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <script src="js/doc-edit.js"></script>
    <script src="js/create-signature.js"></script>
    <script type="text/javascript" src="js/scrolltoolbar.js"></script>

    <script type="text/javascript">
    //document.addEventListener('contextmenu', event => event.preventDefault());
    var document_id = $("#document_id").val();
    $(document).on('click', '#addSignerBtn', function() {
        $("#addSignerModal").modal("show");
    })

    $(document).on('click', '#editSignerBtn', function() {
        $("#editSignerModal").modal("show");
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            // dataType: "json",
            data: {
                signer_form: 1,
                document_id: document_id,
            },
            success: function(data) {
                $("#showSigners").html(data);

            },
        });

    })


    $(document).on("keyup", "#fullName", function() {
        let inputField = $(this).val();
        $(".fullName").html(inputField)
    })
    $(document).on("keyup", "#initials", function() {
        let inputField = $(this).val();
        $(".initials").html(inputField)
    })
    var count = 1;
    $(document).on('click', '#add_row', function() {
        count = count + 1;
        $('#total_item').val(count);
        var data = addRow(count, sn = true);
        $('#expense-item-table').append(data);

    });

    $(document).on('click', '#add_receiver_row', function() {
        count = count + 1;
        // $('#total_item').val(count);
        var data = addRow(count, sn = false);
        $('#add_receiver').append(data);

    });

    function addRow(count, sn) {
        var html_code = '';
        html_code += '<tr id="row_id_' + count + '">';
        if (sn == true) {
            html_code += '<td><span id="sr_no">' + count + '</span></td>';
        }
        html_code += '<td><input type="text" name="full_name[]" id="full_name' +
            count +
            '" data-srno="' + count +
            '"  placeholder="Full name" class="form-control form-control-sm number_only full_name" required></td>';

        html_code += '<td><input type="text" name="email[]" id="email' + count +
            '" data-srno="' +
            count +
            '"  placeholder="Email" class="form-control form-control-sm number_only email" required></td>';

        html_code += '<td><input type="text" name="phone[]" id="phone' + count +
            '" data-srno="' +
            count +
            '"  placeholder="Phone Number" class="form-control form-control-sm number_only phone"></td>';

        html_code += '<td><button type="button" name="remove_row" id="' + count +
            '" class="btn btn-outline-danger btn-sm remove_row">X</button></td></tr>';

        return html_code
    }

    $(document).on('click', '.remove_row', function() {
        var row_id = $(this).attr("id");
        var total_item_amount = $('#amount' + row_id).val();
        var final_amount = $('#final_total_amt').text();
        var result_amount = parseFloat(final_amount) - parseFloat(
            total_item_amount);
        $('#final_total_amt').text(result_amount);
        $('#row_id_' + row_id).remove();
        count--;
        $('#total_item').val(count);

    });

    // Click to select siganture or initial
    $(document).on("click", ".element", function(e) {
        let name = $(this).html();
        let parentID = $(this).closest(".tool-box").data("id");
        let toolUser = $(this).closest(".tool-box").data('user');
        let parentName = $(this).closest(".tool-box").data("name");
        let tool_id = $("#tool_id").val(parentID)
        let tool_name = $("#tool_name").val(parentName)
        let category = '';
        if (name == 'Sign' || name == 'Initial') {
            name == 'Sign' ? category = 1 : category = 2;
            findElement(parentID, parentName, category, toolUser)
        } else {
            // alert(name)
        }
    });

    // Find sinature or
    function findElement(parentID, parentName, category, toolUser) {
        $.ajax({
            url: "inc/find-element.php",
            method: "POST",
            dataType: "json",
            data: {
                findElement: 1,
                tool_id: parentID,
                toolUser: toolUser,
                name: parentName,
                category: category,
            },
            success: function(data) {
                if (data.success == true) {
                    $("#selectSignatureModal").modal("show");
                    $("#showElement").html(data.details)
                    $("#pos_left").val(data.pos_left);
                    $("#pos_top").val(data.pos_top);
                } else {
                    if (data.msg == 'Create Signature') {
                        $("#createSignatureModal").modal("show");
                    } else {
                        errorToast('Alert', data.msg);
                    }

                }

            },
        });
    }


    $(document).on("change", '.tool_name', function() {
        let tool_n = $(this).data("filename")
        let sign_type = $(this).data("id")
        $("#filename").val(tool_n);
        $("#file").val($(this).data("file"));
        $("#sign_type").val(sign_type)
    })
    list_yourself();

    function list_yourself() {

        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            data: {
                list_yourself: 1,
                document_id: document_id,
            },
            success: function(data) {
                $("#list-yourself").html(data);
            },
        });
    }
    $(document).on("click", "#append", function(e) {
        e.preventDefault();
        if ($(".tool_name").is(":checked")) {
            // console.log($(".tool_name").is(":checked"))
            $.ajax({
                url: "inc/process-tool.php",
                method: "POST",
                dataType: "json",
                data: $("#editToolForms").serialize(),
                success: function(data) {
                    if (data.success == true) {
                        $("#selectSignatureModal").modal('hide');
                        load_session_data();
                    }

                },
            });
        } else {
            errorTime("Please select a resource to append")
        }
    })

    $(document).on("click", "#addSigner", function(e) {
        e.preventDefault();
        checkRecord()
    })
    $(document).on("click", "#editSigner", function(e) {
        e.preventDefault();
        editSigners();
    })

    function checkRecord() {
        var formData = $('#addSignerForm').serializeArray();
        formData.push({
            name: 'check_record',
            value: 1,
        });

        formData.push({
            name: 'document_id',
            value: $("#document_id").val(),
        });
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    createSigners()
                } else {
                    $("#addSignerErrorMsg").html(data.msg)
                }
            },
        });
    }
    const user_id = 0;
    const email = '';

    function createSigners() {
        var formData = $('#addSignerForm').serializeArray();

        formData.push({
            name: 'save',
            value: 1,
        });
        formData.push({
            name: 'document_id',
            value: document_id,
        });
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    $("#addSignerModal").modal('hide');
                    successToast('Alert', data.msg);
                    signer_dropdown(document_id)
                    fetch_signer_list(document_id)
                    $('#addSignerForm').trigger("reset");
                } else {
                    $("#addSignerErrorMsg").html(data.msg)
                }

            },
        });
    }

    function editSigners() {
        var formData = $('#editSignerForm').serializeArray();

        formData.push({
            name: 'edit',
            value: 1,
        });
        formData.push({
            name: 'document_id',
            value: document_id,
        });
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    $("#editSignerModal").modal('hide');
                    successToast('Alert', data.msg);
                    signer_dropdown(document_id)
                } else {
                    $("#editSignerErrorMsg").html(data.msg)
                }

            },
        });
    }

    signer_dropdown(document_id)

    function signer_dropdown(document_id) {
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            data: {
                fetch_list: 1,
                document_id: document_id,
            },
            success: function(data) {
                $(".signer-list").html(data)
            },
        });
    }

    fetch_signer_list(document_id)

    function fetch_signer_list(document_id) {
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            data: {
                list_signer: 1,
                document_id: document_id,
            },
            success: function(data) {
                $("#list-signers").html(data)
            },
        });
    }



    $(document).on("change", "#selectSigner", function(params) {
        let user_id = $(this).find(":selected").val();
        let email = $(this).find(":selected").data('email');
        fetch_signers_tool(user_id, email);
    })


    fetch_signers_tool(user_id, email);

    function fetch_signers_tool(user_id, email) {
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            data: {
                fetch: 1,
                user_id: user_id,
                email: email,
            },
            success: function(data) {
                $(".signer-wrapper").html(data)
            },
        });
    }
    $(document).on("click", "#addMe", function(params) {

        // let signer_id = $(this).attr('id');
        let signer_id = $(this).data('id');
        if ($(this).is(':checked')) {
            let action = 1;
            addMe(action, document_id, signer_id)
        } else {
            let title = 'Warning';
            let msg = 'Are you sure you want to remove this signer ?';
            let subMsg = 'This will remove all tools added in the signer' +
                "'" + 's name';
            let actionCall = 'Yes Remove';
            confirmAlert(title, msg, subMsg, actionCall, signer_id);
        }
    })

    $(document).on('click', '.actionCall', function() {
        let action = 0;
        let signer_id = $("#action_id").val()
        console.log(action, document_id, signer_id);
        addMe(action, document_id, signer_id);
        $("#editSignerModal").modal("hide");
    })
    $(document).on('click', '.cancel', function() {
        $("#addMe").prop("checked", true);
    })

    $(document).on('click', '.removeSigner', function() {
        // let signer_id = $(this).data('id');
        let title = 'Warning';
        let msg = 'Are you sure you want to remove this signer ?';
        let subMsg = 'This will remove all tools added in the signer' +
            "'" + 's name';
        let actionCall = 'Yes Remove';
        let signer_id = $(this).data('id');
        confirmAlert(title, msg, subMsg, actionCall, signer_id);
    })

    function addMe(action, document_id, signer_id) {
        $.ajax({
            url: "inc/add-me.php",
            method: "POST",
            dataType: "json",
            data: {
                addMe: 1,
                action: action,
                signer_id: signer_id,
                document_id: document_id,
            },
            success: function(data) {
                if (data.success == true) {
                    successToast('Alert', data.msg);
                    signer_dropdown(document_id)
                    load_session_data()
                    fetch_signers_tool(user_id, email);
                    fetch_signer_list(document_id)
                    list_yourself()
                } else {
                    errorToast('Alert', data.msg);
                }
            },
        });
    }
    $(document).on('click', '#finish', function() {
        $("#finishModal").modal("show");
        $.ajax({
            url: "inc/signer-script.php",
            method: "POST",
            // dataType: "json",
            data: {
                all_signers: 1,
                document_id: document_id,
            },
            success: function(data) {
                $("#all_signers").html(data);

            },
        });
    })
    $(document).on('click', "#sendNow", function() {
        $("#finishModal").modal("hide");
        successToast('Alert', "Email Sent Successfully");
        // successAlert("Email Sent Successfully");
        setTimeout(function() {
            window.location.href = '../dashboard/';
        }, 2000);

    });

    function Convert_HTML_To_PDF() {
        var elementHTML = document.getElementById('mainWrapper');

        html2canvas(elementHTML, {
            useCORS: true,
            onrendered: function(canvas) {
                var pdf = new jsPDF("p", "pt", "a4");

                var pageHeight = 1500;
                var pageWidth = 900;
                for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                    var srcImg = canvas;
                    var sX = 0;
                    var sY = pageHeight * i; // start 1 pageHeight down for every new page
                    var sWidth = pageWidth;
                    var sHeight = pageHeight;
                    var dX = 0;
                    var dY = 0;
                    var dWidth = pageWidth;
                    var dHeight = pageHeight;

                    window.onePageCanvas = document.createElement("canvas");
                    onePageCanvas.setAttribute('width', pageWidth);
                    onePageCanvas.setAttribute('height', pageHeight);
                    var ctx = onePageCanvas.getContext('2d');
                    ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                    var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                    var width = onePageCanvas.width;
                    var height = onePageCanvas.clientHeight;

                    if (i > 0) // if we're on anything other than the first page, add another page
                        pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)

                    pdf.setPage(i + 1); // now we declare that we're working on that page
                    pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height *
                        .62)); // add content to the page
                }

                // Save the PDF
                pdf.save('document.pdf');
            }
        });
    }
    </script>