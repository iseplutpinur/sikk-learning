$(document).ready(function () {
    $("#loader").LoadingOverlay('progress');
    $('#password-visibility').change(function () {
        const password = $('#password')

        // password toggle
        if (this.checked) {
            password.attr('type', 'text')
        } else {
            password.attr('type', 'password')
        }
    })

    $('#form-login').validate({
        // Rules for form validation
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },

        // Messages for form validation
        messages: {
            email: {
                required: 'Tolong masukan NISN or NIP or Username'
            },
            password: {
                required: 'Tolong masukan password'
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            $("button[type=submit]").LoadingOverlay("show");
            $.ajax({
                method: 'post',
                url: '<?= base_url() ?>login/doLogin',
                data: {
                    email: form.email.value,
                    password: form.password.value
                },
                success: function (response) {
                    if (response.status == 1) {
                        setToast({ title: "Gagal", body: "Maaf. Password yang anda masukan salah.", class: "bg-warning" });
                        $('#password').val('')

                        $('#password').focus()
                    } else if (response.status == 2) {
                        setToast({ title: "Gagal", body: "Maaf. Akun tidak ditemukan", class: "bg-warning" });
                        $('#email').val('')
                        $('#password').val('')

                        $('#email').focus()
                    } else if (response.status == 3) {
                        setToast({ title: "Gagal", body: "Maaf. Akun anda dinonaktifkan", class: "bg-warning" });
                    } else if (response.status == 4) {
                        setToast({ title: "Gagal", body: "Maaf. Akun anda belum dikonfirmasi", class: "bg-info" });
                    } else if (response.status == 0) {
                        setToast({ title: "Berhasil", body: "Login Sukses", class: "bg-primary" });
                        setInterval(() => {
                            window.location.href = base_url + 'dashboard'
                        }, 1000)
                    } else {
                        setToast({ title: "Gagal", body: "Koneksi buruk.", class: "bg-warning" });
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                },
                complete: function () {
                    $("button[type=submit]").LoadingOverlay("hide");
                }
            })
        }
    });
})

function setToast(data) {
    $(document).Toasts('create', {
        class: data.class,
        title: data.title,
        body: data.body
    })
    setTimeout(() => $("#toastsContainerTopRight").remove(), 5000);
}