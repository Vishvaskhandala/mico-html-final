<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include "admin_menu.php"; ?>  

<div class="slider_area">
    <div class="slider_active owl-carousel">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <h3>ALL APPOINTMENT</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <table class="table">
                <thead>
                    <tr>
                        <td> APPOINTMENT ID </td>
                        <td> DOCTOR ID </td>
                        <td> PATIENT NAME </td>
                        <td> APPOINTMENT DATE </td>
                        <td> DELETE </td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

                    // Check if a delete request has been made
                    if(isset($_GET['appointment_id'])){
                        $delete_id = $_GET['appointment_id'];
                        $delete_query = "DELETE FROM appointments WHERE id = $delete_id";
                        mysqli_query($conn, $delete_query);
                    }

                    $q = "SELECT * FROM appointments";
                    $rs = mysqli_query($conn, $q);

                    while($row = mysqli_fetch_array($rs)){
                    ?>
                    <tr>
                        <td> <?php echo $row['id'] ?></td>
                        <td> <?php echo $row['doctor_id'] ?> </td>
                        <td> <?php echo $row['patient_name'] ?></td>
                        <td> <?php echo $row['appointment_date'] ?></td>
                        <td> <a href="admin_appointments.php?appointment_id=<?php echo $row['id'];?>" onclick="return confirm('Do you want to delete?')">Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
