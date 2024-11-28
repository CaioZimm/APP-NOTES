{{-- <style>
     form{
        background: linear-gradient(180deg, rgb(218, 218, 230), rgb(193, 201, 231));
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        border: 0.5px solid black;
        border-radius: 8px;
        width: 30rem;
        height: 35rem;
        padding: 1rem;
        box-shadow: 2px 2px 20px
    }
    
    h1{
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 1vh;
    }
    
    label{
        width: 90%;
        font-size: 20px;
        align-items: left;
        margin-top: 4vh;
    }

    input[type=email], input[type=password]{
        width: 90%;
        height: 3rem;
        background: transparent;
        border-bottom: 1px solid black;
        border-radius: 0px;
        font-size: 20px;
        color: rgb(6, 44, 68);
        outline: 0;
    }
    
    .esquece{
        margin-top: 2vh;
        width: 90%;
    }

    a{
        color: blue;
        text-decoration: underline;
    }
    
    button{
        margin-top: 4rem;
        border: 1px solid black;
        width: 90%;
        height: 4rem;
        border-radius: 8px;
        font-weight: bold;
        font-size: 24px;
        color: aliceblue;
        background-color: #244FDD;
        transition: calc(0.3s);
    }
    
    button:hover{
        margin-top: 4rem;
        border: 1px solid black;
        width: 90%;
        height: 4rem;
        border-radius: 8px;
        font-weight: bold;
        font-size: 24px;
        color: rgb(12, 12, 12);
        background-color: #a2dbe2;
    }
    
    .register{
        margin-top: 20px;
    }
</style> --}}

<div>
    <main class="w-full h-[50vh] flex items-center justify-center mt-32">
        <form wire:submit='login' class="bg-slate-400 flex items-center justify-start flex-col border border-black w-[30rem] h-[35rem] p-4 rounded-md">
            <h1>Login</h1>

            <label>Email</label>
            <input wire:model='email' type="email">

            <label>Senha</label>
            <input wire:model='password' type="password">
            <div>
                @error('erro')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <p class="esquece"> Esqueceu a senha? <a wire:navigate href="/"> clique aqui</a> </p>

            <button type="submit"> Entrar </button>

            <p class="register">Não tem conta ainda? <a href="/register"> Registrar aqui </a> </p>
        </form>
    </main>
</div>
