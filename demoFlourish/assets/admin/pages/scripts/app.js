var handleValidationFormUser = function () {
    // for more info visit the official plugin documentation:
    // http://docs.jquery.com/Plugins/Validation
    console.log('validate');

    var $form = $('#formUser');
    var $error = $('.alert-danger', $form);
    var $success = $('.alert-success', $form);

    // Validation method for US currency
    // $.validator.addMethod('currency', function (value, element) {
    //     reg = /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/;
    //     if (value == '' || value.match(reg)) return true;
    //     return false;
    // }, 'Se requiere una cantidad v&aacute;lida.');
    //
    // $form.validate({
    //     errorElement: 'span', //default input error message container
    //     errorClass: 'help-block help-block-error', // default input error message class
    //     focusInvalid: false, // do not focus the last invalid input
    //     ignore: "", // validate all fields including form hidden input
    //     rules: {
    //         'user': {
    //             required: true,
    //             maxlength: 20
    //         },
    //         'password': {
    //             required: true,
    //             maxlength: 50
    //         }
    //     },
    //
    //     messages: { // custom messages for radio buttons and checkboxes
    //         'user': {
    //             required: 'C&oacute;digo de barras requerido.',
    //             maxlength: 'Se requieren m&aacute;ximo 20 caracteres.'
    //         },
    //         'password': {
    //             required: 'Descripci&oacute;n requerida.',
    //             maxlength: 'Se requieren m&aacute;ximo 50 caracteres.'
    //         }
    //     },
    //
    //     invalidHandler: function (event, validator) { //display error alert on form submit
    //         $success.hide();
    //         $error.show();
    //         Metronic.scrollTo($error, -200);
    //     },
    //
    //     errorPlacement: function (error, element) { // render error placement for each input type
    //         var icon = $(element).parent('.input-icon').children('i');
    //         icon.removeClass('fa-check').addClass("fa-warning");
    //         icon.attr("data-original-title", error.text()).tooltip({
    //             'container': 'body'
    //         });
    //     },
    //
    //     highlight: function (element) { // hightlight error inputs
    //         $(element).closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
    //     },
    //
    //     unhighlight: function (element) { // revert the change done by hightlight
    //         // $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
    //     },
    //
    //     success: function (label, element) {
    //         var icon = $(element).parent('.input-icon').children('i');
    //         $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
    //         icon.removeClass("fa-warning").addClass("fa-check");
    //     },
    //
    //     /*
    //     submitHandler: function (form) {
    //         // $success.show();
    //         $error.hide();
    //         form[0].submit(); // call form[0].submit() if you want to submit the form without ajax
    //     }
    //     */
    // });
    //
    // //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
    // $('.select2', $form).change(function () {
    //     $form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    // });
}

var handleAjaxFormUser = function () {
    console.log('ajax');
    var $form = $('#formUser');


    $form.ajaxForm({
        dataType: 'json',
        data: {
            isAjax: 1
        },
        beforeSubmit: function (arr, $form, options) {
            Metronic.blockUI($('body'));


        },
        error: function (err) {
            Metronic.unblockUI($('body'));
        },
        success: function (responseText, statusText, xhr, $form) {
            Metronic.unblockUI($('body'));
            $('#messages').html('');
            $('#requestToken').val(responseText.requestToken);
            if (responseText.status == 0) {

                if (responseText.url != '') window.location = responseText.url;


                $.each(responseText.messages.error, function (key, value) {
                    setMessageWithTimeout($('#messages'), value, 'danger');



                });
            } else {
                $.each(responseText.messages.success, function (key, value) {
                    setMessageWithTimeout($('#messages'), value);
                });
                resetFormUser();
            }
        }
    });
}

var handleDeleteUser = function () {
    $('.eliminar').on('click', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      console.log(id);
      doThis({
                do: 'delete_user',
                additional: 'isAjax=1' + '&id=' + id,
                dataType: 'json',
                beforeSend: function(arr, $form, options) {
                    Metronic.blockUI($('body'));
                },
                error: function(err) {
                    Metronic.unblockUI($('body'));
                },
                success: function(responseText, statusText, xhr, $form) {
                    Metronic.unblockUI($('body'));
                    $('#requestToken').val(responseText.requestToken);
                    if (responseText.status == 0) {
                        $('#messages').html('');
                        if (responseText.url != '') window.location = responseText.url;
                        setMessageWithTimeout($('#messages'), responseText.messages.error, 'danger');
                    } else {
				                setMessageWithTimeout($('#messages'), resposeText.messages.success);
                        $('#modalListSocialReason').modal('hide');

                    }
                }
            });
    });
}
var handleEditUser = function () {
    $('.editar').on('click', function (e) {
      e.preventDefault();

      var id = $(this).data('id');
      $('#id').val(id);

      doThis({
        do: 'edit_user',
        additional: 'isAjax=1' + '&idE=' + id,
        dataType: 'json',
        beforeSend: function(arr, $form, options) {
            Metronic.blockUI($('body'));
        },
        error: function(err) {
            Metronic.unblockUI($('body'));
        },
        success: function(responseText, statusText, xhr, $form) {
            Metronic.unblockUI($('body'));
            //$('#requestToken').val(responseText.requestToken);

            if (responseText.status == 0) {
                $('#messages').html('');
                if (responseText.url != '') window.location = responseText.url;
                setMessageWithTimeout($('#messages'), responseText.messages.error, 'danger');
            } else {
                setMessageWithTimeout($('#messages'), responseText.messages.success);
                console.log(responseText.user);
                $('#user').val(responseText.user.user);
                $('#password').val(responseText.user.password);
                $('#email').val(responseText.user.email);

                $('#number').val(responseText.address.number);
                $('#street').val(responseText.address.street);
                $('#city').val(responseText.address.city);
                $('#code').val(responseText.address.code);

                $('#modalListSocialReason').modal('hide');



            }

        }
            });
    });
}
var modal = function () {
    $('.listar').on('click', function (e) {
      e.preventDefault();
      $('#modalListSocialReason').modal("show");
    });
}



var resetFormUser = function () {
    $('#user').val('');
    $('#password').val('');
    $('#email').val('');
    $('#number').val('');
    $('#street').val('');
    $('#city').val('');
    $('#code').val('');
    $('#id').val('');
}




$(document).ready(function() {
    //$('.listar').click(listar);
    modal();
    handleValidationFormUser();
    handleAjaxFormUser();
    handleDeleteUser();
    handleEditUser();


});
