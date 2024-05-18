$(document).ready(function () {
    $('#register-form').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            success: function (response) {
                $('#register-message').html(response);
            }
        });
    });
});