// resources/js/app.js
require("./bootstrap");
require("jquery-ujs");
require("./remote");

// resources/js/remote.js
$(document).on("ajax:success", function(e, xhr) {
    if (!$("#modal").length) {
        $("body").append($('<div class="modal" id="modal"></div>'));
    }
    $("#modal")
        .html(xhr.responseText)
        .modal("show");
});
