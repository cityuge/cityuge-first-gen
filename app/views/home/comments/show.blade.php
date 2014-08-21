@extends('layouts.home')

@section('content')

<div id="content" class="container">
    <div class="row">
        @include('partials.comments.commentItem')
        <div class="col-sm-6">
            {{-- Admin Section --}}
            @if (Auth::check())
                <h4>{{ trans('app.comment_show_admin') }}</h4>

                @if ($comment->deleted_at != null)
                    <p><span class="label label-danger">Deleted</span></p>
                @endif

                <dl>
                    <dt>{{ trans('app.comment_id') }}</dt>
                    <dd>{{ $comment->id }}</dd>
                    <dt>{{ trans('app.comment_ipAdress') }}</dt>
                    <dd>
                        {{{ $comment->ip_address }}}
                        <a class="btn btn-default btn-xs" href="http://whois.domaintools.com/{{{ $comment->ip_address }}}" target="_blank">{{ trans('app.comment_whois') }} <i class="fa fa-external-link"></i></a>
                    </dd>
                    <dt>Admin Notes</dt>
                    <dd>{{ $comment->admin_note }}</dd>
                </dl>



                @if ($comment->deleted_at == null) {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
                        <a href="{{ route('comments.edit', [$comment->id]) }}" class="btn btn-default" role="button"><i class="fa fa-edit"></i> Edit</a>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                    {{ Form::close() }}
                @else {{ Form::open(['route' => ['comments.restore', $comment->id], 'method' => 'POST']) }}
                        <a href="{{ route('comments.edit', [$comment->id]) }}" class="btn btn-default" role="button"><i class="fa fa-edit"></i> Edit</a>
                       <button type="submit" class="btn btn-success"><i class="fa fa-trash-o"></i> Restore</button>
                    {{ Form::close() }}
                @endif

            @endif

            {{--  Social media share buttons --}}
            <h4>{{ trans('app.comment_share') }}</h4>
            {{ trans('app.comment_show_shareDesc')}}

        </div>
    </div>
</div>

@stop

@section('footerScript')
    @parent
    <script>
        comment.initComment();
    </script>
@stop
