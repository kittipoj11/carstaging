// window.location.href = "main.php?page=open_area_schedule";

$(document).ready(function () {
  // $('#myForm').submit(function (e) {
  $(document).on("click", "#btnSave", function (e) {
    e.preventDefault();
    let dateStart = document.getElementsByClassName("date_start");
    let dateEnd = document.getElementsByClassName("date_end");
    let timeStart = document.getElementsByClassName("time_start");
    let timeEnd = document.getElementsByClassName("time_end");
    let can_save = true;
    // console.log("dateStart = " + dateStart);
    // console.log("dateStart.length = " + dateStart.length);

    // ส่วนนี้ใช้ในการเปรียบเทียบรายการในตารางรายการที่ i เทียบกับรายการที่ i+1,i+2,i+3,... ว่ามีวันที่คาบเกี่ยวกันหรือไม่
    for (let i = 0; i < dateStart.length; i++) {
      // console.log("i = " + i);
      for (let j = i + 1; j < dateStart.length; j++) {
        // console.log("j = " + j);
        // console.log(dateStart[i].value + " " + dateEnd[i].value);
        // console.log(timeStart[i].value + " " + timeEnd[i].value);
        // console.log(dateStart[j].value + " " + dateEnd[j].value);
        // console.log(timeStart[j].value + " " + timeEnd[j].value);
        //ตรวจสอบเงื่อนไขของขอบบนหรือขอบล่างของช่วงของวันที่ 2 เทียบกับช่วงของวันที่ 1
        let dateStart1 = new Date(dateStart[i].value);
        let dateStart2 = new Date(dateStart[j].value);
        let dateEnd1 = new Date(dateEnd[i].value);
        let dateEnd2 = new Date(dateEnd[j].value);
        let timeStart1 = new Date(timeStart[i].value);
        let timeStart2 = new Date(timeStart[j].value);
        let timeEnd1 = new Date(timeEnd[i].value);
        let timeEnd2 = new Date(timeEnd[j].value);

        // if (dateStart2.getTime() > dateEnd1.getTime() || dateEnd2.getTime() < dateStart1.getTime()) {
        if (
          dateStart[j].value > dateEnd[i].value ||
          dateEnd[j].value < dateStart[i].value
        ) {
          console.log(
            "Yes: ช่วงของวันที่2 อยู่นอกช่วงของวันที่1 = กำหนดเวลาได้ทุกเวลา"
          );
        } else {
          console.log(
            "No:  ขอบบนหรือขอบล่างของช่วงของวันที่2 ขอบใดขอบหนึ่งอยู่ในช่วงของวันที่1"
          );

          //ในกรณีที่ช่วงวันที่คาบเกี่ยวกัน
          //จะต้องตรวจสอบเงื่อนไขของขอบบนหรือขอบล่างของช่วงของเวลา2 เทียบกับช่วงของเวลา1
          if (
            timeStart[j].value > timeEnd[i].value ||
            timeEnd[j].value < timeStart[i].value
          ) {
            console.log("Yes: ช่วงของเวลา2 อยู่นอกช่วงของเวลา1 = กำหนดเวลาได้");
          } else {
            console.log("No: กำหนดค่าไม่ได้");
            alert("ไม่สามารถบันทึกข้อมูลได้ เนื่องจากมีช่วงเวลาคาบเกี่ยวกัน");
            can_save = false;
            exit();
          }
        }
      }
    }

    if (can_save == true) {
      let data_sent = $("#myForm").serializeArray();
      data_sent.push({
        name: "action",
        value: "insertdata",
      });
      // console.log(data_sent);
      $.ajax({
        type: "POST",
        url: "201open_area_schedule_crud.php",
        // data: $(this).serialize(),
        data: data_sent,
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: "Data saved successfully",
            color: "#716add",
            background: "black",
            // backdrop: `
            //                     rgba(0,0,123,0.4)
            //                     url("_images/paw.gif")
            //                     left bottom
            //                     no-repeat
            //                     `,
            // showConfirmButton: false,
            // timer: 15000
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "201open_area_schedule.php";
              // window.location.reload();
            }
          });
          // window.location.href = 'main.php?page=open_area_schedule';
        },
      });
    }
  });
});

$(document).ready(function () {
  $(document).on("click", ".btnDelete", function (e) {
    e.preventDefault();
    let id = $(this).parents("tr").attr("iid");
    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete this item!",
      icon: "warning",
      showCancelButton: true,
      cancelButtonColor: "gray",
      confirmButtonColor: "red",
      confirmButtonText: "Yes, delete it!",
      // width: 600,
      // padding: '3em',
      color: "#ff0000",
      background: "black",
      // backdrop: `
      //                           rgba(0,0,123,0.4)
      //                           url("_images/Pyh.gif")
      //                           left top
      //                           no-repeat
      //                           `,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "201open_area_schedule_crud.php", // ให้ส่งข้อมูลไปตาม url ที่กำหนด
          data: { action: "deletedata", delete_id: id }, //จะทำการส่งเป็นรูปแบบ java object ->{name: value}
          method: "POST", //เป็นวิธีการส่ง POST หรือ GET อาจะใช้เป็น type: 'post'
          success: function (response) {
            //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ response
            if (response == "success") {
              Swal.fire({
                title: "Deleted!",
                text: "Your data has been deleted.",
                icon: "success",
                // width: 600,
                // padding: '3em',
                color: "#716add",
                background: "black", //display dialog is black
                // confirmButtonColor: '#3085d6',
                confirmButtonText: "OK",
                // backdrop: `
                //                 rgba(0,0,123,0.4)
                //                 url("_images/Pyh.gif")
                //                 left top
                //                 no-repeat
                //                 `,
              }).then((result) => {
                if (result.isConfirmed) {
                  // window.location.href = "201open_area_schedule.php";
                  window.location.reload();
                }
              });
            } else {
              // alert(response);
              // alert('ไม่สามารถลบรายการนี้ได้');
              Swal.fire({
                title: "Oops...!",
                text: "Something went wrong!",
                icon: "error",
                // width: 600,
                // padding: '3em',
                color: "#716add",
                background: "black", //display dialog is black
                // backdrop: `
                //                 rgba(0,0,123,0.4)
                //                 url("_images/Pyh.gif")
                //                 left top
                //                 no-repeat
                //                 `,
              });
            }
          },
          //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
        });
      }
    });
  });
});

$(document).ready(function () {
  // Click ที่รายการใดๆ
  $(document).on("click", ".tdMain", function (e) {
    // $('.btnDelete').on('click', function() { // แบบเดิม -> ไม่สามารถใช้งานได้เมื่อสร้างปุ่มขึ้นมาที่หลัง
    // let edit_id = $(this).attr('id');//ค่า id ของปุ่มที่กำหนดไว้ซึ่งในที่นี้มาจาก <?php echo $datarow['id'] ?>
    e.preventDefault();
    // console.log('click');
    let id = $(this).parents("tr").attr("iid"); //ค่า id ของปุ่มที่กำหนดไว้ซึ่งในที่นี้มาจาก <?php echo $datarow['id'] ?>
    // $('.cell-main').load('open_area_schedule_view.php' + '?id=' + id, "_self");
    window.location.href = "201open_area_schedule.php?page=view&id=" + id;
    // window.open('main.php?page=open_area_schedule_view?id=' + id);
    // window.open('open_area_schedule_view.php' + '?id=' + edit_id, "_self");
  });
});


// document.getElementById("opt_event_id").addEventListener("change", complete_selection);
document
  .getElementById("building_id")
  .addEventListener("change", complete_selection);
document
  .getElementById("hall_id")
  .addEventListener("change", complete_selection);
document
  .getElementById("event_name")
  .addEventListener("keyup", complete_selection);

function complete_selection() {
  if (
    $("#event_name").val().trim().length === 0 ||
    $("#building_id option:selected").text() == "..." ||
    $("#hall_id option:selected").text() == "..."
  ) {
    $("#div_open_area_schedule").hide();
  } else {
    $("#div_open_area_schedule").show();
  }
}

$(document).ready(function () {
  let i = 0; //เพื่อไว้กำกับเลขที่ของแถว

  $("#btnAdd").click(function () {
    i++;
    $(".firstTr:eq(0)")
      .clone(false)
      .attr("id", "row" + i + "")
      // .addClass("OtherTr")
      // .removeClass("firstTr")
      .find(".id:eq(0)")
      .val(i)
      .end()

      .find(".checkbox")
      .attr("name", "chkCarType" + i + "[]")
      .end()

      // .find(".checkbox").attr("iid", "chkCarType" + i).end()
      .find("a:eq(0)")
      .css("display", "inline")
      .end()

      .find("a:eq(0)")
      .attr("iid", "" + i + "")
      .end()

      .appendTo($("#tableBody"));
    // .find("input:eq(0)").val("2023-05-12").end()
    // .find(".oaData:eq(1)").attr("value", '2023-05-15').end()
    // .find(".oaData:eq(2)").attr("value", '08:00').end()
    // .find(".oaData:eq(3)").attr("value", '18:00').end()
    // .find(".oaData:eq(4)").attr("value", 40).end()
    // alert(">>> 1 รายการ");
    $(".time_start").timepicker({
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
    $(".time_end").timepicker({
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
  });

  $("#btnClear").click(function () {
    // $("#tableBody tr:last").remove();
    $("#tableBody").find("tr:gt(0)").remove();
  });

  // $(".btnDeleteList").click(function() {
  $(document).on("click", ".btnDeleteList", function () {
    // ส่วนสำหรับการลบ
    let row_id = $(this).attr("iid");
    // console.log("#row" + row_id + "");
    $("#row" + row_id + "").remove(); // ลบรายการสุดท้าย
  });

  $(document).ready(function () {
    $("#btnCancel").click(function () {
      // history.go(-1);
      // $('.main').load('open_area_schedule_main.php'); แบบนี้ไม่ได้
      // header('Location: main.php?page=open_area_schedule_main');แบบนี้ไม่ได้
      window.location.href = "201open_area_schedule.php?page=table";
    });
  });
});

$(function () {
  // Event: on change
  // eventObject.on('change', function () {
  //     console.log('eventObject');
  //     let strEventId = $(this).val();
  //     $.get('get_event.php?event_id=' + strEventId, function (data) {
  //         let result = JSON.parse(data);
  //         startDateObject.val(result[0].date_start_booking);
  //         endDateObject.val(result[0].date_end_booking);

  //         $(".date_start").val(startDateObject.val());
  //         $(".date_start").attr("min", startDateObject.val());
  //         $(".date_start").attr("max", endDateObject.val());

  //         $(".date_end").val(endDateObject.val());
  //         $(".date_end").attr("min", startDateObject.val());
  //         $(".date_end").attr("max", endDateObject.val());
  //     });
  // });

  // Building: on change
  $("#building_id").on("change", function () {
    let building_id = $(this).val();
    // console.log(building_id);
    // console.log(`building_id = ${building_id}`);
    // hallObject.html('<option value="">-- เลือกพื้นที่ --</option>');
    $("#hall_id").html('<option value="">...</option>');
    $("#time_start_header").val("");
    $("#time_end_header").val("");
    $("#total_slots").val("");
    // $('#reservable_slots').val("");

    $.get("get_hall.php", { building_id: building_id }, function (data) {
      let result = JSON.parse(data);
      $.each(result, function (index, item) {
        $("#hall_id").append(
          $("<option></option>").val(item.hall_id).html(item.hall_name)
        );
      });
    });
  });

  // Hall: on change
  $("#hall_id").on("change", function () {
    let building_id = $("#building_id").val();
    let hall_id = $(this).val();
    var d = new Date();
    var day = d.getDate();

    $.get(
      "get_hall_time.php",
      { building_id: building_id, hall_id: hall_id },
      function (data) {
        let result = JSON.parse(data);
        // console.log(data);
        // console.log(result[4]);
        // $(".date_start_header").text(Date.now());
        // // $(".date_start").attr("min", startDateObject.val());
        // // $(".date_start").attr("max", endDateObject.val());

        // $(".date_end_header").text(Date.now());
        // // $(".date_end").attr("min", startDateObject.val());
        // // $(".date_end").attr("max", endDateObject.val());
        $("#total_slots").val(result[4]);
        $("#time_start_header").val(result[5]);
        $("#time_end_header").val(result[6]);
        // $('#reservable_slots').val(result[0].reservable_slots);

        $(".time_start").timepicker({
          // minTime: $("#time_start_header").val(),
          // maxTime: $("#time_end_header").val(),
          minTime: "00:00",
          maxTime: "23:30",
          timeFormat: "H:i",
          show2400: true,
          step: 30,
          closeOnScroll: true,
          scrollDefault: $("#time_start_header").val(),
          // orientation: 'c',
          listWidth: 1,
          disableTextInput: true,
        });
        $(".time_end").timepicker({
          // minTime: $("#time_start_header").val(),
          // maxTime: $("#time_end_header").val(),
          minTime: "00:00",
          maxTime: "23:30",
          timeFormat: "H:i",
          show2400: true,
          step: 30,
          closeOnScroll: true,
          scrollDefault: $("#time_end_header").val(),
          // orientation: 'c',
          listWidth: 1,
          disableTextInput: true,
        });

        // $(".time_start").attr("min", $('#time_start_header').val());
        // $(".time_start").attr("max", $('#time_end_header').val());
        $(".time_start").val($("#time_start_header").val());

        // $(".time_end").attr("min", $('#time_start_header').val());
        // $(".time_end").attr("max", $('#time_end_header').val());
        $(".time_end").val($("#time_end_header").val());

        $(".reservable_slots").attr("min", 0);
        $(".reservable_slots").attr("max", $("#total_slots").val());
        $(".reservable_slots").val($("#total_slots").val());
      }
    );
  });
});
