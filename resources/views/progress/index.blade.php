@extends('layouts.app')

@section('content')

<div class="container">
    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col">
            <a href="#" class="btn btn-link text-dark">← 戻る</a>
        </div>
    </div>

    <!-- プロフィール部分 -->
    <div class="d-flex align-items-center mb-4">
        <img src="{{ $user->profile_image ?? asset('images/default.jpg') }}" alt="プロフィール画像" class="profile-img rounded-circle me-3">
        <div>
            <h2 class="fw-bold">{{ $user->name }}さんの授業進捗</h2>
            <p class="fs-5">現在の学年: <span class="badge bg-info text-dark">{{ $currentGrade->name }}</span></p>
        </div>
    </div>

    <!-- 授業進捗リスト -->
    <div class="row">
        @foreach ($curriculums as $grade => $classes)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white fw-bold">
                        {{ $grade }}
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach ($classes as $class)
                                <li class="mb-2">
                                    @if ($class->is_completed)
                                        <span class="badge bg-danger me-2">受講済み</span>
                                    @endif
                                    <button class="btn btn-link" type="button" onclick="location.href='{{ route('user.show.delivery', ['id' => $class->id]) }}'" {{ $class->is_completed ? '' : 'disabled' }}> {{ $class->title }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection