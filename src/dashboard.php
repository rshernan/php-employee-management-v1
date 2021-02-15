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
    <script>
    var employees = [{
        "id": "1",
        "name": "Rack",
        "lastName": "Lei",
        "email": "jackon@network.com",
        "gender": "man",
        "city": "San Jone",
        "streetAddress": "126",
        "state": "CA",
        "age": "24",
        "postalCode": "394221",
        "phoneNumber": "7383627627"
    },
    {
        "id": "2",
        "name": "John",
        "lastName": "Doe",
        "email": "jhondoe@foo.com",
        "gender": "man",
        "city": "New York",
        "streetAddress": "89",
        "state": "WA",
        "age": "34",
        "postalCode": "09889",
        "phoneNumber": "1283645645"
    },
    {
        "id": "3",
        "name": "Leila",
        "lastName": "Mills",
        "email": "mills@leila.com",
        "gender": "woman",
        "city": "San Diego",
        "streetAddress": "55",
        "state": "CA",
        "age": "29",
        "postalCode": "098765",
        "phoneNumber": "9983632461"
    }];
    $("#jsGrid").jsGrid({
        width: "100%",
        height: "100%",

        inserting: true,
        editing: true,
        sorting: true,
        paging: true,

        //data: employees,
        controller: {
        loadData: function(filter) {
            return $.ajax({
        type: "GET",
        url: "http://localhost/PHP-EmployeeManagement/php-employee-management-v1/resources/employees.json",
        data: filter,
        dataType: "json"
    }).then(function(result) {
        console.log(result.data)
        return result.data;
    });
            /* var deferred = $.Deferred();
            $.ajax({
                type: "get",
                url: "http://localhost/PHP-EmployeeManagement/php-employee-management-v1/resources/employees.json",
                dataType: "json",
                success: function(response) {
                    deferred.resolve(response.items);
                }
            });
            console.log(deferred.promise());
            return deferred.promise(); */
        }
    },

        fields: [
            { name: "name", title: "Name", type: "text", width: 150, validate: "required" },
            { name: "lastName", title: "Last name", type: "text", width: 150, validate: "required" },
            { name: "email", title: "Email", type: "text", width: 150, validate: "required" },
            { name: "gender", title: "Gender", type: "select", items: ["male", "female"], valueType: "string"},
            { name: "city", type: "text", width: 200 },
            { name: "streetAddress", type: "text", width: 200 },
            { name: "state", type: "text", width: 200 },
            { name: "age", type: "number", width: 50 },
            { name: "postalCode", type: "number", width: 50 },
            { name: "phone", type: "number", width: 50 },

            { type: "control" }
        ]
    });
</script>
</body>
</html>