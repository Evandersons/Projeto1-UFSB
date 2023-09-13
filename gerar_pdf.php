<?php

//Referenciando o namespace Dompdf
use Dompdf\Dompdf;
use Dompdf\FrameDecorator\Table;

//Carregando o Composer
require './vendor/autoload.php';

//Recebendo os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Convertendo as datas
$timestamp_inicial_1 = strtotime($dados['datainicial_1']);
$new_datainicial_1 = date("d/m/Y", $timestamp_inicial_1);

$timestamp_final_1 = strtotime($dados['datafinal_1']);
$new_datafinal_1 = date("d/m/Y", $timestamp_final_1);

$timestamp_inicial_2 = strtotime($dados['datainicial_2']);
$new_datainicial_2 = date("d/m/Y", $timestamp_inicial_2);

$timestamp_final_2 = strtotime($dados['datafinal_2']);
$new_datafinal_2 = date("d/m/Y", $timestamp_final_2);

$timestamp_apartir = strtotime($dados['apartirData']);
$new_apartir = date("d/m/Y", $timestamp_apartir);

$timestamp_data = strtotime($dados['data']);
$new_data = date("d/m/Y", $timestamp_data);

    //Calculando número de dias
    $diferenca_1 = strtotime($dados['datafinal_1']) - strtotime($dados['datainicial_1']);
    $dias_1 = floor($diferenca_1 / (60 * 60 * 24));

    $diferenca_2 = strtotime($dados['datafinal_2']) - strtotime($dados['datainicial_2']);
    $dias_2 = floor($diferenca_2 / (60 * 60 * 24));


if (!empty($dados['Enviar'])) {

    //Informações para o PDF
    $conteudo_pdf = "<!DOCTYPE html>";
    $conteudo_pdf .= "<html lang='pt-br'>";
    $conteudo_pdf .= "<head>";
    $conteudo_pdf .= "<meta charset='UTF-8'>";
    $conteudo_pdf .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $conteudo_pdf .= "<link rel='stylesheet' href='http://localhost/interrupção-form/css/custom.css'";
    $conteudo_pdf .= "</head>";
    $conteudo_pdf .= "<body>";
    $conteudo_pdf .= "<img class='cabecalho' src='http://localhost/interrupção-form/imagens/logoUFSB.jpg'><br>";

    $conteudo_pdf .= "<p class='titulo'>FORMULÁRIO PARA INTERRUPÇÃO DE FÉRIAS</p>";
    
    //Tabela - Identificação
    $conteudo_pdf .= "<table border='1' width='100%'>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th colspan='2'>IDENTIFICAÇÃO</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th class='nome-siape'>Nome: " . $dados['nome'] . "</th>"; 
    $conteudo_pdf .= "<th class='nome-siape'>SIAPE: " . $dados['siape'] . "</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "</table>";
    $conteudo_pdf .= "<br>";



    //Tabela - Declaração da Solicitação
    $conteudo_pdf .= "<table border='1'>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th class='fundo'>À Pró-Reitoria de Gestão para Pessoas – PROGEPE</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<td>Venho por meio deste, solicitar a interrupção do gozo de férias referente
    ao exercício do ano de " . $dados['ano'] . ", a partir do dia " . $new_apartir .  " conforme art.
    80 da Lei 8.112/1990.</td>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "</table>";
    $conteudo_pdf .= "<table border='1'>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th colspan='3'>PARCELA A INTERROMPER</th>";
    $conteudo_pdf .= "<th colspan='3'>NOVA PARCELA A SER REMARCADA</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th class='datas'>Data Inicial</th>";
    $conteudo_pdf .= "<th class='datas'>Data Final</th>";
    $conteudo_pdf .= "<th class='datas'>N° de Dias</th>";
    $conteudo_pdf .= "<th class='datas'>Data Inicial</th>";
    $conteudo_pdf .= "<th class='datas'>Data Final</th>";
    $conteudo_pdf .= "<th class='datas'>N° de Dias</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<td>$new_datainicial_1</td>";
    $conteudo_pdf .= "<td>$new_datafinal_1</td>";
    $conteudo_pdf .= "<td>$dias_1</td>";
    $conteudo_pdf .= "<td>$new_datainicial_2</td>";
    $conteudo_pdf .= "<td>$new_datafinal_2</td>";
    $conteudo_pdf .= "<td>$dias_2</td>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .="</table>";
    $conteudo_pdf .="<br>";

    //Tabela - Justificativa
    $conteudo_pdf .= "<table border='1'>";
    $conteudo_pdf .= "<tr align='center'>";
    $conteudo_pdf .= "<th class='fundo'>JUSTIFICATIVA (enviar comprovante em anexo ao formulário)</th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<td class='just'>" . $dados['just'] . "</td>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "<br>";
    $conteudo_pdf .= "<br>";
    $conteudo_pdf .= "<br>";
    $conteudo_pdf .= "<br>";
    $conteudo_pdf .= "</table>";
    $conteudo_pdf .= "<br>";

    //Tabela - Observação
    $conteudo_pdf .= "<table border='1'>";
    $conteudo_pdf .= "<tr>";
    $conteudo_pdf .= "<th class='obs' align='justify'>
    OBS.: 
    <br>1.	A alteração do período de férias deverá ser feita pelo próprio servidor, via aplicativo SOUGOV, com 45 dias de antecedência da data almejada.
     
    <br>2.	A interrupção de férias poderá ser solicitada apenas quando o usufruto do período de férias já estiver iniciado. Somente ocorrerá, no mínimo, após um dia do início do período de férias.
    
    <br>3.	Segundo o art. 80 da Lei 8.112/1990, as férias somente poderão ser interrompidas por motivo de calamidade pública, comoção interna, convocação para júri, serviço militar ou eleitoral, ou por necessidade do serviço declarada pela autoridade máxima do órgão ou entidade. E, o restante do período interrompido será gozado de uma só vez.
    
    <br>4.	O formulário sem o documento de comprovação da justificativa apresentada será automaticamente indeferido.  Assim como, possuir distorção referente ao exercício, datas e assinaturas.
    
    <br>5.	A comprovação deverá ser inserida no mesmo arquivo do FORMULÁRIO PARA INTERRUPÇÃO DE FÉRIAS em formato PDF. 
    </th>";
    $conteudo_pdf .= "</tr>";
    $conteudo_pdf .= "</table>";
    $conteudo_pdf .= "<br>";

    //Data do dia
    $conteudo_pdf .= "<p class='data-do-dia'>Data: " . $new_data . "</p>";

    
    //Assinatura
    $conteudo_pdf .= "<h3 class='linha'>     __________________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________ </h3>";
    $conteudo_pdf .= "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assinatura do Servidor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Assinatura da Chefia</h3>";

    //rodapé
    $conteudo_pdf .= "<p class='rodape'>
    PRÓ-REITORIA DE GESTÃO PARA PESSOAS - PROGEPE<br>
    Praça José Bastos, s/n, Centro<br>
    Itabuna-Bahia – CEP 45.600-923<br>
    www.ufsb.edu.br/progepe<br>
    </p>";

    $conteudo_pdf .= "</body>";
    $conteudo_pdf .= "</html>";

    //Instanciando e usando a classe Dompdf
    $dompdf = new Dompdf(['enable_remote' => true]);

    //Instanciando o método loadhtml e enviar o conteúdo do PDF
    $dompdf->loadHtml($conteudo_pdf);

    //Configurando o tamanho e a orientação do papel:
    $dompdf->setPaper('A4', 'portrait');

    //Renderizando o HTML como PDF
    $dompdf->render();

    //Gerando o PDF
    $dompdf->stream("Formulário de Interrupção de Férias");

} else {
    header("Location: index.php");
}
?>