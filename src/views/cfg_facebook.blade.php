
<div class="row cfg-facebook">
        <h2>@if($ch->validate()) <i class="fa fa-circle" style="color:greenyellow;"></i>Online @else <i class="fa fa-circle" style="color:orangered;"></i>Offline @endif</h2>
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <div class="input-group">
                  <input name="fb-app-id"  type="text" @if($ch->getParam('APP_ID')) value="{{$ch->getParam('APP_ID')}}" @endif  class="form-control" placeholder="Facebook App ID" aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2">APP ID</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <div class="input-group">
                  <input name="fb-app-secret" @if($ch->getParam('APP_SECRET')) value="{{$ch->getParam('APP_SECRET')}}" @endif  type="password" class="form-control" placeholder="Facebook App Secret" aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2">APP SECRET</span>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <div class="input-group">
                          <input name="fb-page-id" @if($ch->getParam('PAGE_ID')) value="{{$ch->getParam('PAGE_ID')}}" @endif  type="text" class="form-control" placeholder="Facebook Page ID" aria-describedby="basic-addon2">
                          <span class="input-group-addon" id="basic-addon2">PAGE ID</span>
                        </div>
                    </div>
                </div>
		<div class="row">
		    <div class="col-md-2">
		        <button id="valida-id-secret" class="btn sample btn-sample btn-morado">Autorizar</button>
		    </div>
		    <div class="col-md-1">
		        <a id="valida-id-secret" href="{{URL::to('social/config/test?id_channel='.$ch->id)}}" class="btn  btn-warning">Probar</a>

		    </div>
		</div>
</div>

@section('js')
@parent
    <script>
          $(document).ready(function(){
                //Validar app y secret
                function validApp(id,secret,id_ch,page_id){
                        var data = {
                            id_app:id ,
                            secret_app:secret,
                            id_ch:id_ch,
                            page_id:page_id
                        }

                        var url=url_aj+'/validapp';
                        $.ajax({

                                 url : url,
                                 dataType: "json",
                                 type : "post",
                                 data:data,
                                 beforeSend: function(jqXHR) {
                                          $('.page-header h1').append("<i id='aj-loader' class='fa fa-spinner fa-spin'></i>");
                                    },
                                 success : function (req){
                                          $('#aj-loader').remove();

                                          // Si el canal no ha sido validado aun y tenemos url para login redirige
                                          if(!req.ch_status && req.url){
                                            window.location.href=req.url;
                                          }
                                          console.log(req);

                                          },

                                                    error: function(jqXHR, textStatus, errorMessage) {
                                                                          alert(textStatus); // Optional
                                                                          }

                                    });
                        }

                $('#valida-id-secret').click(function(){

                    id=$('input[name="fb-app-id"]').val();
                    secret=$('input[name="fb-app-secret"]').val();
                    id_ch=$('input[name="id_ch"]').val();
                    page_id=$('input[name="fb-page-id"]').val();
                    validApp(id,secret,id_ch,page_id);
                });










          });
    </script>
@stop