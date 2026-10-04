@if ($errors->any())
    <div class="error-summary">
        <strong>Please fix the {{ $errors->count() }} error(s) below.</strong>
    </div>
@endif

<x-forms.input name="isbn" label="ISBN (13 digits)" :value="$book->isbn" />
<x-forms.input name="title" label="Title" :value="$book->title" />
<x-forms.select name="author_id" label="Author" :options="$authors->pluck('name', 'id')" :selected="$book->author_id" />
<x-forms.input name="published_year" label="Published Year" type="number" :value="$book->published_year" />

<input type="hidden" name="is_reference" value="0">
<label>
    <input type="checkbox" name="is_reference" value="1" @checked(old('is_reference', $book->is_reference ?? false))>
    Reference Book (Cannot be borrowed)
</label>

@if ($book->cover_path)
    <div style="margin-top: 1rem;">
        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Cover" width="120">
    </div>
@endif

<x-forms.input name="cover" label="Cover Image" type="file" accept="image/jpeg,image/png" />