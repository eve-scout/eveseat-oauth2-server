@extends('web::layouts.app-mini')

@section('title', trans('web::seat.sign_in'))

@section('content')
<div class="login-logo">
  S<b>e</b>AT | Single Sign On
</div>
<h2 class="text-center">Authorize {{ $client->getName() }} to use your account?</h2>

@if ($scopes)
<h4>This application will be able to:</h4>
@endif

<ul class="list-group">
@foreach ($scopes as $scope)
  <li class="list-group-item">{{ $scope->getDescription() }}</li>
@endforeach
</ul>

<form method="post" action="{{route('oauth2.authorize.post', $params)}}">
  {{ csrf_field() }}

  <input type="hidden" name="client_id" value="{{ $params['client_id'] }}">
  <input type="hidden" name="redirect_uri" value="{{ $params['redirect_uri'] }}">
  <input type="hidden" name="response_type" value="{{ $params['response_type'] }}">
  <input type="hidden" name="state" value="{{ $params['state'] }}">
  <input type="hidden" name="scope" value="{{ $params['scope'] }}">
  <input type="hidden" name="character_id" value="{{ $params['character_id'] ?: '' }}">

  <div class="pull-right">
    <button type="submit" name="deny" value="1" class="btn btn-default">Deny</button>
    <button type="submit" name="approve" value="1" class="btn btn-primary">Allow</button>
  </div>
</form>

@stop

@section('javascript')

<!-- jQuery Unveil -->
<script src="{{ asset('web/js/jquery.unveil.js') }}"></script>
<!-- SeAT JS -->
<script>
// Init the jQuery unveil plugin. If the
// viewport come into 100px, start loading
// the image
//
// http://luis-almeida.github.io/unveil/
$(document).ready(function () {
    $("img").unveil(100);
});
</script>

@stop