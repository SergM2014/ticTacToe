import RegisterForm from "/components/RegisterForm.js";
import ResultBlock from "/components/ResultBlock.js";
import PlayBoard from "/components/PlayBoard.js";

export default {
    components: { RegisterForm, ResultBlock, PlayBoard },

    data () {
        return {
            showRegister: true,
            showPlayBoard: false,
            showResult: false,
            player: '',
            turnSign: 'x',
            result: {},
            cells: {},
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
                    this.cells = json.playedCells;
                    }
                })
            },

        cleanBoard() {
            this.cells = {}
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

        turn(parametr) {             
            this.cells[parametr] = this.turnSign;
            let post = new FormData;
            post.append('cell', parametr);
            
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