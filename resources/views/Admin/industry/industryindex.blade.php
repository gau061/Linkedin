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
	<div class="row">
			
        <div class="col-xs-12">
		@if($success = Session::get('success'))
		<div class="alert alert-success alert-flat">
			<b>{{ $success }}</b>
		</div>
		@endif
          <div class="box box-primary">
            <div class="box-header">
            	<a href="{{ route('industry.index') }}" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add Industry</a>
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th width="200px">Action</th>
                </tr>
               </thead>
                <tbody>
                @foreach($data as $key => $val) 
                <tr>
                  <td>{{ ++ $key }}</td>
                  <td>{{ $val->industry_name }}</td>
                   <td>{!! Str::words($val->industry_desc,20) !!}</td>
                  <td>
                    <a href="{{ route('industry.edit',$val->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a><!--btn-flat-->
                    <a href="{{ route('industry.delete',$val->id) }}" class="btn btn-danger " onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 
        </div>
       
        <!-- /.col -->
      </div>

@endsection 