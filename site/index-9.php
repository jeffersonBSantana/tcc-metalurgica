<section class="contact-us" id="orcamento">
	<div class="container">
		
		<!-- SECTION HEADER -->
		<div class="section-header">			
			
			<!-- SECTION TITLE -->
			<h2 class="white-text">Orçamento On-line</h2>
			
			<!-- SHORT DESCRIPTION ABOUT THE SECTION -->
			<h6 class="white-text">Faça seu orçamento on-line que entraremos em contato com você em menos de 24 horas.</h6>
		</div>
		<!-- / END SECTION HEADER -->
		
		<!-- CONTACT FORM-->
		<div class="row">
			<form id="form-orcamento" role="form" class="contact-form" style="text-align: left;" >
			<div class="wow fadeInLeft animated" data-wow-offset="30" data-wow-duration="1.5s" data-wow-delay="0.15s">
				<input type="hidden" class="form-control" id="ID_ORCAMENTO" name="ID_ORCAMENTO" value="0" >
				<div class="form-group">
					<input type="text" placeholder="Seu Nome" class="form-control input-box" id="NOME" name="NOME" required >
				</div>
				<div class="form-group">
					<input type="text" placeholder="Email de contato" class="form-control input-box" id="EMAIL" name="EMAIL" required >
				</div>
				<div class="form-group">
					<input type="text" placeholder="Telefone para contato" class="form-control input-box" id="TELEFONE" name="TELEFONE" required minlength="8" onkeydown="Mask.mascara(this, Mask.mtelefone)" maxlength="16" >
				</div>

				<div class="section-header">	
					<h2 class="white-text" > O que você deseja? </h2>
				</div>
				
				<div class="form-group">
					<select class="form-control input-box" id="ID_ESQUADRIA" name="ID_ESQUADRIA" >						
					</select>
				</div>
				<div class="form-group">
					<input type="text" placeholder="Quantidade" class="form-control input-box" id="QUANTIDADE" name="QUANTIDADE" onkeydown="Mask.mascara(this, Mask.mnumeros)" />
				</div>
				<div class="form-group">
					<input type="text" placeholder="Altura (cm)" class="form-control input-box" id="ALTURA" name="ALTURA" onkeydown="Mask.mascara(this, Mask.mvalorbr)"/>
				</div>
				<div class="form-group">
					<input type="text" placeholder="Largura (cm)" class="form-control input-box" id="LARGURA" name="LARGURA" onkeydown="Mask.mascara(this, Mask.mvalorbr)"/>
				</div>
				<div class="form-group">
					<input type="text" disabled placeholder="Valor Unitário" class="form-control input-box" id="VALOR_UNITARIO" name="VALOR_UNITARIO" minlength="1" onkeydown="Mask.mascara(this, Mask.mvalorbr)" >
				</div>
				<div class="form-group input-box">
					<label for="COR" >COR</label>
					<div class="input-group margin-bottom-sm">
						<input type="radio" name="COR" value="0" checked > Fosco
						<input type="radio" name="COR" value="1" > Bronze
						<input type="radio" name="COR" value="2" > Branco
						<input type="radio" name="COR" value="3" > Preto
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" class="form-control" id="ID_ADICIONARITENS" name="ID_ADICIONARITENS" >
					<button type="button" class="btn btn-success" onclick="Orcamento.adicionarItens()" ><span class="glyphicon glyphicon-shopping-cart" ></span> Adicionar no carrinho de compras!</button>
				</div>

				<div class="table-responsive">
					<table id="table-orcamento-cadastro" class="table table-bordered table-striped " style="background-color:#FFFFFF" >
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
							<!--<tr>
								<td colspan="7" >Nenhum produto adicionado no carrinho de compras!</td>
							</tr>-->	
						</tbody>
					</table>
				</div>

				<button id="btn-enviar" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Enviar orçamento</button>
			</div>
			</form>

		</div>
		<!-- / END CONTACT FORM-->
	</div> <!-- / END CONTAINER -->
</section> <!-- / END CONTACT US SECTION-->