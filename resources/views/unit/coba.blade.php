@if(Session::has('alert-success'))
  <div class="alert alert-success" style="background-color:#dff0d8 !important; color:#00a65a !important">
      <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
  </div>
@endif
