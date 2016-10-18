@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Main collection</h2>
        <table>
            <thead>
            <tr>
                <th data-field="name">Name</th>
                <th data-field="video_count">Video Count</th>
                <th data-field="actions" width="200px">Actions</th>
            </tr>
            </thead>

            <tbody>
            @include('collections.partials.row', ['collection' => $main, 'keywords' => false, 'delete' => false, 'added' => false])
            </tbody>
        </table>

        <div class="divider"></div>

        <h2>Other collection</h2>

        <table>
            <thead>
            <tr>
                <th data-field="name" width="30%">Name</th>
                <th data-field="video_count">Video Count</th>
                <th data-field="added" width="30%">Added</th>
                <th data-field="keywords">Keywords</th>
                <th data-field="actions" width="200px">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($other as $row)
                @include('collections.partials.row', ['collection' => $row,'keywords' => true,  'delete' => true, 'added' => true])
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
                <form class="col s12" method="POST" action="{{ url('/collection/create') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Name" name="name" id="name" type="text" class="validate">
                            <label for="name">Name</label>
                        </div>
                    </div>

                    <div class='row'>
                        <button type='submit' name='btn_login'
                                class='col s12 btn btn-large waves-effect indigo'>Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection