<div class="media post">
    @include('shared._vote',[
    'model' => $answer
    ])
    <div class="media-body">
        {!! $answer->body_html !!}
        <div class="row">
            <div class="col-4">
                <div class="ml-auto">
                    @can("update",$answer)
                    <a href="{{ route('questions.answers.edit',[$question->id,$answer->id]) }}" class="btn btn-sm btn-outline-info">編集する</a>
                    @endcan

                    @can("delete",$answer)
                    <form class="form-delete" method="post" action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除しますか?')">削除</button>
                    </form>
                    @endcan
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <user-info :model="{{ $answer }}" label="Answered"></user-info>

            </div>
        </div>
    </div>
</div>