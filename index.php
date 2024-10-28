<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mico Hospital</title>
  <link rel="stylesheet" href="path/to/your/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <?php include "menu.php"; ?>
</head>

<body>

<!-- Slider Section -->
<section class="slider_section">
  <div class="dot_design">
    <img src="images/dots.png" alt="Decorative dots">
  </div>
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <div class="play_btn">
                  <button>
                    <i class="fa fa-play" aria-hidden="true"></i>
                  </button>
                </div>
                <h1>Mico <br><span>Hospital</span></h1>
                <p>
                  Discover comprehensive medical care at Mico Hospital. With top-notch services and experienced staff, we're here to support your health journey.
                </p>
                <a href="contact.php" class="btn btn-primary">Contact Us</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="images/slider-img.jpg" alt="Mico Hospital">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Additional carousel items here -->
    </div>
    <div class="carousel_btn-box">
      <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
        <img src="images/prev.png" alt="Previous">
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
        <img src="images/next.png" alt="Next">
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</section>
<!-- End Slider Section -->

<!-- Feedback Button -->
<button class="feedback_btn" onclick="toggleFeedback()">&#x1F4AC; Give Feedback</button>

<!-- Feedback Section -->
<section class="feedback_section" id="feedbackSection" style="display: none;">
  <span class="close_btn" onclick="toggleFeedback()">&times;</span>
  <h2>Feedback</h2>
  <div class="feedback_container">
    <?php include "fetch_feedback.php"; ?>
  </div>
</section>
<!-- End Feedback Section -->

<!-- JavaScript Code -->
<script>
  function toggleFeedback() {
    const feedbackSection = document.getElementById("feedbackSection");
    feedbackSection.style.display = feedbackSection.style.display === "block" ? "none" : "block";
  }
</script>

<?php include "info.php"; ?>
<?php include "footer.php"; ?>

</body>
</html>
