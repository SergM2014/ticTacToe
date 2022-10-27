export default {
    template: `
        <div v-show="show">
            <h2>
                
                <span  v-text="player"></span>'s turn, plays by
                <span  class="red" v-text="turnSign"></span>
            
            </h2>

            <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
                <tbody>

                    <tr class="row-1">
                        <td class="cell" id="cell_1" @click="$emit('turn', 1 )"></td>
                        <td class="cell vertical-border" id="cell_2" @click="$emit('turn', 2 )"></td>
                        <td class="cell" id="cell_3" @click="$emit('turn', 3 )"></td>
                    </tr>
                    <tr class="row-2">
                        <td class="cell horizontal-border" id="cell_4" @click="$emit('turn', 4 )"></td>
                        <td class="cell center-border" id="cell_5" @click="$emit('turn', 5 )"></td>
                        <td class="cell horizontal-border" id="cell_6" @click="$emit('turn', 6 )"></td>
                    </tr>
                    <tr class="row-3">
                        <td class="cell" id="cell_7" @click="$emit('turn', 7 )"></td>
                        <td class="cell vertical-border" id="cell_8" @click="$emit('turn', 8 )"></td>
                        <td class="cell" id="cell_9" @click="$emit('turn', 9 )"></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    `,
    data () {
        return {}
    },
   
    props: {
        show: Boolean,
        player: String,
        turnSign: String, 
    }

}