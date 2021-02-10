<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorRequest
 * @package App\Http\Requests
 */
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
            // Felder text/done sind Pflichtfeld
            'text' => 'required|min:3|max:50',
            'done' => '',
        ];
    }

    /**
     * Gib mir meine eigenen Fehlermeldungen aus
     * Überschreiben der vordefinierten messages-Funktion mit engl. default Fehlermeldungen
     * @return array
     */
    public function messages()
    {
        return [
            'text.required'     => 'Bitte einen Text eingeben',
            'text.min'         => 'Der Text muss mindestens :min Zeichen enthalten',
            'text.max'         => 'Der Text darf maximal :max Zeichen enthalten',
        ];
    }
}
