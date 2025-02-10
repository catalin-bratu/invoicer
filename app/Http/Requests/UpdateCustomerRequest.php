<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'vat' => ['required', 'regex:/^[A-Z0-9]{8,20}$/', Rule::unique('customers')->where(fn (Builder $query) => $query->where('user_id', request()->user()->id))->ignore($this->route('customer'))],
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'iban' => 'nullable|regex:/^([A-Z]{2})(\d{2})([A-Z0-9]{4})([A-Z0-9]{4})([A-Z0-9]{4})([A-Z0-9]{4})([A-Z0-9]{0,4})$/',
            'bank' => 'nullable|string|max:255',
        ];
    }
}
