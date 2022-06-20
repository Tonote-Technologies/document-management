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
    errorAlert("Please select a signer");
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
    var eId = $("#storage").val();
    var cId = $("#currentId").val();
    $("#" + cId).css("display", "none");
    let toolName = $("#toolName").val();
    let toolUser = $("#toolUser").val();
    let UserEmail = $("#UserEmail").val();
    var posX = $(this).offset().left;
    var posY = $(this).offset().top;
    let x = e.pageX - posX;
    let y = e.pageY - posY;

    // appendToolbox(x, y, eId);
    removeMouseMoveListener();
    storage.val("");
    if (toolName == "Sign") {
      findSignature()
    }
    var action = "addTool";
    var tool_id = cId;
    var tool_class = "tool-box tool-style main-element";
    var tool_text = toolName;
    var tool_top_pos = y;
    var tool_left_pos = x;
    var tool_type = 1;


    savetoSession(action, tool_id, toolUser, UserEmail, tool_type, tool_class, tool_text, tool_top_pos, tool_left_pos,);
  }
});

function findSignature() {
  let signer_id = $("#toolUser").val();
  // successAlert(signer_id);
  $.ajax({
    url: "inc/find-element.php", //path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
    method: "POST",
    dataType: "json",
    data: {
      findSignature: 1,
      signer_id: signer_id,
    },
    success: function (data) {
      if (data.success == true) {
        $("#createSignatureModal").modal("show");
        // signatureFile()
      } else {

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


function savetoSession(action, tool_id, toolUser, UserEmail, tool_type, tool_class, tool_text, tool_top_pos, tool_left_pos) {
  var document_id = $("#document_id").val();
  var filename = $("#filename").val();
  console.log(toolUser);
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
      tool_top_pos: tool_top_pos,
      tool_left_pos: tool_left_pos,
    },
    success: function (data) {
      load_session_data();
      // move(tool_id)
    },
  });
}

function editSession(edit, tool_id, toolUser, tool_class, tool_text, tool_top_pos, tool_left_pos) {
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
  savedragged();
  dragElement();
}
load_session_data()



$(document).on("click", ".deleteItem", function () {
  $(this).parent().parent().remove();
  var tool_id = $(this).data("id");
  remove(tool_id)
});

$(document).on("click", ".removeItem", function () {
  $(this).parent().parent().remove();
  var tool_id = $(this).data("id");
  remove(tool_id)
});

function remove(tool_id) {
  var action = "remove";
  $.ajax({
    url: "inc/process-tool.php",
    method: "POST",
    data: { tool_id: tool_id, action: action },
    success: function () {
      load_session_data();
    },
  });
}

function removeMouseMoveListener() {
  $(document).unbind("mousemove");
}

function savedragged() {
  $(".tool-box").each(function () {
    var $elem = $(this);
    var tool_text = $(this).data("name");
    var tool_id = $(this).attr("id");
    var tool_class = "";
    let edit = "edit_product";
    $elem.draggable({
      containment: "#mainWrapper",
      scroll: false,
      stop: function (e, ui) {
        let tool_top_pos = ui.position.top;
        let tool_left_pos = ui.position.left;
        editSession(edit, tool_id, tool_class, tool_text, tool_top_pos, tool_left_pos);
      },
    });
  });
}
function dragElement() {
  $(".main-element").each(function () {
    var $elem = $(this);
    var tool_id = $(this).data("id");
    let edit = "edit_element";
    $elem.draggable({
      containment: "#mainWrapper",
      scroll: false,
      stop: function (e, ui) {
        let tool_top_pos = ui.position.top;
        let tool_left_pos = ui.position.left;
        editElement(
          edit,
          tool_id,
          tool_top_pos,
          tool_left_pos,
        );
      },
    });
  });
}


function editElement(edit, tool_id, tool_top_pos, tool_left_pos) {
  $.ajax({
    url: "session/edit_element.php",
    method: "POST",
    data: {
      tool_id: tool_id,
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