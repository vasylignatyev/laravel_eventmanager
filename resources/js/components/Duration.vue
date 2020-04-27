<template>
    <div class="container">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>0</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th v-if="!disabled">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="row in durationModel">
                        <td v-for="val in row">
                            <!-- input v-if="!val.checked" type="hidden" :value="val.value" :id="val.id" name="duration[]" :index="val.id" -->
                            <input type="checkbox" :value="val.value" :id="val.id" name="duration[]" v-model="val.checked" :disabled="val.disabled"/>
                        </td>
                        <td v-if="!disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true" @click="delDay"></span></td>
                    </tr>
                </tbody>
            </table>
            <span v-if="!disabled" class="glyphicon glyphicon-plus" aria-hidden="true" @click="addDay"></span>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'duration',
            'disabled',
        ],
        data: function() {
            return {
                durationArr: [],
                dis: false,
            }
        },
        mounted() {
            this.durationArr = this.getDurationArr();
            this.dis = this.disabled;
        },
        computed: {
            durationModel() {
                const disabled = this.dis ? true : null;
                var idx = 0;
                return this.durationArr.map(curr => {
                    return curr.map((row) => {
                        const checked = row === "1";
                        const value = idx++;
                        const id = idx;
                        return {
                            checked: checked,
                            value: value,
                            disabled: disabled,
                            id: id,
                        };
                    })
                })
            },
        },
        methods: {
            getDurationArr: function () {
                return this.duration.match(/\d{24}/g).reduce((accum, cur) => {
                    accum.push(cur.split(""));
                    return accum;
                }, []);
            },
            addDay(event) {
                if (this.durationModel.length > 0) {
                    this.durationArr.push(this.durationModel[this.durationModel.length - 1].map( el => (el.checked === true) ? "1" : "0"));
                } else {
                    this.durationArr.push(["0","0","0","0","0","0","0","0","0","1","1","1","1","0","1","1","1","1","1","0","0","0","0","0"]);
                }
            },
            delDay(event) {
                const tr = event.target.closest("tr");
                const idx = Array.from(tr.parentNode.children).indexOf(tr);
                this.durationArr.splice(idx, 1)
            }
        },
    }
</script>
