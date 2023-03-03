$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault()

        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data: $('form').serialize(),
            beforeSend: function () {
                $('.submit').val('Loading...')
            },
            success: function (res) {
                res = JSON.parse(res)
                if (res.status) {
                    const { dbuser } = res
                    window.localStorage.setItem('user', JSON.stringify({ "uname": res.uname, "email": res.email, "pnumber": dbuser.pnumber, "dob": dbuser.dob, "degree": dbuser.degree, "yop": dbuser.yop }))
                    $('form')[0].reset()
                    window.location = 'profile.html'
                }
                else {
                    alert(res.error)
                }
            }
        })

    })
})