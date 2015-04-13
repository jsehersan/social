<?php  use Jsehersan\Social\Helper; ?>
@extends ('social::layout.base')




@section($tmp['section_main'])

<div class="row">
        <div class="row">
            <div class="col-md-6">
            <h3><small>Titulo</small> {{$post->title}}</h3>
            </div>
            <div class="col-md-4">
            <img class="img-responsive" src="{{$post->img}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <h3><small>Canal</small><a href="{{URL::to('social/config/channel/'.$post->id_channel)}}">{{$post->id_channel}}</a></h3>
            </div>
        </div>

</div>


@stop
