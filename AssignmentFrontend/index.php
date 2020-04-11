<html>

<head>
    <title>Assignment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Button_').click(function() {
                var name = document.getElementById('File_');
                var alpha = name.files[0];
                var data = new FormData();
                data.append('myfile', alpha);
                $.ajax({
                    url: 'http://localhost:3000/api/addData',
                    data: data,     
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(msg) {
                       
                        alert(msg.message);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <br>
    <input type="file"  name="File" id="File_" />
    <br>
    <input type="button" class="btn btn-primary" name="Button" id="Button_" value="UPLOAD">
    <br>
    <br>
    <a href="/AssignmentFrontend/showdata.php"><button class="btn btn-success">Show data</button></a>
</body>

</html>
