<x-layout title="Signup">
    <form action="/signup" method="POST">
        @csrf

        <div>
            <select name="role" id="role" required>
                <option value="cliente" {{ old('role') === 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="empresa" {{ old('role') === 'empresa' ? 'selected' : '' }}>Empresa</option>
            </select>
            <ul class="input-error">
                @foreach ($errors->get('role') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="{{old('email')}}" required>
            <ul class="input-error">
                @foreach ($errors->get('email') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="celular">celular</label>
            <input type="tel" name="celular" id="celular" value="{{old('celular')}}" required pattern="\d{11}" title="número de celular deve conter exatamente 11 dígitos">
            <ul class="input-error">
                @foreach ($errors->get('celular') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="password">senha</label>
            <input type="password" name="password" id="password" required minlength="8">
            <ul class="input-error">
                @foreach ($errors->get('password') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="passwordConfirmation">confirmação da senha</label>
            <input type="password" name="password_confirmation" id="passwordConfirmation" required minlength="8">
        </div>

        <div>
            <label for="inscricao_estadual">inscrição estadual</label>
            <input type="text" name="inscricao_estadual" id="inscricao_estadual" value="{{old('inscricao_estadual')}}" required pattern="\d{6,10}" title="inscrição estadual deve conter entre 6 e 10 dígitos" data-role="cliente">
            <ul class="input-error">
                @foreach ($errors->get('inscricao_estadual') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            {{-- `old('is_pessoa_fisica')` is either null, true or false --}}

            <input type="radio" name="is_pessoa_fisica" id="pessoa_fisica" value="true" required {{ old('is_pessoa_fisica') !== false ? 'checked' : '' }} data-role="cliente">
            <label for="pessoa_fisica">pessoa física</label>

            <input type="radio" name="is_pessoa_fisica" id="pessoa_juridica" value="false" {{ old('is_pessoa_fisica') === false ? 'checked' : '' }} data-role="cliente">
            <label for="pessoa_juridica">pessoa jurídica</label>

            {{-- unecessary, because before validation any value other than `'true'` is converted to false --}}
            {{-- <ul class="input-error">
                @foreach ($errors->get('is_pessoa_fisica') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul> --}}
        </div>

        <div>
            <label for="nome">nome</label>
            <input type="text" name="nome" id="nome" value="{{old('nome')}}" required data-role="cliente" data-pessoa="física">
            <ul class="input-error">
                @foreach ($errors->get('nome') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{old('cpf')}}" required pattern="\d{11}" title="CPF deve conter exatamente 11 dígitos" data-role="cliente" data-pessoa="física">
            <ul class="input-error">
                @foreach ($errors->get('cpf') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="razao_social">razão social</label>
            <input type="text" name="razao_social" id="razao_social" required maxlength="255" value="{{old('razao_social')}}" data-pessoa="jurídica">
            <ul class="input-error">
                @foreach ($errors->get('razao_social') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" required pattern="\d{14}" value="{{old('cnpj')}}" title="CNPJ deve conter exatamente 14 dígitos" data-pessoa="jurídica">
            <ul class="input-error">
                @foreach ($errors->get('cnpj') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>


        <div>
            <label for="nome_fantasia">nome fantasia</label>
            <input type="text" name="nome_fantasia" id="nome_fantasia" value="{{old('nome_fantasia')}}" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('nome_fantasia') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="telefone_comercial">telefone comercial</label>
            <input type="tel" name="telefone_comercial" id="telefone_comercial" value="{{old('telefone_comercial')}}" pattern="\d{10}" title="telefone comercial deve conter exatamente 10 dígitos" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('telefone_comercial') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="rua">rua</label>
            <input type="text" name="rua" id="rua" value="{{old('rua')}}" required maxlength="120" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('rua') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="numero">número</label>
            <input type="number" name="numero" id="numero" value="{{old('numero')}}" required data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('numero') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="bairro">bairro</label>
            <input type="text" name="bairro" id="bairro" value="{{old('bairro')}}" required maxlength="60" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('bairro') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="cidade">cidade</label>
            <input type="text" name="cidade" id="cidade" value="{{old('cidade')}}" required maxlength="40" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('cidade') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="estado">estado</label>
            <input type="text" name="estado" id="estado" value="{{old('estado')}}" required maxlength="25" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('estado') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" value="{{old('cep')}}" required pattern="\d{8}" title="CEP deve conter exatamente 8 dígitos" data-role="empresa">
            <ul class="input-error">
                @foreach ($errors->get('cep') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="complemento">complemento</label>
            <textarea name="complemento" id="complemento" maxlength="255" data-role="empresa">{{old('complemento')}}</textarea>
            <ul class="input-error">
                @foreach ($errors->get('complemento') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <input type="submit" value="Sign Up">
    </form>
    <style>
        /* https://www.geeksforgeeks.org/how-to-disable-arrows-from-number-input/ */
        #numero::-webkit-outer-spin-button,
        #numero::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /*  */
        #numero[type=number]{
            -moz-appearance: textfield;
        }

        div:has(input:disabled, textarea:disabled) {
            display: none;
        }

        /* .attribute {
            background-color: yellow;
        }
        .other {
            background-color: lightblue;
        }
        .value {
            background-color: lightgreen;
        } */
    </style>
    <script>
        const role = document.querySelector('#role');

        // common fields (email, password, razao_social, cnpj, ...) aren't selected by either query
        const clienteFields = document.querySelectorAll('[data-role="cliente"]');
        const empresaFields = document.querySelectorAll('[data-role="empresa"]');

        const pessoaFisicaFields = document.querySelectorAll('[data-pessoa="física"]'); // nome, cpf
        const pessoaJuridicaFields = document.querySelectorAll('[data-pessoa="jurídica"]'); // razao_social, cnpj

        const inputErrorUls = document.querySelectorAll('ul.input-error');

        function toggleInputs() {
            if (role.value === 'cliente') {
                clienteFields.forEach(f => f.disabled = false);
                empresaFields.forEach(f => f.disabled = true);

                const isPessoaFisica = document.querySelector(
                    '[name="is_pessoa_fisica"]:checked'
                ).value === 'true';

                if (isPessoaFisica) {
                    // no need because pessoaFisicaFields are also clienteFields
                    // pessoaFisicaFields.forEach(f => f.disabled = false);
                    //
                    pessoaJuridicaFields.forEach(f => f.disabled = true);
                } else {
                    pessoaFisicaFields.forEach(f => f.disabled = true);
                    pessoaJuridicaFields.forEach(f => f.disabled = false);
                }
            } else {
                clienteFields.forEach(f => f.disabled = true);
                empresaFields.forEach(f => f.disabled = false);

                // no need because pessoaFisicaFields are also clienteFields
                // pessoaFisicaFields.forEach(f => f.disabled = true);
                //
                pessoaJuridicaFields.forEach(f => f.disabled = false);
            }
        }

        toggleInputs();

        [role, ...document.querySelectorAll('[name="is_pessoa_fisica"]')].forEach(
            el => {
                el.addEventListener('change', () => {
                    // hide error messages from previous submit when rerendering
                    // because some messages may become outdated, for instance
                    // after submit form with role equal to cliente and is_pessoa_fisica set to true
                    // and then changing role to empresa
                    // error message for CNPJ field will be
                    // `O campo CNPJ é obrigatório quando o valor do campo é pessoa física é false.`
                    inputErrorUls.forEach(ul => { ul.style.display = 'none'; });

                    toggleInputs();
                });
            }
        );
    </script>
</x-layout>
