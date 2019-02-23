<div id="update-{{ $exea->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-edit"> </i> @lang('words.exe_pro.text_1')</h4>
        </div>
        {!! Form::model($exea,['method' => 'patch','id' => 'experince','route'=>['experience.update',$exea->id]]) !!}
        <div class="modal-body">
            <div class="print-error-msg alert alert-danger" style="display: none;">
                <ul></ul>
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_2') </label>
                {!! Form::text('title',$exea->title,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_3') </label>
                {!! Form::text('company',$exea->company,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('words.exe_pro.text_4') </label>
                {!! Form::text('location',$exea->location,['class'=>'form-control query','id' => '','placeholder' => '']) !!}
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="form-group">
                  @php 
                      $exes = $exea->from;
                      $date = explode('-',$exes);
                  @endphp

                    <label>@lang('words.exe_pro.text_5')</label>
                    {!! Form::selectMonth('fmonth',$date[0],['class' => 'form-control','style'=>'border-radius:0px;','placeholder'=>trans('words.exe_pro.text_11')]) !!}
                    {!! Form::selectYear('fyear',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),$date[1],['class' => 'form-control','style'=>'border-radius:0px;margin-top:10px;','placeholder'=>trans('words.exe_pro.text_12')]) !!}
                  </div>
              </div>

            
              
              

              @php
                $data = $exea->to;
                $datas = explode('-',$data);
              @endphp

              @if(!empty($exea->to))
                <div class="col-md-6 col-sm-12 col-lg-6 to-yser">
                  <div class="form-group">
                    <label>@lang('words.exe_pro.text_5')</label>
                    {!! Form::selectMonth('tmonth',$datas[0],['class' => 'form-control','style'=>'border-radius:0px;','placeholder'=>trans('words.exe_pro.text_11')]) !!}
                    {!! Form::selectYear('tyear',date('Y'),date('Y', strtotime('-60 years', strtotime(date('Y')))),$datas[1],['class' => 'form-control','style'=>'border-radius:0px;margin-top:10px;','placeholder'=>trans('words.exe_pro.text_12')]) !!}
                  </div>
                </div>
              @else
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
              @endif  
            </div>


            @if(!empty($exea->to))
            <div class="form-group">
              <div class="checkbox checkbox-info checkbox-circle">
                  <input class="checkbox7" type="checkbox" name="cur" id="curd">
                  <label for="curd">
                      @lang('words.exe_pro.text_8')
                  </label>
              </div>
            </div>
            @else
            <div class="form-group">
              <div class="checkbox checkbox-info checkbox-circle">
                  <input class="checkbox8" type="checkbox" name="cur"  checked id="curd2">
                  <label for="curd2">
                      @lang('words.exe_pro.text_8')
                  </label>
              </div>
            </div>
            @endif
            <div class="form-group">
              <label>@lang('words.exe_pro.text_9')</label>
                {!! Form::textarea('description',$exea->description,['class' => 'form-control','style'=>'resize:none;']) !!}
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


