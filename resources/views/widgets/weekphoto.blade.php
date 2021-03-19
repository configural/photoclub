<div>
    Лучшие фотографии, опубликованные в это же время в прошлом году.
@foreach(\App\Photo::selectRaw('photos.*, (sum(recomendations.k) + sum(recomendations.o) + sum(recomendations.t)) as summa')
->join('recomendations', 'recomendations.photo_id', '=', 'photos.id')
->groupby('photos.id')
->whereBetween('photos.created_at', [date('Y-m-d', strtotime('now - 1 year - 1 month')), date('Y-m-d', strtotime('now - 1 year + 1 month'))])
->having('summa', '>', 6)
->inRandomOrder()
->orderby('summa', 'desc')
->limit(10)
->get()
as $photo)
<p>
<center>
<a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/_{{ $photo->url }}" class="preview"></a>
                    <br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}">
                    <strong>{{ $photo->name }}</strong><br/>
                    @if($photo->user->name)
                        {{$photo->user->name}}
                        
                        @else
                        
                        @endif
                    </a>
</center>
</p>
@endforeach


</div>