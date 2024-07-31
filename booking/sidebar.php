<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-truck"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Car Staging Booking<sup>*</i></sup></div>
    </a>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider my-0"> -->

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterTable"
            aria-expanded="true" aria-controls="collapseMasterTable">
            <i class="fas fa-fw fa-database"></i>
            <span>จองพื้นที่ Setup</span>
        </a>
        <div id="collapseMasterTable" class="collapse" aria-labelledby="headingMasterTable"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom ข้อมูลพื้นฐาน:</h6> -->
                <a class="collapse-item" href="520booking.php"><i class="fi fi-rr-car-bus"></i> ทำการจอง</a>
                <a class="collapse-item" href="530booking_list.php"><i class="fa-solid fa-city"></i>
                    แสดงรายการจอง</a>
                <a class="collapse-item" href="510history_booking_table.php"><i class="fa-solid fa-grip"></i>
                    ประวัติการจอง</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - SetupArea Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetupArea"
            aria-expanded="true" aria-controls="collapseSetupArea">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>ข้อมูลของฉัน</span>
        </a>
        <div id="collapseSetupArea" class="collapse" aria-labelledby="headingSetupArea" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                <a class="collapse-item" href="610profiles.php"><i class="fi fi-rr-calendar-clock"></i>
                    ข้อมูลส่วนตัว</a>
                <a class="collapse-item" href="620change_password.php"><i class="fi fi-rr-calendar-clock"></i>
                    เปลี่ยนรหัสผ่าน</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Report Collapse Menu -->
    <li class="nav-item d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true"
            aria-controls="collapseReport">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>รายงาน</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                <a class="collapse-item" href="#"><i class="fi fi-rr-calendar-clock"></i>
                    รายงานการจอง</a>
                <a class="collapse-item" href="#"><i class="fi fi-rr-calendar-days"></i>
                    ...</a>
                <a class="collapse-item" href="630reports.php"><i class="fi fi-rr-megaphone"></i> ...</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->