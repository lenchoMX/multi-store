<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|alpha|min:3|max:20',
            'secondName' => 'nullable|alpha|min:3|max:20',
            'surname' => 'required|alpha|min:3|max:20',
            'lastName' => 'required|alpha|min:3|max:20',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'zip' => 'required|digits:5',
        ];
    }

    
    public function attributes()
    {
        return [
            'firstName' => 'Primer nombre',
            'secondName' => 'Segundo nombre',
            'surname' => 'Primer apellido',
            'lastName' => 'Segundo apellido',
            'email' => 'email',
            'phone' => 'Teléfono',
            'zip' => 'Código postal',

        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'El :attribute es requerido',
            'firstName.alpha' => 'Por favor ingrese un :attribute válido (solo letras)',
            'firstName.min' => 'Por favor ingrese un :attribute válido (mayor a 3 letras)',
            'surname.max' => 'Por favor ingrese un :attribute válido (menor a 20 letras)',

            'secondName.alpha' => 'Por favor ingrese un :attribute válido (solo letras)',
            'secondName.min' => 'Por favor ingrese un :attribute válido (mayor a 3 letras)',
            'surname.max' => 'Por favor ingrese un :attribute válido (menor a 20 letras)',

            'lastName.required' => 'El :attribute es requerido',
            'lastName.alpha' => 'Por favor ingrese un :attribute válido (solo letras)',
            'lastName.min' => 'Por favor ingrese un :attribute válido (mayor a 3 letras)',
            'surname.max' => 'Por favor ingrese un :attribute válido (menor a 20 letras)',

            'surname.required' => 'El :attribute es requerido',
            'surname.alpha' => 'Por favor ingrese un :attribute válido (solo letras)',
            'surname.min' => 'Por favor ingrese un :attribute válido (mayor a 3 letras)',
            'surname.max' => 'Por favor ingrese un :attribute válido (menor a 20 letras)',

            'email' =>  'Por favor ingrese un :attribute válido',
            'phone.required' =>  'Por favor ingrese un :attribute válido.',
            'phone.digits' =>  'Por favor ingrese un :attribute válido de 10 dígitos.',
            'zip.required' =>  'Por favor ingrese un :attribute válido.',
            'zip.digits' =>  'Por favor ingrese un :attribute válido de 5 dígitos.',
        ];
    }
}
