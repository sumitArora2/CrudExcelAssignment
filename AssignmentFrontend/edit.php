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
$id = $_GET['id'];
// Only for getting the data as well
$header[] = "Accept: application/json";
$header[] = "Content-Type:application/json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/getSpecificData/$id");
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
$result = $result->res;
$html="<table class='table table-bordered'><thead><th>Id</th>
<th>Level</th>
<th>title</th>
<th>cvss</th>
<th>Vulnerability</th>
<th>Solution</th>
<th>reference</th>
<th>Update</th>";

$html.='<tr><td>'. $result->id."</td><td>".$result->level.
"</td><td><form action='' method='post'>".
"<input type='text' name='title' value='$result->title'>" 
."</td><td>".
"<input type='text' name='cvss' value='$result->cvss'>"."</td><td>".$result->Vulnerability.
"</td><td>".$result->Solution."</td><td>".$result->reference.
"</td><td><button type='submit' name='Update' value='$result->_id'>Update</button></td>".
 "</form></th>";

echo $html;
?>
<?php
if (isset($_POST['Update'])) {
    $header[]="Accept: application/json";
    $header[]="Content-Type:application/json";
    $id = $_POST['Update'];
    $title = $_POST['title'];
    $cvss = $_POST['cvss'];
    $data_string = '{"Name" :$name,"Age":$age}';
    $api_data = array('title'=>$title,'cvss'=>$cvss);
    $api_data=json_encode($api_data);
    $ch = curl_init("http://localhost:3000/api/updateSpecificData/$id");                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
    curl_setopt($ch, CURLOPT_FAILONERROR, true);                                                                    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($api_data))                                                                       
    );                                                                                                                   
     
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $result = json_decode($result);
    // echo $result->message;
    echo "<script>alert('$result->message');</script>";
    header("refresh: 1");
    return $result;
}
?>
