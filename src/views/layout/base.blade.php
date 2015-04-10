<?php use Jsehersan\Social\Helper; ?>

@extends($tmp['extends'])

@section('head')
    @parent
    <script type="text/javascript">
      url_aj="{{URL::to('social/aj/')}}";
    </script>
    <link rel="stylesheet" href="{{Helper::asset('css/style.css')}}">
@show

@section('js')
     @parent
     <script src="{{Helper::asset('js/scripts.js')}}"></script>
@stop
