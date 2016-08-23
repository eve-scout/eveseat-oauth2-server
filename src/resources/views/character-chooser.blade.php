@extends('web::layouts.app-mini')

@section('title', trans('web::seat.sign_in'))

@section('content')
<div class="login-logo">
  S<b>e</b>AT | Single Sign On
</div>
<h2 class="text-center">Choose a Character</h2>
<form method="post" action="{{route('oauth2.character-chooser.post', $params)}}">
  {{ csrf_field() }}
  <ul class="list">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
  <div class="list-group">
    @foreach ($characters as $character)
      <button id="character-{{ $character->characterID }}" name="character_id" value="{{ $character->characterID }}" class="list-group-item row
        @if(setting('main_character_id') == $character->characterID)
          active
        @endif>
      ">
        <div class="col-md-3">
          {!! img('character', $character->characterID, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
        </div>

        <div class="col-md-7" style="padding-top: 10px;">
          <h4 class="list-group-item-heading">{{ $character->characterName }}</h4>
          <div class="list-group-item-text">{{ $character->corporationName }}</div>
        </div>
      </button>
    @endforeach
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