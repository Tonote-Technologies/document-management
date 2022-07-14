<?php  require_once('../../private/initialize.php');?>
<?php if(isset($_POST['fetchNoatrySeal'])){
    $path = "document-edit/";
    $seal = ["seal_gray.png", "seal_green.png", "seal_orange.png"];
    if($_POST['item'] == 1){
        $image  = 'seal_gray.png';
    }else if($_POST['item'] == 2){
        $image  = 'seal_green.png';
    }else{
        $image  = 'seal_orange.png';
    }
?>
<div class="col-md-2">
    <?php $sn = 1; foreach($seal as $list){ ?>
    <div style="width: 100px; height:100px"
        class="sealList mb-1 <?php echo $sn == $_POST['item']  ? 'active' : 'Nill'; ?>" data-id="<?php echo $sn++; ?>">
        <img src="<?php echo $list; ?>" alt="seal gray" class="img-fluid">
    </div>
    <?php } ?>
</div>
<div class="col-md-10 d-flex justify-content-center align-items-center">
    <div class="" style="width: 300px;">
        <div style="position: relative; text-align: center">
            <div class="head-text">
                <div class="head-image">
                    <img src="<?php echo url_for($path.$image) ?>" alt="Freedom Blog" class="img-fluid" />
                </div>
                <div class='text-on-image'>

                    <div>
                        <h3 style="font-size: 16px;"> Fikayo Durosinmi-etti</h3>
                    </div>
                    <p> SCN: 123456 </p>
                    <!-- <img src="qrcode.png" alt="" class="img" width="50"> -->
                </div>
            </div>

        </div>
    </div>
</div>
<?php } ?>

<?php if(isset($_POST['fetchSeal'])){ ?>

<div class="row mb-2 ">
    <div class="form-group col-4">
        <label for="text_cnv">Company Name:</label>
        <input type="text" class="input form-control" placeholder="Company Name" id="text_cnv" size="40" maxlength=""
            value="" />
    </div>
    <div class="form-group col-4">
        <label for="text_cnv">Address:</label>
        <input type="text" class="input form-control" placeholder="Your place, State" id="text_cnv2" size="40"
            maxlength="" value="" />
    </div>
    <div class="col-4">
        <label style="padding-right: 32px;">RC Number:</label>
        <input type="text" id="text_horizontal" class="input form-control" placeholder="RC:12345" value="" />
    </div>
</div>

<div class="row">
    <div class="col-6 " style="position:relative">
        <div id="coy_number"></div>
        <canvas id="canvas1" width="300" height="300"></canvas>

    </div>

</div>

<?php } ?>