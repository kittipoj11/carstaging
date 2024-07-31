<?php
include 'header.php';
include 'sidebar.php';
include 'navbar.php';

// $_SESSION['page'] = $_REQUEST['page'];
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'table') {
    include '201semester_table.php';
} elseif (isset($_REQUEST['page']) && $_REQUEST['page'] == 'view') {
    include '201semester_view.php';
    // if(isset($_REQUEST['id'])){
    //     $_SESSION['id']= $_REQUEST['id'];
    // }else{
    //     $_SESSION['id']='No';
    // }
}else{
    include '201semester_table.php';
}
include 'logout_modal.php';
include 'footer.php';
?>
<!-- js -->
<!-- <script src="100cartype.js"></script> -->
<script src="201semester.js"></script>
</body>

</html>