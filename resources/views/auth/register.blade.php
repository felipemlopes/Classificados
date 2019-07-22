@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('postregister') }}">
                        @csrf

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <label class="h6" for="name">{{trans('app.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <label class="h6" for="email">{{trans('app.email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <label class="h6" for="username">{{trans('app.username')}}</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                                @error('username')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <label class="h6" for="gender">{{trans('app.gender')}}</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option></option>
                                    <option value="1">{{trans('app.genderlist.1')}}</option>
                                    <option value="2">{{trans('app.genderlist.2')}}</option>
                                    <option value="3">{{trans('app.genderlist.3')}}</option>
                                    <option value="4">{{trans('app.genderlist.4')}}</option>
                                    <option value="5">{{trans('app.genderlist.5')}}</option>
                                    <option value="6">{{trans('app.genderlist.6')}}</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <label class="h6" for="civil_status">{{trans('app.civilstatus')}}</label>
                                <select class="form-control" id="civil_status" name="civil_status">
                                    <option></option>
                                    <option value="1">{{trans('app.civilstatuslist.1')}}</option>
                                    <option value="2">{{trans('app.civilstatuslist.2')}}</option>
                                    <option value="3">{{trans('app.civilstatuslist.3')}}</option>
                                    <option value="4">{{trans('app.civilstatuslist.4')}}</option>
                                    <option value="5">{{trans('app.civilstatuslist.5')}}</option>
                                </select>
                                @error('civil_status')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('app.next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
