<div class="modal fade" id="{{ $val->id }}-modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">User View</h4>
              </div>
              <div class="modal-body">
                <table class="table table-bordered table-striped">
                  <tbody>
                     <tr>
                      <td colspan="2" class="text-center">
                        <img src="{{ adminUserData($val->id)->ProPic }}" class="text"  style="border-radius:50%; border:3px solid #afafaf; padding:3px; height:150px; " />
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Full Name</th>
                      <td>{{ $val->first_name }} {{ $val->last_name }}</td>
                    </tr>
                    <tr>
                      <th width="30%">User name</th>
                      <td>{{ $val->username }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Email</th>
                      <td>{{ $val->email }}</td>
                    </tr>
                    @if(! is_null($val->brith_date))
                    <tr>
                      <th width="30%">Brith Date</th>
                      <td><?php echo \Carbon\Carbon::createFromFormat('Y-m-d',$val->brith_date)->format('d-m-Y'); ?>
                      </td>
                    </tr>
                    @endif
                    <tr>
                      <th width="30%">Gender</th>
                      <td>{{ gender($val->gender) }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Status</th>
                      <td>{{ status($val->status) }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Current login</th>
                      <td>{{ $val->current_login }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Last login</th>
                      <td>{{ $val->last_login }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Create Date</th>
                      <td>{{ date_format($val->created_at,'d-m-Y') }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Update Date</th>
                      <td>{{ date_format($val->updated_at,'d-m-Y') }}</td>
                    </tr>
                  </tbody>  
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>