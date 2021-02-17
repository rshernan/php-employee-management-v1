<!-- TODO Employee view -->
<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . "/php-employee-management-v1/src/library/employeeController.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/employee.css">
</head>


<body>
    <?php
    include("./library/sessionhelper.php");
    include('../assets/html/header.html');
    ?>
    <main>
        <form action="" method="post" class="employee__form">
            <div class="column">
                <label for="name">name</label>
                <input type="text" id="name" name="name" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->name : "") ?>" required>
                <label for="email">email</label>
                <input type="email" id="email" name="email" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->email : "") ?>" required>
                <label for="city">city</label>
                <input type="text" id="city" name="city" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->city : "") ?>" required>
                <label for="state">state</label>
                <input type="text" id="state" name="state" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->state : "") ?>" required>
                <label for="postalCode">postal code</label>
                <input type="number" id="postalCode" name="postalCode" max="99999" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->postalCode : "") ?>" required>
                <input name="submit" type="submit" value="save" />
                <button id="back">back</button>
            </div>
            <div class="column">
                <label for="lastName">last name</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->lastName : "") ?>" required>
                <label for="gender">gender</label>
                <select name="gender" id="gender" class="select" required>
                    <option value="nb" <?php echo (isset($_GET['edit']) ? ((json_decode(($_GET['employee']))->gender == "nb") ? "selected" : "") : "") ?>>non-binary</option>
                    <option value="man" <?php echo (isset($_GET['edit']) ? ((json_decode(($_GET['employee']))->gender == "man") ? "selected" : "") : "") ?>>man</option>
                    <option value="woman" <?php echo (isset($_GET['edit']) ? ((json_decode(($_GET['employee']))->gender == "woman") ? "selected" : "") : "") ?>>woman</option>
                </select>
                <label for="streetAddress">street Address:</label>
                <input type="text" name="streetAddress" id="streetAddress" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->streetAddress : "") ?>" required>
                <label for="age">age</label>
                <input type="number" name="age" id="age" max="999" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->age : "") ?>" required>
                <label for="phoneNumber">phone number</label>
                <input type="tel" name="phoneNumber" id="phoneNumber" pattern="[0-9]{9}" value="<?php echo (isset($_GET['edit']) ? json_decode($_GET['employee'])->phoneNumber : "") ?>" required>
            </div>
        </form>
    </main>

    <script src="../assets/js/index.js"></script>
    <?php
    echo "<script>$('.employee__form').on('submit', function(){
        console.log('wtf are you doing?');
        updateOrCreateEmployee(event," . (isset($_GET['edit']) ? "'PUT'" : "'POST'") . "," . (isset($_GET['edit']) ? json_decode($_GET['employee'])->id : null) . ");
    });</script>";
    ?>

</body>

</html>