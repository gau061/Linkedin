

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
          {!! Form::open(['route' => 'skills.store','method' => 'post']) !!}
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Skills</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="skill">Skills :</label>
                  {!! Form::text('skills','',['class' => 'form-control','id' => 'skill']) !!}
                </div>
                  <font color="red">@if($errors->has('skills'))<b> {{ $errors->first('skills') }}</b> @endif</font>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-flat">Save</button>
              </div>
            </div>
            {!! Form::close() !!}
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>