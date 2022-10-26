export default {
    template: `
        <div v-show="show" >
            <table class="wrapper" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="welcome">

                            <h1 v-show="result.showWinner" > <span v-text="result.winner"></span> won!</h1>
                            <h1 v-show="result.showTie" >It's a tie!</h1>

                            <div  class="player-name">
                                <span v-text="result.playerX"></span>'s score: <b><span v-text="result.scoreX"></span></b>
                            </div>

                            <div class="player-name">
                                <span v-text="result.playerO"></span>'s score: <b><span v-text="result.scoreO"></span></b>
                            </div> 

                            <button type="button" @click="replay" class="playAgain">Play again</button>
                            <button type="button" @click="reset" class="resetGame">Reset Game</button>

                        </div>
                    </td>
                </tr>
            </table>
        </div>
    `,

    methods: {
        replay() {
            this.$emit('replay');
        },
        reset() {
            this.$emit('reset');
        }
    },
    props: {
        show: Boolean,
        result: Object
    }
}