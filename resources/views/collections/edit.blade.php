@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row"></div>

        <div class="row">
            <form class="col s12" method="POST" action="{{ url('/collection/edit/' . $collection->id) }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s3">
                        <input placeholder="Name" name="name" id="name" value="{{ $collection->name }}" type="text"
                               class="validate">
                        <label for="name">Name</label>
                    </div>

                    @if($collection->id != 1)
                        <div class="input-field col s4">
                            <input placeholder="Keywords" name="keywords" value="{{ keywords($collection->keywords) }}"
                                   id="keywords" type="text" class="validate">
                            <label for="name">Keywords</label>
                        </div>
                    @endif

                    <button type='submit' name='btn_login'
                            class='col s2 btn waves-effect indigo'>Save
                    </button>

                        <div class="col s3">
                                <a class="bookmarklet"
                                   href="javascript:(function()%7Bfunction%20callback()%7B(function(%24)%7Bvar%20jQuery%3D%24%3Bvar%20url%20%3D%20window.location.href%3Bfunction%20youtube_parser(url)%7Bvar%20regExp%20%3D%20%2F%5E.*((youtu.be%5C%2F)%7C(v%5C%2F)%7C(%5C%2Fu%5C%2F%5Cw%5C%2F)%7C(embed%5C%2F)%7C(watch%5C%3F))%5C%3F%3Fv%3F%3D%3F(%5B%5E%23%5C%26%5C%3F%5D*).*%2F%3Bvar%20match%20%3D%20url.match(regExp)%3Breturn%20(match%26%26match%5B7%5D.length%3D%3D11)%3F%20match%5B7%5D%20%3A%20false%3B%7Dvar%20videoId%20%3D%20youtube_parser(url)%3Bif(!videoId)%20%7Balert('video%20id%20not%20found')%3B%7D%24.post('https%3A%2F%2F{{ $_SERVER['HTTP_HOST'] }}%2Fvideo%2FyoutubeAdd%2F{{ $collection->id }}'%2C%20%7Bvideoid%3A%20videoId%7D).then(()%20%3D%3E%20%7Balert('video%20added%20to%20collection!')%3B%7D%2C%20()%20%3D%3E%20%7Balert('something%20went%20wrong%2C%20maybe%20your%20not%20logged%20in%20or%20the%20video%20is%20already%20added%3F')%3B%7D)%7D)(jQuery.noConflict(true))%7Dvar%20s%3Ddocument.createElement(%22script%22)%3Bs.src%3D%22https%3A%2F%2Fajax.googleapis.com%2Fajax%2Flibs%2Fjquery%2F1.7.1%2Fjquery.min.js%22%3Bif(s.addEventListener)%7Bs.addEventListener(%22load%22%2Ccallback%2Cfalse)%7Delse%20if(s.readyState)%7Bs.onreadystatechange%3Dcallback%7Ddocument.body.appendChild(s)%3B%7D)()">
                                    foresee.tv {{ $collection->name  }}
                                </a>
                        </div>
                </div>
            </form>
        </div>

        <div class="row">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            @include('partial.flash')
        </div>

        <h2>Video</h2>

        <table class="video-table">
            <thead>
            <tr>
                <th data-field="name" width="50%">Title</th>
                <th data-field="added_at" width="20%">Added</th>
                <th data-field="image" width="10%">Image</th>
                <th data-field="image" width="10%">youtube</th>
                <th data-field="actions" width="100px">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($collection->videos as $video)
                <tr @if(Session::get('new_video_id') === $video->id) class="new" @endif>
                    <td>
                        {{ $video->title }}
                    </td>

                    <td>
                        {{ $video->updated_at->diffForHumans() }}
                    </td>

                    <td>
                        <a class="tooltip-image" data-tooltip-content="#tooltip_content_{{$video->id}}"
                           href="{{ $video->image }}" target="_blank">image</a>

                        <div class="tooltip_templates">
                            <span id="tooltip_content_{{$video->id}}">
                                <img src="{{ $video->image }}"/>
                            </span>
                        </div>
                    </td>

                    <td>
                        <span class="tooltip-video" data-tooltip="{{ $video->video_id }}">
                            <a href="http://youtube.com/watch?v={{ $video->video_id }}" target="_blank">link</a>
                        </span>
                    </td>

                    <td>
                        <a class="waves-effect waves-light btn js-delete"
                           href="{{ url('/video/delete/' . $video->id) }}">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
            <button class="btn-floating btn-large red btn modal-trigger" data-target="add" href="#add">
                <i class="large material-icons">add</i>
            </button>
        </div>
    </div>


    <div id="add" class="modal">
        <div class="modal-content">
            <div class="row">
                <form class="col s12" method="POST" action="{{ url('/video/create/' . $collection->id) }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Video id" name="videoid" id="videoid" type="text" class="validate">
                            <label for="name">video id</label>
                        </div>
                    </div>

                    <div class='row'>
                        <button type='submit' name='btn_login'
                                class='col s12 btn btn-large waves-effect indigo'>Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
