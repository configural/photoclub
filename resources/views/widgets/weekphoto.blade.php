<div>
    Случайные фотографии, опубликованные в этом же месяце в прошлые годы (за все время существования Клуба).
@foreach(\App\Photo::selectRaw('photos.*, (sum(recomendations.k) + sum(recomendations.o) + sum(recomendations.t)) as summa')
->leftjoin('recomendations', 'recomendations.photo_id', '=', 'photos.id')
->groupby('photos.id')
//->whereBetween('photos.created_at', [date('Y-m-d', strtotime('now - 1 year - 1 week')), date('Y-m-d', strtotime('now - 1 year + 1 week'))])
->whereMonth('photos.created_at', '=', date('m'))
->whereYear('photos.created_at', '<', date('Y'))
//->having('summa', '>', 5)
->inRandomOrder()
->orderby('summa', 'desc')
->limit(8)
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
 ({{ @substr($photo->created_at, 0, 4) }})
                    </a>
</center>
</p>
@endforeach


</div>