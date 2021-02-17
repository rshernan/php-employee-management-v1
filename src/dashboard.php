<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<?php
include("./library/sessionhelper.php");
include('../assets/html/header.html');
?>

<body>
    <div id="jsGrid"></div>
    <div class="alert alert-danger alert-dismissible validation">
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong>
    </div>
    <?php
    include('../assets/html/footer.html');
    ?>
    <script>
        var employees = [];
        $.ajax({
            type: "GET",
            url: "http://localhost/PHP-EmployeeManagement/php-employee-management-v1/src/library/employeeController.php",
            dataType: "json",
        }).done(function(response) {
            employees = response;
            $("#jsGrid").jsGrid({
                width: "100%",
                height: "100%",

                inserting: true,
                editing: true,
                sorting: true,

                paging: true,
                pageIndex: 1,
                pageSize: 5,
                pageButtonCount: 15,
                pagerFormat: "Pages:  {pages} {prev} {next}    {pageIndex} of {pageCount}",
                pagePrevText: "Prev",
                pageNextText: "Next",

                confirmDeleting: true,
                deleteConfirm: "Do you really want to delete the employee?",


                rowClick: function(args) {
                    window.location.href = `employee.php?employee=${JSON.stringify(args.item)}&edit=true`;
                },
                editItem: function(item) {
                    window.location.href = `employee.php?employee=${JSON.stringify(item)}&edit=true`;
                },
                onItemInserting: function(args) {
                    console.log("inserting")
                    console.log(args.item);
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
                        data: args.item,
                        dataType: "json",
                    });
                },
                onItemDeleting: function(args) {
                    console.log("delete")
                    console.log(args.item);
                    $.ajax({
                        type: "DELETE",
                        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
                        data: args.item,
                        dataType: "json",
                    });
                },
                data: employees,

                fields: [{
                        name: "name",
                        title: "Name",
                        type: "text",
                        align: "center",
                        validate: {
                            validator: function(value, item) {
                                validationFunction(value, "name");
                            },
                        }
                    },
                    //{
                    //    name: "lastName",
                    //    title: "Last name",
                    //    type: "text",
                    //    align: "center",
                    //    validate: "required"
                    //},
                    {
                        name: "email",
                        title: "Email",
                        width: 150,
                        type: "text",
                        align: "center",
                        validate: {
                            validator: function(value, item) {
                                validationFunction(value, "email")
                            },
                        }
                    },
                    {
                        name: "age",
                        title: "Age",
                        type: "number",
                        align: "center",
                        width: 40,
                        validate: {
                            validator: function(value, item) {
                                validationFunction(value, "age");
                            },
                        }
                    },
                    //{
                    //    name: "gender",
                    //    title: "Gender",
                    //    type: "select",
                    //    align: "center",
                    //    items: ["male", "female"],
                    //    valueType: "string"
                    //},
                    {
                        name: "streetAddress",
                        title: "Street Nº",
                        align: "center",
                        type: "text",
                    },
                    {
                        name: "city",
                        title: "City",
                        align: "center",
                        type: "text",
                    },
                    {
                        name: "state",
                        title: "State",
                        type: "text",
                        align: "center",
                        width: 50
                    },
                    {
                        name: "postalCode",
                        title: "Postal Code",
                        type: "number",
                        align: "center",
                        width: 100
                    },
                    {
                        name: "phone",
                        title: "Phone",
                        type: "number",
                        align: "center",
                        width: 100,
                        validate: {
                            validator: function(value, item) {
                                validationFunction(value, "phone");

                            },
                        }
                    },
                    {
                        type: "control"
                    }
                ]
            });
        }).fail(function(status) {
            console.log("fail: " + status);
        });

        function validationFunction(value, field) {
            $(".alert").fadeIn();
            switch (field) {
                case "name":
                    if (value == "") {
                        $errorMsg = `<p>You need to enter a name</p>`
                        $(".alert").append($errorMsg);
                    } else {
                        name_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
                        if (!name_regex.test(value)) {
                            $errorMsg = `<p>Please, enter a valid name</p>`
                            $(".alert").append($errorMsg);
                        } else {
                            name_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
                            if (!name_regex.test(value)) {
                                $errorMsg = `<p>Please, enter a valid name</p>`
                                $(".alert").append($errorMsg);
                            }
                        }
                    }
                    break;
                case "email":
                    if (value == "") {
                        $errorMsg = `<p>You need to enter an email</p>`
                        $(".alert").append($errorMsg);
                    } else {
                        email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
                        if (!email_regex.test(value)) {
                            $errorMsg = `<p>Please, enter a valid email</p>`
                            $(".alert").append($errorMsg);
                        }
                    }
                    break;
                case "age":
                    if (value == null) {
                        $errorMsg = `<p>You need to enter an age</p>`
                        $(".alert").append($errorMsg);
                    } else {
                        if (value > 100 || value < 16) {
                            $errorMsg = `<p>The age must be between 16 and 100</p>`
                            $(".alert").append($errorMsg);
                        } else if (!Number.isInteger(value) && value != "") {
                            $errorMsg = `<p>Please enter a correct age</p>`
                            $(".alert").append($errorMsg);
                        }
                    }
                    break;
                case "phone":
                    if (value == null) {
                        $errorMsg = `<p>You need to enter an age</p>`
                        $(".alert").append($errorMsg);
                    } else {
                        if (value > 100 || value < 16) {
                            $errorMsg = `<p>The age must be between 16 and 100</p>`
                            $(".alert").append($errorMsg);
                        } else if (!Number.isInteger(value) && value != "") {
                            $errorMsg = `<p>Please enter a correct age</p>`
                            $(".alert").append($errorMsg);
                        }
                    }
                    break;
                default:
                    break;
            }
        }
    </script>
    <script src="../assets/js/index.js"></script>

</body>

</html>