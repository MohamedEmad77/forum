@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading text-center">Edit discussion content</div>

                <div class="panel-body">
                    
                    <form action="{{route('discussion.update', ['id' => $d->id])}}" method="post">
                        {{csrf_field()}}


                        <div class="form-group">
                            <label for="content">Ask a question</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$d->content}}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Save changes</button>
                        </div>

            
                    </form>
            
                </div>
            </div>

@endsection
