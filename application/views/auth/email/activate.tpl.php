<html>
<body>
    <h1><? echo sprintf(lang('email_activate_heading'), $identity); ?></h1>

    <p><? echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'.$id.'/'.$activation, lang('email_activate_link'))); ?></p>
</body>
</html>