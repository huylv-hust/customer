<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Create your profile</h2>

<div>

    {{ config('app.url').'/profile/'.$token }}.<br/>
    <p>Please click on above link to create new password. This link will expired at {{date('Y-m-d H:i:s', $time_expired)}}</p>

</div>

</body>
</html>