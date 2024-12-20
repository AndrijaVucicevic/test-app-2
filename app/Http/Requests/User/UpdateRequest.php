<?php

namespace App\Http\Requests\User;

use App\Data\UserData;
use App\Rules\CustomerEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:users,id,' . $this->route('user')->id, new CustomerEmailRule(true)],
            'role'  => ['required', 'string', 'exists:roles,id'],
        ];
    }

    public function getData(): UserData
    {
        $data = $this->validated();
        unset($data['role']);
        return UserData::from([
            ...$data,
        ]);
    }
}
