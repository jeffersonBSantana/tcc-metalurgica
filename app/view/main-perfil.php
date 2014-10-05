<div id="div-perfil" style="display: none;" >

	<div class="page-header" >
		<h1>Perfil</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-perfil" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-perfil" role="form" >
						<input type="hidden" class="form-control" id="ID_PERFIL" name="ID_PERFIL" >
						<div class="form-group">
							<label for="Descricao">Descrição</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-edit fa-fw"></i></span>
								<input type="text" class="form-control" id="DESCRICAO" name="DESCRICAO" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="PESO_POR_METRO">Peso</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-edit fa-fw"></i></span>
								<input type="text" class="form-control" id="PESO_POR_METRO" name="PESO_POR_METRO" required minlength="1" >
							</div>
						</div>

						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Perfil.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-perfil" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Perfil.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Descrição</label></th>
					<th><label>Peso <i>(Por Metro)</i></label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>
