<tr>
    <td>{{ $collection->name }}</td>

    <td>{{$collection->videos()->count() }}</td>

    @if($added)
        <td>
            {{ $collection->updated_at->diffForHumans() }}
        </td>
    @endif

    @if($keywords)
        <td>{{ keywords($collection->keywords) }}</td>
    @endif

    <td>
        <a class="waves-effect waves-light btn" href="{{ url('/collection/edit/' . $collection->id) }}">
            edit
        </a>

        @if($delete)
            <a class="waves-effect waves-light btn js-delete" href="{{ url('/collection/delete/' . $collection->id) }}">
                <i class="material-icons">delete</i>
            </a>
        @endif
    </td>
</tr>