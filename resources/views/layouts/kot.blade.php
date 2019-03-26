@if(Auth::user())


<h3>Рекомендации</h3>
<table class="kot_table">
    <tr>
        <td class="kot_number " id='countK'>{{ $recK }}</td>
        <td class="kot_number kot_border" id='countO'>{{ $recO }}</td>
        <td class="kot_number kot_border" id='countT'>{{ $recT }}</td>
    </tr>
    <tr>
        <td class="kot_label"><span class="bukv">К</span>расиво</td>
        <td class="kot_label kot_border "><span class="bukv">О</span>ригинально</td>
        <td class="kot_label kot_border"><span class="bukv">Т</span>ехнично</td>
        
    </tr>
    @if(Auth::user()->id != $photo->user_id)
    <tr>
        <td class="kot_button "><span class="btn btn-info" id="buttonK" title="Красиво">Рек!</span> </td>
        <td class="kot_button kot_border"><span class="btn btn-info" id="buttonO" title="Оригинально">Рек!</span> </td>
        <td class="kot_button kot_border"><span class="btn btn-info" id="buttonT" title="Технично">Рек!</span></td>
    </tr>
    @endif
</table>


            
                
            
                
            </p>

    


<script>

$('#buttonK').click(function(){
$.get( "{{ url('/ajax/rec') }}",  
    {
      "photo_id" : "{{ $photo->id }}",
      "rec" : "K"
  },
  onRecSuccess);
});


$('#buttonO').click(function(){
$.get( "{{ url('/ajax/rec') }}",  
    {
      "photo_id" : "{{ $photo->id }}",
      "rec" : "O"
  },
  onRecSuccess);
});

$('#buttonT').click(function(){
$.get( "{{ url('/ajax/rec') }}",  
    {
      "photo_id" : "{{ $photo->id }}",
      "rec" : "T"
  },
  onRecSuccess);
});



function onRecSuccess(data)
{
  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
  $("#countK").html(data["k"]);
  $("#countO").html(data["o"]);
  $("#countT").html(data["t"]);
}

</script>
    
@endif