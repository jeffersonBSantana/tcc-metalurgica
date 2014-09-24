<div id="div-cliente" style="display: none;" >

	<div class="page-header" >
		<h1>Clientes:</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-cliente" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-cliente" role="form" >
						<input type="hidden" class="form-control" id="ID_CLIENTE" name="ID_CLIENTE" >
						<div class="form-group">
							<label for="NOME">Nome</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
								<input type="text" class="form-control" id="NOME" name="NOME" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="CPF_CNPJ">CPF/CNPJ</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-edit fa-fw"></i></span>
								<input type="text" class="form-control" id="CPF_CNPJ" name="CPF_CNPJ" required minlength="11" >
							</div>
						</div>
						<div class="form-group">
							<label for="EMAIL">Email</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-envelope-square fa-fw"></i></span>
								<input type="text" class="form-control" id="EMAIL" name="EMAIL" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="TELEFONE">Telefone</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-fax fa-fw"></i></span>
								<input type="text" class="form-control" id="TELEFONE" name="TELEFONE" required minlength="8" >
							</div>
						</div>
						<div class="form-group">
							<label for="CELULAR">Celular</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-phone-square fa-fw"></i></span>
								<input type="text" class="form-control" id="CELULAR" name="CELULAR" required minlength="8" >
							</div>
						</div>
						<div class="form-group">
							<label for="RUA">Rua</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
								<input type="text" class="form-control" id="RUA" name="RUA" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="NUMERO">Numero</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
								<input type="text" class="form-control" id="NUMERO" name="NUMERO" required minlength="1" >
							</div>
						</div>
						<div class="form-group">
							<label for="BAIRRO">Bairro</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
								<input type="text" class="form-control" id="BAIRRO" name="BAIRRO" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="CEP">CEP</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="text" class="form-control" id="CEP" name="CEP" required minlength="8" >
							</div>
						</div>
						<div class="form-group">
							<label for="ID_LOCALIDADE">LOCALIDADE</label>
							<select class="form-control" id="ID_LOCALIDADE" name="ID_LOCALIDADE">
							</select>
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Clientes.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-cliente" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Clientes.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Nome</label></th>
					<th><label>CPF/CNPJ</label></th>
					<th><label>Email</label></th>
					<th><label>Telefone</label></th>
					<th><label>Celular</label></th>
					<th><label>Rua</label></th>
					<th><label>Numero</label></th>
					<th><label>Bairro</label></th>
					<th><label>CEP</label></th>
					<th><label>Localidade</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
