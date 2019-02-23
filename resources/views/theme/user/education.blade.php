<div id="education" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"> </i> @lang('words.edu_pro.text_1')</h4>
      </div>
      {!! Form::open(['method' => 'post','id' => 'experince','route'=>'education.store']) !!}
        <div class="modal-body">
            <div class="print-error-msg alert alert-danger" style="display: none;">
                <ul></ul>
            </div>
            <div class="form-group">
              <label> @lang('words.edu_pro.text_2')</label>
              {!! Form::text('school','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_3')</label>
              {!! Form::text('course','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_4')</label>
              {!! Form::text('field','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_5')</label>
              {!! Form::text('grade','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_6')</label>
              {!! Form::text('activities','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_7')</label>
              {!! Form::selectYear('from',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),'',['class' => 'form-control','style' => 'border-radius:0px;','placeholder' => trans('words.edu_pro.text_9')]) !!}
            </div>
            <div class="form-group">
              <label>@lang('words.edu_pro.text_8')</label>
              {!! Form::selectYear('to',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),'',['class' => 'form-control','style' => 'border-radius:0px;','placeholder' => trans('words.edu_pro.text_10')]) !!}
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

