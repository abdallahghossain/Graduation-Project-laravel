<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('products.store')) {
            return [
                //
                'name' => [
                    'required', 'string', 'min:3', 'max:255',
                ],
                'description' => [
                    'required', 'string', 'min:5', 'max:200'
                ],
                'price' => [
                    'required','numeric','min:0'
                ],
                'compare_price' => [
                    'nullable','numeric','min:0'
                ],
                // 'image' => [
                //     'mimes:png,jpg', 'max:3025'
                // ],
                'status' => 'in:active,draft,archived',
            ];
         }
        // elseif (request()->routeIs('products.update')) {
        //     return[
        //         'name' => [
        //             'nullable', 'string', 'min:3', 'max:255'
        //         ],
        //         'price' => [
        //             'nullable','numeric','min:0'
        //         ],
        //         'compare_price' => [
        //             'nullable','numeric','min:0'
        //         ],
        //         'description' => [
        //             'nullable', 'string', 'min:5', 'max:200'
        //         ],
        //         'status' => 'nullable|in:active,draft,archived',
        //     ];
        // }
    }
}
