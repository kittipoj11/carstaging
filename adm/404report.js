// Example of a template literal
// let name = "Nathapat";
// let role = "Admin";
// `Hello! My name is ${name} and I'm a ${role}`

$(document).ready(function () {
  $(document).on("click", "#btnDisplay", function (e) {
    e.preventDefault();
    $.post(
      "404report_html.php", // ที่ๆจะให้ส่งข้อมูลไป
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
    var open_id = $("#open_id").val();
    var date_start = $("#date_start").val();
    var date_end = $("#date_end").val();
    // window.location.href = `402report_report.php?open_id=${open_id}, \'_blank\'`;
    window.open(
      `404report_pdf.php?open_id=${open_id}&date_start=${date_start}&date_end=${date_end}`,
      "_blank"
    );
  });

  $(function () {
    // on change event
    $("#open_id").on("change", function () {
      $("#report_data").html("");
    });
  });
});
