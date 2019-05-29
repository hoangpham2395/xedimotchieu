{!! Form::open(['route' => ['posts.destroy', $id], 'method' => 'DELETE']) !!}
<!-- Modal -->
<div class="modal fade" id="modal_del_{{$entity->id}}" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Xóa bài đăng</h4>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{transa('cancel')}}</button>
                <button type="submit" class="btn btn-danger">{{transa('delete')}}</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}