<a href="{{ route('authors.edit', $id) }}" class="btn-sm btn btn-info">Edit</a>

<button type="button" class="btn-sm btn btn-danger " id="confirm-delete"
    data-id="{{ route('authors.destroy', $id) }}">Delete</button>
