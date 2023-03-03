$(document).ready(function () {
    const user = JSON.parse(window.localStorage.getItem("user"))
    if (!user) {
        window.location = 'index.html'
    }
    else {
        $(".uname").html(`User Name: ${user.uname}`);
        $(".email").html(`Email: ${user.email}`)
        $(".pnumber").val(user.pnumber)
        $(".dob").val(user.dob)
        $(".degree").val(user.degree)
        $(".yop").val(user.yop)

        $(".edit").click(function () {
            $(".submit").removeClass("d-none")
            $(".form-control").removeAttr("readonly")
            $(".form-control").attr("required")
        })

        $('form').submit(function (e) {
            e.preventDefault()

            $.ajax({
                url: 'php/profile.php',
                type: 'POST',
                data: $('form').serialize() + "&uname=" + user.uname,
                success: function (res) {
                    alert(res)
                    localStorage.clear()
                    location = "index.html"
                }
            })
        })
    }
})