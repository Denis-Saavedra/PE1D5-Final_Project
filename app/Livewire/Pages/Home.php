<?php

namespace App\Livewire\Pages;

use Google\Cloud\VideoIntelligence\V1\Client\VideoIntelligenceServiceClient;
use Google\Cloud\VideoIntelligence\V1\Feature;
use Google\Cloud\VideoIntelligence\V1\AnnotateVideoRequest;
use Livewire\Component;

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . realpath('..\config\key-projeto-pe1d5.json'));

class Home extends Component
{
    // Propriedade pública para armazenar as mensagens
    public $mensagem;

    public function render()
    {
        return view('livewire.pages.home');
    }

    // Método para analisar o vídeo
    public function analyzeVideo()
    {
        $videoPath = base_path('media/Nyan_Cat.mp4');

        // Verifica se o arquivo existe
        if (!file_exists($videoPath)) {
            $this->mensagem = "Erro: O arquivo de vídeo não foi encontrado no caminho especificado.";
            return;
        }

        try {
            // Instancia o cliente da API
            $videoClient = new VideoIntelligenceServiceClient();

            // Carrega o vídeo em binário
            $videoContent = file_get_contents($videoPath);

            // Define o tipo de análise: rotulagem de objetos
            $features = [Feature::LABEL_DETECTION];

            // Cria a instância de AnnotateVideoRequest
            $request = new AnnotateVideoRequest();
            $request->setInputContent($videoContent);
            $request->setFeatures($features);

            // Envia o vídeo para análise
            $operation = $videoClient->annotateVideo($request);

            $this->mensagem = "Processando o vídeo...";
            $operation->pollUntilComplete();

            // Processa os resultados
            if ($operation->operationSucceeded()) {
                $response = $operation->getResult();
                $tags = [];

                foreach ($response->getAnnotationResults() as $result) {
                    foreach ($result->getSegmentLabelAnnotations() as $label) {
                        $tags[] = "Tag: " . $label->getEntity()->getDescription();
                        foreach ($label->getSegments() as $segment) {
                            $start = $segment->getSegment()->getStartTimeOffset();
                            $end = $segment->getSegment()->getEndTimeOffset();
                            $tags[] = "  Tempo: " . $start->serializeToJsonString() . " - " . $end->serializeToJsonString();
                        }
                    }
                }

                $this->mensagem = implode("<br>", $tags);
            } else {
                // Verifica se houve erro no processamento
                $this->mensagem = "Erro: " . $operation->getError()->getMessage();
            }
        } catch (\Exception $e) {
            // Captura e exibe erros específicos
            throw new \Exception("Erro ao processar o vídeo: " . $e->getMessage());
        }
    }

}
