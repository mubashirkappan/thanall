$('#add_user').click(function() {
    $('#qr-create-menu').prop('checked', true);
    alert(ok);
});

$('#edit').click(function() {
    $('#qr-create-menu').prop('checked', true);
    // document.getElementById('formBanner').reset();
    // $(".formBanner").validate().resetForm();
    var editUrl = $(this).attr('edit-url');
    var updateUrl = $(this).attr('update-url');
    // $('#appName', '#formBanner input[name="startDate"]', '#formBanner input[name="endDate"]', '#website', '#appId', '#country', '#state', '#city', '#stateSelected', '#citySelected').val("");
    $.get(editUrl, function(response) {
        document.getElementById('addUser').action = updateUrl;
        $('#firstName').val(response.f_name);
        $('#lastName').val(response.l_name);
        // $('#gender').val(response.gender);
        $('#address').val(response.adress);
        $('#emailAddress').val(response.email);
        $('#phoneNumber').val(response.phone);
        $('#job').val(response.job);
        $('#password').val(response.password);
    }, "json");
});
$('#close').click(function() {
    $('#qr-create-menu').prop('checked', false);
    alert(ok);
});