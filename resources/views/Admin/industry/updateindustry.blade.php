
@extends($AdminTheme)
@section('title','Industry')

@section('content-header')
  
  <section class="content-header">
      <h1>
        Industry
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Industry</li>
      </ol>
    </section>
@endsection

@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Industry</h3>
              <a href="{{ route('industry.display') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            {!! Form::model($data,['route'=>['industry.update',$data->id],'method'=>'put']) !!}

           
              <div class="box-body">
                  <div class="form-group col-md-12">
                    <label for="title">Title :</label>
                    {!! Form::text('industry_name',null,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Industry Name']) !!}
                    @if ($errors->has('industry_name')) <font color="red">{{ $errors->first('industry_name') }}</font> @endif 
                  </div>

                     <div class="form-group col-md-12">
                        <label for="description">Description :</label>
                        {!! Form::textarea('industry_desc',null,['placeholder'=>'Enter Your  description','id'=>'description','class'=> 'form-control summernote']) !!}
                        @if ($errors->has('industry_desc')) <font color="red">{{ $errors->first('industry_desc') }}</font> @endif 
                      </div>
              </div>
              <br/>
              <br/>
                      <div class="box-footer">
                        <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                      </div>
            {!! Form::close() !!}
            </form>
          </div>
@endsection