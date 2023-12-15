<form action="{{ url('createcomment') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Comment</label>
        <input class="form-control" type="text" name="content" placeholder="Enter comment" required />
        <input type="hidden" value="{{ $post->id }}" name="post_id">
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
    </div>
    <button type="submit" class="btn btn-primary">Comment</button>
</form>