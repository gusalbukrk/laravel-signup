@auth
    <h1>Welcome, {{ auth()->user()->email }} ({{ auth()->user()->subclass->cpf ?? auth()->user()->subclass->cnpj }})!</h1>
    <a href="/logout">Sair</a>
@else
    <a href="/login">Entrar</a>
    <a href="/signup">Cadastrar</a>
@endauth
