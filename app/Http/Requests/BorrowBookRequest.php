<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BorrowBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => ['required', Rule::exists('members', 'id')],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $book = $this->route('book');

            if ($book->is_reference) {
                $validator->errors()->add('member_id', 'Reference books cannot be checked out.');
                return;
            }

            if ($book->members()->wherePivotNull('returned_at')->exists()) {
                $validator->errors()->add('member_id', 'This book is currently on loan to another member.');
            }

            $member = Member::find($this->member_id);
            if ($member) {
                $activeLoans = $member->books()->wherePivotNull('returned_at')->count();
                if ($activeLoans >= 3) {
                    $validator->errors()->add('member_id', 'This member already has 3 unreturned loans.');
                }
            }
        });
    }
}