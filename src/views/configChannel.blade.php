<?php  use Jsehersan\Social\Helper; ?>
@extends('social::layout.base')

@section('main')
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

				@if($ch->type=='f'){{HTML::Image(Helper::asset('img/icon_face.png'),'facebook',array('width'=>'50'))}} @endif

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