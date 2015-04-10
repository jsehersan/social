<?php  use Jsehersan\Social\Helper; ?>
@extends ('social::layout.base')




@section($tmp['section_main'])

	<div class="row">
        <div class="col-md-12">
        <div class="table-responsive">


              <table id="mytable" class="table table-bordred table-striped">

                   <thead>

                   <th><input type="checkbox" id="checkall" /></th>
                   <th>Titulo</th>
                   <th>Tipo</th>
                   <th>Estado</th>
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
        <td>{{$p->getStatus()}}</td>
        <td></td>
        {{--<td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Edit"><a data-title="Edit"  href="{{URL::to('social/config/channel/'.$ch->id)}}" ><i class="fa fa-pencil-square-o ceta-acciones-icon"></i></a></p></td>--}}
        {{--<td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Delete"><a href="javaScript::void(0)" onclick="borra({{$ch->id}})"  data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash-o ceta-acciones-icon"></i></a></p></td>--}}
    </tr>
  @endforeach



    </tbody>

</table>


            </div>

        </div>
	</div>


@stop
