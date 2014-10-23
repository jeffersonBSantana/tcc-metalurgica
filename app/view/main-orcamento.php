<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Itens Orcamentos</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table-itens-orcamento" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><label>Esquadria</label></th>
								<th><label>Quantidade</label></th>
								<th><label>Altura</label></th>
								<th><label>Largura</label></th>
								<th><label>Valor Unitário</label></th>
								<th><label>Cor</label></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
			</div>
		</div>
	</div>
</div>

<div id="div-orcamento" style="display: none;" >

	<div class="page-header" >
		<h1>Orçamentos:</h1>
	</div>

	<div class="row">
		<div class="col-sm-8">
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
								<input type="date" class="form-control" id="DATA_ORCAMENTO" name="DATA_ORCAMENTO" required minlength="1" onkeydown="Mask.mascara(this, Mask.mdata)" >
							</div>
						</div>
						<div class="form-group">
							<label for="CONFIRMADO">Confirmado</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="CONFIRMADO" value="0" > Não<br/>
								<input type="radio" name="CONFIRMADO" value="1" checked > Sim<br/>
							</div>
						</div>

						<hr />
						<h2> Itens do Orçamento </h2>

						<div class="form-group">
							<label for="ID_ESQUADRIA">Esquadria</label>
							<select class="form-control" id="ID_ESQUADRIA" name="ID_ESQUADRIA">
							</select>
						</div>

						<div class="form-group">
							<label for="QUANTIDADE">Quantidade</label>
							<input type="text" class="form-control" id="QUANTIDADE" name="QUANTIDADE" onkeydown="Mask.mascara(this, Mask.mnumeros)" />
						</div>
						<div class="form-group">
							<label for="ALTURA">Altura (cm)</label>
							<input type="text" class="form-control" id="ALTURA" name="ALTURA" onkeydown="Mask.mascara(this, Mask.mvalorbr)"/>
						</div>
						<div class="form-group">
							<label for="LARGURA">Largura (cm)</label>
							<input type="text" class="form-control" id="LARGURA" name="LARGURA" onkeydown="Mask.mascara(this, Mask.mvalorbr)"/>
						</div>
						<div class="form-group">
							<label for="VALOR_UNITARIO"> Valor Unitário</label>
							<input type="text" disabled class="form-control" id="VALOR_UNITARIO" name="VALOR_UNITARIO" minlength="1" onkeydown="Mask.mascara(this, Mask.mvalorbr)" >
						</div>
						<div class="form-group">
							<label for="COR">COR</label>
							<div class="input-group margin-bottom-sm">
								<input type="radio" name="COR" value="0" checked > Fosco<br/>
								<input type="radio" name="COR" value="1" > Chumbo<br/>
								<input type="radio" name="COR" value="2" > Branco<br/>
								<input type="radio" name="COR" value="3" > Default<br/>
							</div>
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" id="ID_ADICIONARITENS" name="ID_ADICIONARITENS" >
							<button type="button" class="btn btn-success" onclick="Orcamento.adicionarItens()" ><span class="glyphicon glyphicon-ok" ></span>Adicionar</button>
						</div>

						<div class="table-responsive">
							<table id="table-orcamento-cadastro" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><label>Esquadria</label></th>
										<th><label>Quantidade</label></th>
										<th><label>Altura</label></th>
										<th><label>Largura</label></th>
										<th><label>Valor Unitário</label></th>
										<th><label>Cor</label></th>
										<th><label>Remover</label></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>

						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
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
					<th width='4%' ><div class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></div></th>
					<th width='4%' ><div class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></div></th>
					<th width='4%' ><div onclick="Orcamento.inserir()" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></div></th>
					<th><label>Data do Orçamento</label></th>
					<th><label>Confirmado</label></th>
					<th><label>Funcionario</label></th>
					<th><label>Cliente</label></th>
					<th width='5%' ><label>Editar</label></th>
					<th width='5%' ><label>Deletar</label></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
