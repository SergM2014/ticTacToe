export default {
    
    data () {
        return {
            showRegister: false,
            showPlayBoard: false,
            showResult: false,
            player: '',
            turnSign: 'x',
            playerX: '',
            playerO: '',
            playerXresult: '',
            playerOresult: '',
            scoreX: 0,
            scoreO: 0,
            winner: '',
            outputWinner: false,
            outputTie: false,
          ///  cells: [1,2,3,4,5,6,7,8,9],
            gridrows: [0,1,2],
        }
    },

    methods: {
        init() {
            fetch(
                '/api/init', {
                method: 'POST',
                credentials: 'same-origin',
                }
            )
            .then(response => response.json())
            .then(json => {
        
                if(!json.registered) {
                    this.showRegister = true;
                } else {
                    this.showPlayBoard = true;            
        
                    this.player = json.player;
                    this.turnSign = json.turnSign;
        
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
            },

        cleanBoard() {
            let itemsToDel = document.querySelectorAll('.smallImg');
            let classesToDel = document.querySelectorAll('.cell');

            for (let i = 0; i < itemsToDel.length; i++) { 
                itemsToDel[i].remove();
            }

            for(let i = 0; i< classesToDel.length; i++) {
                classesToDel[i].classList.remove('played');
            }
        },

        register() {
            let formData = new FormData;
            formData.append('playerX', this.playerX);
            formData.append('playerO', this.playerO);
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
                    this.showRegister = true;
                }
                if (json.play == true) {
                    this.cleanBoard();
                    this.showRegister = false;
                    this.showPlayBoard = true;

                    this.player = json.player;
                    this.turnSign = json.turnSign;
                }
            })
        },

        turn(id) {
            let targetCell = document.getElementById(`cell_${id}`);
            if(targetCell.classList.contains('played'))return;
            
            let img = document.createElement('img');
        
            let src = this.turnSign === 'x'? "/images/cross.png" : "/images/circle.png";
            img.src= src;
            img.classList.add('smallImg')
            targetCell.appendChild(img);
            targetCell.classList.add('played');

            let post = new FormData;
            post.append('cell', id);
            
            fetch(
                '/api/turn', {
                    method: 'POST',
                    body: post,
                    credentials: 'same-origin',
                }
                )
                .then(response => response.json())
                .then(json => {
                    this.player = json.player;
                    this.turnSign = json.turnSign;
                
                    if(json.win || json.tie) {
                        this.showResult = true;
                        this.showPlayBoard = false;

                        this.playerXresult = json.playerX;
                        this.playerOresult = json.playerO;

                        this.scoreX = json.scoreX;
                        this.scoreO = json.scoreO;

                        if(json.win) {
                            this.outputWinner = true;
                            this.winner = json.player;
                            this.outputTie = false;
                        }
                        if(json.tie) {
                            this.outputTie = true;
                            this.outputWinner = false;
                        }
                    }

                    this.player = json.player;
                    this.turnSign = json.turnSign;
                })
        } ,

        replay() {
            fetch(
                '/api/init', {
                method: 'POST',
                credentials: 'same-origin',
                }
            )
            .then(response => response.json())
            .then(json => {
                if (!json.playersRegistered) {
                    this.showRegister = true;
                }
                if (json.play == true) {
                    this.cleanBoard();  
                    this.showRegister = false;
                    this.showPlayBoard = true;
                    this.showResult = false;
                }
            })
        },
        
        reset() {
            fetch(
                '/api/reset', {
                method: 'POST',
                credentials: 'same-origin',
                }
            )
            .then(response => response.json())
            .then(json => {
                if (!json.playersRegistered) {
                    this.showRegister = true;
                    this.showResult = false;
                    this.cleanBoard();  
                }
            })
        }
    },

    mounted() {
        this.init()
    }
}