<?php require_once('../private/initialize.php');
$page = 'Manage';
$page_title = 'Request Notary';

// include(SHARED_PATH . '/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- html2canvas library -->
    <script src="../document-edit/js/html2canvas.js"></script>
    <!-- <script src="../document-edit/js/pdf.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

    <!-- jsPDF library -->
    <!-- <script src="js/jsPDF/dist/jspdf.min.js"></script> -->

    <script>
    /* Place custom JavaScript code here */
    </script>
</head>

<body>

    <!-- Trigger button -->
    <button onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button>

    <!-- HTML content for PDF creation -->
    <div id="contentToPrint">
        <h1>What is Lorem Ipsum?</h1>

        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book.</p>

        <!-- <img src="image_1.jpg"> -->

        <!-- <img src="image_2.jpeg"> -->
    </div>

</body>

</html>
<?php include(SHARED_PATH . '/footer.php');?>

<script>
function Convert_HTML_To_PDF() {
    var elementHTML = document.getElementById('contentToPrint');

    html2canvas(elementHTML, {
        useCORS: true,
        onrendered: function(canvas) {
            var pdf = new jsPDF('p', 'pt', 'letter');

            var pageHeight = 980;
            var pageWidth = 900;
            for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                var srcImg = canvas;
                var sX = 0;
                var sY = pageHeight * i; // start 1 pageHeight down for every new page
                var sWidth = pageWidth;
                var sHeight = pageHeight;
                var dX = 0;
                var dY = 0;
                var dWidth = pageWidth;
                var dHeight = pageHeight;

                window.onePageCanvas = document.createElement("canvas");
                onePageCanvas.setAttribute('width', pageWidth);
                onePageCanvas.setAttribute('height', pageHeight);
                var ctx = onePageCanvas.getContext('2d');
                ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                var width = onePageCanvas.width;
                var height = onePageCanvas.clientHeight;

                if (i > 0) // if we're on anything other than the first page, add another page
                    pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)

                pdf.setPage(i + 1); // now we declare that we're working on that page
                pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height *
                    .62)); // add content to the page
            }

            // Save the PDF
            pdf.save('document.pdf');
        }
    });
}
</script>