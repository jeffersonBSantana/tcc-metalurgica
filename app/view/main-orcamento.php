<div id="div-orcamento" style="display: none;" >

	<div class="page-header" >
		<h1>Orçamentos:</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div id="panel-orcamento" class="panel panel-default" style="display:none;" >
				<div class="panel-body">
					<form id="form-orcamento" role="form" >
						<input type="hidden" class="form-control" id="ID_ORCAMENTO" name="ID_ORCAMENTO" >
						<div class="form-group">
							<label for="ID_FUNCIONARIO">Funcionário</label>
							<select class="form-control" id="ID_FUNCIONARIO" name="ID_FUNCIONARIO">
							</select>
						</div>
						<div class="form-group">
							<label for="ID_CLIENTE">Cliente</label>
							<select class="form-control" id="ID_CLIENTE" name="ID_CLIENTE">
							</select>
						</div>						
						<div class="form-group">
							<label for="DATA_ORCAMENTO">Data do Orçamento</label>
							<div class="input-group margin-bottom-sm">
							  	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" class="form-control" id="DATA_ORCAMENTO" name="DATA_ORCAMENTO" required minlength="1" onkeydown="Mask.mascara(this, Mask.mdata)" >
							</div>
						</div>
						<div class="form-group">
							<label for="CONFIRMADO">Confirmado</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="CONFIRMADO" value="0" > Não<br/>
								<input type="radio" name="CONFIRMADO" value="1" checked > Sim<br/>
							</div>
						</div>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Salvar</button>
						<button type="reset" class="btn btn-primary" onclick="Orcamento.limpar()" ><span class="glyphicon glyphicon-plus"></span> Novo</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="table-orcamento" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width='4%' ><div onclick="Orcamento.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Data do Orçamento</label></th>
					<th><label>Confirmado</label></th>
					<th><label>Funcionario</label></th>
					<th><label>Cliente</label></th>
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
