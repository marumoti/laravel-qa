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
                    @include('questions._excerpt')
                    
                    @empty
                    <div class="alert alert-warning">
                        <strong>申し訳ありません</strong> 現在質問がございません
                    </div>
                    @endforelse

                        {{ $questions->links() }} <!-- ページネーションでリンクを作成 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection