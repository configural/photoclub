<p>Здравствуйте.</p>

<p>Вы запросили смену пароля в Фотоклубе Артема Кашканова.</p>

<p>Для выполнения процедуры, пройдите по этой ссылке: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>

<p>--</p>
<p>С уважением,
    Артем Кашканов</p>

