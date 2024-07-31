// Example of a template literal
// let name = "Nathapat";
// let role = "Admin";
// `Hello! My name is ${name} and I'm a ${role}`

const txtDate = document.querySelector("#txtDate");
const txtTime = document.querySelector("#txtTime");
const myModal = document.getElementById("myModal");
const qrcodeModal = document.getElementById("qrcodeModal");
const myModal_Confirm = document.getElementById("myModal_Confirm");
let btnBooking = document.querySelector("#btnBooking");
let qr_code_element = document.querySelector("#qrcode");

var eventObject = $("#optEventId");

// ตรวจสอบ validation
let isSuccess = true;

//การยืนยันการจอง
let isConfirm = true;

function showSuccess(input) {
  const formControl = input.parentElement.parentElement;
  formControl.className = "col-12 form_control";
}

function showError(input, message) {
  const formControl = input.parentElement.parentElement;
  formControl.className = "col-12 form_control fail";
  const small = formControl.querySelector("small");
  small.innerText = message;
}

//ตรวจสอบ element ที่เป็น input
function checkRequired(inputArr) {
  inputArr.forEach((input) => {
    if (input.value.trim() === "") {
      showError(input, `ต้องใส่ข้อมูล ${input.getAttribute("data-type")} ด้วย`);
      isSuccess = false;
    } else {
      showSuccess(input);
    }
  });
}

//ตรวจสอบ element ที่เป็น select-option
function checkSelected(selectArr) {
  selectArr.forEach((select) => {
    if (select.options[select.selectedIndex].text === "...") {
      showError(
        select,
        `ต้องเลือกข้อมูล ${select.getAttribute("data-type")} ด้วย`
      );
      isSuccess = false;
    } else {
      showSuccess(select);
    }
  });
}

//ตรวจสอบ element ที่เป็น input ของ Day และ Time
function checkDayTime(inputArr) {
  inputArr.forEach((input) => {
    if (input.value.trim() === "") {
      isSuccess = false;
    }
  });
}

function getFieldName(input) {
  return input.alt.slice(0); //ใช้ตัดคำโดยเริ่มต้นทางซ้ายที่ตำแหน่งเริ่มต้นที่ 0
}

// หน้าต่างใส่ข้อมูลการจอง: ตรวจสอบการใส่ข้อมูลและเลือกข้อมูลตามที่กำหนดว่าครบถ้วนหรือไม่  ถ้าครบถ้วนจะแสดงหน้าต่างเลือกวันและเวลา
$(document.body).on("click", "#btnSelectDateTime", function (e) {
  e.preventDefault();
  isSuccess = true;
  checkRequired([car_license_number, boot]);
  checkSelected([car_type_id, open_id, building_id, hall_id]);
  // console.log($("#frmBooking").serialize());
  if (isSuccess) {
    $.ajax({
      url: "520booking_open_date.php", // ที่ๆจะให้ส่งข้อมูลไป
      data: $("#frmBooking").serialize(), //จะทำการส่งเป็นรูปแบบ username=cust1&car_license_number=10-111112&car_type_id=3&take_time_minutes=&driver_name=%E0%B8%84%E0%B8%99%E0%B8%97%E0%B8%B5%E0%B9%88%201&driver_phone=1234567890&open_id=68&boot=001&building_id=CH&hall_id=hall01&txtDate=&txtTime=
      method: "POST", //วิธีการส่ง POST หรือ GET
      // data: { username: "Mickey", email: "poj11@hotmail.com", password: "1111" },   //ส่งในรูปแบบ javascript object array
      success: function (data) {
        //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
        // console.log(data);
        // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg
        $("#DateSectionHead").html(data);
        $("#TimeSectionHead").html("");
        // $('#btnBooking').hide();
        $("#btnBooking").prop("disabled", true);
      },
      //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    });
    $("#myModal").css("display", "block");
  }
});

//หน้าต่างเลือกวันและเวลา: ตรวจสอบการเลือกวันและเวลา  ก่อนแสดงหน้าต่างยืนยันการจอง
// btnBooking.addEventListener('click', (e) => {
$(document.body).on("click", "#btnBooking", function (e) {
  e.preventDefault();
  isSuccess = true;
  checkDayTime([txtDate, txtTime]);
  if (isSuccess) {
    // Get the modal
    // When the user clicks the button, open the modal
    // myModal.style.display = "block";

    $("#myModal_Confirm").css("display", "flex");
  } else {
    // btnBooking.disabled = false;
    alert("ต้องเลือกวันและเวลาที่ต้องการจอง");
  }
});

$(document.body).on("click", ".pojDay", function () {
  // $('.pojDay').on('click', function() {
  $(".pojDay").removeClass("pojselected"); //ลบ(remove class):pojselected ออกไปจากทุกปุ่มที่มี class pojDay
  $(this).addClass("pojselected"); //เพิ่ม(add class): pojselected ให้กับปุ่มที่ถูกเลือก

  //สร้างตัวแปรจาก element id = txtDate ใน HTML
  let txtDate = document.querySelector("#txtDate");

  //กำหนดค่าวันที่ที่เลือกไว้ที่ txtDate
  // txtDate.value = '2023-03-' + document.getElementById($(this).attr('id')).innerText;
  txtDate.value = $(this).data("value");
  // console.log($("#frmBooking").serialize());
  $.ajax({
    url: "520booking_open_time.php", // ให้ส่งข้อมูลไปตาม url ที่กำหนด
    data: $("#frmBooking").serialize(), //จะทำการส่งเป็นรูปแบบ username=cust1&car_license_number=10-111112&car_type_id=3&take_time_minutes=&driver_name=%E0%B8%84%E0%B8%99%E0%B8%97%E0%B8%B5%E0%B9%88%201&driver_phone=1234567890&open_id=68&boot=001&building_id=CH&hall_id=hall01&txtDate=2024-01-04&txtTime=
    method: "POST", //วิธีการส่ง POST หรือ GET
    // data: { username: "Mickey", email: "poj11@hotmail.com", password: "1111" },   //ส่งในรูปแบบ javascript object array
    success: function (data) {
      //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
      // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

      $("#TimeSectionHead").html(data);
      // $('#btnBooking').hide();
      $("#btnBooking").prop("disabled", true);
    },
    //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
  });
});

$(document.body).on("click", ".pojTime", function () {
  $(".pojTime").removeClass("pojselected");
  $(this).addClass("pojselected");

  //สร้างตัวแปรจาก element id = txtTime ใน HTML
  let txtTime = document.querySelector("#txtTime");

  //กำหนดค่าวันที่ที่เลือกไว้ที่ txtTime
  // txtTime.value = document.getElementById($(this).attr('id')).innerText;
  txtTime.value = $(this).data("value");
  // $('#btnBooking').show();
  $("#btnBooking").prop("disabled", false);
});

// หน้าต่าง QRCode: ปิดหน้าต่าง QRCode และไปที่หน้า Booking_list.php
// btnClose.addEventListener('click', (e) => {
$(document.body).on("click", "#btnClose", function (e) {
  e.preventDefault();
  // $("#qrcode").empty();
  $("#qrcodeModal").css("display", "none");
  // $("#myModal_Confirm").css("display", "none");

  // header('Location: ../booking_list.php');
  // location.reload();
});

// หน้าต่างเลือกวันและเวลา: ยกเลิกการเลือกวันและเวลา(ปิดหน้าต่างการเลือกวันและเวลา)
// btnCancel.addEventListener('click', () => {
$(document.body).on("click", "#btnCancel", function () {
  $("#myModal").css("display", "none");
});

// หน้าต่างยืนยันการจอง: ยกเลิกการจอง(ปิดหน้าต่างยืนยันการจอง)
// btnCancelConfirm.addEventListener('click', (e) => {
$(document.body).on("click", "#btnCancelConfirm", function (e) {
  e.preventDefault();
  $("#myModal_Confirm").css("display", "none");
  // window.history.go(-1);
  // window.history.back();
});

// หน้าต่างยืนยันการจอง: ทำการบันทึกข้อมูลลง DB และแสดงหน้าต่าง QRCode
//สร้าง qrcode แบบใช้ endroid qrcode แทน PHP QRcode Library
$(document).ready(function () {
  $("#frmBooking").submit(function (e) {
    e.preventDefault();

    // console.log("serialize: "+$(this).serialize());
    $.ajax({
      url: "520booking_crud.php", // ที่ๆจะให้ส่งข้อมูลไป
      data: $(this).serialize(), //จะทำการส่งเป็นรูปแบบ username=Mickey&email=poj11@hotmail.com&password=1111
      method: "POST", //วิธีการส่ง POST หรือ GET
      // data: { username: "Mickey", email: "poj11@hotmail.com", password: "1111" },   //ส่งในรูปแบบ javascript object array
      success: function (data) {
        //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data ในที่นี้ data คือ json
        // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element ชื่อ #error_msg
        if (data != null && data.length > 0) {
          console.log("mydata: "+data);
          // console.log(badge_value);
          // console.log(JSON.stringify(badge_value));
          $.ajax({
            // url: "520gen_qr_old.php",
            url: "520gen_qr.php",
            type: "POST",
            data: { ref_json: data },
            success: function (response) {
              // console.log(response);
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

              $("#myModal").css("display", "none");
              $("#myModal_Confirm").css("display", "none");
              $("#qrcodeModal").css("display", "flex");
            },
          });
        } else {
          console.log("Data not found");
        }
      },
      //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    });
  });
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == myModal) {
    $("#myModal").css("display", "none");
  }
  if (event.target == qrcodeModal) {
    // $("#qrcode").empty();
    $("#qrcodeModal").css("display", "none");
  }
  if (event.target == myModal_Confirm) {
    $("#myModal_Confirm").css("display", "none");
  }
};

$(function () {
  // on change event
  $("#open_id").on("change", function () {
    var open_id = $(this).val();
    console.log("open id: " + open_id);
    $("#building_id").html('<option value="">...</option>');
    $("#hall_id").html('<option value="">...</option>');

    $.get(
      "booking_dropdown.php",
      { action: "select_open_id", open_id: open_id },
      function (data) {
        var result = JSON.parse(data);
        $.each(result, function (index, item) {
          $("#building_id").append(
            $("<option></option>")
              .val(item.building_id)
              .html(item.building_name)
          );
        });
      }
    );
  });

  // on change building
  $("#building_id").on("change", function () {
    var open_id = $("#open_id").val();
    var building_id = $(this).val();
    $("#hall_id").html('<option value="">...</option>');

    $.get(
      "booking_dropdown.php",
      {
        action: "select_building_id",
        open_id: open_id,
        building_id: building_id,
      },
      function (data) {
        var result = JSON.parse(data);
        $.each(result, function (index, item) {
          $("#hall_id").append(
            $("<option></option>").val(item.hall_id).html(item.hall_name)
          );
        });
      }
    );
  });

  // Hall: on change
  $("#car_type_id").on("change", function () {
    let car_type_id = $(this).val();
    console.log("car_type_id = " + car_type_id);
    $.get("get_car_type.php?car_type_id=" + car_type_id, function (data) {
      let result = JSON.parse(data);
      $("#take_time_minutes").val(result[0].take_time_minutes);
    });
  });
});
