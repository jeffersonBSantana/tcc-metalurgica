<div id="div-usuarios" style="display: none;" >

	<div class="page-header" >
		<h1>Usuario</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-usuarios" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-usuarios" role="form" >
						<input type="hidden" class="form-control" id="ID_USUARIOS" name="ID_USUARIOS" >
						<div class="form-group">
							<label for="LOGIN">Login</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-smile-o fa-fw"></i></span>
								<input type="text" class="form-control" id="LOGIN" name="LOGIN" required minlength="2" >
							</div>
						</div>
						<div class="form-group">
							<label for="SENHA">Senha</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="password" class="form-control" id="SENHA" name="SENHA" required minlength="2" >
							</div>
						</div>
						<div class="form-group">
							<label for="ID_FUNCIONARIOS">Funcionários</label>
							<select class="form-control" id="ID_FUNCIONARIO" name="ID_FUNCIONARIO" required >
							</select>
						</div>
						<div class="checkbox">
							<label for="active" ><input id="ATIVO" name="ATIVO" type="checkbox" value="1" checked > Ativo</label>
						</div>
						<div class="form-group">
							<label for="NIVEL_ACESSO">Nivel de Acesso</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="NIVEL_ACESSO" value="0" checked > Ouro<br/>
								<input type="radio" name="NIVEL_ACESSO" value="1" > Prata<br/>
								<input type="radio" name="NIVEL_ACESSO" value="2" > Bronze<br/>
							</div>
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Usuarios.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-usuarios" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Usuarios.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Login</label></th>
					<th><label>Senha</label></th>
					<th><label>Nome Funcionário</label></th>
					<th width='6%' ><label><input id="ativo" name="ativo" type="checkbox" value="1" onclick="Usuarios.ativo()" checked > Ativo</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>
