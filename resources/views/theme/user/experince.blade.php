<div id="myexe" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"> </i> @lang('words.exe_pro.text_1')</h4>
      </div>
      {!! Form::open(['method' => 'post','id' => 'experince','route'=>'experience.store']) !!}
        <div class="modal-body">
            <div class="print-error-msg alert alert-danger" style="display: none;">
                <ul></ul>
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_2') </label>
                {!! Form::text('title','',['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_3') </label>
                {!! Form::text('company','',['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_4') </label>
                {!! Form::text('location','',['class'=>'form-control query','id'=>'','placeholder' => '']) !!}
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="form-group">
                    <label>@lang('words.exe_pro.text_5')</label>
                    {!! Form::selectMonth('fmonth','',['class' => 'form-control','style'=>'border-radius:0px;','placeholder'=>trans('words.exe_pro.text_11')]) !!}
                    {!! Form::selectYear('fyear',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),'',['class' => 'form-control','style'=>'border-radius:0px;margin-top:10px;','placeholder'=>trans('words.exe_pro.text_12')]) !!}
                  </div>
              </div>
              <div class="pre-tag">
                <span class="pre">@lang('words.exe_pro.text_6')</span>
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 to-yser" style="display: none;">
                <div class="form-group">
                  <label>@lang('words.exe_pro.text_7')</label>
                  {!! Form::selectMonth('tmonth','',['class' => 'form-control','style'=>'border-radius:0px;','placeholder'=>trans('words.exe_pro.text_11')]) !!}
                  {!! Form::selectYear('tyear',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),'',['class' => 'form-control','style'=>'border-radius:0px;margin-top:10px;','placeholder'=>trans('words.exe_pro.text_12')]) !!}
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-info checkbox-circle">
                  <input class="checkbox8" type="checkbox" checked="" name="cur" id="test">
                  <label for="test">
                      @lang('words.exe_pro.text_8')
                  </label>
              </div>
            </div>
            <div class="form-group">
              <label>@lang('words.exe_pro.text_9')</label>
              {!! Form::textarea('description','',['class' => 'form-control','style'=>'resize:none;']) !!}
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

