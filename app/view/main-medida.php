<div id="div-medida" style="display: none;" >

	<div class="page-header" >
		<h1>Medidas:</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-medida" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-medida" role="form" >
						<input type="hidden" class="form-control" id="ID_MEDIDA" name="ID_MEDIDA" >
						<div class="form-group">
							<label for="ID_ESQUADRIA">Esquadria</label>
							<select class="form-control" id="ID_ESQUADRIA" name="ID_ESQUADRIA">
							</select>
						</div>
						<div class="form-group">
							<label for="VALOR"> Valor</label>
							<input type="text" class="form-control" id="VALOR" name="VALOR" minlength="1" onkeydown="Mask.mascara(this, Mask.mvalorbr)" >
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Medidas.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-medida" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Medidas.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Esquadria</label></th>
					<th><label>Valor</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
