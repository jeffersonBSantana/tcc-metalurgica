<div id="div-localidade" style="display: none;" >

	<div class="page-header" >
		<h1>Localidade:</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-localidade" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-localidade" role="form" >
						<input type="hidden" class="form-control" id="ID_LOCALIDADE" name="ID_LOCALIDADE" >
						<div class="form-group">
							<label for="CIDADE">Cidade</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
								<input type="text" class="form-control" id="CIDADE" name="CIDADE" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="ESTADO">Estado</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
								<input type="text" class="form-control" id="ESTADO" name="ESTADO" required minlength="3" >
							</div>
						</div>
						<div class="form-group">
							<label for="SIGLA">Sigla</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-location-arrow fa-fw"></i></span>
								<input type="text" class="form-control" id="SIGLA" name="SIGLA" required minlength="2" >
							</div>
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Localidade.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-localidade" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Localidade.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Cidade</label></th>
					<th><label>Estado</label></th>
					<th><label>Sigla</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>
