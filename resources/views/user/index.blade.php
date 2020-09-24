
@extends('template')

@section('header', $auth)
@section('title', trans('c.list'))

@section('title-btn')

@endsection

@section('body')
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>
                        name

                        <small style="color: blue;">
                            #email
                        </small>
                    </th>
                    <th>auth</th>
                    <th>{{trans('c.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}

                            <small style="color: blue;">
                                #{{$user->email}}
                            </small>
                        </td>
                        <td>{{$user->auth}}</td>
                        <td style="text-align: left;">

                            <button type="button" class="btn btn-sm btn-outline-secondary mb-1 mr-1" data-toggle="modal"
                                data-target="#update-{{$user->id}}">{{trans('c.edit')}}</button>
                            @include('user.modal.update')

                            <button type="button" class="btn btn-sm btn-outline-danger mb-1 mr-1" data-toggle="modal"
                                data-target="#delete-{{$user->id}}">{{trans('c.remove')}}</button>
                            @include('user.modal.delete')

                        </td>
                    </tr>
                @empty <td colspan="7" class="text-center">{{trans('c.no_data')}}</td>
                @endforelse
            </tbody>
        </table>
        @isset($params)
            {{$users->appends($params)->links()}}
        @else {{$users->links()}} @endisset
    </div>
@endsection
