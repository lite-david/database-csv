<?php

function ExportExcel($table,$conn)
{
 
$filename = "uploads/".strtotime("now").'.csv';
 
$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

$num_rows = $result->num_rows;
if($num_rows >= 1)
{

	$row = $result->fetch_assoc();

	$fp = fopen($filename, "w");
	$seperator = "";
	$comma = "";
 
	foreach ($row as $name => $value)
		{
			$seperator .= $comma . '' .str_replace('', '""', $name);
			$comma = ",";
		}
 
	$seperator .= "\n";
	fputs($fp, $seperator);
 
	$result->data_seek(0);
	while($row = $result->fetch_assoc())
		{
			$seperator = "";
			$comma = "";
 
			foreach ($row as $name => $value) 
				{
					$seperator .= $comma . '' .str_replace('', '""', $value);
					$comma = ",";
				}
 
			$seperator .= "\n";
			fputs($fp, $seperator);
		}
 
	fclose($fp);
	echo "Your file is ready. You can download it from <a href='$filename'>here!</a>";
}
else
{
	echo "There is no record in your Database";
}
 
}
?>
