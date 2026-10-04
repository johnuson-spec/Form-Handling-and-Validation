<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterMemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function create()
    {
        return view('members.register');
    }

    public function store(RegisterMemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()->route('books.index')
            ->with('status', 'Member registered successfully.');
    }
}