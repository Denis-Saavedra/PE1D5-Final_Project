<div class="balacobaco">

    <div id="loading-screen">
        <div class="spinner"></div>
        <p>Processando Video...</p>
    </div>

    <div class="container">
        <div class="row">
            <!-- Upload de Vídeo -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class = "video-frame d-flex flex-column align-items-center justify-content-center">
                    <video id="videoPreview" autoplay muted loop>
                        <source src="{{$uploadedVideoUrl}}" type="video/mp4">
                        Seu navegador não suporta o elemento de vídeo.
                    </video>
                    <div class="conteudo d-flex flex-column align-items-center justify-content-center">
                        <input id= "videoInput" type="file" wire:model="video" accept="video/mp4" style="margin-bottom: 10px;">
                    </div>
                </div>
                <button wire:click="uploadVideo" {{ !$video ? 'disabled' : '' }}>Enviar Vídeo</button>
            </div>

            <!-- Resultado da Análise -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <textarea disabled>{{ $mensagem }}</textarea>
                <button id="analyzeVideo" wire:click="analyzeVideo" {{ !$uploadedVideoPath ? 'disabled' : '' }}>Analisar Vídeo</button>
            </div>
        </div>
    </div>
</div>
