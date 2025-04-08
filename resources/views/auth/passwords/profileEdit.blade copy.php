@extends('layouts.admin')
@section('title', __('cruds.user.fields.password'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                            <h5> {{ trans('global.my_profile') }}
                            </h5>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-right">
                            <div style="margin-bottom: 10px;" class="row">
                                <div class="col-lg-12">
                                    <a class="btn  btn-sm btn-dark" href="{{ route('admin.home') }}" style="float:right;"
                                        title="{{ trans('global.back') }}">
                                        <i class="fas fa-backward" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password.updateProfile') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                    name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required" for="title">{{ trans('cruds.user.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"
                                    name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                    required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="profile_image">Profile Image (Max: 1MB, JPG/PNG)</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control"
                                    accept="image/*" onchange="previewImage(event)">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Preview Image:</label><br>
                                <img id="image_preview"
                                    src="{{ auth()->user()->profile_image ? asset('storage/profile_images/' . auth()->user()->profile_image) : asset('default_profile.png') }}"
                                    width="100" />
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required" for="title">New
                                    {{ trans('cruds.user.fields.password') }}</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    type="password" name="password" id="password" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required" for="title">Repeat New
                                    {{ trans('cruds.user.fields.password') }}</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button> &nbsp;
                            <a class="btn btn-light" title="{{ trans('global.cancel') }}"
                                href="{{ route('admin.home') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image_preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
