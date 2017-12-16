<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">
		
		<title>Auth</title>
		
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		
		<style type="text/css">
			.panel-heading div a{
				display:block;
				font-weight: 700;
				padding: .375rem .75rem;
				font-size: 1rem;
				line-height: 1.5;
				cursor:pointer
			}
			a.active{
				color: #fff !important;
				background-color: #007bff;
				border-color: #007bff;
				white-space: nowrap;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				border: 1px solid transparent;
				
				transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

			}
		</style>
		<!-- Custom styles for this template -->
		
	</head>
	
	<body>
		
		<div class="container">
			<div class="row" style="margin:10% auto;">
				<div class="col-6 offset-3">
					<div class="panel">
						
						<div class="panel-heading">
							
							<div class="row text-center">
								<div class="col">
									<a id="btn-to-form">Login</a>
								</div>
								<div class="col">
									<a id="btn-to-form">Register</a>
								</div>
							</div>
							
						</div>
						
						<hr>
						
						
						<div class="panel-body">
							<div class="row">
							
								<?php
									
									echo validation_errors('<div id="errors-form" class="alert alert-danger font-weight-bold col-12">', '</div>');
								
									if($msg = sessionMsg("form")):
										echo '<div id="errors-form" class="alert alert-danger font-weight-bold col-12">'. $msg . '</div>';
									endif;
								?>
									
								<form class="form-control entrar" method="POST" <?=set_value('cadastro') ? 'style="display:none"' : ''?>>
								
									<?=form_hidden('entrar', 'true');?>
									
									<div class="form-group">
										<label for="exampleInputEmaile">Email address</label>
										<input type="email" required name="emaile" value="<?=set_value('emaile')?>" class="form-control" id="exampleInputEmaile" aria-describedby="emailHelp" placeholder="Enter email">
									</div>
									
									<div class="form-group">
										<label for="exampleInputPassworde">Password</label>
										<input type="password" name="password" required  minlength="6" class="form-control" id="exampleInputPassworde" placeholder="Password">
									</div>
									
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input">
											Check me out
										</label>
									</div>
									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
								
								<form class="form-control cadastro" method="POST" <?=(set_value('entrar') or !set_value('cadastro')) ? 'style="display:none"' : ''?> >
									
									<?=form_hidden('cadastro', 'true');?>
									
									<div class="form-group">
										<label for="exampleInputEmailc">Email address</label>
										<input type="email" required name="emailc" value="<?=set_value('emailc')?>" class="form-control" id="exampleInputEmailc" aria-describedby="emailHelp" placeholder="Enter email">
										<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
									</div>
									
									<div class="form-group">
										<label for="exampleInputPasswordc">Password</label>
										<input type="password" name="password" required minlength="6" class="form-control" id="exampleInputPasswordc" placeholder="Password">
									</div>
									
									<div class="form-group">
										<label for="exampleInputPasswordc2">Confirm Password</label>
										<input type="password" name="passconf" required minlength="6" class="form-control" id="exampleInputPasswordc2" placeholder="Confirm Password">
									</div>
									
									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				
				<?php if(set_value('cadastro')):?>
				$('#btn-to-form:eq(1)').addClass('active bg-primary');
				<?php else:?>
				$('#btn-to-form:eq(0)').addClass('active');
				<?php endif;?>
				
				$('body').delegate('#btn-to-form:not(.active)','click', function(e) {
					$(".entrar, .cadastro").toggle(100);
					
					$(this).addClass('active');
					$(this).parent('div').siblings('div').find('a').removeClass();
					
					$('#errors-form').toggle();
				});
				
				$('.cadastro input[type=password]').bind('change keyup',function(){
					var pass = $('.cadastro input[type=password]');
					
					if(pass.eq(0).val() != pass.eq(1).val()) {
						pass.eq(1)[0].setCustomValidity("sua senha não confirma com anterior");
						} else {
						pass.eq(1)[0].setCustomValidity('');
					}
					
				});
				
			});
			
		</script>
		
	</body>
</html>
