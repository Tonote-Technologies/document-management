signatureCapture();
$(".signatureID").each(function () {
    var str = $(this).text();
    var num = 15;
    let me = str.length > num ? str.slice(0, num) + "..." : str;
    $(this).text(me);
});

$(document).on("click", ".choose", function () {
    if ($(this).is(":checked")) {
        $(".btn-choose").removeClass("disabled");
        let choiceID = $(this).data("id");
        $("#selectedSignature").val(choiceID);

        let mySignature = $("#signature-wrap" + choiceID).clone().addClass('newClass');
        let myInitial = $("#initial-wrap" + choiceID).clone().addClass('newClass');
        $("#selected-signature").html(mySignature);
        $("#selected-initial").html(myInitial);
    }
});
$(document).on("click", "#first-tab", function () {
    $(".btn-choose").attr("id", "choose");
    $("#cloneWrap").removeClass("d-none");

});

$("#second-tab").click(function () {
    $(".btn-choose").attr("id", "draw").addClass("disabled");
    $("#cloneWrap").addClass("d-none");
});
$("#third-tab").click(function () {
    $(".btn-choose").attr("id", "upload");
    $("#cloneWrap").addClass("d-none");
});
$(document).on("click", ".btn-choose", function () {
    let btnId = $(this).attr("id");

    if (btnId == "choose") {
        let selectedSignature = $("#selectedSignature").val();

        let theSign = "#selected-signature";
        let theIntial = "#selected-initial";

        saveSignature(theSign, "sign", 1, 1);
        saveSignature(theIntial, "initial", 1, 2);

    } else if (btnId == "draw") {
        let theSign = $('#drawnSignature').val();
        uploadSignature(theSign, "sign", 2, 1);

    } else if (btnId == "upload") {
        let img = $("#uploadSignature").val();
        uploadSignature(img, "sign", 3, 1);
    }
});

$(".saveSign").click(function () {
    $("#draw").removeClass("disabled");
});

function uploadSignature(img, imgType, etype, category) {
    $.ajax({
        url: "inc/save-signature.php", //path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
        method: "POST",
        dataType: "json",
        data: {
            action: 'create',
            img: img,
            imgType: imgType,
            etype: etype,
            category: category,
        },
        success: function (data) {
            successAlert(data.msg);
        },
    });

}

function saveSignature(myID, imgType, etype, category) {
    console.log(myID);
    html2canvas($(myID), {
        onrendered: function (canvas) {
            let img = canvas.toDataURL("image/png", 1.0); //here set the image extension and now image data is in var img that will send by our ajax call to our api or server site page
            // alert(img)
            $.ajax({
                url: "inc/save-signature.php", //path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
                method: "POST",
                dataType: "json",
                data: {
                    action: 'create',
                    img: img,
                    imgType: imgType,
                    etype: etype,
                    category: category,
                },
                success: function (data) {
                    successAlert(data.msg);
                },
            });
        },
    });
}

$(document).on("click", "#updateSignature", function () {
    $("#signatureAction").val("create")
    $("#actionWord").text("Update")

    $("#createSignatureModal").modal('show')
})


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            let size = input.files[0].size;
            let newSize = convertSize(size);
            let data = e.target.result;
            $('#image-preview').attr('src', data);
            $("#uploadSignature").val(data);
            $('#file-input-text').text(newSize)
            $('#image-preview').hide();
            $('#image-preview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

$("#file-input").change(function () {
    readURL(this);
    $(".btn-choose").removeClass("disabled");
});


