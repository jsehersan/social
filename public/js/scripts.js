
//Canales


function saveChDes(id,dom){
	des=$('input[name="description"]').val();
	url=url_aj+'/savedeschannel';
  ch={
    description: des,
    id_ch: id
  };
	class_i=$(dom).find('i').attr('class');
	$.ajax({ 
         
         url : url,
         dataType: "json",
         type : "post",
         data:ch, 
         beforeSend: function(jqXHR) {  
                  $(dom).find('i').toggleClass('fa fa-spinner fa-spin',true);
            },
         success : function (req){     
                  $(dom).find('i').attr('class',class_i);
                  }            
             
//         },
//          error: function(jqXHR, textStatus, errorMessage) {
//                                alert(textStatus); // Optional
//                                }    
        
            }); 
}




//!!!