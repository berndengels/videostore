<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Gib Zustand der Auth-Funktion zurück (s. AuthorController)
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Felder firstname/lastname sind Pflichtfeld, Mindestlänge: 3 Zeichen
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
        ];
    }

    /**
     * Gib mir meine eigenen Fehlermeldungen aus
     * Überschreiben der vordefinierten messages-Funktion mit engl. default Fehlermeldungen
     * @return array
     */
    public function messages()
    {
//        return parent::messages();
        return [
            'firstname.required' => 'Bitte einen Vornamen eingeben',
            'lastname.required' => 'Bitte einen Nachnamen eingeben',
            'firstname.min' => 'Der Voname muss mindestens :min Zeichen enthalten',
            'lastname.min' => 'Der Nachname muss mindestens :min Zeichen enthalten',
        ];
    }
}
