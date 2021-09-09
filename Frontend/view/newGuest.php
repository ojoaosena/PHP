<h2 class='principalc2'>Capturar Imagem</h2>
<div class='video'>
    <video id='player' autoplay></video>
</div>
<button class='principalbotao' id='capture-btn'>Capturar</button>
<div class='canvas'>
    <canvas id='canvas'></canvas>
</div><br>
    <a id='salvar' class='principalancorasalvar' href=''>Salvar</a>
<script src='/javascript/capturaimagem.js'></script>
<script src='/javascript/salvacaptura.js'></script>
<h2 class='principalc2'>Cadastro</h2>
        <form action='/fonte/cadastravisitante' method='post'>
            <div>
                <input class='principalcadastravisitanteimagem' type='image' name="imagem" src='<?=$fetch['imagem']?>'>
            </div>
            <div>
                <input class='principalcadastravisitantenome' type='text' name='nome' placeholder='Nome Completo' required>
                <input class='principalcadastravisitantedocumento' type='text' name='documento' placeholder='Documento de Identificação' required>
                <input class='principalcadastravisitanteempresa'type='text' name='empresa' placeholder='Nome da Empresa'>
                <input class='principalcadastravisitantesubmeter' type='submit' value='Salvar'>
            </div>
        </form>
        <h2 class='principalc2'>Entrada</h2>
        <form action='/fonte/entrada' method='post'>
            <div>
                <input class='principalentradaimagem' type='image' name='imagem' src='<?=$fetch['imagem']?>'>
            </div>
            <div>
                <input class='principalentradanome' type='text' name='nome' value='<?=$fetch['nome']?>' readonly>
                <input class='principalentradadocumento' type='text' name='documento' value='<?=$fetch['documento']?>' readonly>
                <input class='principalentradaempresa' type='text' name='empresa' value='<?=$fetch['empresa']?>' readonly>
            </div>
                <h3 class='principalformularioc3'>Horário</h3>
                <label class='principallabelentrada'>Entrada:</label>
                <input class='principalentradaentrada' type='datetime-local' name='entrada'>
                <h3 class='principalformularioc3'>Veículo</h3>
                <label class='principallabelmarca'>Marca:</label>
                <input class='principalentradamarca' type='text' name='marca'>
                <label class='principallabelmodelo'>Modelo:</label>
                <input class='principalentradamodelo' type='text' name='modelo'>
                <label class='principallabelplaca'>Placa:</label>
                <input class='principalentradaplaca' type='text' name='placa'  maxlength='7'><br>
                <h3 class='principalformularioc3'>Destino</h3>
                <label class='principallabelsetor'>Setor:</label>
                <input class='principalentradasetor' type='text' name='setor' id='setor'>
                <label class='principallabelresponsavel'>Responsável:</label>
                <input class='principalentradaresponsavel' type='text' name='responsavel' id='responsavel'><br>
                <label class='principallabelobservacao' for='obs'>Observação:</label><br>
                <textarea class='principalentradaobservacao' id='obs' name='obs' rows='10' cols='100'></textarea>
                <input class='principalentradasubmeter' type='submit' value='Salvar'>
        </form> 
        <h2 class='principalc2'>Saída</h2>
        <form action='/fonte/saida' method='post'>
            <div>
                <input class='principalentradaimagem' type='image' src='<?=$fetchvisitantes['imagem']?>'>
            </div>
            <div>
                <input class='principalentradanome' type='text' name='nome' value='<?=$fetchvisitantes['nome']?>' readonly>
                <input class='principalentradadocumento' type='text' value='<?=$fetchvisitantes['documento']?>' readonly>
                <input class='principalentradaempresa' type='text' value='<?=$fetchvisitantes['empresa']?>' readonly>
            </div>
                <h3 class='principalformularioc3'>Horário</h3>
                <label class='principallabelentrada'>Entrada:</label>
                <input class='principalentradaentrada' type='datetime-local' name="entrada" value='<?=$entrada?>' readonly>
                <label class='principallabelsaida'>Saída:</label>
                <input class='principalentradasaida' type='datetime-local' name="saida"><br>
                <h3 class='principalformularioc3'>Veículo</h3>
                <label class='principallabelmarca'>Marca:</label>
                <input class='principalentradamarca' type='text' value='<?=$fetchentrada['marca']?>' readonly>
                <label class='principallabelmodelo'>Modelo:</label>
                <input class='principalentradamodelo' type='text' value='<?=$fetchentrada['modelo']?>' readonly>
                <label class='principallabelplaca'>Placa:</label>
                <input class='principalentradaplaca' type='text' value='<?=$fetchentrada['placa']?>' readonly><br>
                <h3 class='principalformularioc3'>Destino</h3>
                <label class='principallabelsetor'>Setor:</label>
                <input class='principalentradasetor' type='text' value='<?=$fetchentrada['setor']?>' readonly>
                <label class='principallabelresponsavel'>Responsável:</label>
                <input class='principalentradaresponsavel' type='text' value='<?=$fetchentrada['responsavel']?>' readonly><br>
                <label class='principallabelobservacao'>Observação:</label><br>
                <textarea class='principalentradaobservacao' rows='10' cols='100' readonly><?=$fetchentrada['observacao']?></textarea>
                <input class='principalentradasubmeter' type='submit' value='Salvar'>
        </form>