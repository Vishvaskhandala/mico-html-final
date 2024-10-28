<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .card-text strong {
            display: block;
            margin-bottom: 0.5rem;
        }
        .card-text i {
            color: #007bff;
            margin-right: 0.5rem;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
      
    <?php include "menu.php"; ?>

    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>ALL DOCTORS</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Real div -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <?php
                      $con = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());
                      $q = "SELECT * FROM doctors";
                      $rs = mysqli_query($con, $q);
                      while ($row = mysqli_fetch_array($rs)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Doctor image" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['specialization']; ?></h5>
                                <p class="card-text">
                                    <strong>name:</strong> <?php echo $row['doctor_name']; ?><br>  
                                    <strong>Profile:</strong> <?php echo $row['profile']; ?><br>
                                    <strong><i class="far fa-clock"></i> Availability:</strong> <?php echo $row['availability']; ?><br>
                                    <strong><i class="far fa-money-bill-alt"></i> Fees:</strong>  $<?php echo $row['mony']; ?> per consultation<br>
                                </p>
                                <a href="appointment.php?doctor_id=<?php echo $row['doctor_id']; ?>&doctor_name=<?php echo urlencode($row['doctor_name']); ?>&specialization=<?php echo urlencode($row['specialization']); ?>" class="btn btn-primary">Book Appointment</a> 
                            </div>
                        </div>       
                    </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
