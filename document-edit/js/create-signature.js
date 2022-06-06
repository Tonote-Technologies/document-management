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

        let mySignature = $("#signature-wrap" + choiceID).clone();
        let myInitial = $("#initial-wrap" + choiceID).clone();
        $("#selected-signature").html(mySignature);
        $("#selected-initial").html(myInitial);
    }
});
$(document).on("click", "#first-tab", function () {
    // $("#first-tab").click(function () {
    $(".btn-choose").attr("id", "choose");
});

$("#second-tab").click(function () {
    $(".btn-choose").attr("id", "draw").addClass("disabled");
});
$("#third-tab").click(function () {
    $(".btn-choose").attr("id", "upload");
});
$(document).on("click", ".btn-choose", function () {
    let btnId = $(this).attr("id");

    if (btnId == "choose") {
        let selectedSignature = $("#selectedSignature").val();
        // let theSign = "#digi-sign" + selectedSignature;
        let theIntial = "#initial-wrap" + selectedSignature;
        let theSign = "#selected-signature";
        // let theIntial = "#selected-initial";
        saveSignature(theSign, "sign", 1, 1);
        saveSignature(theIntial, "initial", 1, 2);
        successTime("Signature Created Successfully");
    } else if (btnId == "draw") {
        // console.log("draw");
        let theSign = $('#saveSignature');

        saveSignature(theSign, "sign", 2, 1);
    } else if (btnId == "upload") {
        console.log("upload");
    }
});

$(".saveSign").click(function () {
    $("#draw").removeClass("disabled");
});

function saveSignature(myID, imgType, etype, category) {
    html2canvas($(myID), {
        //give the div id whose image you want in my case this is #cont
        onrendered: function (canvas) {
            var img = canvas.toDataURL("image/png", 1.0); //here set the image extension and now image data is in var img that will send by our ajax call to our api or server site page
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
                    let theImg = "upload/" + data.signImg;
                    console.log(theImg);
                },
            });
        },
    });
}