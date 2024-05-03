
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($student as $std)
                    <tr>
                        <td>{{$std->name}}</td>
                        <td>{{$std->email}}</td>
                        <td>{{$std->password}}</td>
                        <td><img width="300px" src="{{asset('/storage/image/'.$std->image)}}" height="200px" alt=""></td>
                        <td><a class="btn btn-primary" href="edit/{{$std->id}}">Edit</a></td>
                        <td><a class="btn btn-danger" href="delete/{{$std->id}}">Delete</a></td>
                    </tr>
                @endforeach    
                </tbody>
            </table>
    </div>
      
     </body>
</html>