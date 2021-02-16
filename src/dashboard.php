<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard page</title>

    <link type="text/css" rel="stylesheet" href="jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="jsgrid-theme.min.css" />
    <script type="text/javascript" src="jsgrid.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
</head>

<body>
    <div id="jsGrid"></div>
    <div class="alert alert-danger"></div>
    <script>
        console.log("hola")
        var employees = [];
        $.ajax({
            type: "GET",
            url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
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
                onItemInserting: function(args) {
                    console.log("inserting")
                    console.log(args.item);
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/PHP-EmployeeManagement/php-employee-management-v1/src/library/employeeController.php",
                        data: args.item,
                        dataType: "json",
                    });
                },
                onItemUpdating: function() {
                    window.location.href = `employee.php?employee=${JSON.stringify(args.item)}&edit=true`;
                },
                onItemDeleting: function(args) {
                    console.log("delete")
                    console.log(args.item);
                    $.ajax({
                        type: "DELETE",
                        url: "http://localhost/PHP-EmployeeManagement/php-employee-management-v1/src/library/employeeController.php",
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
                                if (value == "") {
                                    return false;
                                } else {
                                    name_regex = /^[a-zA-Z-' ]*$/;
                                    return name_regex.test(value);
                                }
                                },
                            message: function(value, item) {
                                if (value == "") {
                                    return "The name is required";
                                } else {
                                    return "Please, use a valid name";
                                }
                            }
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
                                if (value == "") {
                                    return false;
                                } else {
                                    email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
                                    return email_regex.test(value);
                                }
                                },
                            message: function(value, item) {
                                if (value == "") {
                                    return "The email is required";
                                } else {
                                    return "Please, enter a correct email";
                                }
                            }
                        }
                    },
                    {
                        name: "age",
                        title: "Age",
                        type: "number",
                        align: "center",
                        width: 40,
                        validate: [
                            "required",
                            { validator: "range", param: [21, 80] },
                            function(value, item) {
                                return item.IsRetired ? value > 55 : true;
                            }
                        ]
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
                                    return value.length == 10 && phoneBelongsToCountry(value, item.Country);
                                },
                            message: function(value, item) {
                                return "Please, enter a correct phone number";
                            }
                        }
},

            

                    {
                        type: "control"
                    }
                ]
            });
        }).fail(function(status) {
            console.log("fail: " + status);
        });;
    </script>
</body>

</html>