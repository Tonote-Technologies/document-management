<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';
$full_name = $loggedInAdmin->first_name." ". $loggedInAdmin->last_name;
include(SHARED_PATH . '/header.php');
?>
<style>
#canvas1 {
    /* border: 4px dotted #FFF; */
    border-radius: 50%;
    letter-spacing: 20px;
}

#coy_number {
    position: absolute;
    top: 230;
    left: -10;
    font-weight: normal;
    font-size: 25px;
    font-family: 'verdana';
    width: 100%;
    text-align: center;
    text-transform: uppercase;
    color: #f5f5f5;
    text-shadow: 1px 4px 6px #190000;


}

.input {
    text-transform: uppercase;
}
</style>
<div class="row mb-2 w-50">
    <div class="form-group col-4">
        <label for="text_cnv">Company Name:</label>
        <input type="text" name="company_name" class="input form-control" placeholder="Company Name" id="text_cnv"
            size="40" maxlength="" value="TONOTE TECHNOLOGIES LTD.">
    </div>
    <div class="form-group col-4">
        <label for="text_cnv">Address:</label>
        <input type="text" name="address" class="input form-control" placeholder="Your place, State" id="text_cnv2"
            size="40" maxlength="" value="KM 54 LAGOS IBADAN EXP ROAD OYO STATE." />
    </div>
    <div class="col-4">
        <label style="padding-right: 32px;">RC Number:</label>
        <input type="text" name="rc_number" id="text_horizontal" class="input form-control" placeholder="RC-123456"
            value="" />
    </div>
</div>

<div class="row">
    <div class="" style="position:relative; width: 550px">
        <div id="coy_number"></div>
        <img width='500' height='500' src="red_seal-1.png" alt="Freedom Blog" />
        <canvas id="canvas1" width="300" height="312" style="transform: translate(-50%, -50%); position: absolute;  top: 50%; 
                    left: 49%"></canvas>
        <!-- <canvas id="canvas1" width="320" height="325" style="transform: translate(-50%, -50%); position: absolute;  top: 50%; 
                    left: 48%"></canvas> -->

    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.2/fabric.min.js">
</script>
<?php include(SHARED_PATH . '/footer.php');?>

<script>
var canvas = document.getElementById('canvas1'),
    ctx = canvas.getContext('2d');
// canvas.width = canvas.offsetWidth;
var r = 110;
var space = Math.PI / 12;

ctx.textBaseline = "middle";
draw3dText(ctx, "", canvas.width / 2, 120, 5);
ctx.beginPath();
// ctx.arc(155, 155, r, 0, Math.PI * 2, false);
ctx.arc(155, 155, r, 0, Math.pow(r, 2), false);

ctx.fillStyle = "#f5f5f5";
// arc(x, y, radius, startAngle, endAngle, anticlockwise)
ctx.closePath();

function textCircle(text, x, y, radius, space, top, font_size) {
    ctx.font = 'normal ' + font_size + ' verdana ';
    ctx.clearRect(0, (top ? 0 : y), 600, y);
    space = space || 0;
    var numRadsPerLetter = (Math.PI - space * 2) / text.length;
    ctx.save();
    ctx.translate(x, y);
    // canvas.style.letterSpacing = '3px';
    var k = (top) ? 1 : -1;
    ctx.rotate(-k * ((Math.PI - numRadsPerLetter) / 2 - space));
    for (var i = 0; i < text.length; i++) {
        ctx.save();
        ctx.rotate(k * i * (numRadsPerLetter));
        ctx.textAlign = "left";
        ctx.textBaseline = (!top) ? "top" : "bottom";
        let ctext = text[i].split(" ").join(String.fromCharCode(8201)).toUpperCase()
        ctx.fillText(ctext, 0, -k * (radius));

        // ctx.setLineDash([1, 5]);
        // ctx.stroke();
        ctx.restore();
    }
    ctx.restore();
}

function draw3dText(context, text, x, y, textDepth) {
    var n;

    // draw bottom layers
    for (n = 0; n < textDepth; n++) {
        context.fillText(text, x - n, y - n);
    }

    // draw top layer with shadow casting over
    // bottom layers
    context.shadowColor = "black";
    context.shadowBlur = 10;
    context.shadowOffsetX = textDepth + 2;
    context.shadowOffsetY = textDepth + 2;
    context.fillText(text, x - n, y - n);
}
document.getElementById('text_cnv').onkeyup = function() {
    textCircle(this.value, 145, 140, r, space, 1, '20px');
}
document.getElementById('text_cnv2').onkeyup = function() {
    textCircle(this.value, 145, 170, r, space, 0, '1em');
}
document.getElementById('text_horizontal').onkeyup = function() {
    var coy_number = document.getElementById("coy_number");
    coy_number.innerText = this.value
}
</script>