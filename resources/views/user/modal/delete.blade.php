<div class="modal fade" id="delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="delete-{{$user->id}}"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">

                    <h3 class="block-title">remove_user</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('user.delete')}}" method="post"> @csrf
                    <div class="block-content font-size-sm">

                        <input type="hidden" name="id" value="{{$user->id}}">

                        <p>remove_user</p>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('c.close')}}</button>
                        <button type="submit" class="btn btn-danger">{{trans('c.remove')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
