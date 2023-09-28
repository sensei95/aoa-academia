<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Validation\Validator;

class EmailVerificationRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {


        if(!$this->getUserFromUrl()) {
            return false;
        }

        if (! hash_equals((string) $this->getUserFromUrl()->id, (string) $this->route('id'))) {
            return false;
        }

        if (! hash_equals(sha1($this->getUserFromUrl()->email), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (! $this->getUserFromUrl()->hasVerifiedEmail()) {

            $this->getUserFromUrl()->markEmailAsVerified();

            event(new Verified($this->getUserFromUrl()));
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return \Illuminate\Validation\Validator
     */
    public function withValidator(Validator $validator)
    {
        return $validator;
    }

    public function getUserFromUrl() : ?User {
        return User::find($this->id);
    }
}
