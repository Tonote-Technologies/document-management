<?php require_once('../private/initialize.php');

$page = 'Prepare';
$page_title = 'Edit Document';

include(SHARED_PATH . '/header.php');
// include(SHARED_PATH . '/menu.php');
// pre_r($_GET['document_id']);
$id = $_POST['user_id'] ?? $loggedInAdmin->id;
$user = Admin::find_by_id($id);
$fullName = $user->full_name() ?? "Not Set";

$words = explode(" ", $fullName);
$initial = "";

foreach ($words as $w) {
  $initial .= $w[0];
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
    /*height: 50vh;*/
    /* min-width: 310px; */
}

.sidebar-wrap {
    position: relative;
}
</style>
<!-- <div style="height: 10vh;"></div> -->
<div class="container-fluid">
    <div class="row my-2 d-lg-none">

    </div>

    <div class="row">
        <div class="col-lg-2 d-sm-none d-lg-block">
            <div class="d-flex justify-content-center">
                <div class="sidebar-nav card px-2 pt-2" style="width: 172px;">
                    <div style="height: 100vh">
                        <div>Edit Tools
                            <hr>
                        </div>
                        <div class="border-bottom mb-1 pb-1">
                            <!-- <button type="button" class=""></button> -->
                            <div class="d-grid col-lg-12 col-md-12 mb-1 mb-lg-0">
                                <button type="button"
                                    class="btn btn-relief-primary waves-effect waves-float waves-light" id="addSigner">
                                    <i data-feather='plus'></i>
                                    <span> Add Signer</span>
                                </button>
                            </div>

                        </div>
                        <div class="border-bottom mb-1 pb-1">
                            <select class="form-control select2 ">
                                <option>Select Signer</option>
                                <option>Shafi Akinropo</option>
                            </select>
                        </div>
                        <div class="tool">
                            <li class="btn" data-id="textTool" data-value="Textarea">
                                Text Area <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <g clip-path="url(#a)" fill="#003BB3">
                                        <path
                                            d="M19.001 4.263V3.64h-2.676v.623h1.027v10.473h-1.027v.622h2.676v-.622h-1.027V4.263h1.027ZM.115 12.826l3.133-7.073c.218-.487.616-.783 1.155-.783h.116c.539 0 .924.296 1.142.783l3.132 7.073c.065.142.103.27.103.399 0 .526-.41.95-.937.95-.462 0-.77-.27-.95-.681l-.603-1.412H2.452l-.63 1.476c-.166.385-.5.616-.91.616A.91.91 0 0 1 0 13.25c0-.141.051-.282.115-.424Zm5.559-2.49L4.429 7.371l-1.245 2.965h2.49Zm4.158 1.784v-.026c0-1.502 1.143-2.195 2.773-2.195a4.89 4.89 0 0 1 1.682.282v-.115c0-.81-.501-1.258-1.477-1.258-.539 0-.975.077-1.348.192a.825.825 0 0 1-.282.051.794.794 0 0 1-.809-.795c0-.347.218-.642.527-.758.616-.23 1.283-.36 2.195-.36 1.065 0 1.835.283 2.323.77.514.514.745 1.272.745 2.196v3.132a.937.937 0 0 1-.95.937c-.565 0-.937-.398-.937-.808v-.013c-.475.526-1.13.873-2.08.873-1.296 0-2.362-.745-2.362-2.105Zm4.48-.45v-.346a3.026 3.026 0 0 0-1.245-.257c-.835 0-1.348.334-1.348.95v.025c0 .527.437.835 1.066.835.911 0 1.527-.5 1.527-1.207Z">
                                        </path>
                                    </g>
                                    <defs>
                                        <clipPath id="a">
                                            <path fill="#fff" d="M0 0h19v19H0z"></path>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>

                            <li class=" btn" data-id="signTool" data-value="Sign">
                                Signature <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <g clip-path="url(#a)" fill="#003BB3">
                                        <path
                                            d="M10.002 0 9.46.541a4 4 0 0 0-.75 1.04l-.57 1.143 5.138 5.138 1.143-.572a4.001 4.001 0 0 0 1.04-.749L16 6l-6-6ZM6.663 4.079C4.68 5.334 3 5 3 5L0 16l11-3s-.333-1.68.923-3.663l-5.26-5.26ZM5.5 12.002a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z">
                                        </path>
                                    </g>
                                    <defs>
                                        <clipPath id="a">
                                            <path fill="#fff" d="M0 0h16v16H0z"></path>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                            <li class=" btn" data-id="initialTool" data-value="Initial">
                                Initial <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <path
                                        d="M16 10V9h-3v1h1v4.5h-1v1h3v-1h-.94V10H16Zm-5-4.5V4H6v1.5h1.5V14H6v1.5h5V14H9.5V5.5H11Z"
                                        fill="#003BB3"></path>
                                </svg>
                            </li>


                            <li class=" btn" data-id="dateTool" data-value="Date"> Date
                                Signed <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <path
                                        d="M6.3 15.225h8.4a2.625 2.625 0 0 0 2.625-2.625V5.25A2.625 2.625 0 0 0 14.7 2.625h-.525V2.1a.525.525 0 1 0-1.05 0v.525h-2.1V2.1a.525.525 0 1 0-1.05 0v.525h-2.1V2.1a.525.525 0 1 0-1.05 0v.525H6.3A2.625 2.625 0 0 0 3.675 5.25v7.35A2.625 2.625 0 0 0 6.3 15.225Zm1.05-2.887a.788.788 0 1 1 0-1.576.788.788 0 0 1 0 1.576Zm0-2.625a.788.788 0 1 1 0-1.575.788.788 0 0 1 0 1.575Zm3.15 2.625a.788.788 0 1 1 0-1.576.788.788 0 0 1 0 1.576Zm0-2.625a.787.787 0 1 1 0-1.575.787.787 0 0 1 0 1.575Zm3.15 2.625a.788.788 0 1 1 0-1.576.788.788 0 0 1 0 1.576Zm0-2.625a.787.787 0 1 1 0-1.575.787.787 0 0 1 0 1.575ZM4.725 5.25A1.58 1.58 0 0 1 6.3 3.675h.525V4.2a.525.525 0 1 0 1.05 0v-.525h2.1V4.2a.525.525 0 1 0 1.05 0v-.525h2.1V4.2a.525.525 0 1 0 1.05 0v-.525h.525a1.58 1.58 0 0 1 1.575 1.575v.525H4.725V5.25Z"
                                        fill="#003BB3"></path>
                                </svg>
                            </li>

                            <li class=" btn" data-id="sealTool" data-value="Seal">
                                Seal <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <g clip-path="url(#a)" fill="#003BB3">
                                        <path
                                            d="M17.808 6.033c-.657-.657-.524-1.413-.54-1.516 0-3.099-3.284-3.075-3.288-3.077-.493 0-.957-.192-1.305-.54a3.08 3.08 0 0 0-4.351 0c-.657.657-1.413.523-1.516.54-3.099 0-3.075 3.284-3.077 3.288 0 .493-.192.956-.54 1.305a3.08 3.08 0 0 0 0 4.35c.348.35.54.813.54 1.306.002.004-.135 2.696 2.461 3.225V21l4.307-2.871L14.806 21v-6.086c2.68-.546 2.453-3.203 2.461-3.225 0-.493.192-.957.54-1.305a3.056 3.056 0 0 0 .902-2.176c0-.821-.32-1.594-.901-2.175ZM7.423 15.02c.339.075.65.245.9.496.434.433.974.721 1.561.84v.703L7.423 18.7v-3.679Zm3.691 2.039v-.703a3.055 3.055 0 0 0 1.56-.84c.252-.251.563-.42.902-.496v3.68l-2.462-1.641Zm5.824-7.547a3.056 3.056 0 0 0-.901 2.176c-.002.004.068 2.057-1.846 2.057-.093.016-1.34-.146-2.386.9-.35.35-.813.541-1.306.541-.493 0-.956-.192-1.305-.54-1.043-1.043-2.296-.885-2.386-.901-1.912 0-1.845-2.053-1.846-2.057 0-.822-.32-1.595-.901-2.176-.72-.72-.72-1.89 0-2.61a3.056 3.056 0 0 0 .9-2.175c.002-.004-.068-2.057 1.847-2.057.092-.017 1.339.146 2.386-.901.72-.72 1.89-.72 2.61 0a3.056 3.056 0 0 0 2.176.9c.004.002 2.057-.067 2.057 1.847.016.092-.146 1.339.9 2.386.35.349.541.812.541 1.305 0 .493-.192.957-.54 1.305Z">
                                        </path>
                                        <path
                                            d="M10.5 3.69a4.312 4.312 0 0 0-4.308 4.306 4.312 4.312 0 0 0 4.307 4.307 4.312 4.312 0 0 0 4.307-4.307A4.312 4.312 0 0 0 10.5 3.69Zm0 7.383a3.08 3.08 0 0 1-3.077-3.077 3.08 3.08 0 0 1 3.076-3.076 3.08 3.08 0 0 1 3.077 3.076 3.08 3.08 0 0 1-3.077 3.077Z">
                                        </path>
                                    </g>
                                    <defs>
                                        <clipPath id="a">
                                            <path fill="#fff" d="M0 0h21v21H0z"></path>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                            <li class=" btn" data-id="stampTool" data-value="Stamp">
                                Stamp
                                <svg width="21" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="ml-auto">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M21 0H0v12h21V0Zm-.913 1H.913v10h19.174V1Z" fill="#003BB3"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.348 3H3.652v6h13.696V3Zm-.913 1H4.565v4h11.87V4Z" fill="#003BB3"></path>
                                </svg>
                            </li>

                        </div>
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
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="tool-box  tool-style textTool" id="textTool">
        <input aria-invalid="false" type="text" class="textareaTool" value="">
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
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17"><span id="actionWord">Create</span> Your Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal">
                    <!-- <div id="signatureFile"></div> -->
                    <input type="hidden" name="action" id="signatureAction" value="create">
                    <div class="row border-bottom">
                        <div class="col-6">
                            <div class="mb-1 row">
                                <div class="col-sm-3 col-md-3">
                                    <label class="col-form-label" for="fullName">Full Name</label>
                                </div>
                                <div class="col-sm-9 col-md-9">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="fullName" class="form-control" name="fullName"
                                            value="<?php //echo $fullName?>" placeholder="Full name">
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
                                        <input type="text" id="initials" class="form-control" name="initials"
                                            value="<?php //echo $initial;?>" placeholder="Initial">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row p-0">
                        <div class="">
                            <ul class="nav nav-tabs border-bottom pt-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="first-tab" data-bs-toggle="tab" href="#first"
                                        aria-controls="first" role="tab" aria-selected="true">CHOOSE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="second-tab" data-bs-toggle="tab" href="#second"
                                        aria-controls="second" role="tab" aria-selected="false">DRAW</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="third-tab" data-bs-toggle="tab" href="#third"
                                        aria-controls="third" role="tab" aria-selected="false">UPLOAD</a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="first" aria-labelledby="first-tab" role="tabpanel">
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
                                                            for="customCheck<?php echo $key ?>"
                                                            id="signature-wrap<?php echo $key ?>">
                                                            <!-- <canvas> -->
                                                            <div class="css-pl8xw2" id="digi-sign<?php echo $key ?>">
                                                                <!-- Signed on ToNote by: -->
                                                                <div class="css-fv3lde">
                                                                    <span class="css-4x8v88 fullName"
                                                                        style="font-family: <?php echo $value?>;"><?php echo $fullName ?></span>
                                                                </div>
                                                                <!-- <span
                                                                    class="css-1j983t3 signatureID">6D80C6DF365242545678</span> -->
                                                            </div>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <label class="form-check-label" for="customCheck<?php echo $key ?>">
                                                        <div class="css-pl8xw2">
                                                            <!-- Signed on ToNote by: -->
                                                            <div class="css-fv3lde" id="initial-wrap<?php echo $key ?>">
                                                                <span class="css-4x8v88 initials"
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
                                </div>
                                <div class="tab-pane" id="second" aria-labelledby="second-tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-9 border-right p-0">
                                            <div class="text-center">Draw your signature in the tool-box </div>
                                            <div id="canvas" class="d-flex justify-content-center">
                                                <canvas class="roundCorners" id="newSignature"
                                                    style="position: relative; margin: 0; padding: 0; border: 1px solid #CCC; width: 474px; height: 313px;"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 p-0">
                                            <div class="">
                                                <button type="button" class="btn btn-dark mb-2 saveSign"
                                                    onclick="signatureSave()">Create
                                                    signature</button>
                                                <button type="button" class="btn btn-outline-dark"
                                                    onclick="signatureClear()">Clear
                                                    signature</button>
                                            </div>

                                            <div class="mt-3">
                                                <img id="saveSignature" alt="Saved image png"
                                                    src="<?php echo url_for('assets/images/empty.png') ?>" width="150"
                                                    height="150" />


                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="third" aria-labelledby="third-tab" role="tabpanel">
                                    Upload goes here
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="p-2 ">
                <div class="pb-1">
                    <!-- By signing this document with my electronic signature. 
                    By clicking Create,I agree that the signature is as valid as my hand writen signature to the extent allowed by law -->

                    By clicking Create, I agree that the signature and initials will be the electronic
                    representation of my signature and initials for all purposes when I (or my agent) use them
                    on document through this platform, including legally binding contracts - just the same as a
                    pen-and-paper signature or initial.
                </div>
                <section class="d-flex justify-content-between">
                    <table>
                        <tr>
                            <td id="selected-signature"></td>
                            <td id="selected-initial"></td>
                        </tr>
                    </table>
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
<input type="hidden" id="storage">
<input type="hidden" id="currentId">
<input type="hidden" id="toolName">

<input type="hidden" id="top">
<input type="hidden" id="left">

<input type="hidden" id="selectedSignature">
<input type="hidden" id="watch">



<input type="hidden" class="url" value="upload/certificate.pdf">
<input type="hidden" class="url" value="upload/EmployeeHandbook.pdf">


<div class="modal fade show" id="addSignerModal" style="">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Signer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="addParticipants" method="post">
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
                                                    class="form-control form-control-sm number_only full_name" required>
                                            </td>
                                            <td><input type="email" name="email[]" id="email1" data-srno="1"
                                                    placeholder="Email"
                                                    class="form-control form-control-sm number_only email" required>
                                            </td>
                                            <td><input type="text" name="phone[]" id="phone1" data-srno="1"
                                                    placeholder="Phone Number"
                                                    class="form-control form-control-sm number_only phone"></td>

                                            <td><button type="button" name="add_row" id="add_row"
                                                    class="btn btn-success btn-sm">+</button></td>
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
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Add
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

                    <input type="hidden" id="" name="saveTool[document_id]" value="<?php echo $_GET['document_id']?> ">
                    <input type="hidden" id="tool_id" name="editTool[tool_id]" placeholder="tool_id">
                    <input type="hidden" id="tool_name" name="editTool[tool_name]" placeholder="tool_name">
                    <input type="hidden" id="pos_top" name="editTool[tool_pos_top]">
                    <input type="hidden" id="pos_left" name="editTool[tool_pos_left]">
                    <input type="hidden" id="filename" name="editTool[filename]" placeholder="filename">

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


<?php   include(SHARED_PATH . '/footer.php'); ?>

<script src=" js/draw-signature.js"></script>
<script type="text/javascript" src="js/html2canvas.js">
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="js/doc-edit.js"></script>
<script src="js/create-signature.js"></script>
<script type="text/javascript" src="js/scrolltoolbar.js"></script>

<script type="text/javascript">
$(document).on('click', '#addSigner', function() {
    $("#addSignerModal").modal("show");
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
        '" class="btn btn-danger btn-sm remove_row">X</button></td></tr>';

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

$(document).on("click", ".element", function(e) {
    var name = $(this).html();
    var parentID = $(this).closest(".tool-box").data("id");
    console.log(parentID);
    var parentName = $(this).closest(".tool-box").data("name");
    var tool_id = $("#tool_id").val(parentID)
    var tool_name = $("#tool_name").val(parentName)
    let category = '';
    if (name == 'Sign' || name == 'Initial') {
        name == 'Sign' ? category = 1 : category = 2;
        findElement(parentID, parentName, category)
    } else {
        // alert(name)
    }
});


function findElement(parentID, parentName, category) {
    $.ajax({
        url: "inc/find-element.php",
        method: "POST",
        dataType: "json",
        data: {
            findElement: 1,
            tool_id: parentID,
            name: parentName,
            category: category,
        },
        success: function(data) {
            $("#selectSignatureModal").modal("show");
            $("#showElement").html(data.details)
            $("#pos_left").val(data.pos_left);
            $("#pos_top").val(data.pos_top);
            // $("#filename").val(data.filename);

        },
    });
}


$(document).on("change", '.tool_name', function() {
    let tool_n = $(this).data("file")
    $("#filename").val(tool_n);
})

$(document).on("click", "#append", function(e) {
    e.preventDefault();
    if ($(".tool_name").is(":checked")) {
        console.log($(".tool_name").is(":checked"))
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
</script>