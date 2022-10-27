import NullSign from "/components/signs/NullSign.js";
import Xsign from "/components/signs/Xsign.js";
import Osign from "/components/signs/Osign.js";

export default {
    components: { Xsign, Osign, NullSign },
    template: `
        <div v-show="show">
            <h2>
                
                <span  v-text="player"></span>'s turn, plays by
                <span  class="red" v-text="turnSign"></span>
            
            </h2>

            <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
                <tbody>

                    <tr class="row-1">
                        <td class="cell" :class="{'played': playedCell(1)}" id="cell_1" @click="$emit('turn', 1 )" ><component :is="showComponent(1)"></component></td>
                        <td class="cell  vertical-border" :class="{'played': playedCell(2)}" id="cell_2" @click="$emit('turn', 2 )"><component :is="showComponent(2)"></component></td>
                        <td class="cell" :class="{'played': playedCell(3)}" id="cell_3" @click="$emit('turn', 3 )" ><component :is="showComponent(3)"></component></td>
                    </tr>
                    <tr class="row-2">
                        <td class="cell horizontal-border" :class="{'played': playedCell(4)}" id="cell_4" @click="$emit('turn', 4 )"><component :is="showComponent(4)"></component></td>
                        <td class="cell center-border" :class="{'played': playedCell(5)}" id="cell_5" @click="$emit('turn', 5 )"><component :is="showComponent(5)"></component></td>
                        <td class="cell horizontal-border" :class="{'played': playedCell(6)}" id="cell_6" @click="$emit('turn', 6 )"><component :is="showComponent(6)"></component></td>
                    </tr>
                    <tr class="row-3">
                        <td class="cell" :class="{'played': playedCell(7)}" id="cell_7" @click="$emit('turn', 7 )"><component :is="showComponent(7)"></component></td>
                        <td class="cell vertical-border" :class="{'played': playedCell(8)}" id="cell_8" @click="$emit('turn', 8 )"><component :is="showComponent(8)"></component></td>
                        <td class="cell" :class="{'played': playedCell(9)}" id="cell_9" @click="$emit('turn', 9 )"><component :is="showComponent(9)"></component></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    `,
    data () {
        return {}
    },
   methods:{
    showComponent(id) {
        let sign;
        if (this.cells[id] == 'x') sign = 'Xsign';
        if (this.cells[id] == 'o') sign = 'Osign';
        if (!this.cells[id]) sign = 'NullSign';
       
        return sign;
    },
    playedCell(id) {
        if (this.cells[id] == 'x' || this.cells[id] == 'o') return true;
        return false;
    }
   },
    props: {
        show: Boolean,
        player: String,
        turnSign: String, 
        cells: Object,
    }

}