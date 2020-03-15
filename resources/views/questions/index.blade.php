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
                    @foreach($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">　
                                <!-- 投票数の表示 -->
                                <strong>{{ $question->votes }}</strong>{{ str_plural('vote', $question->votes) }}
                                <!--str_pluralで単数形に変換 -->
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers }}</strong>{{ str_plural('answer', $question->answers) }}
                            </div>
                            <div class="view">
                                {{ $question->views . " " . str_plural('view', $question->views) }}
                            </div>

                        </div>
                        <div class="media-body">
                            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                            <p class="lead">
                                質問者:
                                <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            {{ str_limit($question->body, 250) }}
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="mx-auto">
                        {{ $questions->links() }} <!-- ページネーションでリンクを作成 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection