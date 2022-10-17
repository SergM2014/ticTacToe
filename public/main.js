document.body.addEventListener('click', function(e){
    
    if(e.target.closest('.cell')){
        let target = e.target.closest('.cell');

        if(target.classList.contains('played')) return;
        
        let cell = target.dataset.id;
        let turnSign = document.getElementById('turnSign').innerText;
        let img = document.createElement('img');
    
        let src = turnSign === 'x'? "/images/cross.png" : "/images/circle.png";
        img.src= src;
        img.classList.add('smallImg')
        target.appendChild(img);

        let formData = new FormData;
        formData.append('cell', cell);
        
        fetch(
            '/api/turn', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin',
            }
        )
        .then(response => response.json())
        .then(json => {
            document.getElementById('player').innerText = json.player;
            document.getElementById('turnSign').innerText = json.turnSign;
            if(json.win) {
                document.location.href=`/result?player=${json.player}`;
            }
            if(json.tie) {
                document.location.href=`/result`;
            }
        })
    }
})