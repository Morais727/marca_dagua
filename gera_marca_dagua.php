<?php
require_once 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

class PDFWithWatermarkImage extends Fpdi
{
    // Função para gerar a imagem da marca d'água ajustada ao tamanho do texto
    function gerarImagemMarcaDagua($texto, $angulo, $cor, $opacidade, $tamanhoFonte)
    {
        $fonte = __DIR__ . '/DeliusUnicase-Bold.ttf'; // Caminho para a fonte TTF

        // Calcula o tamanho exato da caixa de texto
        $caixaTexto = imagettfbbox($tamanhoFonte, $angulo, $fonte, $texto);
        $larguraTexto = abs($caixaTexto[2] - $caixaTexto[0]);
        $alturaTexto = abs($caixaTexto[1] - $caixaTexto[5]);

        // Cria uma imagem com base nas dimensões do texto
        $imagem = imagecreatetruecolor($larguraTexto, $alturaTexto);
        imagesavealpha($imagem, true);
        $fundoTransparente = imagecolorallocatealpha($imagem, 0, 0, 0, 127);
        imagefill($imagem, 0, 0, $fundoTransparente);

        // Cor da marca d'água com opacidade
        $corMarcaDagua = imagecolorallocatealpha($imagem, $cor[0], $cor[1], $cor[2], 127 * (1 - $opacidade));

        // Adiciona o texto rotacionado na imagem
        $x = 0; // X começa no início da imagem
        $y = $alturaTexto; // Y é definido como a altura total da imagem para evitar cortes no texto
        imagettftext($imagem, $tamanhoFonte, $angulo, $x, $y, $corMarcaDagua, $fonte, $texto);

        // Salva a imagem temporária
        $arquivoImagem = 'marca_dagua_temp.png';
        imagepng($imagem, $arquivoImagem);
        imagedestroy($imagem);

        return $arquivoImagem;
    }

    // Método para adicionar a imagem de marca d'água no PDF
    function adicionarImagemMarcaDagua($arquivoImagem, $larguraPagina, $alturaPagina)
    {
        // Carrega a imagem para obter suas dimensões
        $imagem = imagecreatefrompng($arquivoImagem);
        $larguraImagem = imagesx($imagem);
        $alturaImagem = imagesy($imagem);
        
        // Centraliza a imagem da marca d'água dentro da página
        $this->Image(
            $arquivoImagem,
            ($larguraPagina - $larguraImagem) / 2,
            ($alturaPagina - $alturaImagem) / 2,
            $larguraImagem,
            $alturaImagem
        );

        imagedestroy($imagem);
    }
}

function adicionarMarcaDagua($inputPdf, $outputPdf, $marcaDagua, $rotacao = 45, $cor = [255, 0, 0], $opacidade = 0.3, $tamanhoFonte = 40, $isImage = false) {
    $pdf = new PDFWithWatermarkImage();
    $pageCount = $pdf->setSourceFile($inputPdf);

    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $pdf->AddPage();
        $templateId = $pdf->importPage($pageNo);
        $pdf->useTemplate($templateId, 0, 0);

        // Obtém as dimensões da página
        $size = $pdf->getTemplateSize($templateId);
        
        if ($isImage) {
            // Marca d'água é uma imagem, adiciona diretamente
            $arquivoImagem = $marcaDagua; // Caminho da imagem fornecida pelo usuário
        } else {
            // Marca d'água é texto, gera a imagem temporária com o texto
            $arquivoImagem = $pdf->gerarImagemMarcaDagua($marcaDagua, $rotacao, $cor, $opacidade, $tamanhoFonte);
        }

        // Adiciona a imagem da marca d'água no centro da página
        $pdf->adicionarImagemMarcaDagua($arquivoImagem, $size['width'], $size['height']);

        // Remove o arquivo de imagem temporário se foi gerado a partir do texto
        if (!$isImage) {
            unlink($arquivoImagem);
        }
    }

    // Salva o PDF com a marca d'água
    $pdf->Output('F', $outputPdf);
}

// Defina as variáveis de configuração
$inputPdf = 'exemplo.pdf';             
$outputPdf = 'exemplo_com_marca_dagua.pdf';
$textoMarcaDagua = 'MARCA D\'ÁGUA'; // Ou um caminho para uma imagem se $isImage = true
$rotacao = 45;                         
$cor = [0, 0, 255];                    
$opacidade = 0.2;                      
$tamanhoFonte = 20;                    // Tamanho da fonte para o texto da marca d'água
$isImage = false;                      // Define se a marca d'água é uma imagem (true) ou texto (false)

// Chama a função com as configurações definidas
adicionarMarcaDagua($inputPdf, $outputPdf, $textoMarcaDagua, $rotacao, $cor, $opacidade, $tamanhoFonte, $isImage);
