   <?php
    require_once '../class/semester.class.php';

    $semester = new Semester;
    $rs = $semester->getAllRecord();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1 class="h3 mb-0 text-gray-800">รายงานผลการเรียน</h1>
                       <a href="201semester_add_main.php" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="เพิ่มรายการ" style="margin: 0px 5px 5px 5px;">
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
                               <h3 class="card-title">ชื่อเทอม</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center">ชั้นปี</th>
                                           <th class="text-center">เทอม</th>
                                           <th class="text-center">จำนวนหน่วยกิต</th>
                                           <th class="text-center">เกรดเฉลี่ย</th>
                                           <th class="text-center">จำนวนวิชา</th>
                                           <th class="text-center" style="width: 120px;"></th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rs as $row) {
                                            $html = <<<EOD
                                        <tr iid={$row['id']}>
                                            <td class = 'tdMain'>{$row['grade_level']}</td>
                                            <td class = 'tdMain'>{$row['term']}</td>
                                            <td class = 'tdMain'>{$row['number_of_credits']}</td>
                                            <td class = 'tdMain'>{$row['gpa']}</td>
                                            <td class = 'tdMain'>{$row['number_of_subjects']}</td>
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