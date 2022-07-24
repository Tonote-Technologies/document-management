<?php require_once('../private/initialize.php');
$page = 'Certificate';
$page_title = 'Digital Certificate';

include(SHARED_PATH . '/header.php');
?>
<style>
.digi_cert {
    background-image: url('cert-bg.png');
    background-repeat: no-repeat;
    background-size: 100%;
    /* background-color: #f7f8f9; */
}
</style>
<div class="container-fluid">

    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-sm-12s">
            <div class="clearfix mb-1">
                <!-- <button class="btn btn-outline-secondary float-end">Share</button> -->
                <div class="btn-group">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-float waves-light" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Share
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                        <a class="dropdown-item" href="#">Downalod</a>
                        <a class="dropdown-item" href="#">Print</a>
                    </div>
                </div>
            </div>
            <section class="card">
                <img src="affidavit.png" class="img-fluid" alt="">
            </section>
            <section class="card digi_cert">
                <div class="sec-1 ">

                    <div class=" p-2">
                        <div class="text-center">
                            <h1 class="fw-bolder  p-2">Digital Transaction Certificate</h1>
                            <p>Document Ref: 97326d3f-2ac8-478b-8a23-5f5c70e12306</p>
                        </div>

                        <div>
                            <h5 class="fw-bolder">Notarised Document Name: Affidavit of Bachelorhood</h5>
                            <p class="fw-bolder">Document Notarised On: 07 Jul, 2022.</p>
                        </div>


                        <table class="table table-bordered border-dark">

                            <?php for ($i=0; $i < 2; $i++) { ?>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-6 pb-1">
                                            <?php echo $i == 0 ? 'Adekunle Enabule' : 'Oluyemi Abiodun'; ?></div>
                                        <div class="col-6 pb-1">
                                            <?php echo $i == 0 ? 'Notary' : 'Document Owner'; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 pb-1">Email</div>
                                        <div class="col-6 pb-1">olu@gmail.com</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 pb-1">ID Number.</div>
                                        <div class="col-6 pb-1">1234567889</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 pb-1">Device IP.</div>
                                        <div class="col-6 pb-1">127.0.0.1</div>
                                    </div>
                                </td>
                                <td>
                                    Signature
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>

                <div class="sec-2">
                    <div class="card-header">
                        <h4 class="card-title">Audit Trail</h4>
                    </div>
                    <div class="card-body">
                        <ul class="timeline">
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Oluyemi Abiodun (Document Owner)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Created Affidavit.</p>

                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Oluyemi Abiodun (Document Owner)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Added Date Tools to document.</p>

                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary  timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Oluyemi Abiodun (Document Owner)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Added Text tool to document .</p>

                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Oluyemi Abiodun (Document Owner)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Fill Text tool with text -- Oluyemi Abiodun --.</p>

                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Adekunle Enabule (Notary)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Add Signature .</p>

                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                        <h6>Adekunle Enabule (Notary)</h6>
                                        <span class="timeline-event-time">07 Jul, 2022 10:05</span>
                                    </div>
                                    <p>Add Stamp .</p>

                                </div>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-end">
                            <img src="logo-dark.png" height="26" alt="">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>