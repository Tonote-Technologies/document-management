<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';

include(SHARED_PATH . '/header.php');
?>
<style>
.request-title {
    color: #3c4043;
    font-family: Roboto, Arial, sans-serif;
    font-size: 20px;
    /* height: 32px; */
    /* line-height: 28px; */
    border: none;
    margin-top: 2px;
    /* background-color: transparent; */
    font-weight: 400;
    border-bottom: 1px solid #D8D6DE;
    border-radius: 0;
}

.fs-13 {
    font-size: 13px
}

.nav-tabs .nav-link.active {
    border-bottom: 2px solid #003bb3 !important;
    background-color: transparent;
}

.request-title:active {
    background-color: transparent;
}
</style>
<div class="content-body">
    <h3>Requesting a Notary</h3>
    <p class="mb-2">
        <li>Please select a date and time for your notary session</li>
        <li>Choose a convenient time for you and your signers</li>
        <li>We will send you a confirmation email with the meeting link and session time.</li>
        <li>You can track the status of your requests in “My Requests”</li>
    </p>
    <section class="invoice-edit-wrapper">
        <div class="row invoice-edit">
            <!-- Invoice Edit Left starts -->
            <div class="col-xl-9 col-md-8 col-12">
                <div class="mb-2">
                    <input type="text" class="form-control request-title" placeholder="Add Title">

                </div>
                <div class="card invoice-preview-card">
                    <!-- Header starts -->
                    <div class="card-body invoice-padding invoice-product-details">

                        <div data-repeater-list="group-a">
                            <div class="repeater-wrapper" data-repeater-item="">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5>All Participants</h5>
                                    </div>
                                    <div>

                                        <button class="btn btn-outline-primary" id="btn-add">+ Add </button>
                                    </div>
                                </div>
                                <div class="row mt-2">

                                    <div class="col-12 d-flex product-details-border position-relative pe-0">
                                        <table class="table table-borderless fs-13">
                                            <!-- <thead> -->
                                            <tr>
                                                <th>SN</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                            </tr>
                                            <!-- </thead> -->

                                            <tbody>
                                                <tr class="mtable">
                                                    <td><span id="sr_no">1</span></td>
                                                    <td>Dele Ashade</td>
                                                    <td>ashade@gmail.com</td>
                                                    <td>08092364789</td>
                                                    <td>Signer</td>
                                                </tr>
                                            </tbody>

                                            <table class="">
                                                <tr>
                                                    <td colspan="4" align="left">
                                                        <input type="hidden" name="total_item" class="form-control "
                                                            id="total_item" value="1">

                                                    </td>
                                                </tr>
                                            </table>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Product Details ends -->



                    <hr class="invoice-spacing mt-0">

                    <div class="card-body invoice-padding py-0">
                        <!-- Invoice Note starts -->
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="note" class="form-label fw-bold">Add Description:</label>
                                    <textarea class="form-control" rows="2" id="note"
                                        placeholder="Hi I'm inviting you to co-sign a document online on the ToNote Platform"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
            </div>
            <!-- Invoice Edit Left ends -->

            <!-- Invoice Edit Right starts -->
            <div class="col-xl-3 col-md-4 col-12">

                <div class=""
                    style="background: transparent; margin-bottom: 2rem; border-radius: 0.428rem;     word-wrap: break-word;">
                    <div class="card-header border-bottom">
                        <h4 class="">Session Details</h4>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                    aria-controls="home" role="tab" aria-selected="true">Pick a slot</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    aria-controls="profile" role="tab" aria-selected="false">Schedule a Date</a>
                            </li>
                        </ul>


                        <div class="tab-content">
                            <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <label for="">Today</label>
                                    </div>
                                    <div class="p-1">
                                        <button type="button" class="form-control btn-outline-primary">
                                            9:00 - 9:30</button>
                                    </div>
                                    <div class="p-1">
                                        <button type="button" class="form-control btn-outline-primary">
                                            9:30 - 10:00</button>
                                    </div>
                                    <div class="p-1">
                                        <button type="button" class="form-control btn-outline-primary">
                                            10:30 - 11:00</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <div class="row mb-2">

                                    <div class="col-12">
                                        <label for="">Date</label>
                                        <div class="form-group mb-1">
                                            <input type="date" class="form-control" name="" id="">
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <label for="">Time Slot</label>
                                        <div class="form-group mb-1">
                                            <button type="button" class="form-control btn-outline-primary">
                                                9:00 - 9:30</button>
                                        </div>
                                        <div class="form-group mb-1">
                                            <button type="button" class="form-control btn-outline-primary">
                                                9:30 - 10:00</button>
                                        </div>
                                        <div class="form-group mb-1">
                                            <button type="button" class="form-control btn-outline-primary">
                                                10:30 - 11:00</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Invoice Edit Right ends -->
        </div>


    </section>
    <section class=" ">

        <div class="clearfix">
            <button class="float-end btn btn-primary">Submit Request</button>
        </div>
    </section>

</div>

<div class="modal fade " id="addModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Participants</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="addSignerForm" method="post">
                <div id="addSignerErrorMsg" class="text-center text-danger"></div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="#" class="invoice-repeater">
                            <div data-repeater-list="invoice">
                                <div data-repeater-item="" id="add_item">
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="fullname">Fullname</label>
                                                <input type="text" class="form-control" id="fullname"
                                                    aria-describedby="fullname" placeholder="fullname">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    aria-describedby="email" placeholder="name@domain.com">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone"
                                                    aria-describedby="phone" placeholder="08012345678">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="role">Role</label>
                                                <select type="text" class="form-select" name="role">
                                                    <option value="">Select Role</option>
                                                    <option value="signer">Signer</option>
                                                    <option value="witness">Witness</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="action"></label>
                                                <!-- <button class="btn btn-outline-danger text-nowrap px-1 waves-effect"
                                                    data-repeater-delete="" type="button">
                                                    x
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button id="add_row"
                                        class="btn btn-icon btn-outline-primary waves-effect waves-float waves-light"
                                        type="button" data-repeater-create="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus me-25">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        <span>Add New Row</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal">Accept</button> -->
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                        id="addSigner">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php');?>

<script>
$(document).on("click", "#btn-add", function() {
    $("#addModal").modal("show")
});


var count = 1;


$(document).on('click', '#add_row', function() {
    count = count + 1;
    var data = addRow(count, sn = false);
    $('#add_item').append(data);

});

function addRow(count, sn) {
    var html_code = '<div class="border-bottom mb-1" id="row_id_' + count + '">';

    html_code += '<div class="row d-flex align-items-end" >';
    html_code +=
        '<div class="col-md-3 col-12"><div class="mb-1"><label class="form-label" for="fullname">Fullname</label><input type="text" class="form-control" id="fullname" aria-describedby="fullname" placeholder="fullname"></div></div>';

    html_code +=
        '<div class="col-md-3 col-12"><div class="mb-1"><label class="form-label" for="email">Email</label><input type="email" class="form-control" id="email" aria-describedby="email" placeholder="name@domain.com"></div></div>';

    html_code +=
        '<div class="col-md-3 col-12"><div class="mb-1"><label class="form-label" for="phone">Phone</label><input type="text" class="form-control" id="phone" aria-describedby="phone" placeholder="08012345678"></div></div>';
    html_code +=
        '<div class="col-md-2 col-12"><div class="mb-1"><label class="form-label" for="role">Role</label><select type="text" class="form-select" name="role"><option value="">Select Role</option><option value="signer">Signer</option><option value="witness">Witness</option></select></div></div>';
    html_code +=
        '<div class="col-md-1 col-12"><div class="mb-1"><label class="form-label" for="action"></label><button class="btn btn-outline-danger text-nowrap px-1 waves-effect remove_row" id="' +
        count + '" data-repeater-delete="" type="button">x';
    html_code += '</div> ';
    html_code += '</div> ';



    return html_code
}

$(document).on('click', '.remove_row', function() {
    var row_id = $(this).attr("id");
    $('#row_id_' + row_id).remove();
    count--;

});
</script>