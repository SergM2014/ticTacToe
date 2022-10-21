let resultBlock = document.getElementById('resultBlock');
let playBoard = document.getElementById('playBoard');
let registerForm = document.getElementById('registerForm');

document.body.addEventListener('click', function(e){
    
    if(e.target.closest('.cell')){
        let target = e.target.closest('.cell');

        if(target.classList.contains('played'))return;
        
        let cell = target.dataset.id;
        let turnSign = document.getElementById('turnSign').innerText;
        let img = document.createElement('img');
    
        let src = turnSign === 'x'? "/images/cross.png" : "/images/circle.png";
        img.src= src;
        img.classList.add('smallImg')
        target.appendChild(img);
        target.classList.add('played');

        let post = new FormData;
        post.append('cell', cell);
        
        fetch(
            '/api/turn', {
            method: 'POST',
            body: post,
            credentials: 'same-origin',
            }
        )
        .then(response => response.json())
        .then(json => {
            document.getElementById('player').innerText = json.player;
            document.getElementById('turnSign').innerText = json.turnSign;
           
            if(json.win || json.tie) {
                resultBlock.classList.remove('hidden');
                playBoard.classList.add('hidden');

                document.getElementById('playerXresult').innerText = json.playerX;
                document.getElementById('playerOresult').innerText = json.playerO;

                document.getElementById('scoreX').innerText = json.scoreX;
                document.getElementById('scoreO').innerText = json.scoreO;

                if(json.win) {
                    document.getElementById('outputWinner').classList.remove('hidden');
                    document.getElementById('winnerName').innerText = json.player;
                    document.getElementById('outputTie').classList.add('hidden');
                }
                if(json.tie) {
                    document.getElementById('outputTie').classList.remove('hidden');
                    document.getElementById('outputWinner').classList.add('hidden');
                }
            }

            document.getElementById('player').innerText = json.player;
            document.getElementById('turnSign').innerText = json.turnSign;
        })
    }

    if(e.target.id === "playAgain"){
        fetch(
            '/api/init', {
            method: 'POST',
            credentials: 'same-origin',
            }
        )
        .then(response => response.json())
        .then(json => {
            if (!json.playersRegistered) {
                showRegisterForm();
            }
            if (json.play == true) {
                cleanBoard();  
                showPlayboard();
            }

        })
    }

    if(e.target.id === "resetGame"){
        fetch(
            '/api/reset', {
            method: 'POST',
            credentials: 'same-origin',
            }
        )
        .then(response => response.json())
        .then(json => {
            if (!json.playersRegistered) {
                showRegisterForm();
                cleanBoard();  
            }
        })
    }

    if(e.target.id === "registerButton"){
        let playerX = document.getElementById('playerX').value;
        let playerO = document.getElementById('playerO').value;
        
        let formData = new FormData;
        formData.append('playerX', playerX);
        formData.append('playerO', playerO);
        fetch(
            '/register', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin',
            }
        )
        .then(response => response.json())
        .then(json => {
            if (!json.playersRegistered) {
                showRegisterForm();
            }
            if (json.play == true) {
                cleanBoard();
                showPlayboard();

                document.getElementById('player').innerText = json.player;
                document.getElementById('turnSign').innerText = json.turnSign;
            }
        })
    }
})

document.body.onload = function(){
    fetch(
        '/api/init', {
        method: 'POST',
        credentials: 'same-origin',
        }
    )
    .then(response => response.json())
    .then(json => {

        if(!json.registered) {
            showRegisterForm();
            return;
        } else {
            showPlayboard();            

            document.getElementById('player').innerText = json.player;
            document.getElementById('turnSign').innerText = json.turnSign;

            let img;
            let cells = document.querySelectorAll('.cell');
            for (let i = 0; i < cells.length; i++) { 
                if (json.playedCells[i+1] ){
                    if(json.playedCells[i+1] == "x"){
                        img = `<img src="/images/cross.png" class="smallImg" />`;
                    } else {
                        img = `<img src="/images/circle.png" class="smallImg" />`;
                    }

                    cells[i].innerHTML = img;
                    cells[i].classList.add('played');
                }
            }
        }
    })
}

function cleanBoard()
{
    let itemsToDel = document.querySelectorAll('.smallImg');
    let classesToDel = document.querySelectorAll('.cell');

    for (let i = 0; i < itemsToDel.length; i++) { 
        itemsToDel[i].remove();
    }

    for(let i = 0; i< classesToDel.length; i++) {
        classesToDel[i].classList.remove('played');
    }
}

function showRegisterForm()
{
    registerForm.classList.remove('hidden');
    playBoard.classList.add('hidden');
    resultBlock.classList.add('hidden');
}

function showPlayboard()
{
    registerForm.classList.add('hidden');
    playBoard.classList.remove('hidden');
    resultBlock.classList.add('hidden');
}