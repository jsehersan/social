@extends('social::layout.base')

@section('opc-header')

<div class="ceta-opc-header">
    <a id="lista" href="{{URL::to('social/channels')}}" style="color: #01B7F2"><i class="fa fa-list-alt"></i><p>Listado</p></a>
</div>
@stop

@section($tmp['section_main'])
	<style type="text/css">
	/*.row{*/
		/*margin-top: 20px;*/
	/*}*/
	</style>

 	{{Form::open(array('url'=>URL::to('social/config/newChannel'),'method'=>'post'))}}
	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			{{--<h3>New Channel</h3>--}}
		</div>
		<div style="text-align:center;margin-top:15px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<select name="type-channel" id="inputType-Channel" class="form-control" required="required">
				<option value="f">Facebook</option>
				<option value="t">Twitter</option>
			</select>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<input type="text" name="description" id="inputDescription" class="form-control" value="{{Input::old('description')}}" placeholder="Descripcion">
		</div>
		 
	</div>

	<div class="row">
		<div style="text-align:center;margin-top:25px;"class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<input type="submit" value="Continue" class="btn btn-primary"/>
		</div>
		 
	</div>
	{{Form::close()}}
@stop 