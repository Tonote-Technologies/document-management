       </div>
       </div>
       </div>
       <!-- End: Content-->

       <!-- <div class="modal fade show" id="confirmModal"> -->
       <div class="modal fade text-start show" id="confirmModal" tabindex="-1" aria-labelledby="myModalLabel4"
           data-bs-backdrop="false" aria-modal="true" role="dialog">
           <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header d-flex justify-content-center alert-primary">
                       <div class="text-center ">
                           <div class="d-flex justify-content-center">
                               <div class="">
                                   <!-- <img src="img/fav.png" height="80"> -->
                               </div>
                           </div>
                           <h4 class="modal-title w-100 msgTitle text-center">Awesome!</h4>

                       </div>
                   </div>

                   <div class="modal-body container">
                       <h3 class="text-center" id="displayMsg">Message goes here</h3>
                       <p class="text-center" id="subMsg">Sub Message</p>

                       <input type="hidden" id="action_id">
                   </div>
                   <div class="modal-footer">
                       <button class="btn btn-primary btn-block cancel" data-bs-dismiss="modal">Cancel</button>
                       <button class="btn btn-outline-primary btn-block actionCall" data-bs-dismiss="modal">Yes</button>
                   </div>

               </div>
           </div>
       </div>

       <!-- BEGIN: Footer-->
       <footer class="footer footer-static footer-light">
           <p class="clearfix mb-0 d-none">

               <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy;
                   <?php echo date('Y') ?><a class="ms-25" href="https://1.envato.market/pixinvent_portfolio"
                       target="_blank">ToNote
                       Technologies Limited</a>
                   <span class="d-none d-sm-inline-block">, All rights Reserved</span></span>

               <!-- <span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span> -->
           </p>
       </footer>
       <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
       <!-- END: Footer-->


       <!-- BEGIN: Vendor JS-->
       <script src="<?php echo url_for('assets/js/vendors.min.js') ?>"></script>
       <!-- BEGIN Vendor JS-->

       <!-- BEGIN: Page Vendor JS-->
       <script src="<?php //echo url_for('assets/js/jquery.sticky.js') ?>"></script>
       <script src="<?php //echo url_for('assets/js/apexcharts.min.js') ?>"></script>
       <script src="<?php //echo url_for('assets/js/toastr.min.js') ?>"></script>
       <!-- END: Page Vendor JS-->

       <!-- BEGIN: Theme JS-->
       <script src="<?php echo url_for('assets/js/app-menu.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/app.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/customizer.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/sweetalert2.all.min.js') ?>"></script>



       <!-- END: Theme JS-->

       <!-- BEGIN: Page JS-->
       <script src="<?php //echo url_for('assets/js/katex.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/highlight.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/quill.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/toastr.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/select2.full.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/form-select2.min.js') ?>"></script>
       <script src="<?php echo url_for('assets/js/app-email.min.js') ?>"></script>

       <!-- END: Page JS-->

       <script>
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
})

function confirmAlert(title, msg, subMsg, actionCall, id) {
    $("#action_id").val(id)
    $(".msgTitle").html(title);

    $("#displayMsg").html(msg);
    $("#subMsg").html(subMsg);
    $(".actionCall").html(actionCall)
    $("#confirmModal").modal("show");
}

function successAlert(msg) {
    Swal.fire({
        title: msg,
        icon: "success",
        // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
        showCloseButton: !1,
        // showCancelButton: !0,
        focusConfirm: !1,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
        confirmButtonAriaLabel: "Thumbs up, great!",
        // cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
        // cancelButtonAriaLabel: "Thumbs down",
        confirmButtonClass: "btn btn-primary",
        buttonsStyling: !1,
        // cancelButtonClass: "btn btn-danger ml-1"
    });
}

function successTime(msg) {
    Swal.fire({
        position: "bottom-end",
        icon: "success",
        title: msg,
        showConfirmButton: !1,
        timer: 1500,
        customClass: {
            confirmButton: "btn btn-primary"
        },
        buttonsStyling: !1
    })
}

function errorAlert(msg) {
    Swal.fire({
        title: msg,
        icon: "error",
        // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
        showCloseButton: !1,
        timer: 1500,
        showCancelButton: !1,
        // focusConfirm: !1,
        // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
        // confirmButtonAriaLabel: "Thumbs up, great!",
        // cancelButtonText: '<i class="la la-thumbs-down"></i> No',
        // cancelButtonAriaLabel: "Thumbs down",
        customClass: {
            confirmButton: "btn btn-primary"
        },
        buttonsStyling: !1,
        // cancelButtonClass: "btn btn-danger ml-1"
    });
}

function errorTime(msg) {
    Swal.fire({
        position: "bottom-end",
        icon: "error",
        title: msg,
        showConfirmButton: !1,
        timer: 1500,
        customClass: {
            confirmButton: "btn btn-primary"
        },
        buttonsStyling: !1
    })
}
       </script>
       </body>
       <!-- END: Body-->

       </html>