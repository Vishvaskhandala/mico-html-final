<!doctype html>
<html class="no-js" lang="zxx">
<body>
<?php include "admin_menu.php"; ?>  

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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <table class="table">
                <thead>
                    <tr>
                        <td> ID </td>
                        <td> NAME </td>
                        <td> PHOTO </td>
                        <td> SPECIALIZATION </td>
                        <td> PROFILE </td>
                        <td> AVAILABILITY </td>
                        <td> DELETE </td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());
                    
                    // Check if a delete request has been made
                    if(isset($_GET['doctor_id'])){
                        $delete_id = $_GET['doctor_id'];
                        $delete_query = "DELETE FROM doctors WHERE doctor_id = $delete_id";
                        mysqli_query($conn, $delete_query);
                    }

                    $q = "SELECT * FROM doctors";
                    $rs = mysqli_query($conn, $q);

                    while($row = mysqli_fetch_array($rs)){
                    ?>
                    <tr>
                        <td> <?php echo $row['doctor_id'] ?> </td>
                        <td> <?php echo $row['doctor_name'] ?> </td>
                        <td> <img src="<?php echo $row['image'] ?>" alt="Doctors image" height="50" width="50"> </td>
                        <td> <?php echo $row['specialization'] ?></td>
                        <td> <?php echo $row['profile'] ?></td>
                        <td> <?php echo $row['availability'] ?></td>
                        <td> <a href="doctors.php?doctor_id=<?php echo $row['doctor_id'];?>" onclick="return confirm('Do you want to delete?')">Delete</a></td>
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
