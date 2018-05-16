<?php

function contractStudentEmail($student_email, $student_name){

//$to = "curringtpm17@uww.edu";
$to = $student_email;
$subject = "CSD-Transportation: Contract Confirmation";

$message = "
<html>
<head>
<title>CSD-Transportation: Contract Confirmation</title>
</head>
<body>
<p>Hello {$student_name},</p>
<p>Thank you for submitting your application. You may now begin requesting rides according to your schedule.</p>
<p>If you have any questions or need any help with setting up your rides, please feel free to contact the CSD-Transportation Department. We are happy to help!</p>
<br/>
<p>Thank you and have a great day!</p>
<br/>
<table>
<tr>
<th>Center for Students with Disabilities</th>
</tr>
<tr>
<td>Anderson Library Room 2002</td>
</tr>
<tr>
<td>800 West Main Street</td>
</tr>
<tr>
<td>Whitewater, WI 53190</td>
</tr>
<tr>
<td>CSD Office Phone: (262) 472-4711</td>
</tr>
<tr>
<td>Dispatch: (262) 472-4712</td>
</tr>
<tr>
<td>Email: transcsd@uww.edu</td>
</tr>



</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <curringtpm17@uww.edu>' . "\r\n";
$headers .= 'Cc: curringtpm17@uww.edu' . "\r\n";


mail($to,$subject,$message,$headers);
}

?>

