<x-app-layout>

<div style="width:700px;margin:auto">

    <h2>Upload Post</h2>

    @if(session('success'))
        <p style="color:green">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('upload') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <p>Caption</p>

        <textarea
            name="caption"
            rows="3"
            style="width:100%"></textarea>

        <br><br>

        <input
            type="file"
            name="image">

        <br><br>

        <button>
            Upload
        </button>

    </form>

    <hr>

    <h2>Feed</h2>

    @foreach($posts as $post)

        <div style="margin-bottom:30px">

            <img
                src="{{ asset('storage/'.$post->image) }}"
                width="300">

            <p>

                {{ $post->caption }}

            </p>
            <form action="{{ route('like', $post->id) }}" method="POST">

                @csrf

                <button type="submit">
                    ❤️ Like ({{ $post->likes->count() }})
                </button>

            </form>

                        <hr>

            <form action="{{ route('comment', $post->id) }}" method="POST">

                @csrf

                <input
                    type="text"
                    name="comment"
                    placeholder="Tulis komentar">

                <button type="submit">
                    Kirim
                </button>

            </form>
            @foreach($post->comments as $comment)

            <p>

                <b>{{ $comment->user->name }}</b>

                : {{ $comment->comment }}

            </p>

        @endforeach

        </div>

    @endforeach

</div>

</x-app-layout>
