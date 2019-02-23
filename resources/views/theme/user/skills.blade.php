<div id="myskills" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"> </i> @lang('words.skill_pro.text_1')</h4>
      </div>
      {!! Form::open(['method' => 'post','route' => 'userskills.store']) !!}
        <div class="modal-body">
            <div class="print-error-msg alert alert-danger" style="display: none;">
                <ul></ul>
            </div>
            <div class="form-group">
                <label>@lang('words.skill_pro.text_1')</label><br>
                <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
                  @if(!empty($skills))
                    @foreach($skills as $key => $val)
                      @if(!empty($userkill))
                          <option value="{{ $val->id }}" {{in_array($val->id,$userkill)?'selected':''}}>{{ $val->skills }}</option>
                      @else
                          <option value="{{ $val->id }}">{{ $val->skills }}</option>
                      @endif
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary create">@lang('words.pro_btn.btn_1')</button>  
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('words.pro_btn.btn_2')</button>
      </div>
    </div>
        {!! Form::close() !!}
  </div>
</div>


