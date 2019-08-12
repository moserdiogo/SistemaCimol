<style>

    .form-control{
        float: right;
        margin-bottom: 10px;
    }

    .form-group{
        margin-bottom: 0px;
    }
    .ibox-footer{
        margin-top: 30px;
    }

</style>

<div class="w-75 float-right">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">
    	<div style="text-align: center; padding: 30px; margin-left:150px">
			<form method="post" action="<?php echo base_url() ?>suporte/editar_submit">
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Código</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputEmail3" name="codigo" value="<?= $chamado[0]->codigo?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Equipamento</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputEmail3" name="equipamento" value="<?= $chamado[0]->nome?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Num de série</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputEmail3" name="num_serie" value="<?= $chamado[0]->num_serie?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Data atendimento</label>
					<div class="col-sm-6">
						<input type="date" class="form-control" id="inputEmail3" name="data_atendimento" value="<?= $chamado[0]->data_atendimento?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Data solução</label>
					<div class="col-sm-6">
						<input type="date" class="form-control" id="inputEmail3" name="data_solucao" value="<?= $chamado[0]->data_solucao?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Defeito</label>
					<div class="col-sm-6">
						<textarea id="" cols="34" rows="3" name="defeito"><?= $chamado[0]->defeito?></textarea>
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Solução</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputEmail3" name="solucao" value="<?= $chamado[0]->solucao?>">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-6">
						<select class="form-control" name="status">
							<option><?= $chamado[0]->status ?></option>
							<option>Pendente</option>
							<option>Aguardando peça</option>
							<option>Aguardando orçamento</option>
							<option>Finalizado</option>
						</select>
					</div>
				</div>

				<input type="hidden" name="id_equipamento" value="<?= $chamado[0]->id_equipamento ?>">
				
				<div class="form-group row">
					<div class="col-sm-8">
					<a class="btn btn-primary" href="<?php echo base_url() ?>servico/servicos">Voltar</a>
					<button type="submit" class="btn btn-primary">Editar</button>
					</div>
				</div>
			</form>
    	</div>
    </div>
</div>