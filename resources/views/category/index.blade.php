@extends('layout.master')
@push('css')
    <style>
        .tree, .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .panel-primary > .panel-heading {
            color: #fff;
            background-color: #606ec3;
            border-color: #606ec3;
        }

        .panel-primary {
            border-color: #606ec3;
            margin: 3%;

        }

        .tree ul {
            margin-left: 1em;
            position: relative

        }

        .tree ul ul {
            margin-left: .5em

        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid

        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: black;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button, .tree li button:active, .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }
    </style>
@endpush
@section('content')
    <div style="width: 100%; display: flex; justify-content: space-between">
        <div>
            <form>
                <div class="input-group">
                    <input value="" name="search" type="search" class="form-control" placeholder="Search..."
                           id="top-search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4" style="text-align: right">
            <a href="{{ route('categories.add') }}" class="btn btn-success mb-2"><i
                        class="mdi mdi-plus-circle mr-2"></i> Add Category</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <ul id="tree1">
                @foreach($categories as $category)
                    <li>
                        <b>Name: </b><a href="{{ route('categories.detail', $category->id) }}">{{ $category->name }}</a>
                        <a href="{{ route('categories.create', $category->id) }}" style="margin-left: 10px"><i
                                    class="mdi mdi-plus-circle"></i></a>
{{--                        @if(count($category->children))--}}
                            @include('category.manage_child', ['categories' => $category->children])
{{--                        @endif--}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $.fn.extend({
            treed: function () {
                let openedClass = 'mdi-arrow-right-drop-circle';
                let closedClass = 'mdi-arrow-down-drop-circle';

                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator mdi " + openedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(closedClass + " " + openedClass);
                            $(this).children().children().toggle('mdi-arrow-down-drop-circle');
                        }
                    })
                    branch.children().children().toggle();
                });

                tree.find('.branch .indicator').each(function () {

                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
            }
        });
         $('#tree1').treed();
    </script>
@endpush
