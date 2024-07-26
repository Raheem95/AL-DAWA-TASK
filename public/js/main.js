function CreateErrorLabel(AfterID, Message) {
  // Check if the error label already exists
  if (!$("#" + AfterID + "Error").length) {
    // Create a new label element for the error message
    var ErrorLabel = $(
      "<label class = 'error-label' style='color:red;font-size:16px'>"
    )
      .attr("id", AfterID + "Error")
      .text(Message);

    // Insert the error label after the element with ID 'AfterID'
    $("#" + AfterID).after(ErrorLabel);
  }
}

function customConfirm(message, callback) {
  var confirmContainer = document.getElementById("customConfirmContainer");
  var confirmDiv = document.createElement("div");
  confirmDiv.classList.add("custom-confirm");
  var confirmMessage = document.createElement("p");
  confirmMessage.textContent = message;
  confirmDiv.appendChild(confirmMessage);

  var btnConfirm = document.createElement("button");
  btnConfirm.textContent = "Confirm";
  btnConfirm.classList.add("btn", "btn-confirm");
  btnConfirm.onclick = function () {
    confirmContainer.removeChild(confirmDiv);
    callback(true);
  };
  confirmDiv.appendChild(btnConfirm);

  var btnCancel = document.createElement("button");
  btnCancel.textContent = "Cancel";
  btnCancel.classList.add("btn", "btn-cancel");
  btnCancel.onclick = function () {
    confirmContainer.removeChild(confirmDiv);
    callback(false);
  };
  confirmDiv.appendChild(btnCancel);

  confirmContainer.appendChild(confirmDiv);
}

function customAlert(message, type) {
  var alertContainer = $("#customAlertContainer"); // Using jQuery to select the container

  var alertDiv = $('<div class="custom-alert"></div>'); // Creating a jQuery object for the alert

  switch (type) {
    case "danger":
      alertDiv.addClass("custom-alert-danger");
      break;
    case "success":
      alertDiv.addClass("custom-alert-success");
      break;
    case "info":
      alertDiv.addClass("custom-alert-info");
      break;
    default:
      break;
  }

  alertDiv.text(message); // Setting text content using jQuery

  alertContainer.append(alertDiv); // Appending the alert to the container

  // Automatically remove the alert after 5 seconds
  setTimeout(function () {
    alertDiv.animate(
      {
        opacity: 0,
      },
      "slow",
      function () {
        $(this).remove(); // Removing the alert from DOM after animation
      }
    );
  }, 3000); // 5000 milliseconds (5 seconds) timeout
}
document.addEventListener("DOMContentLoaded", function () {
  var message = $("#ResultText").val();
  var type = $("#ResultType").val();
  customAlert(message, type);
});
