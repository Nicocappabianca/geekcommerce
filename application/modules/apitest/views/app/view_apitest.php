<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>REST test test...</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="<?=base_url('assets/apitest/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/apitest/bootstrap/css/bootstrap-responsive.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/apitest/debug.css')?>" rel="stylesheet">

</head>

<body>

	<div class="hidden">

		<div class="httpfile">
			<a class="close">&times;</a>
			<div class="row show-grid">
				<div class="span2">
					<div class="control-group">
						<div class="controls">
							<input type="text" class="input-medium fakeinputname" value="">
						</div>
					</div>
				</div>

				<div class="span3">
					<div class="control-group">
						<div class="controls">
							<input class="input-file realinputvalue" multiple type="file">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="httpparameter">
			<a class="close">&times;</a>
			<div class="row show-grid">
				<div class="span2">
					<div class="control-group">
						<div class="controls">
							<input type="text" class="input-medium fakeinputname" value="">
						</div>
					</div>
				</div>

				<div class="span3">
					<div class="control-group">
						<div class="controls">
							<input type="text" class="input-xlarge realinputvalue" value="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="httpauth">
			<a class="close">&times;</a>
			<div class="row show-grid">
				<div class="span2">
					<div class="control-group">
						<div class="controls">
							<input type="text" class="input-medium fakeinputname" value="">
						</div>
					</div>
				</div>

				<div class="span3">
					<div class="control-group">
						<div class="controls">
							<input type="password" class="input-xlarge realinputvalue" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

	<div class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse"
					data-target=".nav-collapse"> <span class="icon-bar"></span> <span
					class="icon-bar"></span> <span class="icon-bar"></span>
				</a> <a class="brand" href="#">REST test test...</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li><a target="_blank" href="https://github.com/jeroenooms/resttesttest">Source Code</a></li>
						<li><a target="_blank" href="https://github.com/jeroenooms/resttesttest/issues/new">Submit Bug</a></li>
						<li><a target="_blank" href="http://jeroenooms.github.io">Author</a></li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row show-grid">
			<div id="leftcolumn" class="span6">
				<form id="paramform" class="well" target="outputframe">
					<fieldset>
						<legend>HTTP request options</legend>

						<br />


						<div class="row show-grid">
							<div class="span1">
								<div class="control-group">
									<label class="control-label" for="httpmethod">Method</label>
									<div class="controls">
										<select class="input-small" id="httpmethod">
											<option>GET</option>
											<option>POST</option>
  											<option>OPTIONS</option>
											<option>PUT</option>
											<option>DELETE</option>
											<option>HEAD</option>
										</select>
									</div>
								</div>
							</div>

							<div class="span4">
								<div class="control-group">
									<label class="control-label" for="urlvalue">Endpoint</label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="urlvalue"
											value="<?=base_url('api/bv1.0/')?>">
									</div>
								</div>
							</div>
						</div>

						<p class="help-block">Method and Endpoint are required. Click
							below to add additional parameters.</p>

						<div align="left">
							<button id="addauthbutton" class="btn btn-primary" style="margin-bottom: 1.5em;">
								<i class="icon-lock icon-white"></i> Add authentication
							</button>
						</div>

						<div id="authentication">

							<div class="row show-grid">
								<div class="span2">
									<div class="control-group">
										<label class="control-label">Username</label>
									</div>
								</div>

								<div class="span3">
									<div class="control-group">
										<label class="control-label">Password</label>
									</div>
								</div>
							</div>
						</div>

						<div id="allheaders">

							<div class="row show-grid">
								<div class="span2">
									<div class="control-group">
										<label class="control-label">Header Name</label>
									</div>
								</div>

								<div class="span3">
									<div class="control-group">
										<label class="control-label">Header Value</label>
									</div>
								</div>
							</div>

						</div>

						<div align="left">
							<button id="addheaderbutton" class="btn btn-primary">
								<i class="icon-plus icon-white"></i> Add header
							</button>
						</div>
						<br />

						<div id="allparameters">

							<div class="row show-grid">
								<div class="span2">
									<div class="control-group">
										<label class="control-label">Parameter Name</label>
									</div>
								</div>

								<div class="span3">
									<div class="control-group">
										<label class="control-label">Parameter Value</label>
									</div>
								</div>
							</div>

						</div>

						<div align="left">
							<button id="addprambutton" class="btn btn-primary">
								<i class="icon-plus icon-white"></i> Add parameter
							</button>
							<button id="addfilebutton" class="btn btn-primary">
								<i class="icon-file icon-white"></i> Add file
							</button>
						</div>
						<br />

						<div align="right">
							<button id="submitajax" class="btn btn-success btn-large">
								<i class="icon-download-alt icon-white"></i> Ajax request
							</button>
							<img src="spinner.gif" id="ajaxspinner" />
						</div>
					</fieldset>
				</form>

				<div id="errordiv"></div>
        
  			<div class="alert alert-info">
					<a class="close" data-dismiss="alert">&times;</a> <strong>Welcome!</strong>
          Use this simple page to poke around at the API.
          Specify HTTP method, URL and parameters, and click on <b>Ajax Request</b>.
          Note that this page requires a browser with HTML5 support.
				</div>

			</div>

			<div class="span6">
				<div id="ajaxoutput">
					<pre id="statuspre">0</pre>
					<pre class="pre-scrollable prettyprint linenums" id="outputpre"></pre>
					<pre class="pre-scrollable prettyprint linenums" id="headerpre"></pre>
				</div>
			</div>
		</div>

		<br>


	</div>

	<script src="<?=base_url('assets/apitest/jquery-1.10.2.min.js')?>"></script>
	<script src="<?=base_url('assets/apitest/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/apitest/debug.js')?>"></script>
  
</body>
</html>
