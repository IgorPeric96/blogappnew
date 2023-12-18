<div class="alert alert-light" role="alert">
    <h4>{{ $comment->user->name }}</h4>
    <p>{{ $comment->content }}</p>
    @if (auth()->id() === $comment->user_id)
    <form action="{{ url('comments/' . $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input class="form-control" type="text" name="content" placeholder="Edit comment" required />
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
        <form action="{{ url('comments/' . $comment->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </form>
        {{-- <a href="/deletecomment/{{ $comment->id }}"><button class="btn btn-primary">Delete</button></a> --}}
    @endif
</div>