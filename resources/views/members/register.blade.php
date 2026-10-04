<x-layout title="Register Member">
    <h1>Register New Member</h1>
    <form method="POST" action="{{ route('members.register.store') }}">
        @csrf
        <x-forms.input name="name" label="Full Name" />
        <x-forms.input name="email" label="Email Address" type="email" />
        <x-forms.input name="date_of_birth" label="Date of Birth" type="date" />
        <x-forms.input name="password" label="Password" type="password" />
        <x-forms.input name="password_confirmation" label="Confirm Password" type="password" />
        
        <button type="submit" style="margin-top: 1rem;">Register Member</button>
    </form>
</x-layout>