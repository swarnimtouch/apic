document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-in-out'
    });
});

$(document).ready(function () {

    $('#registrationForm').validate({
        rules: {
            fullName: {
                required: true,
                minlength: 3
            },
            emailAddress: {
                required: true,
                email: true
            },
            mobileNumber: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            speciality: {
                required: true
            },
            clinicName: {
                required: true
            },
            city: {
                required: true
            }
        },
        messages: {
            fullName: {
                required: "Please enter your full name",
                minlength: "Name must be at least 3 characters long"
            },
            emailAddress: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            mobileNumber: {
                required: "Please enter your mobile number",
                digits: "Please enter numbers only",
                minlength: "Mobile number must be at least 10 digits",
                maxlength: "Mobile number cannot exceed 15 digits"
            },
            speciality: {
                required: "Please select your speciality"
            },
            clinicName: {
                required: "Please enter your clinic or hospital name"
            },
            city: {
                required: "Please enter your city"
            }
        },

        submitHandler: function (form) {

            const btn = $(form).find('button[type="submit"]');

            btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Registering...');
            btn.prop('disabled', true);

            $.ajax({
                url: $(form).attr('action'),
                method: "POST",
                data: $(form).serialize(),

                success: function (res) {

                    $(form).html(`
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle text-success mb-3" style="font-size:3rem;"></i>
                            <h4 class="fw-bold text-dark">Registration Successful!</h4>
                            <p class="text-muted">
                                Thank you for your interest. We will notify you when APIC goes live.
                            </p>
                        </div>
                    `);
                },

                error: function (xhr) {

                    btn.html('Register Now');
                    btn.prop('disabled', false);

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            alert(value[0]);
                        });
                    }

                }
            });

        }

    });

});
