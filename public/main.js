$(document).ready(() => {
    function swal(text, icon) {
        Swal.fire(
            'Thông báo!',
            text,
            icon
        )
    }
    const base_url = "https://localhost/blogci4/"

    function load(time) {
        setTimeout(() => {
            window.location.reload()
        }, time)
    }
    /* This is basic - uses default settings */

    $("a.single_image").fancybox();

    /* Using custom settings */

    $("a.inline").fancybox({
        'hideOnContentClick': true
    });

    /* Apply fancybox to multiple items */

    $("a.group").fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false
    });
    $('#admin_login').submit((e) => {
        e.preventDefault()
        let username = $('#username')
        let password = $('#password')
        if (username.val() == "" || password.val() == "") {
            swal('còn thiếu gì đó', 'error')
        } else {
            $.ajax({
                url: 'Users/login',
                type: 'post',
                data: { 'username': username.val(), 'password': password.val() },
                dataType: 'json',
                beForeSend: () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success: (response) => {
                    if (response.status == true) {
                        swal('đăng nhập thành công', 'success')
                        load(1000)
                    } else {
                        $('#error').addClass('alert-danger')
                        $('#error').html(response.messages)
                        swal('đăng nhập thất bại', 'error')

                    }
                }
            })
        }
    })
    $('#registration').submit((e) => {
        e.preventDefault()
        let username = $('#username')
        let password = $('#password')
        let email = $('#email')
        let rppassword = $('#rppassword')
        let fullname = $('#fullname')
        if (username.val() == "" || password.val() == "" || email.val() == "" || rppassword.val() == "" || fullname.val() == "") {
            swal('còn thiếu gì đó', 'error')
        } else {
            $.ajax({
                url: 'Users/register',
                type: 'post',
                data: {
                    'username': username.val(),
                    'password': password.val(),
                    'email': email.val(),
                    'rppassword': rppassword.val(),
                    'fullname': fullname.val()
                },
                dataType: 'json',
                beForeSend: () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success: (response) => {
                    if (response.status == true) {
                        swal('đăng kí thành công', 'success')
                        load(1000)
                    } else {
                        $('#error').addClass('alert-danger')
                        $('#error').html(response.messages)
                        swal('đăng kí thất bại', 'error')

                    }
                }
            })
        }
    })
    $('#setting_meta').submit((e) => {
        e.preventDefault()

        let description = $('#description')
        let copyright = $('#copyright')
        let region = $('#region')
        let position = $('#position')
        let author = $('#author')
        let ICBM = $('#ICBM')

        if ($('textarea').text() == "") {
            swal('Không được bỏ trống')
        } else {

            $.ajax({
                url: 'Settings/setting_meta',
                type: 'post',
                data: {
                    description: description.val(),
                    copyright: copyright.val(),
                    region: region.val(),
                    position: position.val(),
                    author: author.val(),
                    ICBM: ICBM.val(),

                },
                dataType: 'json',
                beForeSend: () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success: (respone) => {
                    if (respone.status == true) {
                        swal(respone.messages, 'success')
                        load(1000)
                    } else {
                        $('#error').addClass('alert-danger')
                        $('#error').html(respone.messages)
                        swal('Cập nhật thất bại', 'error')

                    }
                }
            })
        }
    })
    $('#setting_header').submit((e) => {
        e.preventDefault();
        let logo = $('#logo')[0].files[0];
        let banner = $('#banner')[0].files[0];

        let title_logo = $('#title_logo')

        let title_banner = $('#title_banner')

        let formdata = new FormData()

        formdata.append('title_logo', title_logo.val())
        formdata.append('title_banner', title_banner.val())
        formdata.append('logo', logo)
        formdata.append('banner', banner)

        $.ajax({
            url: 'Settings/setting_header',
            type: 'post',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beForeSend: () => {

            },
            success: (respone) => {
                if (respone.status == true) {
                    swal(respone.messages, 'success')
                    load(1000)
                } else {
                    $('#error').addClass('alert-danger')
                    $('#error').html(respone.messages)
                    swal('Cập nhật thất bại', 'error')

                }
            }
        })


    })

    function responsive_filemanager_callback(field_id) {
        console.log(field_id);
        var url = jQuery('#' + field_id).val();
        alert('update ' + field_id + " with " + url);
        //your code
    }
    $('#setting_info').submit((e) => {
        e.preventDefault()
        let facebook = $('#facebook')
        let gmail = $('#gmail')
        let youtube = $('#youtube')
        let appid_fb = $('#appid_fb')
        let appsecret_fb = $('#appsecret_fb')
        let appid_gg = $('#appid_gg')
        let appsecret_gg = $('#appsecret_gg')
        if ($('textarea').text() == "") {
            swal('Không được bỏ trống')
        } else {
            $.ajax({
                url: 'Settings/setting_info',
                type: 'post',
                data: {
                    facebook: facebook.val(),
                    gmail: gmail.val(),
                    youtube: youtube.val(),
                    appid_fb: appid_fb.val(),
                    appsecret_fb: appsecret_fb.val(),
                    appid_gg: appid_gg.val(),
                    appsecret_gg: appsecret_gg.val(),
                },
                dataType: 'json',
                beForeSend: () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success: (respone) => {
                    if (respone.status == true) {
                        swal(respone.messages, 'success')
                        load(1000)
                    } else {
                        $('#error').addClass('alert-danger')
                        $('#error').html(respone.messages)
                        swal('Cập nhật thất bại', 'error')

                    }
                }
            })
        }
    })
    $(document).on('submit', '#form-post', function(e) {
        e.preventDefault();
        let image_title = $('#fieldID');
        let title_post = $('#title_post');
        let category = $('#danhmuc :selected').text()
        let sub_category = $('#sub_category_select :selected').text()
        let meta_keywork = $('#meta_keywork');
        let meta_description = $('#meta_description')
        let content = $('#content')
        if (image_title.val() == "" || title_post.val() == "" || category == "" || sub_category == "" || meta_keywork.val() == "" || meta_description.val() == "" || content.val() == "") {
            swal('Không được bỏ trống', 'error')
        } else {
            $.ajax({
                url: 'Posts/write_post',
                data: $('#form-post').serialize(),
                dataType: 'json',
                beForeSend: () => {},
                success: (respone) => {
                    if (respone.status == true) {
                        swal('Thêm mới thành công', 'success')
                        load(1000)
                    } else {
                        swal('Thêm mới thất bại', 'error')
                    }
                },
            })
        }
    })
    $('.iframe-btn').fancybox({
        'width': 900,
        'height': 600,
        'type': 'iframe',
        'autoScale': false
    });
    $('#category').submit((e) => {
        e.preventDefault()
        let name = $('#name').val()
        if (name == "") {
            swal('Tên danh mục không được bỏ trống', 'error')
        } else {
            $.ajax({
                url: 'Posts/add_category',
                type: 'post',
                data: { name: name },
                dataType: 'json',
                beForeSend: () => {

                },
                success: (respone) => {
                    if (respone.status == true) {
                        swal(respone.messages, 'success')

                        load(1000)
                    } else {
                        $('#error').addClass('alert-danger')
                        $('#error').html(respone.messages)
                        swal('không thành công', 'error')
                    }

                }
            })
        }
    })

    $(document).on('click', '.check_box', function() {
        if (this.checked) {
            var html = "";
            html = `<td><input type="checkbox" id="${$(this).attr('id')}" data-name="${$(this).data('name')}" data-stt="${$(this).data('stt')}" data-id="${$(this).data('id')}" class="check_box" checked/>${$(this).data('stt')}<input type="hidden" name="hidden_id[]" value="${$(this).attr('id')}" /></td>`
            html += `<td><input type="text" name="name[]" class="form-control" value="${$(this).data("name")}" /></td>`
        } else {
            html += `<td><input type="checkbox" id="${$(this).attr('id')}" data-name="${$(this).data('name')}"  data-stt="${$(this).data('stt')}" data-id="${$(this).data('id')}" class="check_box"/>${$(this).data('stt')}<input type="hidden" name="hidden_id[]" value="${$(this).attr('id')}" /></td>`
            html += `<td>${$(this).data('name')}</td>`
        }
        $(this).closest('tr').html(html);
    })
    $(document).on('click', '#delete_category', function() {

        if ($('.check_box:checked').length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có thực sự muốn xóa?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Trở về',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'Posts/delete_category',
                        method: "POST",
                        data: $('#form_category').serialize(),
                        dataType: 'json',
                        success: function(respone) {
                            if (respone.status == true) {
                                swal('Xóa Thành Công', 'success')
                                load(1000)
                            } else {
                                swal(respone.messages, 'error')
                            }

                        }
                    })
                }
            })

        } else {
            swal('Không có lựa chọn nào', 'warning')
        }
    })
    $(document).on('click', '#delete_sub_category', function() {

        if ($('.check_box:checked').length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có thực sự muốn xóa?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Trở về',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'Posts/delete_sub_category',
                        method: "POST",
                        data: $('#form_category').serialize(),
                        dataType: 'json',
                        success: function(respone) {
                            if (respone.status == true) {
                                swal('Xóa Thành Công', 'success')
                                load(1000)
                            } else {
                                swal(respone.messages, 'error')
                            }

                        }
                    })
                }
            })

        } else {
            swal('Không có lựa chọn nào', 'warning')
        }
    })
    $(document).on('click', '#update_category', function() {
        if ($('.check_box:checked').length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có thực sự muốn cập nhật?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Cập nhật',
                cancelButtonText: 'Trở về',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'Posts/update_category',
                        method: "POST",
                        data: $('#form_category').serialize(),
                        dataType: 'json',
                        beForeSend: () => {

                        },
                        success: function(respone) {
                            if (respone.status == true) {
                                swal('Cập nhật Thành Công', 'success')
                                load(1000)
                            } else {
                                swal(respone.messages, 'error')
                            }

                        }
                    })
                }
            })

        } else {
            swal('Không có lựa chọn nào', 'warning')
        }
    })

    $('#id_category').change(() => {

        load_sub_category();
    })
    $('#danhmuc').change(() => {

        load_sub_category_select();
    })
    $(document).on('submit', '#add_sub_category', function(e) {
        e.preventDefault()
        let id_category = $('#id_sub_category :selected').val()
        let name = $('#name').val()

        if (name == "") {
            swal('Tên danh mục con không được bỏ trống')
        } else {
            $.ajax({
                url: 'Posts/add_sub_category',
                data: { id_category: id_category, name: name },
                dataType: 'json',
                beForeSend: () => {},
                success: (respone) => {
                    if (respone.status == true) {
                        swal('Cập nhật thành công', 'success')
                        load(1000)
                    } else {
                        swal(respone.messages, 'error')
                    }
                },
            })
        }

    })

    function load_sub_category() {
        let id = $('#id_category :selected').val()
        $.ajax({
            url: 'Posts/load_category',
            data: { id: id },
            dataType: 'json',
            beForeSend: () => {},
            success: (respone) => {
                $('#load_sub_categoty').html(respone.html)
            },

        })

    }

    function load_sub_category_select() {
        let id = $('#danhmuc :selected').val()
        $.ajax({
            url: 'Posts/load_category_select',
            data: { id: id },
            dataType: 'json',
            beForeSend: () => {},
            success: (respone) => {
                $('#sub_category_select').html(respone.html)
            },

        })

    }
    let url = window.location.href;
    if (url.includes('sub_category')) {
        load_sub_category();
    }
    if (url.includes('write-post')) {
        load_sub_category_select();
    }
    $(document).on('click', '#update_sub_category', function() {
        if ($('.check_box:checked').length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có thực sự muốn cập nhật?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Cập nhật',
                cancelButtonText: 'Trở về',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'Posts/update_sub_category',
                        method: "POST",
                        data: $('#form_category').serialize(),
                        beForeSend: () => {

                        },
                        success: (res) => {
                            if (res.status == true) {
                                swal('Cập nhật thành công', 'success')
                                    // load(1000)
                            } else {
                                swal(res.messages, 'error')
                            }
                        }
                    })
                }
            })

        } else {
            swal('Không có lựa chọn nào', 'warning')
        }
    })

    $(document).on('click', '#delete_post', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id')
        Swal.fire({
            icon: 'warning',
            title: 'Bạn có thực sự muốn xóa?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Trở về',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: 'Posts/delete_post',
                    method: "POST",
                    data: { id: id },
                    dataType: 'json',
                    success: function(respone) {
                        if (respone.status == true) {
                            swal('Xóa Thành Công', 'success')
                            load(1000)
                        } else {
                            swal(respone.messages, 'error')
                        }

                    }
                })
            }
        })


    })

    function redirect(timeout, page) {
        setTimeout(() => {
            window.location.href = page
        }, timeout)
    }
    $(document).on('submit', '#form_edit_post', function(e) {
        e.preventDefault();
        let image_title = $('#fieldID');
        let title_post = $('#title_post');
        let category = $('#category :selected').text()
        let sub_category = $('#sub_category :selected').text()
        let meta_keywork = $('#meta_keywork');
        let meta_description = $('#meta_description')
        let content = $('#content')
        if (image_title.val() == "" || title_post.val() == "" || category == "" || sub_category == "" || meta_keywork.val() == "" || meta_description.val() == "" || content.val() == "") {
            swal('Không được bỏ trống', 'error')
        } else {
            $.ajax({
                url: $(this).attr('action'),
                data: $('#form_edit_post').serialize(),
                dataType: 'json',
                beForeSend: () => {},
                success: (respone) => {
                    if (respone.status == true) {
                        swal('Cập nhật thành công', 'success')

                        redirect(1000, respone.slug)
                    } else {
                        swal('Cập nhật thất bại', 'error')
                    }
                },
            })
        }
    })


})