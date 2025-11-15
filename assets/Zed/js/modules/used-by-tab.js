var bootstrap = require('bootstrap');
var clickedButtonUrl = null;

$(document).ready(function () {
    $('#used-by-table').on('click', 'td.actions a.btn', function (e) {
        e.preventDefault();

        clickedButtonUrl = $(this).attr('href');

        var confirmModal = new bootstrap.Modal($('#confirmation-modal-window'));
        confirmModal.show();
    });

    $('.js-btn-confirm').on('click', function () {
        window.location.href = clickedButtonUrl;
    });
});
