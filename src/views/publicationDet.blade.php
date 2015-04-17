<?php  use Jsehersan\Social\Helper; ?>
@extends ('social::layout.base')




@section($tmp['section_main'])

<div class="row">
        <div class="row">
            <div class="col-md-6">
            <h3><small>Titulo</small> {{$post->title}}</h3>
            <h3><small>Texto</small></h3><h5>{{$post->text}}</h5>

            </div>
            <div class="col-md-4">
            <img class="img-responsive" src="{{$post->img}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if($post->channel())
                <h3><small>Canal</small><a href="{{URL::to('social/config/channel/'.$post->channel_id)}}">
                    @if($post->Channel()->type=='f')<i style="color:#3b5998"class="fa fa-facebook-official fa-2x"></i>
                    @elseif($post->Channel()=='t')<i style="color:#55acee" class="fa fa-twitter-square fa-2x"></i>
                    @endif {{$post->channel_id}}- {{$post->channel()->description}}
                    </a></h3>
                @else
                <h3><small>Canal</small> No establecido </h3>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <h3><small>Estado</small> {{$post->getStatus()}}</h3>
            </div>
             <div class="col-md-6">
            <h3><small>Mensaje estado</small> {{$post->result_post}} </h3>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
            <h3><small>Link</small></h3><h5> <a href="{{URL::to($post->link)}}">{{$post->link}}</a></h5>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
            <h3><small>Creado</small> {{$post->created_at}}</h3>
            </div>
             <div class="col-md-6">
            <h3><small>Modificado</small> {{$post->updated_at}} </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <h3><small>Id_item</small> {{$post->id_item}} </h3>
            </div>
            <div class="col-md-6">
            <h3><small>Tipo de item</small> {{$post->type_item}}</h3>
            </div>
        </div>
</div>


@stop
