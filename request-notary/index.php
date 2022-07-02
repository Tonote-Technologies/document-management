<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';

include(SHARED_PATH . '/header.php');
?>


<button class="btn btn-outline-primary toast-basic-toggler mt-2 waves-effect" id="toastbtn">Toast</button>

<div class="card-body d-none">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="first-tab" data-bs-toggle="tab" aria-controls="first" href="#first"
                role="tab" aria-selected="true">Select</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="second-tab" data-bs-toggle="tab" aria-controls="second" href="#second" role="tab"
                aria-selected="false">Draw</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="third-tab" data-bs-toggle="tab" aria-controls="third" href="#third" role="tab"
                aria-selected="false">Upload
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="first" aria-labelledby="first-tab" role="tabpanel">
            <p>
            <div class="row  mb-1">
                <div class="col-6">
                    <div class="mb-1 row">
                        <div class="col-sm-3 col-md-3">
                            <label class="col-form-label" for="fullName">Full
                                Name</label>
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
            <div class="container">
                <!-- <div class="row">
                    <div class="col-6 border alert-primary p-2">Signature</div>
                    <div class="col-6 border alert-primary p-2">Initial</div>
                </div> -->
                <div class="row ">
                    <?php 
                        // $sn = 1; 
                        // $fontFamily = ['Alex Brush', 'Arizonia', 'Great Vibes', 'Creattion Demo', 'Scriptina Regular','Montserrat', 'Oleo Script Swash Caps', 'The Nautigal', 'Poppins', 'Roboto'];
                        $fontFamily = ['Arizonia', 'Montserrat',];
                        foreach ($fontFamily as $key => $value)  { 
                        $key = $key + 1;

                    ?>
                    <div class="border row mb-2 d-flex align-items-center" style="border-radius: 1.49rem;">
                        <div class="col-6">
                            <div class="form-check p-1 d-flex align-items-center">

                                <div class="pr-2">
                                    <input type="hidden" name="signature_id" value="<?php echo $key ?>">
                                    <input type="radio" name="sign" class="form-check-input choose"
                                        id="customCheck<?php echo $key ?>" data-id="<?php echo $key ?>"
                                        <?php //echo $signature_id==$key ? 'checked' : '' ?>>
                                </div>

                                <label class="form-check-label" for="customCheck<?php echo $key ?>">
                                    <div class="css-pl8xw2">
                                        <div class="css-fv3lde">
                                            <span class="css-4x8v88 fullName" id="signature-wrap<?php echo $key ?>"
                                                style="font-family: <?php echo $value?>;">
                                                <?php //echo $fullName ?>Indigo James
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-check-label" for="customCheck<?php echo $key ?>">
                                <div class="css-pl8xw2">
                                    <!-- Signed on ToNote by: -->
                                    <div class="css-fv3lde">
                                        <span class="css-4x8v88 initials" id="initial-wrap<?php echo $key ?>"
                                            style="font-family: <?php echo $value?>;">IJ
                                            <?php //echo $initial;?>
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
                <div class="row">
                    <table class="table " id="cloneWrap">
                        <tr class="p-0 m-0">
                            <td class="p-2 m-0"><span id="selected-signature"></span>
                            </td>
                            <td class="p-1 m-0"><span id="selected-initial"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            </p>

        </div>
        <div class="tab-pane" id="second" aria-labelledby="second-tab" role="tabpanel">
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
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                            checked="">
                        <label class="btn btn-outline-primary waves-effect saveSign" for="btnradio1"
                            onclick="signatureSave()">Generate</label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary waves-effect" for="btnradio2"
                            onclick="signatureClear()">Clear</label>
                    </div>
                    <div class="mt-1">
                        <input type="hidden" id="drawnSignature">
                        <img id="saveSignature" alt="Saved image png"
                            src="<?php echo url_for('assets/images/empty.png') ?>" width="150" height="150" />
                    </div>
                </div>
            </div>
            </p>
        </div>

        <div class="tab-pane" id="third" aria-labelledby="third-tab" role="tabpanel">
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
                                            src="<?php echo url_for('assets/images/download.png') ?>" alt=""
                                            width="100">
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
<?php include(SHARED_PATH . '/footer.php');?>

<script>
document.getElementById("toastbtn").onclick = function() {
    successToast("Notice", "Please create your signature");
};
</script>