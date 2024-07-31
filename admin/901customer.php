<?php
include 'header.php';
include 'sidebar.php';
include 'navbar.php';
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'table') {
    include '901customer_table.php';
} elseif (isset($_REQUEST['page']) && $_REQUEST['page'] == 'new') {
    include '901customer_new.php';
} else {
    include '901customer_table.php';
}

include 'logout_modal.php';
include 'footer.php';
?>
<!-- js -->
<!-- <script src="100cartype.js"></script> -->
<script src="901customer.js"></script>
</body>

</html>