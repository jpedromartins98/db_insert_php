<?php
$host = "localhost";
$usuario = "root";
$senha = "senha";
$nome_db = "base_de_dados";

$conexao = mysqli_connect($host, $usuario, $senha, $nome_db);

	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "erro-1#Email inválido !!!";
		exit;
	}
	$senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
	$senha_confirma = filter_var($_POST["senha_confirma"], FILTER_SANITIZE_STRING);
	if (strlen($senha)<8){
		echo "erro-2#A senha deve ter pelo menos oito caracteres !!!";
		exit;
	}
	if ($senha !== $senha_confirma){
		echo "erro-3#Senhas não conferem !!!";
		exit;
	}
	$edital="Não";
	if (isset($_POST["edital"]) && $_POST["edital"])
		$edital = filter_var($_POST["edital"], FILTER_SANITIZE_STRING);
	if($edital!=="Sim"){
		echo "erro-4#Para se inscrever deve conhecer e concordar com o edital !!!";
		exit;
	}
	$nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
	if (strlen($nome)<3 || strlen($nome)>300){
		echo "erro-5#O nome deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
	function validarCPF( $cpf = '' ) {
		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
		if ( strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return FALSE;
		} else {
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return FALSE;
				}
			}
			return TRUE;
		}
	}
	if (validarCPF($cpf)==FALSE){
		echo "erro-6#CPF inválido !!!";
		exit;
	}
	$rg = filter_var($_POST["rg"], FILTER_SANITIZE_STRING);
	if (strlen($rg)<3 || strlen($rg)>300){
		echo "erro-7#O RG deve ter entre 3 e 300 caracteres caracteres !!!";
		exit;
	}
	$data_expedicao = filter_var($_POST["data_expedicao"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_expedicao, 'd/m/Y')){
		echo "erro-8#A data de expedição do RG não está em um formato válido !!!";
		exit;
	}
	$orgao_expedidor = filter_var($_POST["orgao_expedidor"], FILTER_SANITIZE_STRING);
	if (strlen($orgao_expedidor)<3 || strlen($orgao_expedidor)>300){
		echo "erro-9#O orgão expedidor deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$data_nascimento = filter_var($_POST["data_nascimento"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_nascimento, 'd/m/Y')){
		echo "erro-10#A data de nascimento não está em um formato válido !!!";
		exit;
	}
	$nome_pai = filter_var($_POST["nome_pai"], FILTER_SANITIZE_STRING);
	if (strlen($nome_pai)<0 || strlen($nome_pai)>300){
		echo "erro-11#O nome do seu pai deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$nome_mae = filter_var($_POST["nome_mae"], FILTER_SANITIZE_STRING);
	if (strlen($nome_mae)<3 || strlen($nome_mae)>300){
		echo "erro-12#O nome da sua mãe deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$estados_civil_permitidos = array("Solteiro", "Casado", "Divorciado", "Viúvo");
	$estado_civil = filter_var($_POST["estado_civil"], FILTER_SANITIZE_STRING);
	if (!in_array($estado_civil, $estados_civil_permitidos)){
		echo "erro-13#O estado civil não está em um formato válido ou não é permitido !!!!!!";
		exit;
	}
	$naturalidade = filter_var($_POST["naturalidade"], FILTER_SANITIZE_STRING);
	if (strlen($naturalidade)<3 || strlen($naturalidade)>300){
		echo "erro-14#A naturalidade deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$nacionalidade = filter_var($_POST["nacionalidade"], FILTER_SANITIZE_STRING);
	if (strlen($nacionalidade)<3 || strlen($nacionalidade)>300){
		echo "erro-15#A nacionalidade deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$fixo = filter_var($_POST["fixo"], FILTER_SANITIZE_STRING);
	$fixo = preg_replace("/[^0-9]/", "",$fixo);
	if (strlen($fixo)!=0 && (strlen($fixo)<10 || strlen($fixo)>300)){
		echo "erro-16#O telefone fixo não está em um formato válido !!!";
		exit;
	}
	if ($fixo){
		if ($fixo[0]=="0")
			$fixo=substr($fixo, 1);
		$fixo = "(".$fixo[0].$fixo[1].") ".substr($fixo, 2);
	}
	$celular = filter_var($_POST["celular"], FILTER_SANITIZE_STRING);
	$celular = preg_replace("/[^0-9]/", "",$celular);
	if (strlen($celular)<10 || strlen($celular)>15){
		echo "erro-17#O celular não está em um formato válido !!!";
		exit;
	}
	if ($celular[0]=="0")
		$celular=substr($celular, 1);
	$celular = "(".$celular[0].$celular[1].") ".substr($celular, 2);
	$rua = filter_var($_POST["rua"], FILTER_SANITIZE_STRING);
	if (strlen($rua)<1 || strlen($rua)>300){
		echo "erro-18#A rua deve ter entre 1 e 300 caracteres !!!";
		exit;
	}
	$numero = filter_var($_POST["numero"], FILTER_SANITIZE_STRING);
	if (strlen($numero)<1 || strlen($numero)>300){
		echo "erro-19#O número deve ter entre 1 e 300 caracteres !!!";
		exit;
	}
	$complemento = filter_var($_POST["complemento"], FILTER_SANITIZE_STRING);
	if (strlen($complemento)<1 || strlen($complemento)>300){
		echo "erro-20#O complemento deve ter entre 1 e 300 caracteres !!!";
		exit;
	}
	$bairro = filter_var($_POST["bairro"], FILTER_SANITIZE_STRING);
	if (strlen($bairro)<1 || strlen($bairro)>300){
		echo "erro-21#O bairro deve ter entre 1 e 300 caracteres !!!";
		exit;
	}
	$cidade = filter_var($_POST["cidade"], FILTER_SANITIZE_STRING);
	if (strlen($cidade)<3 || strlen($cidade)>300){
		echo "erro-22#A cidade deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$cep = filter_var($_POST["cep"], FILTER_SANITIZE_STRING);
	if(preg_match("/^[0-9]{2}\.[0-9]{3}\-[0-9]{3}$/",$cep) || strlen($nome)>300){
		echo "erro-23#CEP inválido !!!";
		exit;
	}
	$estados_permitidos = array("Acre", "Alagoas", "Amapá", "Amazonas", "Bahia",
		"Ceará", "Distrito Federal", "Espirito Santo", "Goiás", "Maranhão",
		"Mato Grosso do Sul", "Mato Grosso", "Minas Gerais", "Pará", "Paraíba",
		"Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte",
		"Rio Grande do Sul", "Rondônia", "Roraima", "Santa Catarina",
		"São Paulo", "Sergipe", "Tocantins"
	);
	$estado = filter_var($_POST["estado"], FILTER_SANITIZE_STRING);
	if (!in_array($estado, $estados_permitidos)){
		echo "erro-24#O estado não está no formato aceito ou não é válido !!!";
		exit;
	}
	$graduacao = filter_var($_POST["graduacao"], FILTER_SANITIZE_STRING);
	if (strlen($graduacao)<3 || strlen($graduacao)>300){
		echo "erro-25#A graduação deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$instituicao_graduacao = filter_var($_POST["instituicao_graduacao"], FILTER_SANITIZE_STRING);
	if (strlen($instituicao_graduacao)<3 || strlen($instituicao_graduacao)>300){
		echo "erro-26#A instituição da graduação deve ter entre 3 e 300 caracteres !!!";
		exit;
	}
	$data_inicio_graduacao = filter_var($_POST["data_inicio_graduacao"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_inicio_graduacao, 'd/m/Y')){
		echo "erro-27#A data de conclusão da graduação não está em um formato válido !!!";
		exit;
	}
	$data_conclusao_graduacao = filter_var($_POST["data_conclusao_graduacao"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_conclusao_graduacao, 'd/m/Y')){
		echo "erro-28#A data de conclusão da graduação não está em um formato válido !!!";
		exit;
	}
	$bolsa_ic = filter_var($_POST["bolsa_ic"], FILTER_SANITIZE_STRING);
	$sim_ou_nao = array("Sim","Não");
	if (!in_array($bolsa_ic, $sim_ou_nao)){
		echo "erro-29#A resposta sobre bolsista de IC na graduação deve ser sim ou não !!!";
		exit;
	}
	$mestrado = filter_var($_POST["mestrado"], FILTER_SANITIZE_STRING);
	if (strlen($mestrado)<0 || strlen($mestrado)>300){
		echo "erro-30#O mestrado deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$instituicao = filter_var($_POST["instituicao"], FILTER_SANITIZE_STRING);
	if (strlen($instituicao)<0 || strlen($instituicao)>300){
		echo "erro-31#A instituição do mestrado deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$data_inicio_mestrado = filter_var($_POST["data_inicio_mestrado"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_inicio_mestrado, 'd/m/Y') && strlen($data_inicio_mestrado)!=0){
		echo "erro-32#A data de início do mestrado não está em um formato válido !!!";
		exit;
	}
	$data_conclusao_mestrado = filter_var($_POST["data_conclusao_mestrado"], FILTER_SANITIZE_STRING);
	if (!validateDate($data_conclusao_mestrado, 'd/m/Y') && strlen($data_conclusao_mestrado)!=0){
		echo "erro-33#A data de conclusão do mestrado não está em um formato válido !!!";
		exit;
	}
	$area_atuacao = filter_var($_POST["area_atuacao"], FILTER_SANITIZE_STRING);
	if (strlen($area_atuacao)<0 || strlen($area_atuacao)>300){
		echo "erro-34#A área de atuação deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$areas_profissionais_permitidas = array("Docente da UFRRJ", "Docente de IES no País", "Docente de IES no Exterior", "Pesquisador", "Outro Vínculo", "Sem Vínculo");
	$area_profissional = filter_var($_POST["area_profissional"], FILTER_SANITIZE_STRING);
	if (!in_array($area_profissional, $areas_profissionais_permitidas)){
		echo "erro-35#O nível do curso não está em um formato válido ou não é permitido !!!!!!";
		exit;
	}
	$cargo = filter_var($_POST["cargo"], FILTER_SANITIZE_STRING);
	if (strlen($cargo)<0 || strlen($cargo)>300){
		echo "erro-36#O cargo deve conter no máximo 300 três caracteres !!!";
		exit;
	}
	$matricula = filter_var($_POST["matricula"], FILTER_SANITIZE_STRING);
	if (strlen($matricula)<0 || strlen($matricula)>300){
		echo "erro-37#A matrícula profissional deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$doutorado_sem_bolsa = filter_var($_POST["doutorado_sem_bolsa"], FILTER_SANITIZE_STRING);
	if (!in_array($doutorado_sem_bolsa, $sim_ou_nao)){
		echo "erro-38#A resposta sobre o doutorado sem bolsa deve ser sim ou não !!!";
		exit;
	}
	$sair_emprego = filter_var($_POST["sair_emprego"], FILTER_SANITIZE_STRING);
	if (!in_array($sair_emprego, $sim_ou_nao)){
		echo "erro-39#A resposta sobre sair do emprego caso ganhe uma bolsa deve ser sim ou não !!!";
		exit;
	}
	$rua_trabalho = filter_var($_POST["rua_trabalho"], FILTER_SANITIZE_STRING);
	if (strlen($rua_trabalho)<0 || strlen($rua_trabalho)>300){
		echo "erro-40#A rua do local do seu trabalho deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$numero_trabalho = filter_var($_POST["numero_trabalho"], FILTER_SANITIZE_STRING);
	if (strlen($numero_trabalho)<0 || strlen($numero_trabalho)>300){
		echo "erro-41#O número do local do seu trabalho deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$complemento_trabalho = filter_var($_POST["complemento_trabalho"], FILTER_SANITIZE_STRING);
	if (strlen($complemento_trabalho)<0 || strlen($complemento_trabalho)>300){
		echo "erro-42#O complemento do local do seu trabalho deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$bairro_trabalho = filter_var($_POST["bairro_trabalho"], FILTER_SANITIZE_STRING);
	if (strlen($bairro_trabalho)<0 || strlen($bairro_trabalho)>300){
		echo "erro-43#O bairro do local do seu trabalho deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$cidade_trabalho = filter_var($_POST["cidade_trabalho"], FILTER_SANITIZE_STRING);
	if (strlen($cidade_trabalho)<0 || strlen($cidade_trabalho)>300){
		echo "erro-44#A cidade do local do seu trabalho deve conter no máximo 300 caracteres !!!";
		exit;
	}
	$cep_trabalho = filter_var($_POST["cep_trabalho"], FILTER_SANITIZE_STRING);
	if(preg_match("/^[0-9]{2}\.[0-9]{3}\-[0-9]{3}$/",$cep_trabalho) || strlen($cep_trabalho)>300){
		echo "erro-45#CEP do local do seu trabalho está inválido !!!";
		exit;
	}
	$estado_trabalho = filter_var($_POST["estado_trabalho"], FILTER_SANITIZE_STRING);
	//problema
	if (!in_array($estado_trabalho, $estados_permitidos) && strlen($estado_trabalho)!=0){
		echo "erro-46#O estado não está no formato aceito ou não é válido !!!";
		exit;
	}
	$orientador = filter_var($_POST["orientador"], FILTER_SANITIZE_STRING);
	if (strlen($orientador)<3 || strlen($orientador)>300){
		echo "erro-47#Orientador inválido !!!";
		exit;
	}


//levando em conta que tudo já foi verificado
//guardando os dados via POST

$query_cadastra = "INSERT INTO usuario VALUES ($email, $senha, $nome, $cpf, $rg, $data_expedicao, $orgao_expedidor, $data_nascimento,
						$nome_mae, $nome_pai, $estado_civil, $nacionalidade, $naturalidade, $fixo, $celular, $rua, $numero, $complemento, $bairro,
						$cidade, $cep, $estado, $graduacao, $instituicao_graduacao, $data_inicio_graduacao, $data_conclusao_graduacao, 
						$bolsa_ic, $mestrado, $instituicao_mestrado, $data_inicio_mestrado, $data_conclusao_mestrado, $area_atuacao, 
						$area_profissional, $cargo, $matricula, $doutorado_sem_bolsa, $rua_trabalho, $numero_trabalho, $complemento_trabalho,
						$bairro_trabalho, $cidade_trabalho, $cep_trabalho, $estado_trabalho, $orientador)";
?>
