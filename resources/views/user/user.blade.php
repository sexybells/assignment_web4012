@extends('layouts.app')

@section('content')

    <div class="col-md-12 col-lg-12">
        <div class="row">

            <div class="col-md-1">

            </div>
            <div class="col-md-2">
                <div class="header-card col-md-12 col-lg-12">
                    <div class="user">
                        <a class="avatar"><i class="fas fa-user"></i></a>
                        <a>{{ $user->name }}</a>
                    </div>
                </div>
                <div>
                    <form  @if(Auth::user()->id == $user->id)  action="{{ url('/update_profile/'.$user->id) }}" method="post" @endif style="margin-top: 15px;">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $user->name }}" @if(Auth::user()->id != $user->id) disabled @endif>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="dateOfBirth" placeholder="Enter date of birt" value="{{ date('Y-m-d', strtotime($user->dateOfBirth))}}" @if(Auth::user()->id != $user->id) disabled @endif>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="phoneNumber" placeholder="Enter phone number" value="{{ $user->phoneNumber }}" @if(Auth::user()->id != $user->id) disabled @endif>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}" @if(Auth::user()->id != $user->id) disabled @endif>
                        </div>

                        @if(Auth::user()->id == $user->id)
                        <button type="submit" class="btn btn-primary">Edit</button>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-md-8">

                    <div style="height: 15px; background: #f4f6f8;"></div>
                    <div class="form-post col-md-10 col-lg-10">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Create post</label>
                        </div>
                        <form action="{{ url('/post') }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="text" class="form-control" name="title-blog" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content-blog" placeholder="Enter content"></textarea>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category-blog">
                                    <option>Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div style="height: 15px; background: #f4f6f8;"></div>

                    @foreach($posts as $post)
                    <div style="height: 15px; background: #f4f6f8;"></div>
                    <div class="news-feed col-md-10">
                        <div class="header-card col-md-12 col-lg-12">
                            <div class="user">
                                <a class="avatar" href="{{ url('/user/'.$post->user->id) }}"><i class="fas fa-user"></i></a>
                                <a href="{{ url('/user/'.$post->user->id) }}">{{ $post->user->name }}</a>
                            </div>
                        </div>
                        <div class="body-card col-md-12 col-lg-12">
                            <div class="title-blog">
                                <a href="{{ url('/post/'.$post->id) }}"><p>{{ $post->title }}</p></a>
                                <p style="font-size: 18px;">{{ $post->category->name }}</p>
                            </div>
                            <div class="content-blog">
                                {{ $post->content }}
                            </div>
                        </div>
                        <div class="footer-card col-md-12 col-lg-12">
                            <div>
                                <a href="{{ url('/post/'.$post->id) }}" style="font-size: 18px;"><i class="fas fa-comment">Comment ( {{ $post->comments->count() }} )</i></a>
                            </div>
                        </div>
                    </div>
                    <div style="height: 15px; background: #f4f6f8;"></div>
                    @endforeach

                    <div>
                        {{ $posts->links() }}
                    </div>
            </div>

        </div>
    </div>

@endsection
