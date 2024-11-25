const videoInput = document.getElementById('videoInput');
const videoPreview = document.getElementById('videoPreview');

videoInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        const videoURL = URL.createObjectURL(file); // Create an object URL for the video file
        videoPreview.src = videoURL; // Set the video source to the object URL
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Captura o botão de início
    const startButton = document.getElementById('analyzeVideo');

    // Exibe a tela de loading quando o botão for clicado
    startButton.addEventListener('click', () => {
        document.getElementById('loading-screen').style.display = 'flex'; // Mostra a tela de loading
    });

    // Escuta o evento disparado pelo Livewire
    Livewire.on('processCompleted', () => {
        // Esconde a tela de loading quando o processo for concluído
        document.getElementById('loading-screen').style.display = 'none';
    });
});
