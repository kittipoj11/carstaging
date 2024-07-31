window.onload = function () {
  let id = $("#username").val();
  // console.log("ID : " + id);
  $.ajax({
    url: "610profile_crud.php",
    type: "POST",
    data: { edit_id: id },
    success: function (response) {
      // console.log(response);
      data = JSON.parse(response);
      // console.log(data);
      $("#firstname").val(data[0].firstname);
      $("#lastname").val(data[0].lastname);
      $("#address").val(data[0].address);
      $("#phone").val(data[0].phone);
      $("#email").val(data[0].email);
      $("#line_user_id").val(data[0].line_user_id);

      // console.log('len = ' + data[0].line_user_id.trim().length);
      if (data[0].line_user_id.trim().length > 0) {
        // $("#button_line").hide();
        $("#button_line").addClass("d-none");
        // $(".btn").addClass("d-none");
        // $(".btn").attr("visibility", hidden);
      } else {
        // $("#button_line").show();
        $("#button_line").removeClass("d-none");
        // $(".btn").removeClass("d-none");
        // $(".btn").attr("visibility", visible);
      }
    },
  });
};

$(document).ready(function () {
  $(document).on("click", "#btnUpdateData", function (e) {
    e.preventDefault();

    let data_sent = $("#frmEdit").serialize() + "&action=updatedata";
    console.log(data_sent);
    $.ajax({
      url: "610profile_crud.php",
      type: "POST",
      // data: $(this).serialize(),
      data: data_sent,
      success: function (response) {
        Swal.fire({
          title: "Data updated successfully.",
          icon: "success",
          // width: 600,
          // padding: '3em',
          color: "#716add",
          background: "#fff url(../images/trees.png)",
          backdrop: `
                                rgba(0,0,123,0.4)
                                url("../_images/ani.gif")
                                left top
                                no-repeat
                                `,
        }).then((result) => {
          if (result.isConfirmed) {
            windown.history.back();
            // $("#modalAddLine").modal('show');
          }
        });
      },
    });
  });

  $(document).on("click", "#btnAddLine", function (e) {
    e.preventDefault();

    $("#modalAddLine").modal("show");
  });

  $(document).on("click", "#btnChangePassword", function (e) {
    e.preventDefault();

    if ($("#password").val() != $("#confirm_password").val()) {
      Swal.fire({
        icon: "error",
        title: "รหัสผ่านไม่ตรงกัน กรุณาใส่รหัสผ่านอีกครั้ง",
        color: "#DB4437",
        background: "#fff url(../images/trees.png)",
        backdrop: `
                                rgba(219, 68, 55,0.4)
                                url("../_images/ani.gif")
                                left top
                                no-repeat
                                `,
        // showConfirmButton: false,
        // timer: 1500
      });
      return;
    } else {
      let data_sent = $("#frmEdit").serialize() + "&action=changepassword";
      $.ajax({
        url: "610profile_crud.php",
        type: "POST",
        data: data_sent,
        success: function (response) {
          Swal.fire({
            title: "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว",
            icon: "success",
            // width: 600,
            // padding: '3em',
            color: "#716add",
            background: "#fff url(../images/trees.png)",
            backdrop: `
                                rgba(15, 157, 88,0.4)
                                url("../_images/paw.gif")
                                left ะนย
                                no-repeat
                                `,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "510history_booking_table.php";
            }
          });
        },
      });
    }
  });

  $(document).on("click", ".btnClose", function (e) {
    window.location.href = "510history_booking_table.php";
  });
});
