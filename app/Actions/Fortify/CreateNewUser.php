<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\Pessoa;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        /*  try { */
        if ($input['numero_identidade']) {
            $identidadeExist = Pessoa::where('numero_identidade', $input['numero_identidade'])->first();
            if ($identidadeExist) {
                throw ValidationException::withMessages([
                    'numero_identidade' => 'Número de identidade informado já existe registado.'
                ]);
            }
        }

        $emailExist = User::where('email', $input['email'])->first();
        if ($emailExist) {
            throw ValidationException::withMessages([
                'email' => 'Email informado já existe registado.'
            ]);
        }

        //dd($input);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ], [
            'password.min' => 'A palavra-passe deve ter no mínimo 6 caracteres. [A-Z, a-z, 0-9]',
            'password.confirmed' => 'A confirmação da palavra-passe não corresponde.'
        ])->validate();

        $pessoa = Pessoa::create([
            'nome' => $input['name'],
            'numero_identidade' => $input['numero_identidade'],
            'telefone' => $input['telefone'],
        ]);


        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'pessoa_id' => $pessoa->id,
            'categoria_id' => 3,
        ]);

        /* } catch (\Throwable $th) {
            //if ($th->getCode() == 10) {
              //  $msg = Crypt::encrypt($th->getMessage());
                //dd($th->getCode(), $msg);
               // return redirect()->route('erros', $msg);
            //}
        } */
    }
}
