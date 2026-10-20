<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'teacher';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'nip' => ['required', 'string', 'max:30', Rule::unique('teachers', 'nip')->ignore($this->route('teacher'))],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'subject' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:30'],
            'status' => ['required', Rule::in(['Aktif', 'Tidak Aktif'])],
        ];
    }
}
