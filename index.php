<!-- TODO Application entry point. Login view -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Employee Management</title>
</head>
<body>
    <div class="card">
        <img src="assets/logoAssembler.png" class="card-img-top" alt="Responsive image">
        <form action="" class="card-body">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> Incorrect credentials.
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group row">
                <input type="email" name="" id="" class="form-control" placeholder="Email address">
            </div>
            <div class="form-group row">
                <input type="password" name="" id="" class="form-control" placeholder="Password">
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>