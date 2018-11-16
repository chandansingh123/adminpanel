<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>Hello <?php echo $bid->customer->first_name; ?> <?php echo $bid->customer->last_name; ?>,</p>
<p>Thank you for bidding our product.</p>
<p>Please <a href="<?php echo url('/') ?>">Click Here</a> to view your bid.</p>

<br/><br/>
<p>Thank You !!!</p>
<p>Saral Urja Nepal Pvt. Ltd.</p>
</body>
</html>