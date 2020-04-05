<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">　
            <!-- 投票数の表示 -->
            <strong>{{ $question->votes_count }}</strong>{{ str_plural('vote', $question->votes_count) }}
            <!--str_pluralで単数形に変換 -->
        </div>
        <div class="status {{ $question->status }}">
            <strong>{{ $question->answers_count }}</strong>{{ str_plural('answer', $question->answers_count) }}
        </div>
        <div class="view">
            {{ $question->views . " " . str_plural('view', $question->views) }}
        </div>

    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
            <div class="ml-auto">
                @can("update",$question)
                <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-sm btn-outline-info">編集する</a>
                @endcan

                @can("delete",$question)
                <form class="form-delete" method="post" action="{{ route('questions.destroy',$question->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除しますか?')">削除</button>
                </form>
                @endcan
            </div>
        </div>
        <p class="lead">
            質問者:
            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
            <small class="text-muted">{{ $question->created_date }}</small>
        </p>
        <div class="excerpt">{{ $question->excerpt(350) }}</div>
    </div>
</div>