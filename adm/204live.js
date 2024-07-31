$(document).ready(function () {
  $(document.body).on("click", ".hall-name", function () {
    // $('.hall-name').on('click', function() {
    console.log("hall-name click");

    // ทำการ remove posselected ออกจาก hall-name ทุกตัว
    $(".hall-name").removeClass("pojselected");

    //ทำการ add pojselected ให้กับ hall-name นี้
    $(this).addClass("pojselected");
    let id = $(this).attr("iid");
    $.ajax({
      url: "204live_list.php", // ที่ๆจะให้ส่งข้อมูลไป

      data: { hall_id: id, status: 1 },
      method: "POST", //วิธีการส่ง POST หรือ GET
      // data: {username: "Mickey", email: "poj11@hotmail.com"},   //ส่งในรูปแบบ javascript object array
      success: function (data) {
        //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
        // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

        $(".div-title-waiting").html(data);
      },
      //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    });
    $.ajax({
      url: "204live_list.php", // ที่ๆจะให้ส่งข้อมูลไป

      data: { hall_id: id, status: 2 },
      method: "POST", //วิธีการส่ง POST หรือ GET
      // data: {username: "Mickey", email: "poj11@hotmail.com"},   //ส่งในรูปแบบ javascript object array
      success: function (data) {
        //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
        // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

        $(".div-title-calling").html(data);
      },
      //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    });
    // $.ajax({
    //   url: "204live_list.php", // ที่ๆจะให้ส่งข้อมูลไป

    //   data: { hall_id: id, status: 3 },
    //   method: "POST", //วิธีการส่ง POST หรือ GET
    //   // data: {username: "Mickey", email: "poj11@hotmail.com"},   //ส่งในรูปแบบ javascript object array
    //   success: function (data) {
    //     //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
    //     // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

    //     $(".div-title-calling").append(data);
    //   },
    //   //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    // });
    $.ajax({
      url: "204live_list.php", // ที่ๆจะให้ส่งข้อมูลไป

      data: { hall_id: id, status: 4 },
      method: "POST", //วิธีการส่ง POST หรือ GET
      // data: {username: "Mickey", email: "poj11@hotmail.com"},   //ส่งในรูปแบบ javascript object array
      success: function (data) {
        //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ data
        // $('#error_msg').html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

        $(".div-title-loading").html(data);
      },
      //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
    });
  });
});
// Call a function every 30000 milliseconds (OR 30 seconds).
// window.setInterval('refresh()', 30000);

// Refresh or reload page.
function refresh() {
  window.location.reload();
}

$(document).ready(function () {
  // Click ปุ่ม btn-call เพื่อ Update status 0-->1
  $(document.body).on("click", ".btn-call", function () {
    let btn = $(this);
    let edit_id = btn.closest("div").attr("id"); //closest อ้างถึง parent element ที่เป็น element <div> ที่ใกล้ที่สุด
    var jsonObj = { id: edit_id, status: 2 }; //1:Waiting->2:Calling

    $.ajax({
      type: "POST",
      url: "204live_crud.php",
      data: jsonObj,
      success: function (result) {
        if (result == "success") {
          $.ajax({
            url: "call.php",
            type: "POST",
            data: jsonObj,
            // data: data_sent,
            success: function (response) {
              console.log(response);
            },
          });

          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 1 }, //1:Waiting
            method: "POST",
            success: function (data) {
              $(".div-title-waiting").html(data);
            },
          });

          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 2 }, //2:Calling
            method: "POST",
            success: function (data) {
              $(".div-title-calling").html(data);
            },
          });
        } // Err
        else {
          // alert(result.status + ' ' + result.message);
          console.log("fail");
        }
      },
      error: function () {
        console.log("error");
      },
    });
  });

  // Click ปุ่ม btn-load เพื่อ Update status 2-->3
  $(document.body).on("click", ".btn-load", function () {
    let btn = $(this);
    let edit_id = btn.closest("div").attr("id"); //closest อ้างถึง parent element ที่เป็น element <div> ที่ใกล้ที่สุด
    var jsonObj = { id: edit_id, status: 4 }; //2,3 Calling,Accept->4:Loading

    $.ajax({
      type: "POST",
      url: "204live_crud.php",
      data: jsonObj,
      success: function (result) {
        if (result == "success") {
          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 2 }, //2:Calling
            method: "POST",
            success: function (data) {
              $(".div-title-calling").html(data);
            },
          });
          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 3 }, //3:Accept
            method: "POST",
            success: function (data) {
              $(".div-title-calling").append(data);
            },
          });
          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 4 }, //4:Loading
            method: "POST",
            success: function (data) {
              $(".div-title-loading").html(data);
            },
          });
        } // Err
        else {
          // alert(result.status + ' ' + result.message);
          console.log("fail");
        }
      },
      error: function () {
        console.log("error");
      },
    });
  });

  // Click ปุ่ม btn-complete เพื่อ Update status 3-->4
  $(document.body).on("click", ".btn-complete", function () {
    let edit_id = $(this).closest("div").attr("id"); //closest อ้างถึง parent element ที่เป็น element <div> ที่ใกล้ที่สุด
    var jsonObj = { id: edit_id, status: 5 }; //4:Loading->5:complete

    $.ajax({
      type: "POST",
      url: "204live_crud.php",
      data: jsonObj,
      success: function (result) {
        console.log("result = " + result);
        if (result == "success") {
          $.ajax({
            url: "204live_list.php",
            data: { hall_id: $("#hall-id").val(), status: 4 }, //4:Loading
            method: "POST",
            success: function (data) {
              $(".div-title-loading").html(data);
            },
          });
        } // Err
        else {
          // alert(result.status + ' ' + result.message);
          console.log("fail");
        }
      },
      error: function () {
        console.log("error");
      },
    });
  });
});

$(document).ready(function () {
  $("#pills-waiting-tab").click(function () {
    console.log("W");
    $("#pills-waiting").toggleClass("pills-waiting-hide");
  });
  $("#pills-calling-tab").click(function () {
    console.log("C");
    $("#pills-calling").toggleClass("pills-calling-hide");
  });
  $("#pills-loading-tab").click(function () {
    console.log("L");
    $("#pills-loading").toggleClass("pills-loading-hide");
  });
});
