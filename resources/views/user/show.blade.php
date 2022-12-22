@extends('layouts.dashboard', [
    'class' => '',
    'elementActive' => 'user',
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ $user->userProfile->bgphoto == '' ? asset('profiles/bgphoto/default-bgphoto.jpg') : asset('profiles/bgphoto') . '/' . $user->userProfile->bgphoto }}"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray"
                                    src="{{ $user->userProfile->photo == '' ? asset('profiles/default-avatar.png') : asset('profiles') . '/' . $user->userProfile->photo }}"
                                    alt="...">

                                <h5 class="title">
                                    {{ $user->userProfile->full_name == '' ? $user->name : $user->userProfile->full_name }}
                                </h5>
                            </a>
                            <p class="description">
                                @ {{ __($user->name) }}
                            </p>
                        </div>
                        <p class="description text-center">
                            {{ __('I like the way you work it') }}
                            <br> {{ __('No diggity') }}
                            <br> {{ __('I wanna bag it up') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        {{-- <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ __('12') }}
                                        <br>
                                        <small>{{ __('Files') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ __('2GB') }}
                                        <br>
                                        <small>{{ __('Used') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ __('24,6$') }}
                                        <br>
                                        <small>{{ __('Spent') }}</small>
                                    </h5>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Team Members') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            @if ($user->userProfile->teams)
                                @forelse($user->userProfile->teams->profile as $member)
                                    @if ($member->uid != $user->id)
                                        <li>
                                            <div class="row">
                                                <div class="col-md-2 col-2">
                                                    <div class="avatar">
                                                        <img src="{{ $member->photo == '' ? URL::asset('profiles/default-avatar.png') : URL::asset('profiles') . '/' . $member->photo }}"
                                                            alt="Circle Image"
                                                            class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-7">
                                                    {{ $member->full_name == '' ? $member->user->name : $member->full_name }}
                                                    <br />
                                                    <span class="text-muted">
                                                        <small>{{ __('Offline') }}</small>
                                                    </span>
                                                </div>
                                                <div class="col-md-3 col-3 text-right">
                                                    <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                            class="fa fa-envelope"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @empty
                                    <div>no team members !</div>
                                @endforelse
                            @else
                                <div>no team members !</div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-center">
                <div class="col-md-12">
                    @can('edit-profiles')
                        <form action="{{ route('profile.otherupdate',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        @endcan
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">{{ __('Edit Profile') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                value="{{ $user->userProfile->full_name == '' ? $user->name : $user->userProfile->full_name }}"
                                                required>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit"
                                            class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('edit-profiles')
                        </form>
                    @endcan
                </div>

                {{--
                <div class="card">
                    <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                --}}
                </form>
            </div>
        </div>
    </div>
@endsection
