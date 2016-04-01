<style scoped>

</style>
<template>
	<div>
		<nav-bar></nav-bar>
		<main>
			<div class="row">
				<product v-for="product in products" track-by="$index" :product="product.id" :name="product.name"></product>
			</div>
			<ul class="pagination" v-if="filters.limit > pagination.max">
			    <li v-bind:class="left">
			    	<a v-on:click="page(-1)">
			    		<i class="material-icons">
			    			chevron_left
			    		</i>
			    	</a>
			    </li>
			    <li class="active">
			    	<a>
			    		{{ pagination.active }}
	    			</a>
				</li>
			    <li v-bind:class="right">
			    	<a v-on:click="page(1)">
			    		<i class="material-icons">
			    			chevron_right
		    			</i>
	    			</a>
				</li>
			 </ul>
		</main>
	</div>
</template>
<script> 
	export default {
		data() {
			return {
				products: [],
				filters: {
					limit: 25
				},
				pagination: {
					active: 1,
					max: 1,
					left: "disabled",
					right: "waves-effect"
				}
			}
		},
		created() {
			this.load();

		},
		methods: {
			load() {
				this.$http.get("/api/products").then(function(response){
                    this.products = response.data;
                    this.pagination.max = Math.round(response.data / this.filters.limit);
                });
			},
			page(number) {
				let page = this.pagination;
				
				if (page.active + number > 1) {
					page.active += number;
				}
				this.page.right = this.buttonClass(page, page.max);
				this.page.left = this.buttonClass(page, 1);
			},
			buttonClass(page, number) {
				if (page.active == number) {
					return "disabled";
				}
				return "waves-effect";
			}
		}
	}
</script>