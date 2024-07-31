   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once  '../class/customer.class.php';
    // // include APP_PATH . '/connect.php';
    $customer = new Customer;
    $rs = $customer->getAllRecord();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>ลูกค้า</h1>
                       <a class="btn btn-success btn-sm btnNew" data-toggle="modal" data-placement="right" title="เพิ่มข้อมูล" data-target="#insertModal" style="margin: 0px 5px 5px 5px;">
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
                               <h3 class="card-title">ชื่ออาคาร</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center" style="width: 50px;">Username</th>
                                           <th class="text-center">ชื่อลูกค้า</th>
                                           <th class="text-center">ที่อยู่</th>
                                           <th class="text-center">โทรศัพท์</th>
                                           <th class="text-center">อีเมล์</th>
                                           <th class="text-center">วันที่ลงทะเบียน</th>
                                           <th class="text-center">อนุมัติ</th>
                                           <th class="text-center" style="width: 120px;"></th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rs as $row) {
                                            $check = (isset($row['approved_by']) && strlen(trim($row['approved_by'])) > 0) ? 'checked' : '';
                                            $html = <<<EOD
                                        <tr>
                                            <td>{$row['username']}</td>
                                            <td>{$row['firstname']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['register_datetime']}</td>
                                            <td align='center'>
                                                <input class='form-check-input' type='checkbox' $check onclick='return false;''></td>
                                            <td align='center'>
                                                <div class='btn-group-sm'>
                                                    <a class='btn btn-warning btn-sm btnEdit' data-toggle='modal'
                                                        data-toggle='tooltip' data-placement='right' title='Edit'
                                                        data-target='#editModal' iid='{$row['username']}'
                                                        style='margin: 0px 5px 5px 5px;'>
                                                        <i class='fa-regular fa-pen-to-square'></i>
                                                    </a>
                                                <a class='btn btn-danger btn-sm btnDelete' data-toggle='modal'
                                                    data-toggle='tooltip' data-placement='right' title='Delete'
                                                    data-target='#deleteModal' iid='{$row['username']}'
                                                    style='margin: 0px 5px 5px 5px;'>
                                                    <i class='fa-regular fa-trash-can'></i>
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

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Insert data Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- <div class="container-fluid table-responsive-sm p-0"> -->
   <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title fs-5">เพิ่มข้อมูลใหม่</h1>
                   <a class="btn-close" data-dismiss="modal" aria-label="Close">
                       <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                       <i class="fa-solid fa-xmark"></i>
                   </a>
               </div>

               <form name="frmInsert" id="frmInsert" action="" method="">
                   <div class="modal-body">

                       <!-- <div class="row m-3">
                           <label for="building_id" class="col-sm-6 col-form-label">ซัมเมอร์โน๊ต</label>
                           <textarea id="summernote">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                       </div> -->

                       <div class="row m-3">
                           <label for="username" class="col-sm-4 col-form-label">Username</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm fst-italic" name="username">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="firstname" class="col-sm-4 col-form-label">ชื่อลูกค้า</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="firstname">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="lastname" class="col-sm-4 col-form-label">นามสกุล</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="lastname">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="address" class="col-sm-4 col-form-label">ที่อยู่</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="address">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="phone" class="col-sm-4 col-form-label">โทรศัพท์</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="phone">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="email" class="col-sm-4 col-form-label">อีเมล์</label>
                           <div class="col-sm-8">
                               <input type="email" class="form-control form-control-sm" name="email">
                           </div>
                       </div>
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       <button type="button" name="btnInsertData" id="btnInsertData" class="btn btn-primary" data-dismiss="modal">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Edit data Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- <div class="container-fluid table-responsive-sm p-0"> -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title fs-5" id="modal">แก้ไขข้อมูล</h1>
                   <a class="btn-close" data-dismiss="modal" aria-label="Close">
                       <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                       <i class="fa-solid fa-xmark"></i>
                   </a>
               </div>

               <form name="frmEdit" id="frmEdit" action="" method="">
                   <!-- <input type="text" name="action" id="action"> -->
                   <div class="modal-body">
                       <div class="row m-3">
                           <label for="username" class="col-sm-4 col-form-label">Username</label>
                           <div class="col-sm-8">
                               <!-- <input type="hidden" class="username" name="username"> -->
                               <input type="input" class="form-control form-control-sm fst-italic username" id="username" readonly name="username">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="firstname" class="col-sm-4 col-form-label">ชื่อลูกค้า</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="firstname" id="firstname">
                           </div>
                       </div>
                       <div class="row m-3">
                           <label for="lastname" class="col-sm-4 col-form-label">นามสกุล</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="lastname" id="lastname">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="address" class="col-sm-4 col-form-label">ที่อยู่</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="address" id="address">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="phone" class="col-sm-4 col-form-label">โทรศัพท์</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="phone" id="phone">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="email" class="col-sm-4 col-form-label">อีเมล์</label>
                           <div class="col-sm-8">
                               <input type="email" class="form-control form-control-sm" name="email" id="email">
                           </div>
                       </div>
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       <button type="button" name="btnUpdateData" id="btnUpdateData" class="btn btn-primary" data-dismiss="modal">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>