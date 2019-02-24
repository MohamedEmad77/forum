@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading text-center">Create a new discussion</div>

                <div class="panel-body">
                    
                    <form action="{{route('discussion.store')}}" method="post">
                        {{csrf_field()}}


                        <div class="form-group">
                            <label for="content">Discussion title</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>

                        <div class="form-group">
                            <label for="channel_id">Select a channel</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                @foreach($channels as $channel)
                                    @if($channel->id == old('channel_id'))
                                        <option value="{{$channel->id}}" selected>{{$channel->title}}</option>
                                        @continue
                                    @endif
                                    <option value="{{$channel->id}}" >{{$channel->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Ask a question</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Create a discussion</button>
                        </div>

            
                    </form>
            
                </div>
            </div>

@endsection
