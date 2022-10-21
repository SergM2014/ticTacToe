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
        
                    // let img;
                    // let cells = document.querySelectorAll('.cell');
                    // for (let i = 0; i < cells.length; i++) { 
                    //     if (json.playedCells[i+1] ){
                    //         if(json.playedCells[i+1] == "x"){
                    //             img = `<img src="/images/cross.png" class="smallImg" />`;
                    //         } else {
                    //             img = `<img src="/images/circle.png" class="smallImg" />`;
                    //         }
        
                    //         cells[i].innerHTML = img;
                    //         cells[i].classList.add('played');
                    //     }
                    // }
                }
            })
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
                       // cleanBoard();
                        this.showRegister = false;
                        this.showPlayBoard = true;

                        this.player = json.player;
                        this.turnSign = json.turnSign;
            }
        })
            }
        },
        mounted() {
            this.init()
        }
    
}