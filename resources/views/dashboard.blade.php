
@extends('layouts.app')

@section('content')

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 {{ __('Підтвердіть свою адресу електронної пошти') }}</h3>
                </div>
                <div class="modal-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('На вашу електронну адресу надіслано нове посилання для підтвердження.') }}
                        </div>
                    @endif
                    {{ __('Перш ніж продовжити, перевірте свою електронну пошту на наявність посилання для підтвердження.') }}
                </div>
                <div class="modal-footer">
                    <a href="{{route('main')}}" class="btn btn-primary">{{ __('Ок') }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection








