<?php 
    require_once('../private/initialize.php');

$page = 'Document';
$page_title = 'Edit Document';
$req_type = $_GET['req_type'] ?? 1;
$affidavit = Template::find_by_undeleted();
include(SHARED_PATH . '/header.php'); 

?>
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo url_for('assets/css/jstree.min.css')  ?>"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo url_for('assets/css/ext-component-tree.min.css')  ?> "> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo url_for('assets/css/app-file-manager.min.css')  ?>"> -->
<!-- END: Page CSS-->
<style type="text/css">
#myInput {
    background-image: url('../assets/images/searchicon.png');
    /* Add a search icon to input */
    background-position: 10px 12px;
    /* Position the search icon */
    background-repeat: no-repeat;
    /* Do not repeat the icon image */
    width: 100%;
    /* Full-width */
    font-size: 16px;
    /* Increase font-size */
    padding: 12px 20px 12px 40px;
    /* Add some padding */
    border: 1px solid #ddd;
    /* Add a grey border */
    margin-bottom: 12px;
    /* Add some space below the input */
}

#myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#myUL li a {
    border: 1px solid #ddd;
    /* Add a border to all links */
    margin-top: -1px;
    /* Prevent double borders */
    background-color: #f6f6f6;
    /* Grey background color */
    padding: 12px;
    /* Add some padding */
    text-decoration: none;
    /* Remove default text underline */
    font-size: 18px;
    /* Increase the font-size */
    color: black;
    /* Add a black text color */
    display: block;
    /* Make it into a block element to fill the whole list */
}

#myUL li a:hover:not(.header) {
    background-color: #eee;
    /* Add a hover effect to all links, except for headers */
}
</style>

<section class="container-fluid">
    <h3>
        <div class="email-header-left d-flex align-items-center">
            <a href="<?php echo url_for('dashboard/') ?>" class=""
                style="display:inline-block; width: 100px; border-right:2px solid #CCC; margin-right:6px">
                <span class="go-back me-1 float-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-left font-medium-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
                <h4 class="email-subject mb-0 float-start">Back</h4>
            </a>
            <span><?php echo  Document::REQUEST_TYPE[$req_type] ?></php></span>
        </div>
        <!-- <span> <a href="">Back</a></span> | -->
    </h3>
    <div class="card d-none">
        <div class="card-body">
            <h3>Is your document ready?</h3>
            <div>If you already have your template, Kindly upload below or click on select a template toi choose
                one.</div>
        </div>
    </div>
    <div class="card ">

        <div class="card-body">
            <ul class="nav nav-pills bg-nav-pills nav-justified border-bottom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-bs-toggle="tab" href="#first" aria-controls="first"
                        role="tab" aria-selected="true">Select a Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="second-tab" data-bs-toggle="tab" href="#second" aria-controls="second"
                        role="tab" aria-selected="false">Get a custom template</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="first" aria-labelledby="first-tab" role="tabpanel">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for a template..">
                    <!-- First -->
                    <ul id="myUL">
                        <?php $sn = 1; foreach($affidavit as $value) {
                             ?>
                        <li class="list"><a
                                href="<?php echo url_for('document-edit/prepare.php?document_id='.$value->document_id.'&type='. $req_type) ?>">
                                <?php echo $sn++ .". ". $value->title ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="ctrl-nav d-flex justify-content-start pt-2">
                        <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="prev">Previous</a>
                            <a href="#" class="btn btn-sm btn-primary" id="next">Next</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="second" aria-labelledby="second-tab" role="tabpanel">
                    <!-- second -->
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <label for="trans_type">Document type <sup class="text-danger">*</sup></label>
                                <input type="text" id="trans_type" class="form-control" required="" name="trans_type">

                            </div>
                            <div class="col-md-12 my-2 ">
                                <label for="trans_type">Describe your document <sup class="text-danger">*</sup></label>
                                <textarea class="form-control" placeholder="Description"
                                    style="min-height:200px"></textarea>
                            </div>

                            <div class="col-md-12 my-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>



















            <!-- <div class=" card mb-2 p-2">
            <div class="clearfix ">
                <div class="btn btn-primary btn-sm float-end mr-2 disabled" style="cursor: pointer;" id="proceedbtn">
                    <a href="" class="text-white" id="proceed">Proceed</a>
                </div>
            </div>
        </div>
        <div class="d-none" id="preview"></div> -->
</section>






<?php   include(SHARED_PATH . '/footer.php'); ?>
<script>
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

var visible = "";
var list = $(".list");
console.log(list)
var itemsNumber = list.length;
var min = 0;
var max = itemsNumber;

function pagination(action) {

    var totalItems = $("li" + visible).length;

    if (max < totalItems) { //Stop action if max reaches more than total items 
        if (action == "next") {

            min = min + itemsNumber;
            max = max + itemsNumber;

        }
    }

    if (min > 0) { //Stop action if min reaches less than 0
        if (action == "prev") {

            min = min - itemsNumber;
            max = max - itemsNumber;

        }
    }

    $("li").hide();
    $("li" + visible).slice(min, max).show();

}

pagination();


//Next
$("#next").click(function() {

    action = "next";
    pagination(action);

})

//Previous
$("#prev").click(function() {
    action = "prev";
    pagination(action);

})
</script>