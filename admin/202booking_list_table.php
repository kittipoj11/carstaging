   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require  '../class/car_type.class.php';
    require  '../class/booking.class.php';
    $building = new Building;
    $rs = $building->getAllRecord();

    try {
        $car_type = new Car_type;
        $rsCarType = $car_type->getAllRecord();

        $booking = new Booking;
        $rsBookingGroup = $booking->getRSGroup();
    } catch (PDOException $e) {
        echo 'Data not found!';
    }

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>รายการจอง</h1>
                   </div>
               </div>
           </div><!-- /.container-fluid -->
       </section>

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">
               <!-- large view -->
               <div class="row d-none d-lg-flex">
                   <div class="col-12">

                       <div class="card">
                           <!-- <div class="card-header">
                               <h3 class="card-title">ชื่ออาคาร</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body" id="card-body">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center">วันที่</th>
                                           <th class="text-center">พื้นที่</th>
                                           <th class="text-center">อาคาร</th>

                                           <?php
                                            foreach ($rsCarType as $row) :
                                                echo "<th class='text-center'>{$row['car_type_name']}</th>";
                                            endforeach;
                                            ?>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rsBookingGroup as $row) {
                                            $booking_date = $row['booking_date'];
                                            $hall_id = $row['hall_id'];
                                            $building_id = $row['building_id'];

                                            echo "<tr>";
                                            echo "<td class='d-md-table-cell'>{$row['booking_date']}</td>";
                                            echo "<td class='d-md-table-cell'>{$row['hall_name']}</td>";
                                            echo "<td class='d-md-table-cell'>{$row['building_name']}</td>";

                                            foreach ($rsCarType as $sub_row) :
                                                $car_type_id = $sub_row['car_type_id'];

                                                $rsData = $booking->getRSCountCarByBookingDateAndHallByCar($booking_date, $building_id, $hall_id, $car_type_id);

                                                if (count($rsData) > 0) :
                                                    echo "<td class='d-md-table-cell'>{$rsData[0]['count_car']}</td>";
                                                else :
                                                    echo "<td class='d-md-table-cell'>0</td>";
                                                endif;
                                            endforeach;
                                            echo "</tr>";
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
               <!-- Small view -->
               <div class="row d-flex d-lg-none">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-body">
                               <!-- <div class="container-fluid table-responsive-sm p-0"> -->
                               <?php
                                foreach ($rsBookingGroup as $row) :
                                    $booking_date = $row['booking_date'];
                                    $hall_id = $row['hall_id'];
                                    $building_id = $row['building_id'];

                                    echo "<table id='example1' class='table table-bordered table-striped table-sm'>";

                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th class='text-center'>{$row['booking_date']}</th>";
                                    echo "<th class='text-center '>{$row['hall_name']} ({$row['building_name']})</th>";
                                    echo "</tr>";
                                    echo "</thead>";

                                    echo "<tbody id='tbody'>";
                                    $rsData = $booking->getRSCountCarByBookingDateAndHall($booking_date, $building_id, $hall_id);
                                    foreach ($rsData as $sub_row) :
                                        $car_type_name = $sub_row['car_type_name'];
                                        $count_car = $sub_row['count_car'];

                                        echo "<tr>";
                                        echo "<td class='d-md-table-cell'>{$car_type_name}</td>";
                                        echo "<td class='d-md-table-cell'>{$count_car}</td>";
                                        echo "</tr>";
                                    endforeach;
                                    echo "</tbody>";

                                    echo "</table>";
                                endforeach;
                                ?>
                               <!-- </div> -->
                           </div>
                       </div>
                   </div>

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