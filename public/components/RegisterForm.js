export default {
    template: `
        <div v-show="show" class="welcome">
            <h1>Start playing Tic Tac Toe!</h1>
            <h2>Please fill in your names</h2>

                <form @submit.prevent="register">

                <div class="p-name">
                    <label for="playerX"> Player (First)</label>
                    <input type="text" id="playerX" name="playerX" required v-model="playerX"/>
                </div>

                <div class="p-name">
                    <label for="playerO"> Player (Second)</label>
                    <input type="text" id="playerO" name="playerO" required v-model="playerO" />
                </div>

                <button type="submit">Register</button>

            </form>
        </div>
         
    `,
    data() {
        return {
            playerX: '',
            playerO: '',
        }
    },
    methods: {
        register() {
            this.$emit('register', this.playerX, this.playerO);
        },
    },
    props: {
        show: Boolean,
    }
}