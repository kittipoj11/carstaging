    <!-- <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top"> 
    <div class="text-end">
        <a href="#" type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginForm">ลงชื่อเข้าใช้</a>
    </div>        
    -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="http://www.impact.co.th/">
                <img src="../_images/logo-impact.svg" alt="Impact" width="100px" class="d-inline-block align-text-top">
            </a>

            <!-- Hamburger bar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item"><a class="nav-link" href="#!">Sign
                            Up</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#loginForm">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column  justify-content-end align-items-center min-vh-100 impact-image p-5">
        <!-- <div class="p-4 p-md-5 mx-3 mt-2 text-bg-dark impact-image"> -->
        <!-- <h1 class="display-4 fw-bold text-body-emphasis">Centered screenshot</h1> -->
        <div class="row text-start text-bg-dark bg-transparent">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic fw-bold">Car Staging</h1>
                <p class="lead my-3 ">
                    Car Staging
                    เป็นระบบการจองคิวในการนำรถเข้ามาเพื่อขนถ่ายสินค้าและอุปกรณ์ตามวันและเวลาในการจองคิวไว้
                    และทำให้ลดความแออัดของการจราจรภายในเมืองทองได้
                </p>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-evenly text-start text-bg-dark bg-transparent min-vw-100">
                <div class="col">
                    <img src="../_images/impact_chalenger1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <img src="../_images/impact_forum1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <img src="../_images/impact_exhibition1.jpg" class="card-img-top" alt="...">
                </div>

            </div>

        </div>
    </div>

    <!-- Modal: Login Form -->
    <div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <div class="modal-content opacity-75"> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LoginModalLabel">ลงชื่อเข้าใช้</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="frmLogin" id="frmLogin" action="check_login.php" method="POST">
                        <!-- Username input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="username">User Name</label>
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>

                        <div class="form-outline mb-2">
                            <!-- Submit button -->
                            <button type="submit" name="login" id="login" class="btn btn-primary btn-block form-control">Log in</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>