$(document).on("click", ".tool li", function (e) {
  var toolId = $(this).data("id");
  var toolName = $(this).data("value");
  var toolUser = $(this).data("user");
  var UserEmail = $(this).data("email");
  $("#storage").val(toolId);
  $("#toolName").val(toolName);
  $("#toolUser").val(toolUser);
  $("#UserEmail").val(UserEmail);

  if (toolUser == 0) {
    // errorAlert("Please select a signer");
    errorToast("Alert", data.msg);
  } else {
    var current_click = $("#currentId").val();
    if (current_click != "") {
      removeMouseMoveListener();
      addMouseMoveListener(toolId);
    } else {
      addMouseMoveListener(toolId);
    }
  }

});
$(document).on("click", "#clearSession", function (e) {
  clearCart()
});
function addMouseMoveListener(toolId) {
  var count = 1;
  $(document).bind("mousemove.toolId", function (e) {
    count = count + 1;
    $("." + toolId).attr("id", count);
    $("#currentId").val(count);
    $("." + toolId).css({
      display: "block",
      left: e.pageX + 10,
      top: e.pageY,
    });
  });
}

$(document).on("click", "#mainWrapper", function (e) {
  var storage = $("#storage");
  // console.log(storage);
  if (storage.val() != "") {
    let eId = $("#storage").val();
    let cId = $("#currentId").val();
    $("#" + cId).css("display", "none");
    let toolName = $("#toolName").val();
    let toolUser = $("#toolUser").val();
    let UserEmail = $("#UserEmail").val();
    let posX = $(this).offset().left;
    let posY = $(this).offset().top;
    let x = e.pageX - posX;
    let y = e.pageY - posY;

    // appendToolbox(x, y, eId);
    removeMouseMoveListener();
    storage.val("");
    let action = "addTool";
    let tool_id = cId;
    let tool_text = toolName;
    let text_value = '';
    let tool_top_pos = y;
    let tool_left_pos = x;
    let tool_type = 1;

    if (toolName == "Sign" || toolName == "Initial") {
      checkSignatureOwnership()
      var tool_class = "tool-box tool-style main-element";
    } else if (toolName == "Textarea") {
      var tool_class = "main-element";
    } else if (toolName == "Photo") {
      var tool_class = "main-element photo-style";
    } else {
      var tool_class = "tool-box main-element";
    }



    savetoSession(action, tool_id, toolUser, UserEmail, tool_type, tool_class, tool_text, text_value, tool_top_pos, tool_left_pos,);
  }
});

function checkSignatureOwnership() {
  let signer_id = $("#toolUser").val();
  // successAlert(signer_id);
  $.ajax({
    url: "inc/find-element.php", //path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
    method: "POST",
    dataType: "json",
    data: {
      findUser: 1,
      signer_id: signer_id,
    },
    success: function (data) {
      if (data.success == true) {
        hasSignature(signer_id);
      } else {
        // errorAlert('false')
      }
    },
  });
}

function hasSignature(signer_id) {
  $.ajax({
    url: "inc/find-element.php", //path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
    method: "POST",
    dataType: "json",
    data: {
      hasSignature: 1,
      signer_id: signer_id,
    },
    success: function (data) {
      if (data.success == true) {
        // successAlert(data.msg);
      } else {
        $("#createSignatureModal").modal("show");
        // errorAlert(data.msg);
        errorToast("Notice", data.msg);
      }
    },
  });
}


function signatureFile() {
  $.ajax({
    url: "inc/signature-file.php",
    method: "POST",
    data: {
      fetch: 1,
    },
    success: function (data) {
      $("#signatureFile").html(data)
    },
  });
}


function savetoSession(action, tool_id, toolUser, UserEmail, tool_type, tool_class, tool_text, text_value, tool_top_pos, tool_left_pos) {
  var document_id = $("#document_id").val();
  var filename = $("#filename").val();

  $.ajax({
    url: "inc/process-tool.php",
    method: "POST",
    data: {
      action: action,
      document_id: document_id,
      filename: filename,
      tool_id: tool_id,
      toolUser: toolUser,
      UserEmail: UserEmail,
      tool_type: tool_type,
      tool_class: tool_class,
      tool_text: tool_text,
      text_value: text_value,
      tool_top_pos: tool_top_pos,
      tool_left_pos: tool_left_pos,
    },
    success: function (data) {
      load_session_data();
      // move(tool_id)
    },
  });
}

function editSession(edit, tool_id, toolUser, tool_class, tool_text, text_value, tool_top_pos, tool_left_pos) {
  var tool_qty = 1;
  $.ajax({
    url: "session/action.php",
    method: "POST",
    data: {
      tool_id: tool_id,
      toolUser: toolUser,
      tool_qty: tool_qty,
      tool_class: tool_class,
      tool_text: tool_text,
      text_value: text_value,
      tool_top_pos: tool_top_pos,
      tool_left_pos: tool_left_pos,
      edit: edit,
    },
    success: function (data) {
      load_session_data();
      // move(tool_id)
    },
  });
}

function clearCart() {
  var action = 'empty';
  $.ajax({
    url: "session/action.php",
    method: "POST",
    data: { action: action },
    success: function () {
      load_session_data();
    }
  });
}


async function load_session_data() {
  let document_id = $("#document_id").val();
  let response = await fetch('session/fetch_session.php?document_id=' + document_id);
  let data = await response.json();
  $("#mainWrapper").html(data.session_details);
  $("#shopping_cart").html(data.added_tool);
  dragElement();
  resizeElement();

}
load_session_data()

$(document).on("click", ".deleteItem", function () {
  $(this).parent().parent().remove();
  let tool_id = $(this).data("id");
  remove(tool_id)
});

$(document).on("click", ".removeItem", function () {
  $(this).parent().parent().remove();
  let tool_id = $(this).data("id");
  let tool_text = $(this).closest('.tool-box').data("name");
  remove(tool_id, tool_text)
});

$(document).on("click", ".removePhoto", function () {
  $(this).parent().parent().remove();
  let tool_id = $(this).data("id");
  let tool_text = $(this).closest('.tool-box').data("name");
  remove(tool_id, tool_text)
});

function remove(tool_id, tool_text) {
  var action = "remove";
  $.ajax({
    url: "inc/process-tool.php",
    method: "POST",
    data: { tool_id: tool_id, tool_text: tool_text, action: action },
    success: function () {
      load_session_data();
    },
  });
}

function removeMouseMoveListener() {
  $(document).unbind("mousemove");
}

function dragElement() {
  $(".main-element").each(function () {
    var $elem = $(this);
    var tool_id = $(this).data("id");
    var tool_text = $(this).data("name");
    let edit = "edit_element";
    $elem.draggable({
      containment: "#mainWrapper",
      scroll: false,
      stop: function (e, ui) {
        // if (tool_text == "Textarea") {
        //   var text_value = $(this)[0].children[0].children[1].value;
        // } else {
        //   var text_value = '';
        // }
        let tool_top_pos = ui.position.top;
        let tool_left_pos = ui.position.left;
        editElement(edit, tool_id, tool_text, tool_top_pos, tool_left_pos,);
      },
    })
  });

  // $(".element").each(function () {
  //   var $elem = $(this);
  //   $elem.resizable();
  // });
}



function resizeElement() {
  $(".resize").each(function () {
    var $elem = $(this);
    var tool_id = $(this).data("id");
    $elem.resizable({
      option: true,
      // handles: "se, sw, nw",
      handles: "se",
      stop: function (e, ui) {
        let tool_width = ui.size.width;
        let tool_height = ui.size.height;
        console.log(tool_id, tool_width, tool_height);
        updateSize(tool_id, tool_width, tool_height);
      },

    });
  });

}

$(document).on('keyup', '.textareaTool', function () {
  let text_value = $(this).val();
  let tool_id = $(this).data('id');
  $.ajax({
    url: "session/edit_element.php",
    method: "POST",
    data: {
      edit_text: 1,
      tool_id: tool_id,
      text_value: text_value,
    },
    success: function (data) {
      // load_session_data();
    },
  });

})

function editElement(edit, tool_id, tool_text, tool_top_pos, tool_left_pos) {
  $.ajax({
    url: "session/edit_element.php",
    method: "POST",
    data: {
      tool_id: tool_id,
      tool_text: tool_text,
      // text_value: text_value,
      tool_top_pos: tool_top_pos,
      tool_left_pos: tool_left_pos,
      edit: edit,
    },
    success: function (data) {
      load_session_data();
      // move(tool_id)
    },
  });
}

function updateSize(tool_id, tool_width, tool_height) {
  $.ajax({
    url: "session/edit_element.php",
    method: "POST",
    data: {
      tool_id: tool_id,
      tool_width: tool_width,
      tool_height: tool_height,
      resize: 1,
    },
    success: function (data) {
      load_session_data();
    },
  });
}

$(document).on("click", "#imagePreview", function () {
  $(".photo-layer").css("display", "flex");
  $('#imgupload').trigger('click');
  setTimeout(function () {
    $(".photo-layer").css("display", "none");
  }, 5000);
})


$(document).on("change", "#imgupload", function () {

  let tool_id = $(this).data('id');
  let file_data = $(this).prop('files')[0];

  // var reader = new FileReader();
  // reader.readAsDataURL(file_data);
  // reader.onloadend = function () {
  //   $("#imagePreview").attr("src", reader.result)
  //   $("#imagePreview").parent('.image-area').addClass("resize")
  // }

  let form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('uploadPhoto', '1');
  form_data.append('tool_id', tool_id);

  
  $.ajax({
    url: 'inc/process-tool.php', // point to server-side PHP script
    dataType: 'json',  // what to expect back from the PHP script, if anything
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function (data) {
      if (data.success == true) {
        
        load_session_data()
      } else {
        // errorAlert(data.msg)
        errorToast("Notice", data.msg);
      }
    }
  });

})

// $('#draggableHelper').draggable();
// $('#image').resizable();



  //  changes mouse cursor when highlighting loawer right of box
  // $(document).on('mousemove', '.textareaTool', function (e) {
  //   var a = $(this).offset().top + $(this).outerHeight() - 16,	//	top border of bottom-right-corner-box area
  //     b = $(this).offset().left + $(this).outerWidth() - 16;	//	left border of bottom-right-corner-box area
  //   $(this).css({
  //     cursor: e.pageY > a && e.pageX > b ? 'nw-resize' : ''
  //   });

    
  //   let tool_id = $(this).data("id");
  //   let tool_width = $(this).outerWidth();
  //   let tool_height = $(this).outerHeight();
  //   // updateSize(tool_id, tool_width, tool_height);
    
  // })
  //   //  the following simple make the textbox "Auto-Expand" as it is typed in
  //   .on('keyup', '.textareaTool', function (e) {
  //     //  the following will help the text expand as typing takes place
  //     while ($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
  //       $(this).height($(this).height() + 1);
  //     };
  //   });



// function readURL(file_data) {
  
// }
// $('#upload').on('click', function () {
//   var file_data = $('#sortpicture').prop('files')[0];
//   var form_data = new FormData();
//   form_data.append('file', file_data);
//   alert(form_data);
//   $.ajax({
//     url: 'upload.php', // point to server-side PHP script 
//     dataType: 'text',  // what to expect back from the PHP script, if anything
//     cache: false,
//     contentType: false,
//     processData: false,
//     data: form_data,
//     type: 'post',
//     success: function (php_script_response) {
//       alert(php_script_response); // display response from the PHP script, if any
//     }
//   });
// });

// function uploadPhoto(dataFile, tool_id) {
//   $.ajax({
//     url: 'inc/process-tool.php',
//     type: 'post',
//     data: {
//       uploadPhoto: 1,
//       file: dataFile,
//       tool_id: tool_id,
//     },
//     dataType: 'json',
//     success: function (data) {
//       if (data.success == true) {
//         $(".photo-layer").css("display", "none");
//         load_session_data()
//       } else {
//         errorAlert(data.msg)
//       }
//     }
//   });
// }






