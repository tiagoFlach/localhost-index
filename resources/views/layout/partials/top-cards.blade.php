<!-- Content Row -->
<div class="row">

	<!-- PHP Card -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							<?php echo phpversion();?>
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">PHP</div>
					</div>
					<div class="col-auto">
						<i class="fab fa-php fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Apache Card -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							<?php echo apache_get_version();?> 
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Apache</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-feather-alt fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MySQL Card-->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
							<?php 
							if(function_exists('mysqli_connect')){
								$link = mysqli_connect( env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));
								echo $link->server_info; 
								mysqli_close($link);
								$icon = true;
							} else {
								echo "ERRO";
								$icon = false;
							}
							?>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">MySQL
									<?php
									if(!$icon){
										echo '<i class="far fa-times-circle text-danger"></i>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-database fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Browser Card -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
							<?php 
							function getBrowser() { 
								$u_agent = $_SERVER['HTTP_USER_AGENT']; 
								$bname = 'Unknown';
								$platform = 'Unknown';
								$version= "";
								$ub="";

								if (preg_match('/linux/i', $u_agent)) {
									$platform = 'linux';
								}
								elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
									$platform = 'mac';
								}
								elseif (preg_match('/windows|win32/i', $u_agent)) {
									$platform = 'windows';
								}

								if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
									$bname = 'Internet Explorer'; 
									$ub = "MSIE"; 
								} 
								elseif(preg_match('/Firefox/i',$u_agent)) { 
									$bname = 'Mozilla Firefox'; 
									$ub = "Firefox"; 
								} 
								elseif(preg_match('/Chrome/i',$u_agent)) { 
									$bname = 'Google Chrome'; 
									$ub = "Chrome"; 
								} 
								elseif(preg_match('/Safari/i',$u_agent)) { 
									$bname = 'Apple Safari'; 
									$ub = "Safari"; 
								}
								elseif(preg_match('/Opera/i',$u_agent)) { 
									$bname = 'Opera'; 
									$ub = "Opera"; 
								}
								elseif(preg_match('/Netscape/i',$u_agent)) { 
									$bname = 'Netscape'; 
									$ub = "Netscape"; 
								};


								$known = array('Version', $ub, 'other');
								$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
								if (!preg_match_all($pattern, $u_agent, $matches)) {

								}

								$i = count($matches['browser']);
								if ($i != 1) {
									if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
										$version= $matches['version'][0];
									} else {
										$version= $matches['version'][1];
									};
								} else {
									$version= $matches['version'][0];
								};
								if ($version==null || $version=="") {$version="?";}

								return array(
									'userAgent' => $u_agent,
									'name'      => $bname,
									'version'   => $version,
									'platform'  => $platform,
									'pattern'    => $pattern
								);
							}; 
							$ua=getBrowser();

							echo $ua['version'];

							?>
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo $ua['name']; ?>
						</div>
					</div>
					<div class="col-auto">
						<?php
						if($ua['name'] == 'Internet Explorer')
							echo '<i class="fab fa-internet-explorer fa-2x text-gray-300"></i>';
						elseif ($ua['name'] == 'Mozilla Firefox')
							echo '<i class="fab fa-firefox fa-2x text-gray-300"></i>';
						elseif($ua['name'] == 'Google Chrome')
							echo '<i class="fab fa-chrome fa-2x text-gray-300"></i>';
						elseif($ua['name'] == 'Apple Safari')
							echo '<i class="fab fa-safari fa-2x text-gray-300"></i>';
						elseif($ua['name'] == 'Opera')
							echo '<i class="fab fa-opera fa-2x text-gray-300"></i>';
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>