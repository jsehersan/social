<?php  use Jsehersan\Social\Helper; ?>
@extends ('social::layout.base')


@section($tmp['section_main'])
    <div class="row">
    <div class="col-md-6">
        <a href="{{URL::to('social/publications/clean')}}" class="btn btn-mini btn-danger"><i class="fa fa-trash"></i> Limpiar publicados</a>
        @if(Auth::user()->acl==3)
        <a href="{{URL::to('social/publications/cleanall')}}" class="btn btn-mini btn-default"><i class="fa fa-trash"></i> Limpiar todos</a>
        @endif
    </div>
    {{Form::open(array('method' => 'get')) }}
    <div class="col-md-1 pull-right">
        <button class="btn btn-mini btn-primary ">Filtrar</button>
     </div>

     <div class="col-md-3 pull-right">
        <select name="filter" class="form-control">
            <option {{{ (Request::get('filter')==0 ? 'selected' : '') }}} value="0">Pendientes</option>
            <option {{{ (Request::get('filter')==5 ? 'selected' : '') }}} value="5">Fallidos</option>
            <option {{{ (Request::get('filter')==1 ? 'selected' : '') }}} value="1">Publicados</option>
            <option {{{ (Request::get('filter')=='all' || Request::get('filter')==null ?  'selected' : '') }}} value="all">Todos</option>
        </select>
     </div>
     {{Form::close()}}
    </div>
	<div class="row">
        <div class="col-md-12">
        <div class="table-responsive">

              <table id="mytable" class="table table-bordred table-striped">

                   <thead>
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>Titulo</th>
                   <th>Tipo</th>
                   <th>Estado</th>
                   <th>Canal</th>
                   <th>Acciones</th>
                   {{--<th>Edit</th>--}}
                   {{--<th>Delete</th>--}}
                   </thead>
    <tbody>
  @foreach($post as $p )
    <tr>
        <td><input type="checkbox" class="checkthis" /></td>
        <td>{{$p->title}}</td>
        <td>{{$p->type_item}}</td>
        <td><span title="{{$p->result_post}}" class="@if ($p->status==0)naranja @elseif($p->status==1)verde @elseif($p->status==5)rojo @endif">{{$p->getStatus()}}</span></td>
        <td>
                @if($p->Channel()->type=='f')<i style="color:#3b5998"class="fa fa-facebook-official fa-2x"></i>
				@elseif($p->Channel()->type=='t')<i style="color:#55acee" class="fa fa-twitter-square fa-2x"></i>
				@endif
        </td>
        <td>
        <a title="Detalle" class="btn btn-success" href="{{URL::to('social/publication/'.$p->id)}}">Ver</a>
        @if($p->status!=1)<a title="Detalle" class="btn btn-warning" href="{{URL::to('social/publication/publish/'.$p->id)}}">Publicar</a>@endif
        {{--<button type="button" class="btn btn-warning">Publicar</button>--}}

        </td>
        {{--<td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Edit"><a data-title="Edit"  href="{{URL::to('social/config/channel/'.$ch->id)}}" ><i class="fa fa-pencil-square-o ceta-acciones-icon"></i></a></p></td>--}}
        {{--<td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Delete"><a href="javaScript::void(0)" onclick="borra({{$ch->id}})"  data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash-o ceta-acciones-icon"></i></a></p></td>--}}
    </tr>
  @endforeach



    </tbody>

</table>

            {{$post->links()}}
            </div>

        </div>
	</div>


@stop
