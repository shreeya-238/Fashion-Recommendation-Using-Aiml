 <!-- Navigation -->
 <?php
    require('db_config.php');
    require('essentials.php');
    session_start();

    ?>



<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">WardrobeGenie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
    <li class="nav-item"><a class="nav-link" href="recommendation.php">Recommendation</a></li>
    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true): 
        $path = USER_IMG_PATH;
        $userPic = !empty($_SESSION['uPic']) ? $_SESSION['uPic'] : 'default.png';
    ?>
        <li class="nav-item dropdown">
            <button class="btn btn-outline-dark dropdown-toggle shadow-none " style="margin-left: 2px;" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $path . $userPic ?>" alt="Profile" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                <?= $_SESSION['uName'] ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link login-btn" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Log in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link login-btn" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
        </li>
    <?php endif; ?>
</ul>

        </div>
    </div>
</nav>


 <!-- login model -->

 <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <form id="login-form">
                 <div class="modal-header">
                     <h5 class="modal-title d-flex align-items-center">
                         <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                     </h5>
                     <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="mb-3">
                         <label class="form-label">Email / Mobile Number</label>
                         <input type="text" name="email_mob" class="form-control shadow-none">
                     </div>
                     <div class="mb-4">
                         <label class="form-label">Password</label>
                         <input type="password" name="pass" class="form-control shadow-none">
                     </div>

                     <div class="d-flex align-items-center justify-content-between">
                         <button class="btn btn-dark shadow-none" type="submit">LOGIN</button>
                     </div>
                 </div>

             </form>
         </div>
     </div>
 </div>

 <!-- register page -->
 <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form id="register-form">
                 <div class="modal-header">
                     <h5 class="modal-title d-flex align-items-center">
                         <i class="bi bi-person-lines-fill"></i> User Registration
                     </h5>
                     <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">

                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-6 ps-0 mb-3">
                                 <label class="form-label">Name</label>
                                 <input type="text" name="name" class="form-control shadow-none" required>
                             </div>
                             <div class="col-md-6 p-0 mb-3">
                                 <label class="form-label">Email</label>
                                 <input type="email" name="email" class="form-control shadow-none" required>
                             </div>
                             <div class="col-md-6 ps-0 mb-3">
                                 <label class="form-label">Phone Number</label>
                                 <input type="number" name="phonenum" class="form-control shadow-none" required>
                             </div>
                             <div class="col-md-6 p-0 mb-3">
                                 <label class="form-label">Picture</label>
                                 <input type="file" name="profile" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                             </div>

                             <div class="col-md-6 ps-0 mb-3">
                                 <label class="form-label">Gender</label>
                                 <select name="gender" class="form-control shadow-none" required>
                                     <option value="" selected disabled>Select Gender</option>
                                     <option value="male">Male</option>
                                     <option value="female">Female</option>
                                     <option value="other">Other</option>
                                 </select>
                             </div>

                             <div class="col-md-6 p-0 mb-3">
                                 <label class="form-label">Date of Birth</label>
                                 <input type="date" name="dob" class="form-control shadow-none" required>
                             </div>
                             <div class="col-md-6 ps-0 mb-3">
                                 <label class="form-label">Password</label>
                                 <input type="password" name="pass" class="form-control shadow-none" required>
                             </div>
                             <div class="col-md-6 p-0 mb-3">
                                 <label class="form-label">Confirm Password</label>
                                 <input type="password" name="cpass" class="form-control shadow-none" required>
                             </div>
                         </div>
                         <div class="text-center">
                             <button class="btn btn-dark shadow-none my-3" type="submit">Register</button>
                         </div>
                     </div>

                 </div>

             </form>
         </div>
     </div>
 </div>