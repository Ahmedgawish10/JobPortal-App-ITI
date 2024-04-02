<?php
@session_start();
?>
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">JobEntry</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <?php
              if(isset($_SESSION['company_user'])){
                echo '<a href="" class="nav-item nav-link">' . $_SESSION["company_user"] . '</a>';
                  echo '<a href="logout.php" class="nav-item nav-link">Logout</a>';
                  echo ' <a href="contact.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>';
              }
            else{
                echo '<a href="login.php" class="nav-item nav-link">Login</a>';
                echo '<a href="register.php" class="nav-item nav-link">REGISTER</a>';
            }
                    ?>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->