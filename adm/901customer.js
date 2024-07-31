$(document).ready(function () {
  // $('#myForm').submit(function (e) {
  $(document).on("click", "#btnInsertData", function (e) {
    e.preventDefault();

    let data_sent = $("#frmInsert").serialize() + "&action=insertdata";
    // data_sent.push({
    //     name: "action",
    //     value: "insertdata"
    // });
    $.ajax({
      url: "901customer_crud.php",
      type: "POST",
      // data: $(this).serialize(),
      data: data_sent,
      success: function (response) {
        // var jsonData = JSON.parse(response); //ส่งกลับมาเป็น html ว่าสำเร็จหรือไม่
        Swal.fire({
          icon: "success",
          title: "Data added successfully",
          color: "#716add",
          background: "#fff url(/images/trees.png)",
          backdrop: `
                                rgba(0,0,123,0.4)
                                url("_images/paw.gif")
                                left bottom
                                no-repeat
                                `,
          // showConfirmButton: false,
          // timer: 1500
        });

        // // $("#modalInsert").modal('hide');
        // $("#frmInsert")[0].reset();
        // $("#tbody").empty();
        // $("#tbody").html(response);

        window.location.reload();
      },
    });
  });

  $(document).on("click", ".btnEdit", function (e) {
    e.preventDefault();
    let id = $(this).attr("iid");
    console.log(id);
    $.ajax({
      url: "901customer_crud.php",
      type: "POST",
      data: { edit_id: id },
      success: function (response) {
        console.log(response);
        data = JSON.parse(response);
        console.log(data);
        $(".username").val(data[0].username);
        $("#firstname").val(data[0].firstname);
        $("#lastname").val(data[0].lastname);
        $("#address").val(data[0].address);
        $("#phone").val(data[0].phone);
        $("#email").val(data[0].email);
      },
    });
  });

  $(document).on("click", "#btnCall", function (e) {
    e.preventDefault();
    console.log("Click");
    $.ajax({
      url: "call.php",
      type: "POST",
      // data: $("#frmEdit").serialize(),
      // data: data_sent,
      success: function (response) {
        console.log(response);
      },
    });
  });

  $(document).on("click", "#btnUpdateData", function (e) {
    e.preventDefault();

    let data_sent = $("#frmEdit").serialize() + "&action=updatedata";
    // data_sent.push({
    //     name: "action",
    //     value: "updatedata"
    // });
    console.log(data_sent);
    $.ajax({
      url: "901customer_crud.php",
      type: "POST",
      // data: $(this).serialize(),
      data: data_sent,
      success: function (response) {
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Data updated successfully'
        //     // showConfirmButton: false,
        //     // timer: 1500
        // })

        Swal.fire({
          title: "Data updated successfully.",
          icon: "success",
          // width: 600,
          // padding: '3em',
          color: "#716add",
          background: "#fff url(/images/trees.png)",
          backdrop: `
                                rgba(0,0,123,0.4)
                                url("_images/paw.gif")
                                left bottom
                                no-repeat
                                `,
        });

        // // $("#modalInsert").modal('hide');
        // $("#frmEdit")[0].reset();
        // $("#tbody").empty();
        // $("#tbody").html(response);
        
        // window.location()
        window.location.reload();
      },
    });
  });

  $(document).on("click", "#btnApprove", function (e) {
    e.preventDefault();
    let id = $(this).attr("iid");
    let data_sent = $("#frmEdit").serialize() + "&action=approved_by";
    // data_sent.push({
    //     name: "action",
    //     value: "updatedata"
    // });

    $.ajax({
      url: "901customer_crud.php",
      type: "POST",
      // data: $(this).serialize(),
      data: data_sent,
      success: function (response) {
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Data updated successfully'
        //     // showConfirmButton: false,
        //     // timer: 1500
        // })

        Swal.fire({
          title: "Data updated successfully.",
          icon: "success",
          // width: 600,
          // padding: '3em',
          color: "#716add",
          background: "#fff url(/images/trees.png)",
          backdrop: `
                                rgba(0,0,123,0.4)
                                url("_images/paw.gif")
                                left bottom
                                no-repeat
                                `,
        });

        // // $("#modalInsert").modal('hide');
        // $("#frmEdit")[0].reset();
        // $("#tbody").empty();
        // $("#tbody").html(response);
        // window.location()
        window.location.reload();
      },
    });
  });

  $(document).on("click", ".btnDelete", function (e) {
    e.preventDefault();
    let id = $(this).attr("iid");
    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete this item!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
      // width: 600,
      // padding: '3em',
      color: "#716add",
      background: "#fff url(/images/trees.png)",
      backdrop: `
                                rgba(0,0,123,0.4)
                                url("_images/Pyh.gif")
                                left top
                                no-repeat
                                `,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "901customer_crud.php",
          type: "POST",
          data: { delete_id: id },
          success: function (response) {
            // Swal.fire({
            //     title: 'Deleted!',
            //     text: 'Your data has been deleted.',
            //     icon: 'success'
            //     // showConfirmButton: false,
            //     // timer: 1500
            // })
            Swal.fire({
              title: "Deleted!",
              text: "Your data has been deleted.",
              icon: "success",
              // width: 600,
              // padding: '3em',
              color: "#716add",
              background: "#fff url(/images/trees.png)",
              backdrop: `
                                rgba(0,0,123,0.4)
                                url("_images/Pyh.gif")
                                left top
                                no-repeat
                                `,
            });

            // // $("#modalInsert").modal('hide');
            // $("#frmEdit")[0].reset();
            // $("#tbody").empty();
            // $("#tbody").html(response);

            // // $("#modalInsert").modal('hide');
            // $("#tbody").empty();
            // $("#tbody").html(response);
            window.location.reload();
          },
        });
      }
    });
  });
});
