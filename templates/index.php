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

    <div class="card d-none">
        <div class="card-body">
            <h3>Is your document ready?</h3>
            <div>If you already have your template, Kindly upload below or click on select a template toi choose
                one.</div>
        </div>
    </div>
    <div class="card ">

        <div class=" card-body">
            <div class="p-1 mb-1 border-bottom">Please select a template or search below</div>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for a template..">

            <ul id="myUL">
                <?php $sn = 1; foreach($affidavit as $value) {
                 ?>
                <li class="list"><a
                        href="<?php echo url_for('document-edit/prepare.php?document_id='.$value->document_id.'&type=2') ?>"><?php echo $sn++ .". ". $value->title ?></a>
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



















        <div class=" card mb-2 p-2">
            <div class="clearfix ">
                <div class="btn btn-primary btn-sm float-end mr-2 disabled" style="cursor: pointer;" id="proceedbtn">
                    <a href="" class="text-white" id="proceed">Proceed</a>
                </div>
            </div>
        </div>
        <div class="d-none" id="preview"></div>
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