@extends('layouts.app')

@section('title')
{{$photo->name}}
@endsection


@section('content')

<!-- TinyMCE -->
<script type="text/javascript" src="{{url('/')}}/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
                language: "ru",
		//plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,",

		// Theme options
// Theme options
theme_advanced_buttons1 : "bold, italic,|, link, unlink, image",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_buttons4 : "",

theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
//theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		//template_external_list_url : "lists/template_list.js",
		//external_link_list_url : "lists/link_list.js",
		//external_image_list_url : "lists/image_list.js",
		//media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->




<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                
                    <a href="{{ url('/user/'.$photo->user->id.'')}}" class="user-link">
                            
                            @if ($photo->user->name)
                                {{ $photo->user->name }}
                            @else
                                id{{ $photo->user->id }}
                            @endif
                          </a>:
                    
                    {{$photo->category->name}} / {{ $photo->name }}
                    
                    <p class="pull-right"><i class="fa fa-calendar"></i> {{ $published_at }} &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> {{$photo->views}}&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-comments-o"></i> {{$comments->count()}}</p>

                
                </div>

                <div class="panel-body photobackground">
                <center>

                   @if($next)
                    <a href="{{url('/')}}/photo/{{ $next->id }}" title="Щелкните для перехода к следующему фото">
                   @endif
                        
                        <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" class="photo" id="photo">
                    @if($next)
                       </a>
                   @endif
                    <div class="photo-nav">
                        @if ($previous) 
                        <a href="{{url('/')}}/photo/{{ $previous->id }}" title="Предыдущее фото" class="btn btn-default"><i class="fa fa-chevron-left"></i> Назад </a> 
                        @endif
                        &nbsp;
                        @if ($next)                        
                        <a href="{{url('/')}}/photo/{{ $next->id }}" title="Следующее фото"  class="btn btn-default"> Вперед <i class="fa fa-chevron-right"></i></a>
                        @endif
                    </div>

                     @if ($photo->description)
                    <div class="photo-description" id="description">{!! $photo->description !!}</div>
                    @endif
                    

                    
                    <small>
                     @if($photo->Model)   
                        Камера: {{ $photo->Model }}<br/> 
                     @endif

                     @if($photo->ExposureProgram)     
                        Режим {{$photo->ExposureProgram}}, 
                     @endif
                     
                     @if($photo->FocalLength)     
                       фокусное расстояние: {{$photo->FocalLength}} мм, 
                     @endif
                     
                     @if($photo->ExposureTime)
                        выдержка: {{$photo->ExposureTime}} сек, 
                     @endif
                     
                     @if($photo->FNumber)
                        диафрагма: {{$photo->FNumber}}, 
                     @endif
                     
                     @if($photo->ISOSpeedRatings)
                        ISO{{$photo->ISOSpeedRatings}},
                     @endif
                     
                     @if($photo->ExposureBiasValue)
                        экспокоррекция: {{$photo->ExposureBiasValue}}EV, 
                     @endif
                        
                     @if($photo->Software)
                        <br/> ПО: {{$photo->Software}} 
                     @endif
                    </small>
                    
                                   <p>
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter"></div>
                    </p>     
                    </center>
                    
                    @if(Auth::user())
                    @if (Auth::user()->id == $photo->user_id || Auth::user()->admin)
                    <p><center><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default"><i class="fa fa-gear"></i> Редактировать описание</a></center></p>
                    @endif
                    @endif
                    
                   </div>



                </div>
             </div>
        </div>
    <!-- Комментарии -->
    
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                
                @foreach($comments as $comment)
                <a name="{{ $comment->id }}"></a>
                <div class="panel panel-default comment">
                    <div class="panel-heading">
                        <a href="{{ url('/user/'. $comment->user->id .'') }}" class="user-link">
                            @if ($comment->user->name)
                                {{ $comment->user->name }}
                            @else
                                id{{ $comment->user->id }}
                            @endif
                        </a>
                    
                        <span class="pull-right">
                        @if ($comment->created_at) 
                            
                        @endif
                        
                        @if ($comment->updated_at) 
                        <i class="fa fa-calendar"></i> {{ $comment->updated_at }}
                        @endif
                        </span>
                    
                    </div>
                    <div class="panel panel-body" id="">{!! $comment->bbCode($comment->text) !!}</div>
                    


                    
                    @if (Auth::user())
                    
                    @if (Auth::user()->id == $comment->user_id  || Auth::user()->admin)
                    <center>
                        [<a href="{{ url('/editcomment')}}/{{ $comment->id }}">Редактировать</a>] 
                        [<a href="{{ url('/deletecomment')}}/{{ $comment->id }}" onclick="return confirm('Действительно удалить?');">Удалить</a>]
                    </center>
                    @endif
                    
                    @endif 
                    
                </div>
                @endforeach
                
                <a name="comments"></a>
                
                 <div class="panel  panel-primary">
                     <div class="panel-heading">Добавить комментарий</div>
                     <div class="panel panel-body">
                      
                         
                         
                         @if(Auth::user())
                         <p>Вы вошли как {{ Auth::user()->name }}.</p>
                         <p>

                         </p>

                            <form name="addcomment" action="{{ url('/addcomment')}}" method="post">

                                
                                <p><textarea name="text" class="form-control coment-text"></textarea></p>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">


                                {{ csrf_field() }}

                                <p><button class="btn btn-success">Отправить комментарий</button></p>
                            </form>

                            @else 
                            Для комментирования нужно <a href="{{ url('/')}}/register">зарегистрироваться</a> или <a href="{{ url('/')}}/login">залогиниться</a>

                            @endif
                         
                         
                     </div>
                     
                 </div>

                
                
                </div>
                
                
                
    <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Реклама
                </div>

                <div class="panel-body">
                @include("ads.adsense")
                </div>
            </div>
                </div>
                
                
                
            </div>
            
           
        
    </div>
</div>



@endsection

