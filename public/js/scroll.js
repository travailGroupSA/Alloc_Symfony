$(document).ready(function(){
    let limit=7,
        offset=0;
        loadData(offset,limit);
        let zoneList = $('.scrollTable');
          zoneList.scroll(function(){
              console.log("scrolling");
              const st = zoneList[0].scrollTop;
              const sh = zoneList[0].scrollHeight;
              const ch = zoneList[0].clientHeight;
              console.log(sh);
              console.log(st);
              console.log(ch);
              if(sh-st<=ch+1){
                offset+=7;
                loadData(offset,limit);
                
              }
            })
  function loadData(offset,limit){
    $.ajax({
      url:"/traitement/",
      method:"POST",
      dataType:'text',
      data:{
          limit:limit,
          offset:offset
      },
      success:function(response){
          $('#tbody').append(response);
          offset=offset+7;
      }
    })
  }
  $('#submit').on('click',function(e){
              e.preventDefault();
                  selection=$('#select').children("option:selected").val();
                  search_value = $('#valeur').val();
              $.post(
                  //le fichier php à appeler
                  "{{path('scroll')}}",
                  //les donnees à envoyer
                  {
                      search_value:search_value,
                      selection:selection
                  },
                  //fonction de retour
                  function(data){
                      console.log(data);
                      $('#tbody').html(data);
                  },
                  //le type de retour
                  'text'
              )
          })
})