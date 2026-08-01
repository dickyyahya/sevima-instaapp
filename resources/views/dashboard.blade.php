<x-app-layout>

<style>
body{
    background:#f3f4f6;
    font-family:Arial, Helvetica, sans-serif;
}

.container{
    width:700px;
    margin:30px auto;
}

.card{
    background:#fff;
    border-radius:10px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

h2{
    margin-bottom:15px;
}

textarea,
input[type="text"]{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    margin-top:5px;
    box-sizing:border-box;
}

input[type="file"]{
    margin-top:10px;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:6px;
    cursor:pointer;
    margin-top:10px;
}

button:hover{
    background:#1d4ed8;
}

.post-image{
    width:100%;
    border-radius:10px;
    margin-bottom:10px;
}

.caption{
    font-size:16px;
    margin:10px 0;
}

.comment-box{
    background:#f8f8f8;
    padding:10px;
    border-radius:6px;
    margin-top:10px;
}

.comment-item{
    padding:6px 0;
    border-bottom:1px solid #ddd;
}

.comment-item:last-child{
    border-bottom:none;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:10px;
    border-radius:6px;
    margin-bottom:20px;
}

.feed-title{
    margin:25px 0 15px;
}
</style>

<div class="container">

    <div class="card">

        <h2>📷 Upload Post</h2>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('upload') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <label>Caption</label>

            <textarea
                name="caption"
                rows="3"></textarea>

            <br>

            <input
                type="file"
                name="image">

            <br>

            <button type="submit">
                Upload
            </button>

        </form>

    </div>

    <h2 class="feed-title">📰 Feed</h2>

    @foreach($posts as $post)

    <div class="card">

        <img
            src="{{ asset('storage/'.$post->image) }}"
            class="post-image">

        <div class="caption">
            {{ $post->caption }}
        </div>

        <form action="{{ route('like', $post->id) }}" method="POST">

            @csrf

            <button type="submit">
                ❤️ Like ({{ $post->likes->count() }})
            </button>

        </form>

        <hr style="margin:20px 0;">

        <form action="{{ route('comment', $post->id) }}" method="POST">

            @csrf

            <input
                type="text"
                name="comment"
                placeholder="Tulis komentar...">

            <button type="submit">
                Kirim
            </button>

        </form>

        <div class="comment-box">

            @forelse($post->comments as $comment)

                <div class="comment-item">
                    <strong>{{ $comment->user->name }}</strong>
                    <br>
                    {{ $comment->comment }}
                </div>

            @empty

                <p>Belum ada komentar.</p>

            @endforelse

        </div>

    </div>

    @endforeach

</div>

</x-app-layout>
