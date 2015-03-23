<?php  use Jsehersan\Social\Helper; ?>
@extends ('social::layout.base')


@section('main')
<div class="container">
	<div class="row">


        <div class="col-md-12">
        <h4>Canales disponibles</h4>
        <div class="table-responsive">


              <table id="mytable" class="table table-bordred table-striped">

                   <thead>

                   <th><input type="checkbox" id="checkall" /></th>
                   <th>Nombre</th>
                   <th>Tipo</th>
                   <th>Info_extra</th>
                      <th>Edit</th>

                       <th>Delete</th>
                   </thead>
    <tbody>
  @foreach($channels as $ch )
    <tr>
        <td><input type="checkbox" class="checkthis" /></td>
        <td>{{$ch->description}}</td>
        <td>@if($ch->type=='f'){{HTML::Image(Helper::asset('img/icon_face.png'),'facebook',array('width'=>'25'))}} @endif</td>
        <td>----</td>
        <td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Edit"><a class="btn btn-primary btn-xs" data-title="Edit"  href="{{URL::to('social/config/channel/'.$ch->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></p></td>
        <td class="col-md-1"><p data-placement="top" data-toggle="tooltip" title="Delete"><button onclick="borra({{$ch->id}})" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
  @endforeach




    </tbody>

</table>


            </div>

        </div>
	</div>
</div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">

       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

      </div>
        <div class="modal-footer ">
        <a id="delete-button" href="#" type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content -->
  </div>
      <!-- /.modal-dialog -->
    </div>
@stop
@section('js')
        <script>
         function borra(id){
                    var url = "{{URL::to('social/channel/delete?id=')}}"+id;
                    jQuery('#delete-button').attr('href',url);
                }
        $(document).ready(function(){
        $("#mytable #checkall").click(function () {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        });

        </script>

@stop