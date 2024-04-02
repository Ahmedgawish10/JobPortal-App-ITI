<?php
require "head.php";
global $pdo;
?>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->



        <?php
        require "header.php";
        require "carosoul.php";
       // print_r($_SESSION);
        ?>
        <!-- Carousel End -->
        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
                                <h6 class="mt-n1 mb-0">Latest Jobs</h6>
                            </a>
                        </li>
                        <?php
                        if (isset($_SESSION['company_user'])) {
                            echo '    <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">My Jobs</h6>
                            </a>
                        </li>';
                        }
                        ?>

                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php
                            require "connection_db.php";
                            $stmt = $pdo->prepare("SELECT * FROM jobs");
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            // all featch jobs in database
                            foreach ($rows as $row) {
                                echo '
                                <div class="job-item p-4 mb-4 text-capitalize">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">' . $row['job_title'] . '</h5>
                                                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>' . $row['location'] . '</span>
                                                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>' . $row['type'] . '</span>
                                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>' . $row['salary'] . '</span>
                                            </div>
                                        </div>';
                                $expireTimestamp = strtotime($row['expire_date']);
                                $currentTimestamp = time();
                                //  echo $currentTimestamp."<br>";
                                //  echo $expireTimestamp;
                                if ($expireTimestamp < $currentTimestamp) {
                                    echo '<div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-danger" href="job-detail.php?id=' . $row['id'] . '">Expired</a>   
                                            </div>';
                                } else {
                                    $enableApplyButton = "";
                                    echo '<div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                            
                                            <div class="d-flex mb-3 ">
                                            <a class="btn btn-primary' . ($row['status'] == "closed" ? ' hidden' : '') . '" href="' . ($row['status'] == "active" ? 'job-detail.php?id=' . $row['id'] : '#') . '">Apply Now </a>'
                                            ."</div>";

                                    if (isset($_SESSION['company_user']) && $row['comp_id'] == $_SESSION['comp_id']) {
                                        if ($row['status'] == "active") {
                                            echo '<button class="btn open btn-info active mx-3"">' . $row['status'] . '</button>';

                                        } elseif ($row['status'] == "closed") {
                                            echo '<button class="btn btn-danger close1 mx-3"">' . $row['status'] . '</button>';

                                        }

                                    }

                                    echo '  </div>';
                                    if (isset($_SESSION['company_user']) && $row['comp_id'] == $_SESSION['comp_id']) {

                                        echo '<a href="updateStatus.php?id=' . $row['id'] . '&status=';

                                        if ($row['status'] == "active") {
                                            echo 'inactive" class=" mx-3 disable-job"';
                                        } elseif ($row['status'] == "closed") {
                                            echo 'active" class=" mx-3 disable-job"';
                                        }
                                        
                                        echo ' onclick="toggleApplyButton(' . $row['id'] . ')">';
                                        
                                        if ($row['status'] == "active") {
                                            echo '<button class="btn open btn-warning mx-3">' ." Disabled ". '</button>';
                                        } elseif ($row['status'] == "closed") {
                                            echo '<button class="btn btn-success close ">' ."Enabled" . '</button>';
                                        }
                                        
                                        echo '</a>';
                                        
                                
                                    }

                                }

                                echo 'posted date ' . $row['start_date'] . '<br> expire date ' . $row['expire_date'];

                                echo '</div>
                                    </div>
                                </div>';
                            }

                            ?>


                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM jobs WHERE comp_id = :comp_id");
                            // var_dump($stmt);die();
                            $stmt->bindParam(':comp_id', $_SESSION['comp_id']);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($rows as $row) {
                                echo '
                                <div class="job-item p-4 mb-4 text-capitalize">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">' . $row['job_title'] . '</h5>
                                                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>' . $row['location'] . '</span>
                                                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>' . $row['type'] . '</span>
                                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>' . $row['salary'] . '</span>
                                            </div>
                                        </div>';
                                $expireTimestamp = strtotime($row['expire_date']);
                                $currentTimestamp = time();
                                if ($expireTimestamp < $currentTimestamp) {
                                    echo '<div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-danger" href="job-detail.php?id=' . $row['id'] . '">Expired</a>
                                                
                                            </div>';
                                } else {
                                    $enableApplyButton = "";
                                    echo '<div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                            
                                            <div class="d-flex mb-3 ">
                                            <a class="btn btn-primary' . ($row['status'] == "closed" ? ' hidden' : '') . '" href="' . ($row['status'] == "active" ? 'job-detail.php?id=' . $row['id'] : '#') . '">Apply Now </a>'
                                            ."</div>";

                                    if (isset($_SESSION['company_user']) && $row['comp_id'] == $_SESSION['comp_id']) {
                                        if ($row['status'] == "active") {
                                            echo '<button class="btn open btn-info active mx-3"">' . $row['status'] . '</button>';

                                        } elseif ($row['status'] == "closed") {
                                            echo '<button class="btn btn-danger close1 mx-3"">' . $row['status'] . '</button>';

                                        }

                                    }




                                    // if (isset($_SESSION['company_user']) && $row['comp_id'] == $_SESSION['comp_id']) {
                                    //     echo '<button class="btn btn-dark mx-3 disable-job" onclick="toggleApplyButton(' . $row['id'] . ')">Disable Now</button>';
                                    // }
                                    echo '  </div>';
                                    echo '<a href="updateStatus.php?id=' . $row['id'] . '&status=';

                                    if ($row['status'] == "active") {
                                        echo 'inactive" class=" mx-3 disable-job"';
                                    } elseif ($row['status'] == "closed") {
                                        echo 'active" class=" mx-3 disable-job"';
                                    }
                                    
                                    echo ' onclick="toggleApplyButton(' . $row['id'] . ')">';
                                    
                                    if ($row['status'] == "active") {
                                        echo '<button class="btn open btn-warning mx-3">' ." Disabled ". '</button>';
                                    } elseif ($row['status'] == "closed") {
                                        echo '<button class="btn btn-success close ">' ."Enabled" . '</button>';
                                    }
                                    echo '</a>';
                                    // if (isset($_SESSION['company_user']) && $row['comp_id'] == $_SESSION['comp_id']) {
                                    //     echo '<a href="updateStatus.php?id=' . $row['id'] . '" class="btn btn-dark mx-3 disable-job" 
                                    // onclick="toggleApplyButton(' . $row['id'] . ')">Change Status job</a>';
                                    // }
                                }

                                echo 'posted date ' . $row['start_date'] . ' expire date' . $row['expire_date'];
                                echo '</div>
                                    </div>
                                </div>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->




        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">

            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script>
        var applyButton;
        function toggleApplyButton(jobId) {

            applyButton = document.querySelector('a[href="job-detail.php?id=' + jobId + '"]');
            if (applyButton) {

                if (applyButton.classList.contains('disabled')) {
                    applyButton.classList.remove('disabled');
                    applyButton.removeAttribute('disabled');
                    localStorage.setItem("val", "disable")

                    applyButton.nextElementSibling.textContent = localStorage.getItem("val");
                } else {
                    applyButton.classList.add('disabled');
                    applyButton.setAttribute('disabled', 'disabled');
                    localStorage.setItem("val", "enable1")

                    applyButton.nextElementSibling.textContent = localStorage.getItem("val");;
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            let hiddenJob =document.querySelectorAll('.hidden');
            let closeJob =document.querySelectorAll('.close1');
    
            hiddenJob.forEach(function(div) {
                if (div.classList.contains("hidden")) {
                    div.style.dispaly = 'block';
                      div.textContent="closed "
                      div.style.background="#dc3545"
                }
  
});
// closed job function
closeJob.forEach(function(div) {
                if (div.classList.contains("close1")) {
                    //div.style.color = 'red';
                     // div.textContent="closed"
                     div.previousSibling.classList.add("hide")
                     console.log(  div.previousElementSibling);
                }
  
});













            // handle status
            // var close = document.querySelectorAll(".close");
            // close.forEach(function (div) {
            //     div.addEventListener("click", function () {

            //      console.log("1")

            //         // if (this.classList.contains("close")) {
            //         //           console.log(this)
            //         //       close.previousSibling.style.display = "none"                
            //         // } else {
                      

            //         // }


            //     });
            // });
            // var close = document.querySelector(".close");
            // if (close) {
            //     close.previousSibling.style.display = "none"
            //     console.log();

            // }

            // var privatejobs = document.querySelectorAll(".private");

            // privatejobs.forEach(function (div) {
            //     div.addEventListener("click", function () {
            //         if (this.classList.contains("disable-job")) {

            //             this.classList.remove("disable-job");
            //             this.classList.add("active");
            //             this.textContent = "Enable";
            //         } else {
            //             this.classList.remove("active");
            //             this.classList.add("disable-job");

            //             this.textContent = "Disabled";
            //         }


            //     });
            // });
        });

    </script>




    <script src="js/main.js"></script>
</body>

</html>