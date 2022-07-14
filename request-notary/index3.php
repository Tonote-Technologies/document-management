<!DOCTYPE html>
<html>

<head>
    <title>
        How to change character spacing
        of text canvas using Fabric.js?
    </title>

    <!-- Loading the FabricJS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.2/fabric.min.js">
    </script>
</head>

<body>
    <canvas id="canvas" width="600" height="200" style="border:1px solid #000000;">
    </canvas>

    <script>
    // Create a new instance of Canvas
    var canvas = new fabric.Canvas("canvas");

    // Create a new Textbox instance
    var first_text = new fabric.Text(
        'charSpacing is 200', {
            charSpacing: 200
        });

    // Create a new Textbox instance
    var second_text = new fabric.Text(
        'charSpacing is 10', {
            charSpacing: 100,
            top: 50
        });

    // Render both of the Textbox on Canvas
    canvas.add(first_text);
    canvas.add(second_text);
    </script>
</body>

</html>