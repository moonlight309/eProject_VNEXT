<ul>
    @foreach($categories as $category)
        <li>
            <b>Name: </b><a href="{{ route('categories.detail', $category->id) }}">{{ $category->name }}</a>
            <a href="{{ route('categories.create', $category->id) }}" style="margin-left: 10px"><i
                        class="mdi mdi-plus-circle"></i></a>
            @if(count($category->children))
                @include('category.manage_child', ['categories' => $category->children])
            @endif
        </li>
    @endforeach
</ul>
