@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>全ての質問</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">新しく質問する</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')

                    @forelse($questions as $question)
                    <div class="media">
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
                    <hr>
                    @empty
                    <div class="alert alert-warning">
                        <strong>申し訳ありません</strong> 現在質問がございません
                    </div>
                    @endforelse

                    <div class="mx-auto">
                        {{ $questions->links() }} <!-- ページネーションでリンクを作成 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection