@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{ $question->title }}</h1>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">全ての質問に戻る</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   {!! $question->body_html !!} <!-- マークダウンをHTMLに変換 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection