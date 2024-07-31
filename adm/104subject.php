<?php
include 'header.php';
include 'sidebar.php';
include 'navbar.php';
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'table') {
    include '104subject_table.php';
} elseif (isset($_REQUEST['page']) && $_REQUEST['page'] == 'view') {
    include '104subject_view.php';
    // if(isset($_REQUEST['id'])){
    //     $_SESSION['id']= $_REQUEST['id'];
    // }else{
    //     $_SESSION['id']='No';
    // }
} else {
    include '104subject_table.php';
}
include 'logout_modal.php';
include 'footer.php';
?>
<!-- js -->
<!-- <script src="100cartype.js"></script> -->
<script src="104subject.js"></script>
</body>

</html>