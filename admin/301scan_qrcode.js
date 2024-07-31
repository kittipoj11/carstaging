var video = document.createElement("video");
var canvasElement = document.getElementById("canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");
var outputContainer = document.getElementById("output");
var outputMessage = document.getElementById("outputMessage");
var outputData = document.getElementById("outputData");
var outputResult = document.getElementById("outputResult");
var beepsound = document.getElementById("beepsound");
var outputQrcode = document.getElementById("outputqrcode");
var TLR, TRR, BRL, BLL;
var code;
var waiting;

function drawLine(begin, end, color) {
  canvas.beginPath();
  canvas.moveTo(begin.x, begin.y);
  canvas.lineTo(end.x, end.y);
  canvas.lineWidth = 4;
  canvas.strokeStyle = color;
  canvas.stroke();
  return true;
}

// Use facingMode: environment to attemt to get the front camera on phones
navigator.mediaDevices
  .getUserMedia({
    video: {
      facingMode: "environment",
    },
  })
  .then(function (stream) {
    video.srcObject = stream;
    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
    video.play();
    requestAnimationFrame(tick);
  });

function tick() {
  loadingMessage.innerText = "⌛ Loading video...";
  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    loadingMessage.hidden = true;
    canvasElement.hidden = false;
    outputContainer.hidden = false;

    canvasElement.height = video.videoHeight;
    canvasElement.width = video.videoWidth;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    if (!video.paused) {
      var imageData = canvas.getImageData(
        0,
        0,
        canvasElement.width,
        canvasElement.height
      );
      code = jsQR(imageData.data, imageData.width, imageData.height, {
        inversionAttempts: "dontInvert",
      });
    }

    if (code) {
      TLR = drawLine(
        code.location.topLeftCorner,
        code.location.topRightCorner,
        "#FF3B58"
      );
      TRR = drawLine(
        code.location.topRightCorner,
        code.location.bottomRightCorner,
        "#FF3B58"
      );
      BRL = drawLine(
        code.location.bottomRightCorner,
        code.location.bottomLeftCorner,
        "#FF3B58"
      );
      BLL = drawLine(
        code.location.bottomLeftCorner,
        code.location.topLeftCorner,
        "#FF3B58"
      );
      outputMessage.hidden = true;
      outputData.parentElement.hidden = false;
      outputData.innerText = code.data;
      if (
        code.data != "" &&
        !waiting &&
        TLR == true &&
        TRR == true &&
        BRL == true &&
        BLL == true
      ) {
        // ส่งค่า code.data ไปทำงานอย่างอื่นๆ ผ่าน ajax ได้
        video.pause();
        beepsound.play();
        beepsound.onended = function () {
          beepsound.muted = true;
        };
        // ให้เริ่มเล่นวิดีโอก่อนล็กน้อย เพื่อล้างค่ารูป qrcod ล่าสุด เป็นการใช้รูปจากกล้องแทน
        setTimeout(function () {
          video.play();
        }, 4500);
        // ส่งค่า code.data ไปทำงานอย่างอื่นๆ ผ่าน ajax ได้
        const data = [];
        data[0] = JSON.parse(code.data);
        // data[1] = <?php echo $status ?>;
        let status = $("#txtStatus").val();
        data[1] = status;

        // console.log('data[0] -->' + data[0]);
        // console.log('data[1] -->' + data[1]);
        // console.log(data[0]);
        $.ajax({
          // เรียกใช้ไฟล์ที่จะส่งข้อมูลไป Update
          url: "301scan_qrcode_crud.php",

          //แปลง code.data (JSON) ให้เป็น Object (JavaScript) และเพื่อส่งไป
          //ซึ่งจะอยู่ในรูปแบบนี้ตอนส่งไป
          // data: {car_license_number: "4 กส",event_name: "John Wick#4",building_id: "CH"},
          // data: JSON.parse(code.data), //OK
          type: "POST",
          data: {
            data1: data,
          },

          success: function (response) {
            //ถ้าดึงข้อมูลมาเสร็จเรียบร้อยแล้วข้อมูลจะถูกส่งกลับมาไว้ที่ response
            // $('#error_msg').html(response); //-->คำสั่งนี้ให้ทำงานในรูปแบบ html จาก response ที่ส่งกลับมา  และไปแสดงที่ element id= #error_msg

            $(".outputResult").html(response);
            $("#modalQrdetail").modal("show");
            // outputResult.innerText = data;

            if (status != 5) {
              setTimeout(function () {
                window.location.reload(1);
              }, 5000);
            }

            //PHP
            // header("Refresh:0");
            // header("Refresh:0; url=live.php");
          },
          //หรืออาจจะสั่งให้แสดง Modal ขึ้นมา เช่น $('#myModal').modal('show'); //ถ้าใช้ Bootstrap Modal
        });

        // ให้รอ 5 วินาทีสำหรับการ สแกนในครั้งต่อไป
        // waiting = setTimeout(function() {
        //     TLR,
        //     TRR,
        //     BRL,
        //     BLL = null;
        //     beepsound.muted = false;
        //     if (waiting) {
        //         clearTimeout(waiting);
        //         waiting = null;
        //     }
        // }, 5000);
      }
    } else {
      outputMessage.hidden = false;
      outputData.parentElement.hidden = true;
    }
  }
  requestAnimationFrame(tick);
}
