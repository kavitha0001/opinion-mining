
<?php
$pid = $_POST['ppid'];
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "ita");
$sql = "select review from reviews where pid='$pid'";
$result = $conn->query($sql);
$treview = "";
while ($row1 = mysqli_fetch_assoc($result)) {
	$treview = $row1['review'] . "\n" . $treview;
}

$myfile = fopen("userReview.txt", "w") or die("Unable to open file!");
$txt = $treview;
fwrite($myfile, $txt);
fclose($myfile);

$script_path = 'C:/xampp/htdocs/rating/admin/main.py';
$command = "python $script_path";
$output = shell_exec($command);
//print_r($output);
//echo $output[0];
//$output_array = json_decode($output);
//$rate = $rating[1];

$rating = $output;

$sql = "update products set rating='$rating' where pid='$pid'";
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "ita");
if ($conn->query($sql)) {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Product rating updated!!')
				window.location.href='admin-rate-product.php'
				</SCRIPT>");
}
