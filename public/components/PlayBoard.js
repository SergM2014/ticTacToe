import Cell from "/components/Cell.js";

export default {
    components: { Cell },
    template: `
        <div v-show="show">
            <h2>
                <span  v-text="player"></span>'s turn, plays by
                <span  class="red" v-text="turnSign"></span>
            </h2>

            <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
                <tbody>

                    <tr class="row-1">
                        <cell :id = 1 :cells="cells"></cell>
                        <cell :id = 2 addClass="vertical-border" :cells="cells"></cell>
                        <cell :id = 3 :cells="cells"></cell>
                    </tr>
                    <tr class="row-2">
                        <cell :id = 4 addClass="horizontal-border" :cells="cells"></cell>
                        <cell :id = 5 addClass="center-border" :cells="cells"></cell>
                        <cell :id = 6 addClass="horizontal-border" :cells="cells"></cell>
                    </tr>
                    <tr class="row-3">
                        <cell :id = 7 :cells="cells"></cell>
                        <cell :id = 8 addClass="vertical-border" :cells="cells"></cell>
                        <cell :id = 9 :cells="cells"></cell>
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
        cells: Object,
    }

}