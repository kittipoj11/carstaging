// Example of a template literal
// let name = "Nathapat";
// let role = "Admin";
// `Hello! My name is ${name} and I'm a ${role}`

$(document).ready(function () {
  $(document).on("click", "#btnDisplay", function (e) {
    e.preventDefault();
    $.post(
      "402report_html.php", // ที่ๆจะให้ส่งข้อมูลไป
      //วิธีการส่งข้อมูล 2 แบบ
      //1. ทำการส่งเป็นรูปแบบ serialize(),
      //2. ทำการส่งแบบกำหนดค่าเอง action=select_open_id&open_id=40
      //     {
      //       action: "select_open_id",
      //       open_id: open_id,
      //     },
      $("#frmReport").serialize(),
      function (data) {
        $("#report_data").html(data); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก data ที่ส่งกลับมา  และไปแสดงที่ element
        $("#btnPrint").removeClass("d-none");
        // $("#btnPrint").addClass("d-none");
        //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
      }
    );
  });

  $(document).on("click", "#btnPrint", function (e) {
    e.preventDefault();
    var date_start = $("#date_start").val();
    var time_start = $("#time_start").val();
    var time_end = $("#time_end").val();

    // window.location.href = `402report_report.php?open_id=${open_id}, \'_blank\'`;

    //ตอนนี้ใช้แบบนี้
    window.open(
      `402report_pdf.php?date_start=${date_start}&time_start=${time_start}&time_end=${time_end}`,
      "_blank"
    );
  });

  $("#time_start").timepicker({
    minTime: $("#time_start_header").val(),
    maxTime: $("#time_end_header").val(),
    timeFormat: "H:i",
    show2400: true,
    step: 30,
    closeOnScroll: true,
    // orientation: 'c',
    listWidth: 1,
    disableTextInput: true,
  });
  $("#time_end").timepicker({
    minTime: $("#time_start_header").val(),
    maxTime: $("#time_end_header").val(),
    timeFormat: "H:i",
    show2400: true,
    step: 30,
    closeOnScroll: true,
    // orientation: 'c',
    listWidth: 1,
    disableTextInput: true,
  });

  $(function () {
    // on change event
    $("#open_id").on("change", function () {
      $("#report_data").html("");
      // var open_id = $(this).val();
      // console.log("open id: " + open_id);
      // $("#building_id").html('<option value="">...</option>');
      // $("#hall_id").html('<option value="">...</option>');
      // $.get(
      //   "booking_dropdown.php",
      //   {
      //     action: "select_open_id",
      //     open_id: open_id,
      //   },
      //   function (data) {
      //     var result = JSON.parse(data);
      //     $.each(result, function (index, item) {
      //       $("#building_id").append(
      //         $("<option></option>")
      //           .val(item.building_id)
      //           .html(item.building_name)
      //       );
      //     });
      //   }
      // );
    });
    // on change building
    // $("#building_id").on("change", function () {
    //   var open_id = $("#open_id").val();
    //   var building_id = $(this).val();
    //   $("#hall_id").html('<option value="">...</option>');
    //   $.get(
    //     "booking_dropdown.php",
    //     {
    //       action: "select_building_id",
    //       open_id: open_id,
    //       building_id: building_id,
    //     },
    //     function (data) {
    //       var result = JSON.parse(data);
    //       $.each(result, function (index, item) {
    //         $("#hall_id").append(
    //           $("<option></option>").val(item.hall_id).html(item.hall_name)
    //         );
    //       });
    //     }
    //   );
    // });
    // Hall: on change
    // $("#car_type_id").on("change", function() {
    //     let car_type_id = $(this).val();
    //     console.log("car_type_id = " + car_type_id);
    //     $.get("get_car_type.php?car_type_id=" + car_type_id, function(data) {
    //         let result = JSON.parse(data);
    //         $("#take_time_minutes").val(result[0].take_time_minutes);
    //     });
    // });
  });
});
