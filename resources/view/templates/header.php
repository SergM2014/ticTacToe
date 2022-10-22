<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>TicTacToe game</title>

    <link rel='stylesheet' href='/style.css?ver=<?=time() ?>' type='text/css'/>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script type="module">
        import App from "/components/App.js";
        Vue.createApp(App).mount('#app');

    </script>
   
</head>
<body>

    <div id="app" class="wrapper">
