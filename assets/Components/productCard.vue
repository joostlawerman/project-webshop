<style scoped lang="scss">

</style>
<template>
    <div class="col s12 m6 l4">
        <div class="card">    
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" v-on:click="loadInfo" src="http://materializecss.com/images/sample-1.jpg">
                <span class="card-title">
                    {{ name }}
                </span>
            </div>
            <div class="card-action">
                <a class="activator" v-on:click="loadInfo">More info</a>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">
                    {{ name }}<i class="material-icons right">close</i>
                </span>
                <p>
                    {{ data.info }}
                </p>
                <div class="card-action">
                    <a v-bind:v-link="makeVLink()">{{ data.price }}</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script> 
	export default {
        props: ["product", "name"],
		data(){
			return {
                data: {
                }
			}
		},
		created() {
		},
		methods: {
            makeApiLink() {
                return "/api/" + this.makeVLink();
            },
            makeVLink() {
                return "products/" + this.product;
            },
            loadInfo() {
                this.$http.get(this.makeApiLink()).then((response) => {
                    this.data = response.data;
                });
            }
		}
	}
</script>