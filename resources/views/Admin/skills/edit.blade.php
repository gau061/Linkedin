      <div class="modal fade" id="modal-default-{{ $val->id }}">
          <div class="modal-dialog">
           {!! Form::open(['method' => 'patch','route' => ['skills.update',$val->id]]) !!}
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Skills</h4>
              </div>
              <div class="modal-body full-width">

                  <label for="skill">Skills :</label><br>
                  {!! Form::text('skills',$val->skills,['class' => 'form-control']) !!}
                  <font color="red">@if($errors->has('skills'))<b> {{ $errors->first('skills') }}</b> @endif</font>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-flat">Update</button>
              </div>
            </div>
            {!! Form::close() !!}
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<style type="text/css">
   .full-width .form-control{
      display: inline-block !important;
      width:100% !important; 
   }
</style>