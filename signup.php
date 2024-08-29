<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $acre = $_POST['acre'];
    $village = $_POST['village'];
    $taluka = $_POST['taluka'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Check if user_id already exists
    $check_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($result) > 0) {
        $user_id_message = "युजर आयडी आधीपासूनच अस्तित्वात आहे. कृपया एक वेगळा वापरकर्ता आयडी निवडा";
        $user_id_alertClass = "danger";
    } else {
        $query = "INSERT INTO users (full_name, mobile_no, acre, village, taluka, district, state, pin_code, user_id, password) VALUES ('$full_name', '$mobile_no', '$acre', '$village', '$taluka', '$district', '$state', '$pin_code', '$user_id', '$password')";

        mysqli_query($con, $query);
        $message = "यशस्वीरित्या नोंदणी केली आहे : लॉगिन करा";
        $alertClass = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-3 AgroTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    <script>
    function checkUserIdAvailability() {
        var user_id = document.getElementById('user_id').value;

        if (user_id.trim() === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'check_user_id_availability.php?user_id=' + user_id, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        document.getElementById('user_id_error').innerText = 'User ID alreaformdy exists';
                    } else {
                        document.getElementById('user_id_error').innerText = '';
                    }
                } else {
                    console.error('Error checking user ID availability');
                }
            }
        };
        xhr.send();
    }
    </script>
    <script>
        function updateTalukas() {
            var district = document.getElementById('district').value;
            var talukaSelect = document.getElementById('taluka');
            var talukas = {
                Parbhani: ['Gangakhed', 'Jintur', 'Manwath', 'Palam', 'Parbhani', 'Pathri', 'Purna', 'Selu', 'Sonpeth'],
                Latur: ['Ahemadpur', 'Ausa', 'Chakur', 'Deoni', 'Jalkot', 'Latur', 'Nilanga', 'Renapur', 'Shirur Anantpal', 'Udgir']
            };

            talukaSelect.innerHTML = '';
            talukas[district].forEach(function(taluka) {
                var option = document.createElement('option');
                option.text = taluka;
                option.value = taluka;
                talukaSelect.add(option);
            });
        }
    </script>




</head>

<body>
    

    <div class="signup">
        <img src="logo1.png" class="img-fluid" alt="Responsive image">
        <br>
        <h3>शेतकरी नोंदणी फॉर्म</h3>
        <?php if (isset($user_id_message)) : ?>
        <div class="alert alert-<?php echo $user_id_alertClass; ?>" role="alert">
            <?php echo $user_id_message; ?>
        </div>
        <?php endif; ?>

        <form class="form-all" method="POST">
            <div class="form-group">
                <label><i class="fas fa-user"></i> पूर्ण नाव</label>
                <input type="text" class="form-control" name="full_name" required>
                <br>
                <label><i class="fas fa-phone"></i> मोबाईल क्रमांक</label>
                <input type="text" class="form-control" name="mobile_no" pattern="[0-9]{10}" title="कृपया 10-अंकी मोबाइल नंबर प्रविष्ट करा" required oninvalid="showAlert()" onchange="this.setCustomValidity('')">
                <br>
                <label><i class="fas fa-map-marker-alt"></i> एकूण शेती(एकर मध्ये)</label>
                <input type="text" class="form-control" name="acre" required>
                <br>
                <label><i class="fas fa-map"></i> राज्य</label>
                <select type="text" class="form-control" name="state" id="exampleFormControlSelect1" required>
                    <option>Maharashtra</option>
                </select>
                <br>
                <label><i class="fas fa-city"></i> जिल्हा</label>
                <select type="text" class="form-control" name="district" id="district" onchange="updateTalukas()" required>
                    <option></option>
                    <option value="Parbhani">Parbhani</option>
                    <option value="Latur">Latur</option>
                </select>
                <br>
                <label><i class="fas fa-map-marked"></i> तालुका</label>
                <select type="text" class="form-control" name="taluka" id="taluka" required>
                    <option value="">Select Taluka</option>  
                </select>
                <br>
                <label><i class="fas fa-building"></i> गाव</label>
                <input type="text" class="form-control" name="village" required>
                <br>
                <label><i class="fas fa-thumbtack"></i> पिन कोड</label>
                <input type="text" class="form-control" name="pin_code" required>
                <br>
                <label><i class="fas fa-user"></i> यूजर आयडी / मोबाईल क्रमांक</label>
                <input type="text" class="form-control" name="user_id" id="user_id" oninput="checkUserIdAvailability()" required>

                <div id="user_id_error" style="color: red;"></div>
                <br>
                <label><i class="fas fa-lock"></i> पासवर्ड</label>
                <input type="password" class="form-control" name="password" minlength="4" required>
                <span id="password-error" style="color: red; display: none;">पासवर्ड किमान 4 वर्णांचा असणे आवश्यक आहे</span>

                <input type="submit" class="btn btn-primary" name="" value="नोंदणी करा">

                <?php if (isset($message)) : ?>
            <div class="alert alert-<?php echo $alertClass; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
            </div>
        </form>
        <p>खाते आहे! लॉगिन वर जा <a href="login.php">लॉगिन</a></p>

        
    </div>
    <footer class="bg-body-tertiary text-center text-lg-start">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            All rights Reserved © T-3 AgroTech PVT LTD , 2024
            <a class="text-body" href="https://www.t3agro.com/">T-3 AgroTech</a>
        </div>
    </footer>
    <script>
    document.querySelector('input[name="password"]').addEventListener('input', function() {
        var password = this.value;
        var errorSpan = document.getElementById('password-error');
        if (password.length < 4) {
            errorSpan.style.display = 'inline';
        } else {
            errorSpan.style.display = 'none';
        }
    });
    </script>   
<script>
function showAlert() {
    alert('कृपया 10-अंकी मोबाइल नंबर प्रविष्ट करा');
}
</script>    
</body>


</html>
