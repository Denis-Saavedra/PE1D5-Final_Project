<?php

namespace App\Livewire\Pages;

use Google\Cloud\VideoIntelligence\V1\Client\VideoIntelligenceServiceClient;
use Google\Cloud\VideoIntelligence\V1\Feature;
use Google\Cloud\VideoIntelligence\V1\AnnotateVideoRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . realpath('..\config\key-projeto-pe1d5.json'));

class Home extends Component
{
    use WithFileUploads;

    public $video;
    public $uploadedVideoUrl;

    public function uploadVideo()
    {
        $this->uploadedVideoPath = $this->video->store('videos\tmp', 'public');
        $this->mensagem = "Vídeo enviado com sucesso. Pronto para análise.";
        $this->uploadedVideoUrl = asset('storage/' . $this->uploadedVideoPath);
    }

    // Propriedade pública para armazenar as mensagens
    public $mensagem;
    public $uploadedVideoPath;

    public function render()
    {
        return view('livewire.pages.home');
    }

    // Método para analisar o vídeo
    public function analyzeVideo()
    {

        $videoPath = storage_path('app/public/' . $this->uploadedVideoPath);

        if (!file_exists($videoPath)) {
            $this->mensagem = "Erro: O arquivo de vídeo não foi encontrado." . $videoPath;
            return;
        }

        try {
            set_time_limit(300); // 5 minutos

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

            $operation->pollUntilComplete();

            // Processa os resultados
            if ($operation->operationSucceeded()) {
                $response = $operation->getResult();
                $tags = [];

                foreach ($response->getAnnotationResults() as $result) {
                    foreach ($result->getSegmentLabelAnnotations() as $label) {
                        // Transformar a descrição em hashtag
                        $tag = "#" . str_replace(" ", "_", strtolower($label->getEntity()->getDescription()));
                        $tags[] = $tag;
                    }
                }

                // Concatenar as tags com espaços
                $this->mensagem = implode("  ", $tags);
            }
             else {
                // Verifica se houve erro no processamento
                $this->mensagem = "Erro: " . $operation->getError()->getMessage();
            }
        } catch (\Exception $e) {
            // Captura e exibe erros específicos
            throw new \Exception("Erro ao processar o vídeo: " . $e->getMessage());
        }
        $this->dispatch('processCompleted');
    }

}
