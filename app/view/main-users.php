<div id="div-users" style="display: none;" >

	<div class="page-header" >
		<h1>Usuario</h1>
	</div>	

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-users" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-users" role="form" >	
						<input type="hidden" class="form-control" id="id_user" name="id_user" required editar="ID_USER" >
						<div class="form-group">
							<label for="name">Nome</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-smile-o fa-fw"></i></span>
								<input type="text" class="form-control" id="name" name="name" required editar="NAME" minlength="2" >
							</div>							
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="email" class="form-control" id="email" name="email" required editar="EMAIL" minlength="2" >
							</div>							
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input type="text" class="form-control" id="username" name="username" required editar="USERNAME" maxlength="10" minlength="5" >
							</div>							
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
								<input type="password" class="form-control" id="password" name="password" required editar="PASSWORD" maxlength="10" minlength="5" >
							</div>							
						</div>
						<div class="checkbox">
							<label for="active" ><input id="active" name="active" type="checkbox" value="1" checked editar="ACTIVE" > Ativo</label>
						</div>	
						<div class="form-group">
							<label for="access_level">Nivel de Acesso</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="access_level" value="0" checked > Teste<br/>
								<input type="radio" name="access_level" value="1" > Teste 2<br/>
								<input type="radio" name="access_level" value="2" > Teste 3<br/>
							</div>							
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Users.reset()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div> 

	<div class="table-responsive">
		<table id="table-users" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Users.insert()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Usuario</label></th>
					<th><label>Email</label></th>
					<th><label>Username</label></th>
					<th><label>Pass</label></th>
					<th><label>Nivel acesso</label></th>
					<th width='6%' ><label><input id="active" name="active" type="checkbox" value="1" onclick="Users.active()" checked > Ativo</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>