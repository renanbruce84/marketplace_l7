<h1> Olá {{ $user->name }}! Tudo bem?</h1>

<h3> Obrigado por sua inscrição </h3>

<p> 
    Faça bom proveito e excelentes compras em nosso marketplace! <br>
    Seu email de cadastro é <strong> {{ $user->email }} </strong> <br>
    <strong>Por questões de segurança não enviamos sua senha.</strong>
</p>

<hr>

<span>Email enviado em {{ date('d/m/Y H:i:s') }}.</span>