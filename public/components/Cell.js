import Xsign from "/components/signs/Xsign.js";
import Osign from "/components/signs/Osign.js"

export default {
    components: { Xsign, Osign },
    template: `
    <td class="cell" 
    :class="{
        'played': playedCell,
        'vertical-border' : addClass === 'vertical-border',
        'horizontal-border' : addClass === 'horizontal-border',
        'center-border' : addClass === 'center-border'
    }" 
    
     @click="turn" ><component v-show="showComponent" :is="showComponent"></component></td>
    `,
    data(){
        return{

        }
    },
    props: {
        id: Number,
        cells: Object,
        addClass: String,
    },
    methods: {
        turn(){
            if(this.cells[this.id] == 'x' || this.cells[this.id] == 'o') return;
            this.$parent.$emit('turn' , this.id);
        }
    },
    computed: {
        playedCell() {
            let id = this.id;
            if (this.cells[id] == 'x' || this.cells[id] == 'o') return true;
            return false;
        },
        showComponent()
        {
            let id = this.id;
            let sign;
            if (this.cells[id] == 'x') sign = 'Xsign';
            if (this.cells[id] == 'o') sign = 'Osign';
            if (!this.cells[id]) sign = false;
           
            return sign;
        },
    },
    
}