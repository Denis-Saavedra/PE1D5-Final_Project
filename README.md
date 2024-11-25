
# Projeto Final - Tópicos Especiais I (PE1D5)

  

Este repositório contém o projeto final da matéria **Tópicos Especiais I (PE1D5)**. O trabalho consiste em uma aplicação web desenvolvida com **Laravel** e **Livewire**, que utiliza a **Google Cloud Video Intelligence API** para analisar vídeos enviados pelos usuários e gerar tags relacionadas ao conteúdo.

  

---

  

## 📝 **Descrição do Projeto**

  

A aplicação permite que os usuários façam upload de vídeos no formato `.mp4`. Após o processamento do vídeo, o sistema utiliza a Google Cloud Video Intelligence API para identificar categorias e características do conteúdo, retornando tags relevantes.

  
  

---

  

## ⚙️ **Tecnologias Utilizadas**

  

### **Back-End**

-  **[Laravel](https://laravel.com/):** Framework PHP para construção da aplicação.

-  **[Livewire](https://laravel-livewire.com/):** Ferramenta para criação de componentes reativos no Laravel.

  

### **Serviços de Nuvem**

-  **[Google Cloud Video Intelligence API](https://cloud.google.com/video-intelligence):** Serviço usado para análise e extração de informações dos vídeos.

  

### **Outras Dependências**

- PHP 8.2

  

---

  

## 🚀 **Funcionalidades**

  

1.  **Upload de Vídeos:**

Os usuários podem fazer upload de vídeos no formato `.mp4`.

  

2.  **Análise de Conteúdo:**

O sistema processa o vídeo usando a Google Cloud Video Intelligence API e identifica características como:

- Objetos no vídeo.

- Ações ou atividades realizadas.

- Contexto geral do vídeo.

  

3.  **Geração de Tags:**

Tags geradas são exibidas para os usuários com base na análise realizada.

  

4.  **Interface Dinâmica:**

- A interface é construída com **Livewire**, permitindo interatividade sem recarregar a página.

- Integração com o design moderno e responsivo.

  

---

  

## 🖥️ **Como Rodar o Projeto Localmente**

  

### **Pré-requisitos**

- [Composer](https://getcomposer.org/)

- PHP 8.2 ou superior

- [Laravel](https://laravel.com/docs/11.x/installation)

- [Node.js](https://nodejs.org/)

- Conta ativa no [Google Cloud Platform](https://cloud.google.com/).

  

### **Passos para Configuração**

  

1. Clone este repositório:

```bash

git clone https://github.com/Denis-Saavedra/PE1D5-Final_Project

cd PE1D5-Final_Project
   ```

2. Instale as dependências do Laravel:
   ```bash
   composer install
   ```

3. Configure a chave da Google Cloud API:
     ```env
     GOOGLE_CLOUD_API_KEY=sua_chave_google_cloud
     ```

4. Instale as dependências do front-end:
   ```bash
   npm install && npm run dev
   ```

5. Inicie o servidor:
   ```bash
   php artisan serve
   ```

6. Acesse a aplicação no navegador:
   ```
   http://localhost:8000
   ```

---

## 📂 **Estrutura do Projeto**

- **/app:** Contém os controladores, modelos e lógica de negócios.
- **/resources/views:** Arquivos Blade e componentes Livewire para renderização.
- **/routes:** Configuração de rotas da aplicação.
- **/public:** Arquivos estáticos (CSS, JS, etc.).

---

## 🖊️ **Autor**

Desenvolvido por **Denis Saavedra** como projeto final da disciplina **Tópicos Especiais I (PE1D5)**.
