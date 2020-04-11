
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
</body>
</html>
<?php
// Only for getting the data as well
$header[] = "Accept: application/json";
$header[] = "Content-Type:application/json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/getAllData");
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
$result=$result->res;
echo "<pre>";
$html="<table class='table table-bordered'><thead><tr>
<th>Id</th>
<th>Level</th>
<th>cvss</th>
<th>title</th>
<th>Vulnerability</th>
<th>Solution</th>
<th>Reference</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>";

foreach ($result as $row) {
$html.="<tr><th>".$row->id ."</th><th>".$row->level."</th><th>".$row->cvss.
"</th><th>".$row->title."</th><th>".$row->Vulnerability."</th><th>".$row->Solution.
"</th><th>".$row->reference."</th><th><form action='' method='post'>".
"<a href='/AssignmentFrontend/edit.php/?id=$row->_id'>Edit</a>"."</th><th>".
"<button type='submit' name='delete' class='btn btn-danger' value='$row->_id'>Delete</button>".
"</th></form>";
}
$html.="<tr><th><a href='/AssignmentFrontend/export.php'>
<button class='btn btn-primary'>Export</button></a></tr></table>";

echo $html;
?>

<?php
if (isset($_POST['delete'])) {
    $value2 = $_POST['delete'];
    $header[] = "Accept: application/json";
    $header[] = "Content-Type:application/json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/deleteSpecificData/$value2");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "<script>alert('data Deleted successfully');</script>";
    header("refresh: 1");
    // return $result;

}
?>

<?php

?>