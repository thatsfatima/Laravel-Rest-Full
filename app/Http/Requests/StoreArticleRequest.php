<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'libelle' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            // 'status' => 'required|in:available,sold_out,archived',
        ];
    }
}


