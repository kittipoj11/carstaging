   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once  '../class/subject.class.php';
    // // include APP_PATH . '/connect.php';
    $subject = new Subject;
    $rs = $subject->getAllRecord();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>วิชาเรียน</h1>
                       <a class="btn btn-success btn-sm" data-toggle="modal" data-placement="right" title="เพิ่มข้อมูล" data-target="#insertModal" style="margin: 0px 5px 5px 5px;">
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
                               <h3 class="card-title">subject_name</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body" id="card-body">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center" style="width: 100px;">subject_code</th>
                                           <th class="text-center">subject_name</th>
                                           <th class="text-center">category_code</th>
                                           <th class="text-center">credit</th>
                                           <th class="text-center" style="width: 120px;">Action</th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rs as $row) {
                                            $html = <<<EOD
                                        <tr>
                                            <td>{$row['subject_code']}</td>
                                            <td>{$row['subject_name']}</td>
                                            <td>{$row['category_code']}</td>
                                            <td>{$row['credit']}</td>
                                            <td align='center'>
                                                <div class='btn-group-sm'>
                                                    <a class='btn btn-warning btn-sm btnEdit' data-toggle='modal' data-toggle='tooltip' data-placement='right' title='Edit' data-target='#editModal' iid='{$row['subject_code']}' style='margin: 0px 5px 5px 5px'>
                                                        <i class='fa-regular fa-pen-to-square'></i>
                                                    </a>
                                                    <a class='btn btn-danger btn-sm btnDelete' data-toggle='modal' data-toggle='tooltip' data-placement='right' title='Delete' data-target='#deleteModal' iid='{$row['subject_code']}' style='margin: 0px 5px 5px 5px'>
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
                           <label for="subject_code" class="col-sm-6 col-form-label">ซัมเมอร์โน๊ต</label>
                           <textarea id="summernote">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                       </div> -->

                       <div class="row m-3">
                           <label for="subject_code" class="col-sm-4 col-form-label">subject_code</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm fst-italic" name="subject_code">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="subject_name" class="col-sm-4 col-form-label">subject_name</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="subject_name">
                           </div>
                       </div>
                       
                       <div class="row m-3">
                           <label for="category_code" class="col-sm-4 col-form-label">category_code</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="category_code">
                           </div>
                       </div>
                       <div class="row m-3">
                           <label for="credit" class="col-sm-4 col-form-label">credit</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="credit">
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
                           <label for="subject_code" class="col-sm-4 col-form-label">subject_code</label>
                           <div class="col-sm-8">
                               <!-- <input type="hidden" class="subject_code" name="subject_code"> -->
                               <input type="input" class="form-control form-control-sm fst-italic subject_code" id="subject_code" readonly name="subject_code">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="subject_name" class="col-sm-4 col-form-label">subject_name</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="subject_name" id="subject_name">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="category_code" class="col-sm-4 col-form-label">category_code</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="category_code" id="category_code">
                           </div>
                       </div>
                       
                       <div class="row m-3">
                           <label for="credit" class="col-sm-4 col-form-label">credit</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="credit" id="credit">
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