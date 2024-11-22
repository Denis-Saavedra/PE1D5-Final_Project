<div>
    <button wire:click="analyzeVideo">Analisar Vídeo</button>

    <!-- Exibir a mensagem de resposta -->
    <div>
        @if ($mensagem)
            <p>{{ $mensagem }}</p>
        @endif
    </div>
</div>
