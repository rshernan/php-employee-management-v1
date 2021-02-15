<!-- TODO Main view or Employees Grid View here is where you get when logged here there's the grid of employees -->
<?php

?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script></head>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
</head>
<body>
    <div id="jsGrid"></div>
    <script>
    $("#jsGrid").jsGrid({
        width: "100%",
        height: "100%",

        inserting: true,
        editing: true,
        sorting: true,
        paging: true,

        //data: clients,
        controller: {
            loadData: function(filter) {
                var deferred = $.Deferred();
                $.ajax({
                    type: "get",
                    url: "./resources/employees.json",
                    dataType: "json",
                    success: function(response) {
                        deferred.resolve(response.items);
                    }
                });
                console.log(deferred.promise());
                return deferred.promise();
            }
        }

        fields: [
            { name: "name", title: "Name", type: "text", width: 150, validate: "required" },
            { name: "lastName", title: "Last name", type: "text", width: 150, validate: "required" },
            { name: "email", title: "Email", type: "text", width: 150, validate: "required" },
            { name: "gender", title: "Gender", type: "select", items: ["male", "female"], valueType: "string"},
            { name: "city", "City", type: "text", width: 200 },
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