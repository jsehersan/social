@extends('social::layout.base')

@section('opc-header')

<div class="ceta-opc-header">
    <a id="lista" href="{{URL::to('social/channels')}}" style="color: #01B7F2"><i class="fa fa-list-alt"></i><p>Listado</p></a>
</div>
@stop

@section($tmp['section_main'])
	<div class="row">

    @if (isset($opciones))
    <div style="margin-bottom: 30px;">
    <button type="button"  class="btn btn-outline btn-primary  envia-config">Guardar configuración</button>
    </div>
      {{ Form::open(array('url' => 'social/config/save','method'=>'POST','class'=>'opciones-form','name'=>'opciones-form','id'=>'update-opciones'))}}

        @foreach($opciones as $o)

    <div class="row">
        <div class="col-lg-2 ceta-tipo-config">
        <span>{{$o->tipo}}</span>
        </div>
        <div class="col-lg-2">
        <span>{{$o->nombre}}</span>
        </div>
        <div class="col-lg-5">
        @if ($o->tipo=='channel' && $o->nombre=='main')
        <select class="form-control" name="{{$o->id}}">
          @foreach($channels as $ch)
          <option  value="{{$ch->id}}"@if ($o->valor==$ch->id)selected @endif>{{$ch->description}} -- {{$ch->type}}</option>
          @endforeach
        </select>
        @else
        {{Form::text($o->id, $o->valor, array('class' => 'form-control','required'=>'required' )) }}
        @endif
        </div>
    </div>
        @endforeach
      {{Form::close()}}

    @endif
    <div style="margin-top: 30px;">
    <button type="button"  class="btn btn-outline btn-primary  envia-config">Guardar configuración</button>
    </div>

</div>
@stop
@section('js')
@parent
{{--HTML::script('assets/js/index.js')--}}
<script type="text/javascript">

$( document ).ready(function() {
    $(".envia-config").click(function() {
    $("form#update-opciones").submit();

});


});
</script>
@stop