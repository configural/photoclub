<div>
@foreach(\App\Photo::selectRaw('photos.*, (sum(recomendations.k) + sum(recomendations.o) + sum(recomendations.t)) as summa')
->join('recomendations', 'recomendations.photo_id', '=', 'photos.id')
->groupby('photos.id')
->whereBetween('photos.created_at', [date('Y-m-d', strtotime('now - 1 year - 1 month')), date('Y-m-d', strtotime('now - 1 year + 1 month'))])
->having('summa', '>', 5)
->inRandomOrder()
->orderby('summa', 'desc')
->limit(5)
->get()
as $photo)
<div class='preview-block'>
<a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/_{{ $photo->url }}" class="preview"></a>
                    <br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}">
                    <strong>{{ $photo->name }}</strong><br/>
                    @if($photo->user->name)
                        {{$photo->user->name}}
                        
                        @else
                        
                        @endif
                    </a>
</div>
@endforeach


</div>