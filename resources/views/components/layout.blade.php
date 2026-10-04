@props(['title' => 'Library Circulation Desk'])
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; }
        label { display: block; margin-top: .75rem; }
        .error { color: #c00; margin: .25rem 0; }
        .error-summary { background: #fdecea; border: 1px solid #c00; padding: .5rem 1rem; }
        .success { color: #080; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('books.index') }}">Books</a> |
        <a href="{{ route('books.create') }}">Add Book</a> |
        <a href="{{ route('members.register') }}">Register Member</a>
    </nav>
    
    @if (session('status'))
        <p class="success">{{ session('status') }}</p>
    @endif

    {{ $slot }}
</body>
</html>