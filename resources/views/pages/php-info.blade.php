@extends('layout.mainlayout')

@section('title')
PHP Info
@endsection

@section('custom-style')
<!-- Custom style -->
<link href="{{asset('app-assets/css/custom.css')}}" rel="stylesheet">
@endsection


@section('page-content')

<!-- Page Content -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">PHP Info</h6>
    </div>

    <!-- Card Body -->
    <div class="card-body">
       
    	<div id='phpinfo'> 
    		<?php
			    ob_start();
			    phpinfo();
			    $phpinfo = ob_get_contents();
			    ob_end_clean();
			    $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);
			    echo $phpinfo;
			?>
    	</div>
	

    </div>
    <!-- End of Card Body -->
</div>
<!-- End of Page Content -->

@endsection