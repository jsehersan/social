
<div class="row cfg-facebook">
        <div class="row">
           <div class="col-md-2">
               <h5>@if($ch->validate()) <i class="fa fa-circle" style="color:limegreen;"></i> Online @else <i class="fa fa-circle" style="color:orangered;"></i> Offline @endif</h5>

           </div>

        </div>
        <div class="row">
            <p style="color: orangered">Para configurar el canal ir a la configuracion del paquete social</p>
            <div class="col-md-6">
                <h4>CONSUMER_KEY</h4>
                <p>{{Config::get('social::twitter.CONSUMER_KEY')}}</p>
                <h4>CONSUMER_SECRET</h4>
                <p>{{Config::get('social::twitter.CONSUMER_SECRET')}}</p>
                <h4>ACCESS_TOKEN</h4>
                <p>{{Config::get('social::twitter.ACCESS_TOKEN')}}</p>
                <h4>ACCESS_TOKEN_SECRET</h4>
                <p>{{Config::get('social::twitter.ACCESS_TOKEN_SECRET')}}</p>
            </div>
        </div>

</div>

@section('js')
@parent
    <script>
          jQuery(document).ready(function(){
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