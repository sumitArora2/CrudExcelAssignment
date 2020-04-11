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
$html="<table><thead><th>Id</th>
<th>Level</th>
<th>title</th>
<th>cvss</th>
<th>Vulnerability</th>
<th>Solution</th>
<th>reference</th>";


foreach ($result->res as $row) {
    $html.= '<tr><td>'. $row->id .'</td><td>'.
    $row->level .'</td><td>'.$row->title.
    '</td><td>'. $row->cvss.'</td><td>'. $row->Vulnerability."</td><td>".
    $row->Solution."</td><td>".$row->reference."</td></tr>";
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=data.xls');
echo $html;
?>