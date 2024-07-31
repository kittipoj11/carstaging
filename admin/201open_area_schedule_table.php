   <?php
    require_once '../class/car_type.class.php';
    require_once '../class/open_area.class.php';

    $open_area = new OpenArea;
    $rs = $open_area->getRSOpenAreaSchedule();

    //Car type
    $car_type = new Car_type;
    $rsCarType =    $car_type->getAllRecord();
    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1 class="h3 mb-0 text-gray-800">วัน/เวลาเปิดพื้นที่ Setup</h1>
                       <a href="201open_area_schedule_add_main.php" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="เพิ่มรายการ" style="margin: 0px 5px 5px 5px;">
                           <i class="fa-solid fa-plus"></i>
                       </a>
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
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center">Open ID</th>
                                           <th class="text-center">พื้นที่</th>
                                           <th class="text-center">อาคาร</th>
                                           <th class="text-center">ชื่องาน</th>
                                           <th class="text-center">ช่วงวันที่เปิด-ปิด</th>
                                           <th class="text-center">Total Slots</th>
                                           <th class="text-center" style="width: 120px;"></th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rs as $row) {
                                            $open_date_start = new DateTime($row['open_date_start']);
                                            $open_date_end = new DateTime($row['open_date_end']);
                                            $html = <<<EOD
                                        <tr iid={$row['id']}>
                                            <td class = 'tdMainx'>{$row['open_id']}</td>
                                            <td class = 'tdMain'>{$row['hall_name']}</td>
                                            <td class = 'tdMain'>{$row['building_name']}</td>
                                            <td class = 'tdMain'>{$row['event_name']}</td>
                                            <td class = 'tdMain'>{$open_date_start->format("d/m/Y")} - {$open_date_end->format("d/m/Y")}</td>
                                            <td class = 'tdMain'>{$row['total_slots']}</td>
                                            <td class = 'tdMain' align='center'>
                                                <div class='btn-group-sm'>
                                                    <a href="201open_area_schedule.php?page=view&id={$row['id']}" class='btn btn-info btn-sm btnEdit' data-placement='right' title='Edit' iid='{$row['id']}' style='margin: 0px 5px 5px 5px'>
                                                        <i class="bi bi-info-circle"></i>
                                                    </a>
                                                    <a class='btn btn-danger btn-sm btnDelete' data-toggle='modal' data-placement='right' title='Delete' iid='{$row['id']}' style='margin: 0px 5px 5px 5px'>
                                                        <i class='fa-regular fa-trash-can'></i>
                                                        <!-- <i class="bi bi-trash"></i> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        EOD;
                                            echo $html;
                                        } ?>

                                   </tbody>

                               </table>
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