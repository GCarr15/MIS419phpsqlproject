<?php
// Multiple recipients
$to = 'grant.edward.carr@gmail.com, gcarr@go.olemiss.edu'; // note the comma

// Subject
$subject = 'Birthday Reminders for October';

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for October</title>
</head>
<body>
  <p>Here are the birthdays upcoming in October!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>October</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>October</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';


// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: gcarr@go.olemiss.edu';
$headers[] = 'From: gcarr@go.olemiss.edu';
$headers[] = 'Cc: gcarr@go.olemiss.edu';
$headers[] = 'Bcc: gcarr@go.olemiss.edu';

// Mail it

if (mail($to, $subject, $message, implode("\r\n", $headers))) {
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?>