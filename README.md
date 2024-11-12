# Marca D'Água em PDF com PHP

Este projeto aplica uma marca d'água (imagem ou texto) a todas as páginas de um PDF usando a biblioteca FPDI. Ele foi criado para oferecer flexibilidade no tipo de marca d'água, permitindo que o usuário selecione entre uma marca d'água de texto ou uma imagem, com controles adicionais para tamanho e opacidade da marca d'água.

## Descrição do Funcionamento

### Configuração da Marca D'Água
O código define variáveis para o arquivo PDF de entrada, nome do PDF de saída, tipo de marca d'água (imagem ou texto), cor, opacidade, rotação e tamanho.

### Geração da Marca D'Água
- **Para texto**: O código cria uma imagem temporária com o texto desejado usando a biblioteca GD, permitindo controle sobre cor, rotação, opacidade e tamanho da fonte.
- **Para imagem**: A imagem fornecida é carregada e redimensionada com a opacidade ajustada. A opacidade é gerida com a função `imagecopymerge`, simulando uma transparência ajustável.

### Aplicação ao PDF
O código percorre todas as páginas do PDF original, adicionando a marca d'água (imagem ou texto) no centro de cada página, com as configurações de opacidade e tamanho aplicadas.

### Geração do PDF Final
Após inserir a marca d'água em todas as páginas, o código salva o novo PDF com o nome especificado, contendo a marca d'água visível em cada página.

## Tecnologias Utilizadas

- **FPDI**: Utilizada para manipular o PDF, importar páginas e aplicar imagens como marca d'água.
- **GD**: Biblioteca usada para criar e manipular imagens no PHP, especialmente útil para criar a marca d'água de texto e ajustar a opacidade e tamanho da imagem.

## Funcionalidades

Este código oferece flexibilidade, permitindo a aplicação de marca d'água de forma personalizável em PDFs com controle direto sobre parâmetros de opacidade, tamanho e estilo da marca d'água.

## Como Usar

1. Clone o repositório e instale as dependências usando Composer:
   ```bash
   git clone https://github.com/SeuUsuario/MarcaDaguaPDF.git
   cd MarcaDaguaPDF
   composer install
   ```

2. Configure as variáveis no arquivo `gera_marca_dagua.php`, como:
   - Caminho do PDF de entrada e saída
   - Tipo de marca d'água (imagem ou texto)
   - Cor, opacidade, rotação e tamanho

3. Execute o script:
   ```bash
   php gera_marca_dagua.php
   ```

O novo PDF com a marca d'água será gerado no diretório especificado.

## Exemplo de Configuração

```php
$inputPdf = 'exemplo.pdf';             
$outputPdf = 'exemplo_com_marca_dagua.pdf';
$textoMarcaDagua = 'MARCA D\'ÁGUA';
$rotacao = 45;                         
$cor = [0, 0, 255];                    
$opacidade = 0.5;                      
$tamanhoFonte = 20;
$isImage = false;                      // Define se a marca d'água é uma imagem (true) ou texto (false)
$imagemTamanho = 0.5;                  // Proporção do tamanho da imagem (ex: 0.5 = 50% do tamanho original)
```

## Observações

Certifique-se de que a biblioteca GD está habilitada no seu ambiente PHP, pois é necessária para manipular imagens.

## Licença

Este projeto é licenciado sob a MIT License. Consulte o arquivo LICENSE para mais detalhes.
