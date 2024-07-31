const txtDate = document.querySelector("#txtDate");
const txtTime = document.querySelector("#txtTime");

// เมื่อ Click ตรงวันที่(booking-date) จะแสดงรายการ booking-item ตามวันที่นั้นๆทางด้านกล่องขวา(กล่อง _list)
$(document.body).on("click", ".booking-date", function () {
  // $('.booking-date').on('click', function() {
  $(".booking-date").removeClass("pojselected"); //ทำการ remove [pojselected class] ออกจาก [booking-date class] ทั้งหมด
  $(this).addClass("pojselected"); //ทำการ add [pojselected class] ให้กับ [booking-date class] ที่เลือกเท่านั้น

  //สร้างตัวแปรจาก element id = txtDate ใน HTML
  let booking_date = $(this).attr("iid");
  // booking_date = $(this).data("value");
  // console.log("booking_date = " + booking_date);

  $.ajax({
    url: "530booking_list_detail.php", // ที่ๆจะให้ส่งข้อมูลไป
    // data: $("#frmBooking_list").serialize(),
    data: { booking_date: booking_date },
    //จะทำการส่งเป็นรูปแบบ username=poj11&email=poj11@hotmail.com&password=1111
    //ส่งในรูปแบบ javascript array เช่น data: { username: "poj11", email: "poj11@hotmail.com", password: "1111" },
    method: "POST", //วิธีการส่งแบบ POST หรือ GET
    success: function (response) {
      //ถ้าทำงานเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ response โดยเราต้องเขียนให้มันส่งสิ่งที่เราต้องการกลับมา
      // $('#error_msg').html(response); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก response ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

      $(".item-lists").html(response);
    },
    //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
  });
});

$(document).on("click", ".booking-item", function (e) {
  e.preventDefault();
  let booking_item_value = $(this).data("value");
  let data = JSON.stringify(booking_item_value);
  // console.log(booking_item_value);
  $.ajax({
    url: "530gen_qr.php",
    type: "POST",
    data: { ref_json: data },
    success: function (response) {
      console.log(response);
      let data = JSON.parse(response);
      let img_file = data.img_file;
      let detail = data.detail;
      // let qr_code_element = document.querySelector("#qrcode");
      // let img = document.createElement("img");
      // img.src = response;
      // qr_code_element.appendChild(img);

      $("#qrcodeModal").css("display", "none");
      $("#imgQrCode").attr("src", img_file);
      $("#aDownload").attr("download", img_file);
      qr_code_canvas = document.querySelector("canvas");
      if ($("#imgQrCode").attr("src") == null) {
        setTimeout(() => {
          $("#aDownload").attr("href", `${qr_code_canvas.toDataURL()}`);
        }, 300);
      } else {
        // console.log($("#imgQrCode").attr("src"));
        setTimeout(() => {
          $("#aDownload").attr("href", $("#imgQrCode").attr("src"));
        }, 300);
      }

      $("#qrdetail").empty();
      $("#qrdetail").html(detail);

      $("#qrcodeModal").css("display", "flex");
    },
  });
});

// หน้าต่าง QRCode: ปิดหน้าต่าง QRCode และไปที่หน้า Booking_list.php
// btnClose.addEventListener('click', (e) => {
$(document.body).on("click", "#btnClose", function (e) {
  e.preventDefault();
  // $("#qrcode").empty();
  // $("#qrcodeModal").css("display", "none"); or ใช้ $("#qrcodeModal").addClass("d-none");
  $("#qrcodeModal").css("display", "none");
  // $("#qrcodeModal").addClass("d-none");
  // header('Location: ../booking_list.php');
  // location.reload();
});

// หน้าต่าง QRCode: ปิดหน้าต่าง QRCode และไปที่หน้า Booking_list.php
// btnClose.addEventListener('click', () => {
//     qrcodeModal.style.display = "none";
//     header('Location: ../booking_list.php');
// })

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  // if (event.target == myModal) {
  //     myModal.style.display = "none";
  // }
  if (event.target == qrcodeModal) {
    // $("#qrcode").empty();
    $("#qrcodeModal").css("display", "none");
  }
  // if (event.target == myModal_Confirm) {
  //     myModal_Confirm.style.display = "none";
  // }
};
