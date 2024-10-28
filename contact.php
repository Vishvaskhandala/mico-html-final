<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .contact_section {
            padding: 20px;
        }
        .form_container {
            max-width: 600px;
            margin: auto;
        }
        .form_container form div {
            margin-bottom: 15px;
        }
        .form_container form input,
        .form_container form textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn_box button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- contact section -->
<section class="contact_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container">
            <h2>Get In Touch</h2>
        </div>
        <div class="form_container">
            <form action="submit_contact.php" method="POST">
                <div>
                    <input type="text" name="full_name" placeholder="Full Name" required />
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div>
                    <input type="text" name="phone_number" placeholder="Phone Number" required />
                </div>
                <div>
                    <textarea name="message" placeholder="Message" rows="5" required></textarea>
                </div>
                <div class="btn_box">
                    <button type="submit">SEND</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- end contact section -->

</body>
</html>
