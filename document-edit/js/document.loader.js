$(".url").each(function (index) {
  var url = $(this).val();
  renderPDF(url, document.getElementById('holder'), 1);
});


var totalPage = '';
function renderPDF(url, canvasContainer, options) {
  var __CANVAS = $('#pdf-canvas').get(0);
  var options = options || { scale: 1 };
  // __PDF_DOC.numPages
  let array = [];
  function renderPage(page) {
    let scale_required = __CANVAS.width / page.getViewport(1).width;
    let viewport = page.getViewport(scale_required);
    let canvas = document.createElement('canvas');
    canvas.classList = 'htmlImg img-fluid';
    let context = canvas.getContext('2d');

    let renderContext = {
      canvasContext: context,
      viewport: viewport
    };

    canvas.height = viewport.height;
    canvas.width = viewport.width;

    canvasContainer.appendChild(canvas);
    page.render(renderContext);


    let numpage = page.pageIndex;
    array.push(numpage);
    let totalPage = array.length

    $("#holder").append("<div class='watermark'>ToNote-6f5423-fty334-345</div>");
    $("#holder").append("<div class='pageNum'>Page " + (numpage + 1) + " </div> ");



  }

  // console.log(page.length);

  function renderPages(pdfDoc) {
    for (var num = 1; num <= pdfDoc.numPages; num++)
      pdfDoc.getPage(num).then(renderPage);

  }

  PDFJS.disableWorker = true;
  PDFJS.getDocument(url).then(renderPages);

  $(document).on("click", "#proceed_toEdit", function (e) {
    e.preventDefault()
    var imgType = 'Tonote_doc';
    let document_id = $("#document_id").val()
    let status = 2;
    let title = $(".title").val();
    createDocument(title, document_id, status, imgType)

  })

  function createDocument(title, document_id, status, imgType) {
    // 
    $.ajax({
      url: "inc/save-document-file.php",
      method: "POST",
      dataType: "json",
      data: {
        document: 1,
        title: title,
        document_id: document_id,
        status: status,
        imgType: imgType,
      },
      success: function (data) {
        if (data.success == true) {
          $(".htmlImg").each(function () {
            var myID = $(this)[0];
            createDocumentFiles(document_id, myID, imgType)
          });
        }


        // console.log(theImg);
      },
    });
  }

  function createDocumentFiles(document_id, myID, imgType) {
    /* here set the image extension and now image data is in var img that will send 
    by our ajax call to our api or server site page */
    let url_dir = $("#url_dir").val()
    let img = myID.toDataURL("image/png", 1.0);
    $.ajax({
      url: "inc/save-document-file.php",
      method: "POST",
      dataType: "json",
      data: {
        documentFiles: 1,
        document_id: document_id,
        img: img,
        imgType: imgType,
      },
      success: function (data) {
        window.location.href = url_dir + document_id
        // console.log(theImg);
      }
    });

  }





}   