const txtDate = document.querySelector("#txtDate");

function showSuccess(input) {
  const formControl = input.parentElement.parentElement;
  formControl.className = "col-sm-12 mb-2 form_control success";
}

function showError(input, message) {
  const formControl = input.parentElement.parentElement;
  formControl.className = "col-sm-12 mb-2 form_control error";
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

// เมื่อ Click ตรงวันที่(booking_date) จะแสดงรายการ Badge ตามวันที่นั้นๆทางด้านกล่องขวา(กล่อง div_list)
$(document.body).on("click", ".booking-date", function () {
  // $('.booking-date').on('click', function() {
  $(".booking-date").removeClass("pojselected");
  $(this).addClass("pojselected");

  //สร้างตัวแปรจาก element id = txtDate ใน HTML
  let booking_date = $(this).attr("iid");
  //   console.log(booking_date);
  //กำหนดค่าวันที่ที่เลือกไว้ที่ txtDate
  // txtDate.value = '2023-03-' + document.getElementById($(this).attr('id')).innerText;
  // txtDate.value = $(this).data('value');

  $.ajax({
    url: "510history_booking_list.php", // ที่ๆจะให้ส่งข้อมูลไป
    // data: $('#frmBooking_list').serialize(),
    data: { booking_date: booking_date },
    //จะทำการส่งเป็นรูปแบบ username=poj11&email=poj11@hotmail.com&password=1111
    method: "POST", //วิธีการส่งแบบ POST หรือ GET
    // วิธีการส่งแบบ javascript array เช่น data: { username: "poj11", email: "poj11@hotmail.com", password: "1111" },   //ส่งในรูปแบบ javascript object array
    success: function (response) {
      //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ response
      // console.log(response);
      // $('#error_msg').html(response); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก response ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

      $("#tbody").html(response);
      // $('#div_list').html(response);
    },
    //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
  });
});
