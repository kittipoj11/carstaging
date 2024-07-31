<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../dist/img/mypic.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Car Staging</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- Nav Item - หน้าหลัก -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-landmark"></i>
                        <!-- <i class="nav-icon fi fi-rr-house-blank"></i> -->
                        <p>
                            หน้าหลัก
                        </p>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Today Activities -->
                <li class="nav-item">
                    <a href="001today.php" class="nav-link">
                        <!-- <i class="nav-icon fas fa-file"></i> -->
                        <i class="nav-icon fas fi-rr-chart-tree-map"></i>
                        <p>
                            Today Activities
                            <!-- <i class="nav-icon right fas fa-angle-left"></i> -->
                        </p>
                    </a>

                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - ข้อมูลพื้นฐาน -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            ข้อมูลพื้นฐาน
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                    <ul class="nav nav-treeview bg-primary text-white py-2 collapse-inner rounded">
                        <li class="nav-item">
                            <a href="101cartype.php" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-truck"></i>
                                <p>ประเภทรถ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="102building.php" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-city"></i>
                                <p>อาคาร</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="103hall.php" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-grip"></i>
                                <p>พื้นที่</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Nav Item - พื้นที่ Setup -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-truck-loading"></i>
                        <p>
                            พื้นที่ Setup
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                    <ul class="nav nav-treeview bg-primary text-white py-2 collapse-inner rounded">
                        <li class="nav-item">
                            <a href="201open_area_schedule.php?page=table" class="nav-link text-dark">
                                <i class="nav-icon fi fi-rr-calendar-clock"></i>
                                <p>วัน-เวลาเปิดพื้นที่</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="202booking_list.php" class="nav-link text-dark">
                                <i class="nav-icon fi fi-rr-calendar-days"></i>
                                <p>รายการการจอง</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="203booking_history.php" class="nav-link text-dark">
                                <i class="nav-icon fi fi-rr-calendar-days"></i>
                                <p>ประวัติการจอง</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="204live.php" class="nav-link text-dark">
                                <i class="nav-icon fi fi-rr-megaphone"></i>
                                <p>เรียกคิว</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Nav Item - ScanQr -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <!-- <i class="nav-icon fa-solid fa-qrcode"></i> -->
                        <i class="nav-icon bi bi-qr-code-scan"></i>
                        <p>
                            Scan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                    <ul class="nav nav-treeview bg-primary text-white py-2 collapse-inner rounded">
                        <li class="nav-item">
                            <a href="301scan_qrcode.php?next_status=1" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-map-location-dot"></i>
                                <p>เข้าพื้นที่ Impact</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="301scan_qrcode.php?next_status=4" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-right-to-bracket"></i>
                                <p>เข้าช่องโหลด</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="301scan_qrcode.php?next_status=5" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>ออกจากช่องโหลด</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Nav Item - ลูกค้า -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            ลูกค้า
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                    <ul class="nav nav-treeview bg-primary text-white py-2 collapse-inner rounded">
                        <li class="nav-item">
                            <a href="901customer.php?page=table" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>รายการลูกค้า</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="901customer.php?page=new" class="nav-link text-dark">
                                <i class="nav-icon fa-solid fa-user-check"></i>
                                <p>ลูกค้าใหม่รอการอนุมัติ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Reports
                </div>

                <!-- Nav Item - รายงาน -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-regular fa-file-lines"></i>
                        <p>
                            รายงาน
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                    <ul class="nav nav-treeview bg-primary text-white py-2 collapse-inner rounded">
                        <li class="nav-item">
                            <a href="401report.php" class="nav-link text-dark">
                                <!-- <i class="nav-icon fa-solid fa-users"></i> -->
                                <p>รายงานจำนวนการจองรายวันแยกตามอีเวนต์ในแต่ละช่วงเวลา</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="402report.php" class="nav-link text-dark">
                                <!-- <i class="nav-icon fa-solid fa-user-check"></i> -->
                                <p>รายงานการจองรายวันตามวันที่จอง</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="403report.php" class="nav-link text-dark">
                                <!-- <i class="nav-icon fa-solid fa-user-check"></i> -->
                                <p>รายงานจำนวนรถตามวันในแต่ละช่วงเวลา</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="404report.php" class="nav-link text-dark">
                                <!-- <i class="nav-icon fa-solid fa-user-check"></i> -->
                                <p>รายงานจำนวนการจองของรถแต่ละประเภทแยกตามอีเวนต์</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rpt_summary.php" class="nav-link text-dark">
                                <!-- <i class="nav-icon fa-solid fa-user-check"></i> -->
                                <p>รายงานสรุปการจองตามช่วงวัน-เวลา</p>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>