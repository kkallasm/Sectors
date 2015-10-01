$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$(document).ready(function() {

		$("#index_form").validate({
			rules: {
				"name": "required",
				"sectors[]": "required",
				"terms": "required"
			},
			messages: {
				"name": "Name is missing",
			    "sectors[]": "Sectors are required",
				"terms": "Please accept our terms"
			}
		});
});