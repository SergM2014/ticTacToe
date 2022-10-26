import RegisterForm from "/components/RegisterForm.js";
import ResultBlock from "/components/ResultBlock.js";
export default {
    components: { RegisterForm, ResultBlock },

    data () {
        return {
            showRegister: true,
            showPlayBoard: false,
            showResult: false,
            player: '',
            turnSign: 'x',
            result: {}
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
                }
                if (json.play == true ) {
                    this.showPlayBoard = true; 
                    this.showRegister = false;           
        
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

        register(playerX, playerO) {
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

                        this.result.playerX = json.playerX;
                        this.result.playerO = json.playerO;

                        this.result.scoreX = json.scoreX;
                        this.result.scoreO = json.scoreO;

                        if(json.win) {
                            this.result.showWinner = true;
                            this.result.winner = json.player;
                            this.result.showTie = false;
                        }
                        if(json.tie) {
                            this.result.showTie = true;
                            this.result.showWinner = json.player;
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