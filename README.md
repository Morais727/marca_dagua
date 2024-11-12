Este código PHP aplica uma marca d'água (imagem ou texto) a todas as páginas de um PDF usando a biblioteca FPDI. Ele foi criado para oferecer flexibilidade no tipo de marca d'água, permitindo que o usuário selecione entre uma marca d'água de texto ou uma imagem, com controles adicionais para tamanho e opacidade da marca d'água.

Descrição do Funcionamento
Configuração da Marca D'Água:

O código define variáveis para o arquivo PDF de entrada, nome do PDF de saída, tipo de marca d'água (imagem ou texto), cor, opacidade, rotação, e tamanho.
Geração da Marca D'Água:

Para texto: O código cria uma imagem temporária com o texto desejado usando a biblioteca GD, permitindo controle sobre cor, rotação, opacidade e tamanho da fonte.
Para imagem: A imagem fornecida é carregada e redimensionada com a opacidade ajustada. A opacidade é gerida com a função imagecopymerge, simulando uma transparência ajustável.
Aplicação ao PDF:

O código percorre todas as páginas do PDF original, adicionando a marca d'água (imagem ou texto) no centro de cada página, com as configurações de opacidade e tamanho aplicadas.
Geração do PDF Final:

Após inserir a marca d'água em todas as páginas, o código salva o novo PDF com o nome especificado, contendo a marca d'água visível em cada página.
Como foi Feito
FPDI: Utilizada para manipular o PDF, importar páginas e aplicar imagens como marca d'água.
GD: Biblioteca usada para criar e manipular imagens no PHP, especialmente útil para criar a marca d'água de texto e ajustar a opacidade e tamanho da imagem.
Este código oferece flexibilidade, permitindo a aplicação de marca d'água de forma personalizável em PDFs com controle direto sobre parâmetros de opacidade, tamanho e estilo da marca d'água.
