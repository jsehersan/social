  @if ($errors->first())
                    <div class="alert alert-ceta alert-danger">{{$errors->first()}}</div>
                    @endif

                    @if (Session::get('fallo'))
                    <div class="alert alert-ceta alert-danger">
                        @foreach(Session::get('fallo') as $f)
                        <ul>
                        <li>{{$f}}</li>
                        </ul>
                        @endforeach
                    </div>
                    @endif

                    @if (Session::get('ok'))
                    <div class="alert alert-ceta alert-success">
                        @foreach(Session::get('ok') as $o)
                        <ul>
                        <li><i style="font-size: 20px;" class="fa fa-smile-o"></i> {{$o}}</li>
                        </ul>
                        @endforeach
                    </div>
                    @endif


                    @if (Session::get('error'))
                        <div class="alert alert-ceta alert-danger"><span class="label label-danger">Atencion</span>
                        {{Session::get('error')}}</div>
                    @endif

                    @if (Session::get('message'))
                        <div class="alert alert-ceta alert-success"><span class="label label-success">Exito</span>
                        {{Session::get('message')}}</div>
                    @endif