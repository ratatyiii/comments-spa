<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'integer',
                'exists:comments,id',
            ],
            'username' => [
                'required',
//                'regex:/^[\p{L}a-zA-Z0-9]+$/u',
                'alpha_dash',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
            ],
            'home_page' => [
                'nullable',
                'url',
            ],
            'text' => [
                'required',
                'regex:/^(<a\s+(?:[^>]*\s+)?href="[^"]*"\s*(?:[^>]*\s+)?title="[^"]*"\s*(?:[^>]*)?>.*<\/a>|<code>(?:[^<]|<\/?[^c]|<\/c[^o]|<\/co[^d]|<\/cod[^e]|<\/code[^>])*<\/code>|<i>(?:[^<]|<\/?[^i]|<\/i[^>])*<\/i>|<strong>(?:[^<]|<\/?[^s]|<\/s[^t]|<\/st[^r]|<\/str[^o]|<\/stro[^n]|<\/stron[^g]|<\/strong[^>])*<\/strong>|<p>(?:[^<]|<\/?[^p]|<\/p[^>])*<\/p>|[^<]+)*$/u',
            ],
        ];
    }
}
