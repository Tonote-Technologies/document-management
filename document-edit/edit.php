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
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Arizonia&family=Great+Vibes&family=Inter:wght@200;500&family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400&family=Oleo+Script+Swash+Caps&family=The+Nautigal&display=swap"
    rel="stylesheet">
<!-- Font End -->
<link rel="stylesheet" type="text/css" href="css/doc-edit.css">
<link rel="stylesheet" type="text/css" href="css/signature-design.css">
<link rel="stylesheet" type="text/css" href="css/pdf2img.css">



<input type="hidden" id="document_id" value="<?php echo $_GET['document_id'] ?>">


<style type="text/css">
/* Sticky our navbar on window scroll */
#viewPort {
    position: relative;
}

.sidebar-nav.sticky {
    position: fixed;
    top: 100;
    bottom: 0;
}

.sidebar-wrap {
    position: relative;
}

input[type="file"] {
    display: none;
}

.file-upload-wrapper {
    border: 2px dashed #EBE9F1;

}

.custom-file-upload {
    /* border: 1px dashed #EBE9F1 !important; */
    font-size: 20px;
    padding: 30px 12px;
    cursor: pointer;
    width: 100%;
    text-align: center;
    height: 200px;
    /* display: flex; */
    display: inline-block;
    align-items: center;
    justify-content: center;
}

.custom-file-upload:hover {
    border: 2px dashed #000;
    color: #000;
    font-weight: bolder;
}

.newClass {
    /* display: none; */
    font-size: 25px;
    color: #000;
}

.nav-tabs .nav-link.active {
    color: #FFF;
    background-color: #003bb3;
    border-radius: 2px;
    /* border-bottom: 2px solid #003bb3 !important; */
}

/* #nwgrip,
#negrip,
#swgrip,
#segrip,
#ngrip,
#egrip,
#sgrip,
#wgrip {
    width: 10px;
    height: 10px;
    background-color: #ffffff;
    border: 3px solid #000000;
} */

/* .ui-resizable-handle {
    position: absolute;
    font-size: 0.1px;
    display: block;
}

.ui-resizable-disabled .ui-resizable-handle,
.ui-resizable-autohide .ui-resizable-handle {
    display: none;
}

.ui-resizable-n {
    cursor: n-resize;
    height: 7px;
    width: 100%;
    top: 0px;
    left: 0;
    background: url(http://www.dakardesign.com/resize-handle.gif) top center no-repeat;
    border-top: 1px solid #000;
}

.ui-resizable-s {
    cursor: s-resize;
    height: 7px;
    width: 100%;
    bottom: 0px;
    left: 0;
    background: url(http://www.dakardesign.com/resize-handle.gif) bottom center no-repeat;
    border-bottom: 1px solid #000;
}

.ui-resizable-e {
    cursor: e-resize;
    width: 7px;
    right: 0px;
    top: 0;
    height: 100%;
    background: url(http://www.dakardesign.com/resize-handle.gif) right center no-repeat;
    border-right: 1px solid #000;
}

.ui-resizable-w {
    cursor: w-resize;
    width: 7px;
    left: 0px;
    top: 0;
    height: 100%;
    background: url(http://www.dakardesign.com/resize-handle.gif) left center no-repeat;
    border-left: 1px solid #000;
}

.ui-resizable-se {
    cursor: se-resize;
    width: 7px;
    height: 7px;
    right: 0px;
    bottom: 0px;
    background: url(http://www.dakardesign.com/resize-handle.gif) bottom right no-repeat;
    border: 1px solid #000;
}

.ui-resizable-sw {
    cursor: sw-resize;
    width: 9px;
    height: 9px;
    left: 0px;
    bottom: 0px;
    background: url(http://www.dakardesign.com/resize-handle.gif) bottom left no-repeat;
    border-top: 1px solid #000;
}

.ui-resizable-nw {
    cursor: nw-resize;
    width: 9px;
    height: 9px;
    left: 0px;
    top: 0px;
    background: url(http://www.dakardesign.com/resize-handle.gif) top left no-repeat;
    border-top: 1px solid #000;
}

.ui-resizable-ne {
    cursor: ne-resize;
    width: 9px;
    height: 9px;
    right: 0px;
    top: 0px;
    background: url(http://www.dakardesign.com/resize-handle.gif) top right no-repeat;
    border-top: 1px solid #000;
}

#resizable {
    top: 150px;
    left: 150px;
    width: 150px;
    height: 150px;
    padding: 0.5em;
}

#resizable h3 {
    text-align: center;
    margin: 0;
} */



.button,
.rectangle {
    background:
        url(http://pic.52mxp.com/site/tool/line-h.png) top repeat-x,
        url(http://pic.52mxp.com/site/tool/line-h.png) bottom repeat-x,
        url(http://pic.52mxp.com/site/tool/line-v.png) left repeat-y,
        url(http://pic.52mxp.com/site/tool/line-v.png) right repeat-y;
}

.button {
    box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.5) !important;
}
</style>
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
    <div class="container">
        <div class="row my-2 ">
            <div class="col-lg-12">
                <!-- <button class="btn btn-primary float-end" id="finish">Finish</button> -->

                <div class="btn-group float-end">
                    <button class="btn btn-outline-primary">Request a Notary</button>
                    <button class="btn btn-primary" id="finish">Share document</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 d-sm-none d-lg-block">
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
                            <!-- <button type="button" class=""></button> -->
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
                <!-- <div class="title">
                    <img src="upload/sign1654145135img.png" data-name="Sign" data-id="69"
                        style="top: 341.5; left: 512.171875; "
                        class="tool-box main-element ui-draggable ui-draggable-handle">
                    <button type="button" class="btn-close removeItem" data-id="69"></button>
                </div> -->
                <div class="card-body" id="mainWrapper" style="overflow-x:scroll;">

                </div>
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
    </div>


    <div class="modal fade text-start" id="createSignatureModal">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17"><span id="actionWord">Create</span> Your Signature
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <!-- <div id="signatureFile"></div> -->
                        <input type="hidden" name="action" id="signatureAction" value="create">


                        <div>
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs nav-left flex-column" role="tablist" style="height: 140px;">
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
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Signature</th>
                                                    <th>Initial</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                        // $sn = 1; 
                        // $fontFamily = ['Alex Brush', 'Arizonia', 'Great Vibes', 'Creattion Demo', 'Scriptina Regular','Montserrat', 'Oleo Script Swash Caps', 'The Nautigal', 'Poppins', 'Roboto'];
                        $fontFamily = ['Arizonia', 'Montserrat',];
                        foreach ($fontFamily as $key => $value)  { 
                        $key = $key + 1;

                    ?>
                                                <tr>
                                                    <td class="">
                                                        <div class="form-check p-1 d-flex align-items-center">

                                                            <div class="pr-2">
                                                                <input type="hidden" name="signature_id"
                                                                    value="<?php echo $key ?>">
                                                                <input type="radio" name="sign"
                                                                    class="form-check-input choose"
                                                                    id="customCheck<?php echo $key ?>"
                                                                    data-id="<?php echo $key ?>"
                                                                    <?php //echo $signature_id == $key ? 'checked' : '' ?>>
                                                            </div>

                                                            <label class="form-check-label"
                                                                for="customCheck<?php echo $key ?>">
                                                                <div class="css-pl8xw2">
                                                                    <div class="css-fv3lde">
                                                                        <span class="css-4x8v88 fullName"
                                                                            id="signature-wrap<?php echo $key ?>"
                                                                            style="font-family: <?php echo $value?>;"><?php echo $fullName ?></span>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="p-0">
                                                        <label class="form-check-label"
                                                            for="customCheck<?php echo $key ?>">
                                                            <div class="css-pl8xw2">
                                                                <!-- Signed on ToNote by: -->
                                                                <div class="css-fv3lde">
                                                                    <span class="css-4x8v88 initials"
                                                                        id="initial-wrap<?php echo $key ?>"
                                                                        style="font-family: <?php echo $value?>;"><?php echo $initial;?></span>
                                                                </div>
                                                                <!-- <span
                                        class="css-1j983t3 signatureID">6D80C6DF365242545678</span> -->
                                                            </div>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>

                                        <div class="table-responsive text-center">
                                            <table class="table " id="cloneWrap">
                                                <tr class="p-0 m-0">
                                                    <td class="p-2 m-0"><span id="selected-signature"></span></td>
                                                    <td class="p-1 m-0"><span id="selected-initial"></span></td>
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
                                                        class="btn btn-outline-success btn-sm">+</button></td>
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
                        <input type="hidden" id="file" name="editTool[file]" placeholder="filename">
                        <input type="text" name="editTool[tool_class]" value="resize tool-box main-element">


                        <div id="showElement"></div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal">Accept</button> -->
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
                            <tbody id="showSigners">


                            </tbody>
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
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center py-1">
                        <p>The following people will be inivited to sign this document</p>
                        <div class="table-responsive text-center mb-1 p-1">
                            <table class="table table-bordered table-sm" style="font-size: 12px;">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <td>Name</td>
                                        <td>Email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Frances Udeme</td>
                                        <td>udeme@gmail.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary">Send now</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php   include(SHARED_PATH . '/footer.php'); ?>

    <script src=" js/draw-signature.js"></script>
    <script type="text/javascript" src="js/html2canvas.js">
    </script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="js/doc-edit.js"></script>
    <script src="js/create-signature.js"></script>
    <script type="text/javascript" src="js/scrolltoolbar.js"></script>

    <script type="text/javascript">
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

        var html_code = '';

        html_code += '<tr id="row_id_' + count + '">';
        html_code += '<td><span id="sr_no">' + count + '</span></td>';
        html_code += '<td><input type="text" name="full_name[]" id="full_name' + count +
            '" data-srno="' + count +
            '"  placeholder="Full name" class="form-control form-control-sm number_only full_name" required></td>';

        html_code += '<td><input type="text" name="email[]" id="email' + count + '" data-srno="' +
            count +
            '"  placeholder="Email" class="form-control form-control-sm number_only email" required></td>';

        html_code += '<td><input type="text" name="phone[]" id="phone' + count + '" data-srno="' +
            count +
            '"  placeholder="Phone Number" class="form-control form-control-sm number_only phone"></td>';

        html_code += '<td><button type="button" name="remove_row" id="' + count +
            '" class="btn btn-outline-danger btn-sm remove_row">X</button></td></tr>';

        $('#expense-item-table').append(html_code);

    });

    $(document).on('click', '.remove_row', function() {
        var row_id = $(this).attr("id");
        var total_item_amount = $('#amount' + row_id).val();
        var final_amount = $('#final_total_amt').text();
        var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
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
                        errorAlert(data.msg);
                    }

                }
                // $("#filename").val(data.filename);

            },
        });
    }


    $(document).on("change", '.tool_name', function() {
        let tool_n = $(this).data("filename")
        $("#filename").val(tool_n);
        $("#file").val($(this).data("file"));
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
                    successAlert(data.msg);
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
                    successAlert(data.msg);
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
                    successAlert(data.msg);
                    signer_dropdown(document_id)
                    load_session_data()
                    fetch_signers_tool(user_id, email);
                    fetch_signer_list(document_id)
                    list_yourself()
                } else {
                    errorAlert(data.msg);
                }
            },
        });
    }
    $(document).on('click', '#finish', function() {
        $("#finishModal").modal("show");
    })
    </script>