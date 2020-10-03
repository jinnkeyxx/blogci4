$(document).ready(() => {
    function swal(text , icon)
    {
        Swal.fire(
            'Thông báo!',
            text,
            icon
          )
    }
    function load(time)
    {
        setTimeout(() => {
            window.location.reload()
        }, time)
    }
    $('#admin_login').submit((e) => {
        e.preventDefault()
        let username = $('#username')
        let password = $('#password')
        if(username.val() == "" || password.val() == "")
        {
            swal('còn thiếu gì đó' , 'error')
        }
        else 
        {
            $.ajax({
                url : 'Users/login',
                type : 'post',
                data : {'username' : username.val() , 'password' : password.val()},
                dataType : 'json',
                beForeSend : () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success : (response) => {
                    if(response.status == true)
                    {
                        swal('đăng nhập thành công' , 'success')
                        load(2000)
                    }
                    else 
                    { 
                        $('#error').addClass('alert-danger') 
                        $('#error').html(response.messages) 
                        swal('đăng nhập thất bại' , 'error')
                        
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
        if(username.val() == "" || password.val() == "" || email.val() == "" || rppassword.val() == "" || fullname.val() == "")
        {
            swal('còn thiếu gì đó' , 'error')
        }
        else 
        {
            $.ajax({
                url : 'Users/register',
                type : 'post',
                data : {'username' : username.val() ,
                        'password' : password.val(),
                        'email' : email.val(),
                        'rppassword' : rppassword.val(),
                        'fullname' : fullname.val()
                },
                dataType : 'json',
                beForeSend : () => {
                    $('#submit').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>`)
                },
                success : (response) => {
                    if(response.status == true)
                    {
                        swal('đăng kí thành công' , 'success')
                        load(2000)
                    }
                    else 
                    { 
                        $('#error').addClass('alert-danger') 
                        $('#error').html(response.messages) 
                        swal('đăng kí thất bại' , 'error')
                        
                    }
                }
            })
        }
    })
    
})