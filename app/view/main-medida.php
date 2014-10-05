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
							<label for="ID_PERFIL">Perfil</label>
							<select class="form-control" id="ID_PERFIL" name="ID_PERFIL">
							</select>
						</div>
						<div class="form-group">
							<label for="QUANTIDADE">Quantidade Utilizada</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-plus-square fa-fw"></i></span>
								<input type="text" class="form-control" id="QUANTIDADE" name="QUANTIDADE" required minlength="1" >
							</div>
						</div>
						<div class="form-group">
							<label for="DIMINUIR">Diminuir(cm)</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-minus-square fa-fw"></i></span>
								<input type="text" class="form-control" id="DIMINUIR" name="DIMINUIR" required minlength="1" >
							</div>
						</div>
						<div class="form-group">
							<label for="AUMENTAR">Aumentar(cm)</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-plus-square fa-fw"></i></span>
								<input type="text" class="form-control" id="AUMENTAR" name="AUMENTAR" required minlength="1" >
							</div>
						</div>
						<div class="form-group">
							<label for="DIVIDIR">Dividir por</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-cut fa-fw"></i></span>
								<input type="text" class="form-control" id="DIVIDIR" name="DIVIDIR" required minlength="1" onkeydown="Mask.mascara(this, Mask.mvalorbr)" >
							</div>
						</div>
						<div class="form-group">
							<label for="MEDIDA_REFERENCIA">Medida de Referência</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="MEDIDA_REFERENCIA" value="0" checked > Largura<br/>
								<input type="radio" name="MEDIDA_REFERENCIA" value="1" > Altura<br/>
							</div>
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
					<th><label>Qtd Utilizada</label></th>
					<th><label>Diminuir(cm)</label></th>
					<th><label>Aumentar(cm)</label></th>
					<th><label>Dividir por</label></th>
					<th><label>Medida de Referência</label></th>
					<th><label>Esquadria</label></th>
					<th><label>Perfil</label></th>
					<!--<th width='6%' ><label><input id="ativo" name="ativo" type="checkbox" value="1" onclick="Funcionarios.ativo()" checked > Ativo</label></th>-->
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>
