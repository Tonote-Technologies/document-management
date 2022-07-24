<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';
$full_name = $loggedInAdmin->first_name." ". $loggedInAdmin->last_name;
include(SHARED_PATH . '/header.php');
?>

<style>
.avatar .img {
    border-radius: 50%;
    min-width: 40px;
    min-height: 40px;
}
</style>
<li class="nav-item dropdown dropdown-user">

    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-users" href="#" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">John Doe</span><span
                class="user-status">Admin</span></div><span class="avatar">
            <span class="img d-flex align-items-center justify-content-center">SA</span>
            <span class="avatar-status-online"></span>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-users">
        <div style="" class="border px-1">
            <div class="demo-inline-spacing d-flex justify-content-center">
                <div class="avatar avatar-xl">
                    <span class="img d-flex align-items-center justify-content-center">SA</span>
                </div>
            </div>

            <div class="p-2 text-center border-bottom">
                <h6>Shafi Akinropo</h6>
                <small>sakinropo@gmail.com</small>
            </div>
            <a class="dropdown-item border-bottom d-flex justify-content-between" href="#">
                <div class="avatar avatar-xl">
                    <span class="img d-flex align-items-center justify-content-center"
                        style="font-size: 12px;">SA</span>
                    <span class="avatar-status-online"></span>
                </div>
                <div>
                    <h5 class="text-truncate" style="max-width: 120px;">Shafi Akinropo</h5>
                    <div><small>Basic Plan</small></div>
                </div>
            </a>

            <a class="dropdown-item border-bottom d-flex justify-content-between" href="#">
                <div class="avatar avatar-xl">
                    <span class="img d-flex align-items-center justify-content-center"
                        style="font-size: 12px;">TT</span>
                </div>
                <div>
                    <h5 class="text-truncate" style="max-width: 120px;">ToNote Technologies Ltd.</h5>
                    <div><small>Business Plan</small></div>
                </div>
            </a>
            <div class="text-center">
                <a class="btn btn-outline-seconday" href="auth-login-cover.html"><svg xmlns="http://www.w3.org/2000/svg"
                        width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-power me-50">
                        <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                        <line x1="12" y1="2" x2="12" y2="12"></line>
                    </svg> Logout</a>
            </div>
        </div>
    </div>
</li>
<?php include(SHARED_PATH . '/footer.php');?>