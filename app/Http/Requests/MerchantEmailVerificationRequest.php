<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Http\FormRequest;

class MerchantEmailVerificationRequest extends EmailVerificationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! hash_equals((string) $this->user('merchant')->getKey(), (string) $this->route('id'))) {
            return false;
        }

        if (! hash_equals(sha1($this->user('merchant')->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

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
            //
        ];
    }
}
