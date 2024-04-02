<div class="container-fluid p-0">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="img/carousel-1.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(43, 57, 64, .5);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                        <?php
                            require "connection_db.php";
                                //  print_r($_SESSION);
                            if (@$_SESSION['company_user'] && @$_SESSION['comp_id']) {
                                echo '<h1 class="display-3 text-white animated slideInDown mb-4">You Can Announce a  new Job now </h1>';

                            } else {
                                echo '  <h1 class="display-3 text-white animated slideInDown mb-4">Find The Perfect Job That You
                                Deserved</h1>';

                            }


                            ?>

                           
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at
                                sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="img/carousel-2.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(43, 57, 64, .5);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">

                            <?php
                            require "connection_db.php";
                                //  print_r($_SESSION);
                            if (@$_SESSION['company_user'] && @$_SESSION['comp_id']) {
                                echo '<h1 class="display-3 text-white animated slideInDown mb-4">Largest  Job Site in the World</h1>';

                                echo '  <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at
                                    sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitroo.</p>';

                                echo ' <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Create new jop</a>
                                 <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>';
                            } else {
                                echo '<h1 class="display-3 text-white animated slideInDown mb-4">Largest  Job Site in the World</h1>';

                                echo '  <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at
                                    sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitroo.</p>';
                                echo ' <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search a jop</a>';

                            }


                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>