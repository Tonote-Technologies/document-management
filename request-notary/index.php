<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';
$full_name = $loggedInAdmin->first_name." ". $loggedInAdmin->last_name;
include(SHARED_PATH . '/header.php');
?>
<style>
#canvas1 {
    border: 2px dotted #3b4253;
    border-radius: 50%;
    letter-spacing: 20px;
}

#coy_number {
    position: absolute;
    top: 130;
    font-weight: normal;
    font-size: 30px;
    font-family: 'Courier New', ;
    color: #3b4253;
    width: 300px;
    text-align: center;
    text-transform: uppercase;
}

.input {
    text-transform: uppercase;
}
</style>
<div class="row mb-2 w-50">
    <div class="form-group col-4">
        <label for="text_cnv">Company Name:</label>
        <input type="text" class="input form-control" placeholder="Company Name" id="text_cnv" size="40" maxlength=""
            value="TONOTE TECHNOLOGIE LTD." />
    </div>
    <div class="form-group col-4">
        <label for="text_cnv">Address:</label>
        <input type="text" class="input form-control" placeholder="Your place, State" id="text_cnv2" size="40"
            maxlength="" value="1625B Adeola Odeku V.I Lagos" />
    </div>
    <div class="col-4">
        <label style="padding-right: 32px;">RC Number:</label>
        <input type="text" id="text_horizontal" class="input form-control" placeholder="RC:12345" value="RC:12345" />
    </div>
</div>

<div class="row">
    <div class="col-6 " style="position:relative">
        <div id="coy_number"></div>
        <canvas id="canvas1" width="300" height="300"></canvas>

    </div>

</div>



<?php include(SHARED_PATH . '/footer.php');?>

<script>
var inp = document.querySelectorAll('input'),
    canvas = document.getElementById('canvas1'),
    ctx = canvas.getContext('2d');
canvas.width = canvas.offsetWidth;



var r = 110;
var space = Math.PI / 12;

ctx.font = "normal 30px Courier New";
ctx.beginPath();
ctx.arc(150, 150, r, 0, Math.PI * 2, false);
ctx.closePath();

function textCircle(text, x, y, radius, space, top) {

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

        ctx.fillText(text[i].toUpperCase(), 0, -k * (radius));
        ctx.fillStyle = "#3b4253";
        ctx.setLineDash([1, 5]);

        ctx.stroke();
        ctx.restore();
    }
    ctx.restore();
}


document.getElementById('text_cnv').onkeyup = function() {
    textCircle(this.value, 150, 145, r, space, 1);
}
document.getElementById('text_cnv2').onkeyup = function() {
    textCircle(this.value, 150, 160, r, space);
}



// let top_text = document.getElementById('text_cnv')
// textCircle(top_text.value, 150, 145, r, space, 1);


// let bottom_text = document.getElementById('text_cnv2')
// textCircle2(bottom_text.value, 150, 160, r, space, 1);


document.getElementById('text_horizontal').onkeyup = function() {
    var coy_number = document.getElementById("coy_number");
    coy_number.innerText = this.value
}
</script>