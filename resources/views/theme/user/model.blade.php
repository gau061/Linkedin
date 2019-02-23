<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->

    
  {!! Form::model($data,['method'=>'patch','route' => ['profile.update',$data->id]]) !!}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"> </i> @lang('words.usr_pro.text_15')</h4>
      </div>

        <div class="modal-body">
            <div class="print-error-msg alert alert-danger" style="display: none;">
                <ul></ul>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="fnm">@lang('words.usr_pro.text_1') <font color="#0077B5">*</font></label>
                {!! Form::text('firstname',$data->firstname,['class'=> 'form-control','id' => 'fnm']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="lnm">@lang('words.usr_pro.text_2') <font color="#0077B5">*</font></label>
                {!! Form::text('lastname',$data->lastname,['class'=> 'form-control','id' => 'lnm']) !!}
              </div>
              <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                <label for="abus">@lang('words.usr_pro.text_3') <font color="#0077B5">*</font></label>
                {!! Form::textarea('aboutus',$data->aboutus,['class'=> 'form-control','id' => 'abus','size' => '3x3','style' => 'resize:none']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="gen">@lang('words.usr_pro.text_4')</label>
                <br>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="0" {{ $data->gender == 0 ?'checked':'' }} >@lang('words.usr_pro.text_5')
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="1" {{ $data->gender == 1 ?'checked':'' }}>@lang('words.usr_pro.text_6')
                </label>
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="dob">@lang('words.usr_pro.text_7') <font color="#0077B5">*</font></label>
                {!! Form::text('birthdate',$data->birthdate,['class'=> 'form-control date','id' => 'dob']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="countries_states1">@lang('words.usr_pro.text_8') <font color="#0077B5">*</font></label>
                <select id="countries_states1" class="form-control bfh-countries" name="country" data-country="{{ $data->country }}" style="border-radius: 0px;"></select>
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="stat">@lang('words.usr_pro.text_9') <font color="#0077B5">*</font></label>
                <select class="form-control bfh-states" data-country="countries_states1" data-state="{{ $data->state }}" id="stat" name="state" style="border-radius: 0px;"></select>
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="city">@lang('words.usr_pro.text_10') <font color="#0077B5">*</font></label>
                {!! Form::text('city',$data->city,['class'=> 'form-control','id' => 'city']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="pincode">@lang('words.usr_pro.text_11') <font color="#0077B5">*</font></label>
                {!! Form::text('postalcode',$data->postalcode,['class'=> 'form-control','id' => 'pincode','onkeypress' => 'return isNumber(event)']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <label for="address">@lang('words.usr_pro.text_12') <font color="#0077B5">*</font></label>
                {!! Form::textarea('address',$data->address,['class'=> 'form-control','id' => 'address','size' => '3x5','style' => 'resize:none']) !!}
              </div>
              <div class="col-md-6 col-sm-12 col-lg-6 form-group">
                <div class="form-group">
                    <label for="phone">@lang('words.usr_pro.text_13')</label>
                    {!! Form::text('cellphone',$data->cellphone,['class'=> 'form-control','id' => 'phone','onkeypress' => 'return isNumber(event)']) !!}
                </div>
                <div class="form-group">
                    <label for="web">@lang('words.usr_pro.text_14')</label>
                    {!! Form::text('website',$data->website,['class'=> 'form-control','id' => 'web']) !!}
                </div>
              </div>
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