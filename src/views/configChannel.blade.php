<?php  use Jsehersan\Social\Helper; ?>

@extends('social::layout.base')

@section('opc-header')
<div class="ceta-opc-header">
 <ul>
    <li><a id="lista" href="{{URL::to('social/channels')}}" style="color: #01B7F2"><i class="fa fa-list-alt"></i><p>Listado</p></a></li>

    <li>    <a id="nuevo" href="{{URL::to('social/channel/new')}}" style="color: #FDB714"><i class="fa fa-plus-square-o"></i><p>Nuevo</p></a></li>
 </ul>
</div>
@stop
@section($tmp['section_main'])
	<style type="text/css">
	.row{
		margin-top: 20px;
	}
	</style>

<div class="row">
	<div class="col-md-6">
		 	{{Form::open(array('url'=>URL::to('social/config/newChannel'),'method'=>'post'))}}
		 	{{ Form::hidden('id_ch', $ch->id) }}
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<h3>Channel <small>@if ($ch->type=='f')Facebook @endif </small></h3>
				</div>
				<div style="text-align:center;margin-top:15px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

				@if($ch->type=='f')<i style="color:#3b5998"class="fa fa-facebook-official fa-3x"></i>
				@elseif($ch->type=='t')<i style="color:#55acee" class="fa fa-twitter-square fa-3x"></i>
				@endif

				</div>
			</div>
			
			<div class="row">
				<div class="col-md-8">
					<input style="width:80%;display:inline;" type="text" name="description" id="inputDescription" class="form-control" value="{{$ch->description}}" placeholder="Descripcion">
					<a href="javascript:void(0)" onclick=saveChDes({{$ch->id}},this); id="save-ch-description"><i style="font-size:20px;color:green;" class="fa fa-floppy-o"></i></a>
				</div>
				 
			</div>

			{{-- <div class="row">
				<div style="text-align:center;margin-top:25px;"class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<input type="submit" value="Continue" class="btn btn-primary"/>
				</div>
				 
			</div> --}}
			{{Form::close()}}
	</div>
	<div class="col-md-6">
		@include('social::'.$ch->tmp_config)
	</div>
</div>			
@stop 