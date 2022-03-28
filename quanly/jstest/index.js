  $(document).ready(function() {
    $('#contact_form2').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tu_ngay: {
                validators: {
                    notEmpty: {
                        message: 'Bạn chưa nhập từ ngày'
                    }
                }
            },
            den_ngay: {
                validators: { 
                    notEmpty: {
                        message: 'Bạn chưa nhập đến ngày'
                    }
                }
            },
            gio_batdau: {
                validators: {
                        
                    notEmpty: {
                        message: 'Bạn chưa nhập giờ bắt đầu'
                    }
                }
            },
            gio_ketthuc: {
                validators: {
                        
                    notEmpty: {
                        message: 'Bạn chưa nhập giờ kết thúc'
                    }
                }
            },
            cmbThu: {
                validators: {
                        
                    notEmpty: {
                        message: 'Bạn chưa chọn thứ '
                    }
                }
            },
            soluonghocvien: {
                validators: {
                        
                    notEmpty: {
                        message: 'Bạn chưa nhập số lượng học viên '
                    }
                }
            }
            
          
        }
    }).on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form2').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});