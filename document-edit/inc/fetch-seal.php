<?php  require_once('../../private/initialize.php');?>
<?php if(isset($_POST['fetchSeal'])){
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
                    <img src="<?php echo $image ?>" alt="Freedom Blog" class="img-fluid" />
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