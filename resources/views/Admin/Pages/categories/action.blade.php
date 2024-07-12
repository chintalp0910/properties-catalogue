<a href="{{ route('categories.edit', $id) }}" class="btn-sm btn btn-info">Edit</a>

<button type="button" class="btn-sm btn btn-danger " id="confirm-delete"
    data-id="{{ route('categories.destroy', $id) }}">Delete</button>
