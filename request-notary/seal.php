<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <canvas id="canvas1" width="600" height="400" style="float:left;"></canvas>
    <div style="float: left; width: 538px;">
        <label style="padding-right: 51px;">Text-Top:</label>
        <input type="text" id="text_cnv" size="40" maxlength="" />
        <button id="text_cnv3" style="visibility:hidden">
            Delete
        </button>
        <label style="padding-right: 32px;">Text-bottom:</label>
        <input type="text" id="text_cnv2" size="40" maxlength="" />
        <button id="text_cnv4" style="visibility:hidden">
            Delete
        </button>
        <label style="padding-right: 32px;">Text-horizontal:</label>
        <input type="text" id="text_horizontal" />

    </div>

</body>
<script>
var ctx = document.getElementById('canvas1').getContext('2d');
var r = 50;
var space = Math.PI / 12;
ctx.font = "bold 30px Courier";
document.getElementById('text_cnv').onkeyup = function() {
    var textLength = (this.value.length);

    if (textLength > 5) {
        radiusChaninging = r + (textLength * 3);
    } else {
        radiusChaninging = r + (textLength);
    }
    textCircle(this.value, 150, 150, radiusChaninging, space, 1);
    document.getElementById('text_cnv3').style.visibility = 'visible';
}

document.getElementById('text_cnv2').onkeyup = function() {
    var textLength = (this.value.length);

    if (textLength > 5) {
        radiusChaninging = r + (textLength * 3);
    } else {
        radiusChaninging = r + (textLength);
    }
    textCircle(this.value, 150, 150, radiusChaninging, space);

    document.getElementById('text_cnv4').style.visibility = 'visible';
}

document.getElementById('text_cnv3').onclick = function() {

    textCircle('', 150, 150, 0, space, 1);
    $("#text_cnv").val('');
}

document.getElementById('text_cnv4').onclick = function() {

    textCircle('', 150, 150, 0, space);
    $("#text_cnv2").val('');
}





function drawTextHorizontal(text, x, y, radius) {
    ctx.font = "bold 30px Serif";
    // ctx.textAlign = "center";

    wrapText(ctx, text, x, y, 4000, 1);

    ctx.restore();
}

function wrapText(context, text, x, y, maxWidth, lineHeight) {
    var words = text.split(' ');
    var line = '';

    for (var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = context.measureText(testLine);

        var testWidth = metrics.width;
        console.log(testWidth);
        if (testWidth > maxWidth && n > 0) {

            line = words[n] + ' ';
            y += lineHeight;
            context.fillText(line, x, y);
        } else {
            line = testLine;
        }
    }
    context.fillText(line, x, y);
}

var x_pos = 90;
var y_pos = 150;

document.getElementById('text_horizontal').onkeyup = function() {

    var nr_w = (this.value.length);
    var textLength = (nr_w);
    if (textLength > 5) {
        radiusChaninging = r + (textLength * 2);
    } else {
        radiusChaninging = r + (textLength);
    }
    drawTextHorizontal(this.value, x_pos, y_pos, radiusChaninging);
}




function textCircle(text, x, y, radius, space, top) {
    ctx.clearRect(0, (top ? 0 : y), 600, y);
    space = space || 0;
    var numRadsPerLetter = (Math.PI - space * 2) / text.length;
    ctx.save();
    ctx.translate(x, y);
    var k = (top) ? 1 : -1;

    ctx.rotate(-k * ((Math.PI - numRadsPerLetter) / 2 - space));
    for (var i = 0; i < text.length; i++) {
        // alert(radius);

        ctx.save();
        ctx.rotate(k * i * (numRadsPerLetter));
        ctx.textAlign = "center";
        ctx.textBaseline = (!top) ? "top" : "bottom";
        ctx.fillText(text[i], 0, -k * (radius));
        ctx.restore();
    }
    ctx.restore();
}
</script>

</html>