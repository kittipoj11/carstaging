   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once '../class/hall.class.php';
    require_once '../class/building.class.php';
    require_once '../class/car_type.class.php';
    require_once '../class/open_area.class.php';

    try {
        // if (isset($_REQUEST['id']) && $_REQUEST['page'] == 'table') {
        // }

        $id = $_REQUEST['id'];

        $car_type = new Car_type;
        $rsCarType =    $car_type->getAllRecord();

        $hall = new Hall;
        $rsHall =    $hall->getAllRecord();

        $building = new Building;
        $rsBuilding =    $building->getAllRecord();

        $open_area = new OpenArea;
        $rsHeader = $open_area->getRSOpenAreaScheduleHeaderById($id);
        $rsDetail = $open_area->getRSOpenAreaScheduleDetailById($id);
        // print_r($rsHeader);
        // exit();
    } catch (PDOException $e) {
        print_r($e);
        exit();
    }
    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1 class="h3 mb-0 text-gray-800">เปิดพื้นที่ Setup: <?= $rsHeader[0]['open_id'] ?></h1>
                       <!-- <a href="201open_area_schedule_add_main.php" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="เพิ่มรายการ" style="margin: 0px 5px 5px 5px;">
                           <i class="fa-solid fa-plus"></i>
                       </a> -->
                   </div>
               </div>
           </div><!-- /.container-fluid -->
       </section>

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">

                       <div class="card">
                           <!-- <div class="card-header">
                               <h3 class="card-title">ชื่อพื้นที่</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body">
                               <form name="myForm" id="myForm">
                                   <div class="row">
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">อาคาร(Building)</span>
                                               <div class="col">
                                                   <input type="text" name='building_name' id='building_name' class="form-control" value=<?= $rsHeader[0]['building_name'] ?> disabled>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">พื้นที่(Hall)</span>
                                               <div class="col">
                                                   <input type="text" name='hall_name' id='hall_name' class="form-control" value=<?= $rsHeader[0]['hall_name'] ?> disabled>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">จำนวนช่องจอดรวม(Total Slots)</span>
                                               <div class="col">
                                                   <input type="number" name='total_slots' id='total_slots' class="form-control" value=<?= $rsHeader[0]['total_slots'] ?> disabled>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-12 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">ชื่องาน(Event)</span>
                                               <div class="col">
                                                   <input type="text" name='event_name' id='event_name' class="form-control" value=<?= $rsHeader[0]['event_name'] ?> disabled>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="card border border-1 border-dark mt-3" id="div_open_area_schedule">
                                       <!-- <div class="card-header" style="display: flex;"> -->
                                       <div class="card-header p-2">
                                           <h6>ช่วงเวลาเปิดพื้นที่</h6>
                                       </div>

                                       <div class="card-body">
                                           <!-- สร้าง Table ตามปกติ -->
                                           <table id="example1" class="table table-bordered table-striped table-sm">
                                               <thead>
                                                   <tr>
                                                       <th class="text-center">วันที่เปิด</th>
                                                       <th class="text-center">วันที่ปิด</th>
                                                       <th class="text-center">เวลาเปิด</th>
                                                       <th class="text-center">เวลาปิด</th>
                                                       <th class="text-center">จำนวน Slots ที่เปิด</th>
                                                       <th class="text-center">ประเภทรถ</th>
                                                   </tr>
                                               </thead>
                                               <tbody id="tbody">
                                                   <?php
                                                    foreach ($rsDetail as $row) {
                                                        echo "<tr class='firstTr'>";
                                                        echo "<td class='p-1'>{$row['open_date_start']}</td>";
                                                        echo "<td class='p-1'>{$row['open_date_end']}</td> ";
                                                        echo "<td class='p-1'>{$row['open_time_start']}</td>";
                                                        echo "<td class='p-1'>{$row['open_time_end']}</td> ";
                                                        echo "<td class='p-1'>{$row['reservable_slots']}</td>";
                                                        echo "<td>";
                                                        foreach ($rsCarType as $row2) {
                                                            $key = json_decode($row['car_type_json']);
                                                            $check = (in_array($row2['car_type_id'], $key)) ? 'checked' : '';
                                                            // echo "{$row['car_type_json']}";
                                                            echo "<div class='form-check form-check-inline'>";
                                                            echo "<input type='checkbox' name='chkCarType0[]' class='form-check-input checkbox' value='{$row2['car_type_id']}' {$check} onclick='return false;'>";
                                                            echo "<label class='form-check-label' for='chkCarType{$row2['car_type_id']}'>{$row2['car_type_name']}</label>";
                                                            echo "</div>";
                                                        }
                                                        echo "</td>";

                                                        echo "</tr>";
                                                    } ?>
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>

                                   <div class="modal-footer">
                                       <a type="button" href="201open_area_schedule.php?page=table" name="btnCancel" id="btnCancel" class="btn btn-secondary">ปิด</a>
                                   </div>

                               </form>
                           </div>
                           <!-- /.card-body -->
                       </div>
                       <!-- /.card -->
                   </div>
                   <!-- /.col -->
               </div>
               <!-- /.row -->
           </div>
           <!-- /.container-fluid -->
       </section>
       <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ส่วน Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Logout Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- logout.php -->