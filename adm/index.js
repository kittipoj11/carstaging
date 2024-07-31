$(document).ready(function () {
  $('#frmLogin').submit(function (e) {
    e.preventDefault();




    $.ajax({
      url: 'check_login.php',
      // data: $(this).serialize(),
      data: $(this).serialize(),
      method: 'POST',
      success: function (response) {
        if (response) {
          window.location = "001today.php";
        } else {
          // var jsonData = JSON.parse(response); //ส่งกลับมาเป็น html ว่าสำเร็จหรือไม่
          Swal.fire({
            icon: 'error',
            title: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            color: '#716add',
            background: '#fff url(/images/trees.png)',
            backdrop: `
                      rgba(0,0,123,0.4)
                      url("_images/ani.gif")
                      left top
                      no-repeat
                      `
            // showConfirmButton: false,
            // timer: 1500
          })
        }

        // $("#registrationForm").modal('hide');
        // $("#frmMemberRegistration")[0].reset();
        // window.location = "login.php";
      }
    });
  });
});