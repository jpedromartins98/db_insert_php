<?php
$host = "localhost";
$usuario = "root";
$senha = "senha";
$nome_db = "base_de_dados";

$conexao = mysqli_connect($host, $usuario, $senha, $nome_db);


//levando em conta que tudo já foi verificado
//guardando os dados via POST

$query_cadastra = "INSERT INTO usuario VALUES ($email, $senha, $nome, $cpf, $rg, $data_expedicao, $orgao_expedidor, $data_nascimento,
						$nome_mae, $nome_pai, $estado_civil, $nacionalidade, $naturalidade, $fixo, $celular, $rua, $numero, $complemento, $bairro,
						$cidade, $cep, $estado, $graduacao, $instituicao_graduacao, $data_inicio_graduacao, $data_conclusao_graduacao, 
						$bolsa_ic, $mestrado, $instituicao_mestrado, $data_inicio_mestrado, $data_conclusao_mestrado, $area_atuacao, 
						$area_profissional, $cargo, $matricula, $doutorado_sem_bolsa, $rua_trabalho, $numero_trabalho, $complemento_trabalho,
						$bairro_trabalho, $cidade_trabalho, $cep_trabalho, $estado_trabalho, $orientador)";
?>
