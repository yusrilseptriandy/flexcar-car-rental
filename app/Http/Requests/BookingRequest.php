<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'item_id' => 'required|bi|exists:items,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:PENDING,SUCCESS,CANCEL',
            'payment_method' => 'required|string|in:CASH,TRANSFER',
            'total_price' => 'required|numeric|min:0',

        ];
    }
}
