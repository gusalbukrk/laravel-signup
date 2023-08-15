<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // preparing input before validation
        // couldn't find a native way of doing this inside controller, only inside custom Request class
        // https://laravel.com/docs/10.x/validation#preparing-input-for-validation
        // `boolean` validation rule only accepts `true`, `false`, `1`, `0`, `"1"`, and `"0"` and
        // radio inputs can only pass strings; therefore `"1"` and `"0"` are the only available options
        // however, such values would make error messages a bit weird
        // e.g. `The razao social field must be missing when is pessoa fisica is 1.`
        // couldn't find how to change `:value` placeholders inside controller, only inside custom Request class
        // https://laravel.com/docs/10.x/validation#specifying-values-in-language-files
        $request->whenHas('is_pessoa_fisica', function ($value) use ($request) {
            $request->merge([
                'is_pessoa_fisica' => $value === 'true' ? true : false,
            ]);
        });

        $rules = [
            // common fields
            'role' => 'required|string|in:cliente,empresa',
            'email' => 'required|email|min:10|unique:users',
            'celular' => 'required|string|regex:/^\d*$/|size:11|unique:users',
            'password' => 'required|string|min:8|confirmed',

            // cliente-only fields
            'inscricao_estadual' => 'required_if:role,cliente|missing_unless:role,cliente|string|regex:/^\d*$/|min:6|max:10|unique:clientes',
            'is_pessoa_fisica' => 'required_if:role,cliente|missing_unless:role,cliente|boolean',
            //
            // required only if: is_pessoa_fisica,true
            'nome' => 'missing_unless:role,cliente|required_if:is_pessoa_fisica,true|missing_if:is_pessoa_fisica,false|string|nullable|max:255',
            'cpf' => 'missing_unless:role,cliente|required_if:is_pessoa_fisica,true|missing_if:is_pessoa_fisica,false|string|nullable|regex:/^\d*$/|size:11|unique:clientes',

            // required only if: (role,cliente && is_pessoa_fisica,false) OR (role,empresa)
            'razao_social' => 'required_if:is_pessoa_fisica,false|missing_if:is_pessoa_fisica,true|required_if:role,empresa|string|nullable|max:255',
            //
            // NOTE: currently checking if CNPJ is unique in both clientes and empresas tables
            // would be better instead to check for uniqueness only in the table of the current role
            'cnpj' => 'required_if:is_pessoa_fisica,false|missing_if:is_pessoa_fisica,true|required_if:role,empresa|string|nullable|regex:/^\d*$/|size:14|unique:clientes|unique:empresas',

            // empresa-only fields
            'nome_fantasia' => 'missing_unless:role,empresa|string|nullable|max:255',
            'telefone_comercial' => 'missing_unless:role,empresa|string|nullable|regex:/^\d*$/|size:10|unique:empresas',
            'rua' => 'required_if:role,empresa|missing_unless:role,empresa|string|max:120',
            'numero' => 'required_if:role,empresa|missing_unless:role,empresa|integer',
            'bairro' => 'required_if:role,empresa|missing_unless:role,empresa|string|max:60',
            'cidade' => 'required_if:role,empresa|missing_unless:role,empresa|string|max:40',
            'estado' => 'required_if:role,empresa|missing_unless:role,empresa|string|max:25',
            'cep' => 'required_if:role,empresa|missing_unless:role,empresa|string|regex:/^\d*$/|size:8',
            'complemento' => 'missing_unless:role,empresa|string|max:255',
        ];

        $only_numbers_msg = 'O campo de :attribute deve conter apenas números.';
        //
        $messages = [ // custom error messages
            'celular.regex' => $only_numbers_msg,
            'inscricao_estadual.regex' => $only_numbers_msg,
            'cpf.regex' => $only_numbers_msg,
            'cnpj.regex' => $only_numbers_msg,
            'telefone_comercial.regex' => $only_numbers_msg,
            'cep.regex' => $only_numbers_msg,
        ];

        $attributes = [ // customize validation messages' `:attribute` placeholders
            'cpf' => 'CPF',
            'cnpj' => 'CNPJ',
            'cep' => 'CEP',
            'inscricao_estadual' => 'inscrição estadual',
            'razao_social' => 'razão social',
            'password' => 'senha',
            'role' => 'tipo de usuário',
            'is_pessoa_fisica' => 'é pessoa física',
        ];

        $fields = $request->validate($rules, $messages, $attributes);

        $roleClass = $fields['role'] === 'cliente' ? Cliente::class : Empresa::class;
        //
        $user = $roleClass::create($fields);
        $user->user()->create($fields);

        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';

        // https://laravel.com/docs/10.x/eloquent-relationships#one-to-one-polymorphic-retrieving-the-relationship
        // afterwards, use `auth()->user()->subclass` to get the subclass
        auth()->login($user->user);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->attempt($fields)) {
            return redirect('/');
        } else {
            return back()->with([
                'error' => 'credenciais incorretas',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
