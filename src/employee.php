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

</head>

<body>
    <form action="" method="post" class="employee__form" style="display:flex;flex-direction:row">
        <div class="column" style="display:flex;flex-direction:column;">
            <label for="name">name</label>
            <input type="text" id="name" name="name" required>
            <label for="email">email</label>
            <input type="email" id="email" name="email" required>
            <label for="city">city</label>
            <input type="text" id="city" name="city" required>
            <label for="state">state</label>
            <input type="text" id="state" name="state" required>
            <label for="postalCode">postal code</label>
            <input type="number" id="postalCode" name="postalCode" max="99999" required>
            <input name="submit" type="submit" value="SUBMIT" />
            <button>back</button>
        </div>
        <div class="column" style="display:flex;flex-direction:column;">
            <label for="lastName">last name</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="gender">gender</label>
            <select name="gender" id="gender" required>
                <option value="nb">non-binary</option>
                <option value="man">man</option>
                <option value="woman">woman</option>
            </select>
            <label for="streetAddress">street Address:</label>
            <input type="text" name="streetAddress" id="streetAddress" required>
            <label for="age">age</label>
            <input type="number" name="age" id="age" max="999" required>
            <label for="phoneNumber">phone number</label>
            <input type="tel" name="phoneNumber" id="phoneNumber" pattern="[0-9]{9}" required>
        </div>
    </form>
    <?php
    echo "<script>$('.employee__form').on('submit', function(){
        updateOrCreateEmployee(" . (isset($_GET['edit']) ? 'PUT' : 'POST') . ");
    });</script>";

    print_r(json_decode($_GET['employee'])->id);
    ?>
    <script src="../assets/js/index.js"></script>
</body>

</html>