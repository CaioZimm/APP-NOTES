<div>
    <main>
        <form wire:submit='register'>
            <h1>Registrar</h1>

            <label>Nome</label>
            <input wire:model='name' type="text">

            <label>Email</label>
            <input wire:model='email' type="email">

            <label>Senha</label>
            <input wire:model='password' type="password">

            <label>Confirmar senha</label>
            <input wire:model='password_confirmation' type="password">

            <p> Já tem conta? <a wire:navigate href="/login">entrar aqui</a> </p>

            <button type="submit"> Registrar </button>
        </form>
    </main>
</div>
